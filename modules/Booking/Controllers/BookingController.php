<?php
namespace Modules\Booking\Controllers;

use App\Models\ReferralCommission;
use App\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Mockery\Exception;
use Modules\Booking\Events\BookingCreatedEvent;
use Modules\Booking\Events\BookingUpdatedEvent;
use Modules\Booking\Events\EnquirySendEvent;
use Modules\Booking\Events\SetPaidAmountEvent;
use Modules\Booking\Models\BookingPassenger;
use Modules\Space\Models\Space;
use Modules\User\Emails\RegisteredEmail;
use Modules\User\Events\SendMailUserRegistered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Booking\Models\Booking;
use Modules\Booking\Models\Enquiry;
use App\Helpers\ReCaptchaEngine;
use Jijunair\LaravelReferral\Models\Referral;
use Illuminate\Support\Facades\Cookie;

class BookingController extends \App\Http\Controllers\Controller
{
    use AuthorizesRequests;
    protected $booking;
    protected $enquiryClass;
    protected $bookingInst;

    public function __construct(Booking $booking, Enquiry $enquiryClass)
    {
        $this->booking = $booking;
        $this->enquiryClass = $enquiryClass;
    }

    protected function validateCheckout($code){

        if(!is_enable_guest_checkout() and !Auth::check()){
            $error = __("You have to login in to do this");
            if(\request()->isJson()){
                return $this->sendError($error)->setStatusCode(401);
            }
            return redirect(route('login',['redirect'=>\request()->fullUrl()]))->with('error',$error);
        }

        $booking = $this->booking::where('code', $code)->first();

        $this->bookingInst = $booking;

        if (empty($booking)) {
            abort(404);
        }
        if (!is_enable_guest_checkout() and $booking->customer_id != Auth::id()) {
            abort(404);
        }
        return true;
    }

    public function checkout($code)
    {
        $res = $this->validateCheckout($code);
        if($res !== true) return $res;

        $booking = $this->bookingInst;

        if ( !in_array($booking->status , ['draft','unpaid'])) {
            return redirect('/');
        }

        $is_api = request()->segment(1) == 'api';

        $data = [
            'page_title' => __('Checkout'),
            'booking'    => $booking,
            'service'    => $booking->service,
            'gateways'   => $this->getGateways(),
            'user'       => auth()->user(),
            'is_api'    =>  $is_api
        ];
        return view('Booking::frontend/checkout', $data);
    }

    public function checkStatusCheckout($code)
    {
        $booking = $this->booking::where('code', $code)->first();
        $data = [
            'error'    => false,
            'message'  => '',
            'redirect' => ''
        ];
        if (empty($booking)) {
            $data = [
                'error'    => true,
                'redirect' => url('/')
            ];
        }
        if (!is_enable_guest_checkout() and $booking->customer_id != Auth::id()) {
            $data = [
                'error'    => true,
                'redirect' => url('/')
            ];
        }
        if ( !in_array($booking->status , ['draft','unpaid'])) {
            $data = [
                'error'    => true,
                'redirect' => url('/')
            ];
        }
        return response()->json($data, 200);
    }
    protected function validateDoCheckout(){

        $request = \request();
        if(!is_enable_guest_checkout() and !Auth::check()){
            return $this->sendError(__("You have to login in to do this"))->setStatusCode(401);
        }

        if(auth()->user() && !auth()->user()->hasVerifiedEmail() && setting_item('enable_verify_email_register_user') == 1){
            return $this->sendError(__("You have to verify email first"), ['url' => url('/email/verify')]);
        }
        /**
         * @param Booking $booking
         */
        $validator = Validator::make($request->all(), [
            'code' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError('', ['errors' => $validator->errors()]);
        }
        $code = $request->input('code');

        $booking = $this->booking::where('code', $code)->first();
        $this->bookingInst = $booking;

        if (empty($booking)) {
            abort(404);
        }
        if (!is_enable_guest_checkout() and $booking->customer_id != Auth::id()) {
            abort(404);
        }
        return true;
    }
    public function payNow(Request $request) {
        $booking = Booking::findOrFail($request->id);
        $service = $booking->service;
        if (empty($service)) {
            return back()->with('error','Service not found');
        }
        $payment_gateway = 'stripe';
        $gateways = get_payment_gateways();
        if($booking->pay_now > 0){
            $gatewayObj = new $gateways[$payment_gateway]($payment_gateway);
            if (!empty($rules['payment_gateway'])) {
                if (empty($gateways[$payment_gateway]) or !class_exists($gateways[$payment_gateway])) {
                    return $this->back()->with('error',"Payment gateway not found");
                }
                if (!$gatewayObj->isAvailable()) {
                    return $this->back()->with('error',"Payment gateway is not available");
                }
            }
            $url = $gatewayObj->process2($request, $booking, $service);
            return redirect($url);
        }


    }

    public function doCheckout(Request $request)
    {
        /**
         * @var $booking Booking
         * @var $user User
         */
        $res = $this->validateDoCheckout();
        if($res !== true) return $res;
        $user = null;
        if(auth()->check()) {
            $user = User::find(auth()->user()->id);
        }
        $booking = $this->bookingInst;

        if ( !in_array($booking->status , ['draft','unpaid'])) {
            return $this->sendError('',[
                'url'=>$booking->getDetailUrl()
            ]);
        }
        $service = $booking->service;
        if (empty($service)) {
            return $this->sendError(__("Service not found"));
        }

        $is_api = request()->segment(1) == 'api';

        /**
         * Google ReCapcha
         */
        if(!$is_api and ReCaptchaEngine::isEnable() and setting_item("booking_enable_recaptcha")){
            $codeCapcha = $request->input('g-recaptcha-response');
            if(!$codeCapcha or !ReCaptchaEngine::verify($codeCapcha)){
                return $this->sendError(__("Please verify the captcha"));
            }
        }

        $messages = [];
        $rules = [
            'first_name'      => 'required|string|max:255',
            'last_name'       => 'required|string|max:255',
            'email'           => 'required|string|email|max:255',
            'phone'           => 'required|string|max:255',
            'country' => 'required',
            'term_conditions' => 'required',
            'vehicle_registration' => 'required',
            'vehicle_manufacture' => 'required',
            'vehicle_model' => 'required',
            'vehicle_color' => 'required',
            'flight_no' => 'required',
            'arrival_time' => '',
            'departure_time' => '',
        ];


        $confirmRegister = $request->input('confirmRegister');
        if(!empty($confirmRegister)){
            $rules['password'] = 'required|string|confirmed|min:6|max:255';
            $rules['email'] = ['required', 'email', 'max:255', Rule::unique('users')];
            $messages['password.confirmed']   =__('The password confirmation does not match');
            $messages['password.min']   = __('The password must be at least 6 characters');
        }

        $how_to_pay = $request->input('how_to_pay', '');
        $credit = $request->input('credit', 0);
        $payment_gateway = $request->input('payment_gateway');

        // require payment gateway except pay full
        if(empty(floatval($booking->deposit)) || $how_to_pay == 'deposit' || !auth()->check()){
            $rules['payment_gateway'] = 'required';
        }

        if(auth()->check()) {
            if ($credit > $user->balance) {
                return $this->sendError(__("Your credit balance is :amount", ['amount' => $user->balance]));
            }
        }else{
            // force credit to 0 if not login
            $credit = 0;
        }

        $rules = $service->filterCheckoutValidate($request, $rules);
        if (!empty($rules)) {

            $messages['term_conditions.required']    = __('Term conditions is required field');
            $messages['payment_gateway.required'] = __('Payment gateway is required field');

            $validator = Validator::make($request->all(), $rules , $messages );
            if ($validator->fails()) {
                return $this->sendError('', ['errors' => $validator->errors()]);
            }
        }

        $wallet_total_used = $credit;
        if($wallet_total_used > $booking->total){
            $credit = $booking->total;
            $wallet_total_used = $booking->total;
        }

        if($res = $service->beforeCheckout($request, $booking)){
            return $res;
        }

        if($how_to_pay=='full'and !empty($booking->deposit)){
            $booking->addMeta('old_deposit',$booking->deposit??0);
        }
        $oldDeposit = $booking->getMeta('old_deposit',0);
        if(empty(floatval($booking->deposit)) and !empty(floatval($oldDeposit))){
            $booking->deposit = $oldDeposit;
        }

        // Normal Checkout
        $booking->first_name = $request->input('first_name');
        $booking->last_name = $request->input('last_name');
        $booking->email = $request->input('email');
        $booking->phone = $request->input('phone');
        $booking->address = $request->input('address_line_1');
        $booking->address2 = $request->input('address_line_2');
        $booking->city = $request->input('city');
        $booking->state = $request->input('state');
        $booking->zip_code = $request->input('zip_code');
        $booking->country = $request->input('country');
        $booking->customer_notes = $request->input('customer_notes');
        $booking->vehicle_registration = $request['vehicle_registration'];
        $booking->vehicle_model = $request['vehicle_model'];
        $booking->vehicle_manufacture = $request['vehicle_manufacture'];
        $booking->vehicle_color = $request['vehicle_color'];
        $booking->flight_no = $request['flight_no'];

        if (isset($request['arrival_time'])) {
            $booking->start_date = Carbon::parse($booking->start_date)->setTimeFromTimeString($request['arrival_time']);
        }
        else {
            $booking->start_date = Carbon::parse($booking->start_date);
        }
        if (isset($request['departure_time'])) {
            $booking->end_date = Carbon::parse($booking->end_date)->setTimeFromTimeString($request['departure_time']);
        }
        else {
            $booking->end_date = Carbon::parse($booking->end_date);
        }

        $booking->gateway = $payment_gateway;
        $booking->wallet_credit_used = floatval($credit);
        $booking->wallet_total_used = floatval($wallet_total_used);
        $booking->pay_now = floatval((int)$booking->deposit == null ? $booking->total : (int)$booking->deposit);

        // If using credit
        if($booking->wallet_total_used > 0){
            if($how_to_pay == 'full'){
                $booking->deposit = 0;
                $booking->pay_now = $booking->total;
            }elseif($how_to_pay == 'deposit'){
                // case guest input credit more than "pay deposit" need to pay
                // Ex : pay deposit 10$ but guest input 20$ -> minus credit balance = 10$
                if($wallet_total_used > $booking->deposit){
                    $wallet_total_used = $booking->deposit;
                    $booking->wallet_total_used = floatval($wallet_total_used);
                    $booking->wallet_credit_used = $wallet_total_used;
                }

            }

            $booking->pay_now = max(0,$booking->pay_now - $wallet_total_used);
            $booking->paid = $booking->wallet_total_used;
        }else{
            if($how_to_pay == 'full'){
                $booking->deposit = 0;
                $booking->pay_now = $booking->total;
            }
        }

        $gateways = get_payment_gateways();
        if($booking->pay_now > 0){
            $gatewayObj = new $gateways[$payment_gateway]($payment_gateway);
            if (!empty($rules['payment_gateway'])) {
                if (empty($gateways[$payment_gateway]) or !class_exists($gateways[$payment_gateway])) {
                    return $this->sendError(__("Payment gateway not found"));
                }
                if (!$gatewayObj->isAvailable()) {
                    return $this->sendError(__("Payment gateway is not available"));
                }
            }
        }

        if($booking->wallet_credit_used && auth()->check()) {
            try {
                $transaction = $user->withdrawFloat($booking->wallet_credit_used, [
                    'wallet_total_used' => $booking->wallet_total_used,
                    'description' => 'Booking #'.$booking->reference_no
                ]);

            }catch (\Exception $exception){
                return $this->sendError($exception->getMessage());
            }

            $transaction->booking_id = $booking->id;
            $transaction->save();
            $booking->wallet_transaction_id = $transaction->id;
        }
        $booking->save();

//        event(new VendorLogPayment($booking));

        $referralCode = Cookie::get(config('referral.cookie_name'));
        $referrer = Referral::userByReferralCode($referralCode);
        if(Auth::check()) {
            $user->first_name = $request->input('first_name');
            $user->last_name = $request->input('last_name');
            $user->phone = $request->input('phone');
            $user->address = $request->input('address_line_1');
            $user->address2 = $request->input('address_line_2');
            $user->city = $request->input('city');
            $user->state = $request->input('state');
            $user->zip_code = $request->input('zip_code');
            $user->country = $request->input('country');
            $user->save();
        }else{
            $user = User::where('email',$request->input('email'))->first();

            $already = true;
            if($user == null) {
                $user = new User();
                $already = false;
            }

            $user->first_name = $request->input('first_name');
            $user->last_name = $request->input('last_name');
            $user->email = $request->input('email');
            $user->phone = $request->input('phone');
            $user->address = $request->input('address_line_1');
            $user->address2 = $request->input('address_line_2');
            $user->city = $request->input('city');
            $user->state = $request->input('state');
            $user->zip_code = $request->input('zip_code');
            $user->country = $request->input('country');
            $password = rand(0000000,99999999);
            $user->password = Hash::make($password);
            $user->status = 'publish';
            $user->save();
            // dd($user,$already,$user,$referrer);
            if($referrer != null) {
                $user->createReferralAccount($referrer->id);
            }
            $body = '<b>Hello '.$user->first_name.' '.$user->last_name.' </b><br><br>Thank you for signing up with Midlands Parking! We hope you enjoy your time with us. <br><br>Your Login credentials are below: <br>email: '.$user->email.' <br>password: '.$password.' <br><br>Regards,<br>Midlands Parking';
            Mail::to($user->email)->send(new RegisteredEmail($user, $body, 'customer'));
            event(new Registered($user));
            Auth::loginUsingId($user->id);
            try {
                event(new SendMailUserRegistered($user));
            } catch (\Matrix\Exception $exception) {
                Log::warning("SendMailUserRegistered: " . $exception->getMessage());
            }

            $user->assignRole(setting_item('user_role'));
        }

        $booking->customer_id = $user->id;
        $booking->save();

        $booking->addMeta('locale',app()->getLocale());
        $booking->addMeta('how_to_pay',$how_to_pay);

        // Save Passenger
        $this->savePassengers($booking,$request);

        if($res = $service->afterCheckout($request, $booking)){
            return $res;
        }

        if($booking->pay_now > 0) {
            try {
                $gatewayObj->process($request, $booking, $service);
            } catch (Exception $exception) {
                return $this->sendError($exception->getMessage());
            }
        }else{
            if($booking->paid < $booking->total){
                $booking->status = $booking::PARTIAL_PAYMENT;
            }else{
                $booking->status = $booking::PAID;
                if($user->hasReferralAccount()) {

                    $referrer = $user->referralAccount->referrer;
                    if($referrer != null) {
                        $referrer = User::find($referrer->id);

                        $check = ReferralCommission::where('user_id', $user->id)->where('referrer_id', $referrer->id)->first();
                        if ($check == null) {

                            $amount = ($booking->total / 100) * 10;
                            try {
                                $transaction = $referrer->depositFloat($amount, [
                                    'referral_commission' => $amount,
                                    'description' => 'Referral Commission for User:  ' . $user->id . ' on Booking #' . $booking->reference_no
                                ]);

                                ReferralCommission::create([
                                    'user_id' => $user->id,
                                    'referrer_id' => $referrer->id
                                ]);

                            } catch (\Exception $exception) {
                                return $this->sendError($exception->getMessage());
                            }
                        }
                    }
                }

            }

            if(!empty($booking->coupon_amount) and $booking->coupon_amount > 0 and $booking->total == 0){
                $booking->status = $booking::PAID;

            }

            $booking->save();
            event(new BookingCreatedEvent($booking));
            return $this->sendSuccess( [
                'url'=>$booking->getDetailUrl()
            ], __("You payment has been processed successfully"));
        }
    }

    protected function savePassengers(Booking $booking,Request $request){
        $booking->passengers()->delete();
        if($totalPassenger = $booking->calTotalPassenger())
        {
            $input = $request->input('passengers',[]);
            for($i = 1 ; $i <= $totalPassenger ; $i ++)
            {
                $passenger = new BookingPassenger();
                $data = [
                    'booking_id'=>$booking->id,
                    'first_name'=>$input[$i]['first_name'] ?? '',
                    'last_name'=>$input[$i]['last_name'] ?? '',
                    'email'=>$input[$i]['email'] ?? '',
                    'phone'=>$input[$i]['phone'] ?? '',
                ];
                $passenger->fillByAttr(array_keys($data),$data);
                $passenger->save();
            }
        }
    }
    public function confirmPayment(Request $request, $gateway)
    {

        $gateways = get_payment_gateways();
        if (empty($gateways[$gateway]) or !class_exists($gateways[$gateway])) {
            return $this->sendError(__("Payment gateway not found"));
        }
        $gatewayObj = new $gateways[$gateway]($gateway);
        if (!$gatewayObj->isAvailable()) {
            return $this->sendError(__("Payment gateway is not available"));
        }
        return $gatewayObj->confirmPayment($request);
    }

    public function callbackPayment(Request $request, $gateway)
    {
        $gateways = get_payment_gateways();
        if (empty($gateways[$gateway]) or !class_exists($gateways[$gateway])) {
            return $this->sendError(__("Payment gateway not found"));
        }
        $gatewayObj = new $gateways[$gateway]($gateway);
        if (!$gatewayObj->isAvailable()) {
            return $this->sendError(__("Payment gateway is not available"));
        }
        if(!empty($request->input('is_normal'))){
            return $gatewayObj->callbackNormalPayment();
        }
        return $gatewayObj->callbackPayment($request);
    }

    public function cancelPayment(Request $request, $gateway)
    {

        $gateways = get_payment_gateways();
        if (empty($gateways[$gateway]) or !class_exists($gateways[$gateway])) {
            return $this->sendError(__("Payment gateway not found"));
        }
        $gatewayObj = new $gateways[$gateway]($gateway);
        if (!$gatewayObj->isAvailable()) {
            return $this->sendError(__("Payment gateway is not available"));
        }
        return $gatewayObj->cancelPayment($request);
    }

    /**
     * @todo Handle Add To Cart Validate
     *
     * @param Request $request
     * @return string json
     */
    public function addToCart(Request $request)
    {
        if(!is_enable_guest_checkout() and !Auth::check()){
            return $this->sendError(__("You have to login in to do this"))->setStatusCode(401);
        }
        if(auth()->user() && !auth()->user()->hasVerifiedEmail() && setting_item('enable_verify_email_register_user')==1){
            return $this->sendError(__("You have to verify email first"), ['url' => url('/email/verify')]);
        }

        $validator = Validator::make($request->all(), [
            'service_id'   => 'required|integer',
            'service_type' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->sendError('', ['errors' => $validator->errors()]);
        }
        $service_type = $request->input('service_type');
        $service_id = $request->input('service_id');
        $allServices = get_bookable_services();
        if (empty($allServices[$service_type])) {
            return $this->sendError(__('Service type not found'));
        }
        $module = $allServices[$service_type];
        $service = $module::find($service_id);
        if (empty($service) or !is_subclass_of($service, '\\Modules\\Booking\\Models\\Bookable')) {
            return $this->sendError(__('Service not found'));
        }
        if (!$service->isBookable()) {
            return $this->sendError(__('Service is not bookable'));
        }

        if(Auth::id() == $service->author_id){
            return $this->sendError(__('You cannot book your own service'));
        }

        return $service->addToCart($request);
    }

    public function getGateways()
    {

        $all = get_payment_gateways();
        $res = [];
        foreach ($all as $k => $item) {
            if (class_exists($item)) {
                $obj = new $item($k);
                if ($obj->isAvailable()) {
                    $res[$k] = $obj;
                }
            }
        }
        return $res;
    }

    public function detail(Request $request, $code)
    {
        if(!is_enable_guest_checkout() and !Auth::check()){
            return $this->sendError(__("You have to login in to do this"))->setStatusCode(401);
        }

        $booking = $this->booking::where('code', $code)->first();
        if (empty($booking)) {
            abort(404);
        }

        if ($booking->status == 'draft') {
            return redirect($booking->getCheckoutUrl());
        }
        if (!is_enable_guest_checkout() and $booking->customer_id != Auth::id()) {
            abort(404);
        }
        $data = [
            'page_title' => __('Booking Details'),
            'booking'    => $booking,
            'service'    => $booking->service,
        ];
        if ($booking->gateway) {
            $data['gateway'] = get_payment_gateway_obj($booking->gateway);
        }
        return view('Booking::frontend/detail', $data);
    }

	public function exportIcal($type, $id=false)
	{
	    if(empty($type) or empty($id)){
            return $this->sendError(__('Service not found'));
        }

		$allServices = get_bookable_services();
		$allServices['room']='Modules\Hotel\Models\HotelRoom';
		if (empty($allServices[$type])) {
            return $this->sendError(__('Service type not found'));
		}
		$module = $allServices[$type];

		$path ='/ical/';
		$fileName = 'booking_' . $type . '_' . $id . '.ics';
		$fullPath = $path.$fileName;

		$content  = $this->booking::getContentCalendarIcal($type,$id,$module);
		Storage::disk('uploads')->put($fullPath, $content);
		$file = Storage::disk('uploads')->get($fullPath);

		header('Content-Type: text/calendar; charset=utf-8');
		header('Content-Disposition: attachment; filename="' . $fileName . '"');

		echo $file;
	}

	public function addEnquiry(Request $request){
        $rules =  [
            'service_id'   => 'required|integer',
            'service_type' => 'required',
            'enquiry_name' => 'required',
            'enquiry_note' => 'required',
            'enquiry_phone' => 'required',
            'enquiry_email' => [
                'required',
                'email',
                'max:255',
            ],
        ];

        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            return $this->sendError('', ['errors' => $validator->errors()]);
        }

        if(setting_item('booking_enquiry_enable_recaptcha')){
            $codeCapcha = trim($request->input('g-recaptcha-response'));
            if(empty($codeCapcha) or !ReCaptchaEngine::verify($codeCapcha)){
                return $this->sendError(__("Please verify the captcha"));
            }
        }

        $service_type = $request->input('service_type');
        $service_id = $request->input('service_id');
        $allServices = get_bookable_services();
        if (empty($allServices[$service_type])) {
            return $this->sendError(__('Service type not found'));
        }
        $module = $allServices[$service_type];
        $service = $module::find($service_id);
        if (empty($service) or !is_subclass_of($service, '\\Modules\\Booking\\Models\\Bookable')) {
            return $this->sendError(__('Service not found'));
        }
        $row = new $this->enquiryClass();
        $row->fill([
            'name'=>$request->input('enquiry_name'),
            'email'=>$request->input('enquiry_email'),
            'phone'=>$request->input('enquiry_phone'),
            'note'=>$request->input('enquiry_note'),
        ]);
        $row->object_id = $request->input("service_id");
        $row->object_model = $request->input("service_type");
        $row->status = "pending";
        $row->vendor_id = $service->author_id;
        $row->save();
        event(new EnquirySendEvent($row));
        return $this->sendSuccess([
            'message' => __("Thank you for contacting us! We will be in contact shortly.")
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function setPaidAmount(Request $request){
        $rules =  [
            'remain'   => 'required|integer',
            'id' => 'required'
        ];

        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            return $this->sendError('', ['errors' => $validator->errors()]);
        }


        $id = $request->input('id');
        $remain = floatval($request->input('remain'));

        if($remain < 0){
            return $this->sendError(__('Remain can not smaller than 0'));
        }

        $booking = Booking::where('id', $id)->first();
        if (empty($booking)) {
            return $this->sendError(__('Booking not found'));
        }

        if($booking->vendor_id != Auth()->id()){
            return $this->sendError(__("You don't have access."));
        }

        if(!Auth::user()->hasPermission('dashboard_vendor_access')){
            return $this->sendError(__("You don't have access."));
        }

        $booking->pay_now = $remain;
        $booking->paid = floatval($booking->total) - $remain;
        event(new SetPaidAmountEvent($booking));
        if($remain == 0){
            $booking->status = $booking::PAID;
//            $booking->sendStatusUpdatedEmails();
            event(new BookingUpdatedEvent($booking));
        }

        $booking->save();

        return $this->sendSuccess([
            'message' => __("You booking has been changed successfully")
        ]);
    }

    public function modal(Booking $booking){
        if(!is_admin() and $booking->vendor_id != auth()->id() and $booking->customer_id != auth()->id()) abort(404);

        return view('Booking::frontend.detail.modal',['booking'=>$booking,'service'=>$booking->service]);
    }

    public function append(Booking $booking){
        if(!is_admin() and $booking->vendor_id != auth()->id() and $booking->customer_id != auth()->id()) abort(404);

        return view('Booking::frontend.detail.edit',['booking'=>$booking,'spaces' => Space::all(), 'customers' => User::where('role_id',3)->get(),]);
    }
}
