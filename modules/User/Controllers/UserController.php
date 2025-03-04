<?php
namespace Modules\User\Controllers;

use App\Models\BookingAmendment;
use App\Models\BookingCancellation;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Matrix\Exception;
use Modules\Boat\Models\Boat;
use Modules\Booking\Events\BookingUpdatedEvent;
use Modules\Booking\Models\Service;
use Modules\Car\Models\Car;
use Modules\Event\Models\Event;
use Modules\Flight\Models\Flight;
use Modules\FrontendController;
use Modules\Hotel\Models\Hotel;
use Modules\Space\Models\Space;
use Modules\Tour\Models\Tour;
use Modules\User\Events\NewVendorRegistered;
use Modules\User\Events\UserSubscriberSubmit;
use Modules\User\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Vendor\Models\VendorRequest;
use Validator;
use Modules\Booking\Models\Booking;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Modules\Booking\Models\Enquiry;
use Illuminate\Support\Str;

class UserController extends FrontendController
{
    use AuthenticatesUsers;

    protected $enquiryClass;

    public function __construct()
    {
        $this->enquiryClass = Enquiry::class;
        parent::__construct();
    }

    public function dashboard(Request $request)
    {
        if(!$this->hasPermission('dashboard_vendor_access')) {

            $user_id = Auth::id();
            $user = User::find($user_id);
            $referrals = $user->referrals();
            $bookings = Booking::getBookingHistory($request->input('status'), $user_id,perpage: 5);

            $stats = [
                'bookings' => $bookings,
                'total_bookings' => $bookings->total(),
                'total_referrals' => $referrals->count(),
                'balance' => $user->balanceFloat,
                'transactions' => $user->transactions()->with(['payment','author'])->orderBy('id','desc')->take(5)->get()
            ];
            $currentYear = Carbon::now()->year;
                // $months = array_reverse($months);
                $months = [];
                for ($i = 1; $i <= 12; $i++) {
                    $month = Carbon::createFromDate(null, $i, 1)->format('M');
                    $months[] = $month;
                }
              // Get the booking data for each of the last 12 months
                $bookingData = \DB::table('bravo_bookings')
                    ->selectRaw("DATE_FORMAT(created_at, '%b') as month_name, COUNT(*) as total_bookings, SUM(total) as total_amount")
                    ->where('created_at', '>=', Carbon::now()->subYear())->where('customer_id', $user_id)
                    ->groupBy(\DB::raw("YEAR(created_at), MONTH(created_at)"))
                    ->orderBy(\DB::raw("YEAR(created_at), MONTH(created_at)"))
                    ->get()
                    ->keyBy('month_name');
               
                // Prepare data with totals for each month, using zero if there are no bookings for that month
                $bookingcount=0;
                $monthlyBookings = [];
                foreach ($months as $month) {
                  
                    $monthAbbr = Carbon::parse($month)->format('M');
                    $bookingcount += $bookingData->get($monthAbbr)->total_bookings??0;
                    $monthlyBookings[] =
                       // 'month' => $monthAbbr,
                        $bookingData->get($monthAbbr)->total_bookings ?? 0;
                        //'total_amount' => $bookingData->get($monthAbbr)->total_amount ?? 0,
                }
            
                    return view('user.dashboard', ['stats' => $stats,
                    'monthlyBookings'=>$monthlyBookings,'months'=>$months,'bookingcount'=>$bookingcount]);
             }
        $user_id = Auth::id();
        $data = [
            'cards_report'       => Booking::getTopCardsReportForVendor($user_id),
            'earning_chart_data' => Booking::getEarningChartDataForVendor(strtotime('monday this week'), time(), $user_id),
            'page_title'         => __("Vendor Dashboard"),
            'breadcrumbs'        => [
                [
                    'name'  => __('Dashboard'),
                    'class' => 'active'
                ]
            ]
        ];
        return view('User::frontend.dashboard', $data);
    }

    public function reloadChart(Request $request)
    {
        $chart = $request->input('chart');
        $user_id = Auth::id();
        switch ($chart) {
            case "earning":
                $from = $request->input('from');
                $to = $request->input('to');
                return $this->sendSuccess([
                    'data' => Booking::getEarningChartDataForVendor(strtotime($from), strtotime($to), $user_id)
                ]);
                break;
        }
    }

    public function profile(Request $request)
    {
        $user = Auth::user();
        $data = [
            'dataUser'         => $user,
            'page_title'       => __("Profile"),
            'breadcrumbs'      => [
                [
                    'name'  => __('Setting'),
                    'class' => 'active'
                ]
            ],
            'is_vendor_access' => $this->hasPermission('dashboard_vendor_access')
        ];
        return view('User::frontend.profile', $data);
    }

    public function profileUpdate(Request $request){
        if(is_demo_mode()){
            return back()->with('error',"Demo mode: disabled");
        }
        $user = Auth::user();
        $messages = [
            'user_name.required'      => __('The User name field is required.'),
        ];
        $request->validate([
            'first_name' => 'required|max:255',
            'last_name'  => 'required|max:255',
            'email'      => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id)
            ],
            'user_name'=> [
                'required',
                'max:255',
                'min:4',
                'string',
                'alpha_dash',
                Rule::unique('users')->ignore($user->id)
            ],
            'phone'       => [
                'required',
                Rule::unique('users')->ignore($user->id)
            ],
        ],$messages);
        $input = $request->except('bio');
        $user->fill($input);
        $user->bio = clean($request->input('bio'));
        $user->birthday = date("Y-m-d", strtotime($user->birthday));
        $user->user_name = Str::slug( $request->input('user_name') ,"_");
        $user->save();
        return redirect()->back()->with('success', __('Update successfully'));
    }

    public function bookingHistory(Request $request)
    {
        $user_id = Auth::id();
        $data = [
            'bookings'    => Booking::getBookingHistory($request->input('status'), $user_id),
            'statues'     => config('booking.statuses'),
            'breadcrumbs' => [
                [
                    'name'  => __('Booking History'),
                    'class' => 'active'
                ]
            ],
            'page_title'  => __("Booking History"),
        ];
        return view('User::frontend.bookingHistory', $data);
    }

    public function subscribe(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|max:255'
        ]);
        $check = Subscriber::withTrashed()->where('email', $request->input('email'))->first();
        if ($check) {
            if ($check->trashed()) {
                $check->restore();
                return $this->sendSuccess([], __('Thank you for subscribing'));
            }
            return $this->sendError(__('You are already subscribed'));
        } else {
            $a = new Subscriber();
            $a->email = $request->input('email');
            $a->first_name = $request->input('first_name');
            $a->last_name = $request->input('last_name');
            $a->save();

            event(new UserSubscriberSubmit($a));

            return $this->sendSuccess([], __('Thank you for subscribing'));
        }
    }

    public function upgradeVendor(Request $request){
        $user = Auth::user();
        $vendorRequest = VendorRequest::query()->where("user_id",$user->id)->where("status","pending")->first();
        if(!empty($vendorRequest)){
            return redirect()->back()->with('warning', __("You have just done the become vendor request, please wait for the Admin's approved"));
        }
        // check vendor auto approved
        $vendorAutoApproved = setting_item('vendor_auto_approved');
         $dataVendor['role_request'] = setting_item('vendor_role');
        if ($vendorAutoApproved) {
            if ($dataVendor['role_request']) {
                $user->assignRole($dataVendor['role_request']);
            }
            $dataVendor['status'] = 'approved';
            $dataVendor['approved_time'] = now();
        } else {
            $dataVendor['status'] = 'pending';
        }
        $vendorRequestData = $user->vendorRequest()->save(new VendorRequest($dataVendor));
        try {
            event(new NewVendorRegistered($user, $vendorRequestData));
        } catch (Exception $exception) {
            Log::warning("NewVendorRegistered: " . $exception->getMessage());
        }
        return redirect()->back()->with('success', __('Request vendor success!'));
    }



    public function permanentlyDelete(Request $request){
        if(is_demo_mode()){
            return back()->with('error',"Demo mode: disabled");
        }
        if(!empty(setting_item('user_enable_permanently_delete')))
        {
            $user = Auth::user();
            \DB::beginTransaction();
            try {
                Service::where('author_id',$user->id)->delete();
                Tour::where('author_id',$user->id)->delete();
                Car::where('author_id',$user->id)->delete();
                Space::where('author_id',$user->id)->delete();
                Hotel::where('author_id',$user->id)->delete();
                Event::where('author_id',$user->id)->delete();
                Boat::where('author_id',$user->id)->delete();
                Flight::where('author_id',$user->id)->delete();
                $user->sendEmailPermanentlyDelete();
                $user->delete();
                \DB::commit();
                Auth::logout();
                if(is_api()){
                    return $this->sendSuccess([],'Deleted');
                }
                return redirect(route('home'));
            }catch (\Exception $exception){
                \DB::rollBack();
            }
        }
        if(is_api()){
            return $this->sendError('Error. You can\'t permanently delete');
        }
        return back()->with('error',__('Error. You can\'t permanently delete'));

    }
    public function cancelBooking(Request $request,$is_return = false)
    {
        $booking_id = $request->input('booking_id');
        $module = Booking::find($booking_id);
        if(empty($module)){
            if($is_return){
                return $this->sendError(__("Booking not found"));
            }else{
                return redirect()->to(url()->previous() . '#review-form')->with('error', __('Booking not found'));
            }
        }



        $rules = [
            'user_message' => 'required|min:10'
        ];
        $messages = [
            'user_message.required' => __('Reason Content is required field'),
            'user_message.min'      => __('Reason Content has at least 10 character'),
        ];
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            if($is_return){
                return $this->sendError($validator->errors());
            }else{
                return redirect()->to(url()->previous() . '#review-form')->withErrors($validator->errors());
            }
        }
        BookingCancellation::create([
            'user_message' => $request->input('user_message'),
            'booking_id' => $module->id,
        ]);
        return redirect()->to(url()->previous() . '#bravo-reviews')->with('success', 'Booking Cancellation Request submitted successfully!');


    }

    public function amendBooking(Request $request,$is_return = false)
    {
        $booking_id = $request->input('booking_id');
        $module = Booking::find($booking_id);
        if(empty($module)){
            if($is_return){
                return $this->sendError(__("Booking not found"));
            }else{
                return redirect()->to(url()->previous() . '#review-form')->with('error', __('Booking not found'));
            }
        }



        $rules = [
            'user_message' => 'required|min:10',
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'arrival_date' => 'required',
            'arrival_time' => 'required',
            'departure_date' => 'required',
            'departure_time' => 'required',
            'vehicle_manufacture' => 'required',
            'vehicle_model' => 'required',
            'vehicle_registration' => 'required',
            'vehicle_color' => 'required',
            'flight_no' => 'required',

        ];
        $messages = [
            'user_message.required' => __('Reason Content is required field'),
            'user_message.min'      => __('Reason Content has at least 10 character'),
        ];
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            if($is_return){
                return $this->sendError($validator->errors());
            }else{
                return redirect()->to(url()->previous() . '#review-form')->withErrors($validator->errors());
            }
        }

        $changes = [];

        if ($request->first_name != $module->first_name) {
            $changes['first_name'] = [
                'old' => $module->first_name,
                'new' => $request->first_name
            ];
        }


        if ($request->last_name != $module->last_name) {
            $changes['last_name'] = [
                'old' => $module->last_name,
                'new' => $request->last_name
            ];
        }

        if ($request->phone != $module->phone) {
            $changes['phone'] = [
                'old' => $module->phone,
                'new' => $request->phone
            ];
        }

        if ($request->arrival_date != Carbon::parse($module->start_date)->toDateString()) {
            $changes['arrival_date'] = [
                'old' => Carbon::parse($module->start_date)->toDateString(),
                'new' => $request->arrival_date
            ];
        }

        if ($request->arrival_time != Carbon::parse($module->start_date)->toTimeString()) {
            $changes['arrival_time'] = [
                'old' => Carbon::parse($module->start_date)->toTimeString(),
                'new' => $request->arrival_time
            ];
        }

        if ($request->departure_date != Carbon::parse($module->end_date)->toDateString()) {
            $changes['departure_date'] = [
                'old' => Carbon::parse($module->end_date)->toDateString(),
                'new' => $request->departure_date
            ];
        }

        if ($request->departure_time != Carbon::parse($module->end_date)->toTimeString()) {
            $changes['departure_time'] = [
                'old' => Carbon::parse($module->end_date)->toTimeString(),
                'new' => $request->departure_time
            ];
        }

        if ($request->vehicle_manufacture != $module->vehicle_manufacture) {
            $changes['vehicle_manufacture'] = [
                'old' => $module->vehicle_manufacture,
                'new' => $request->vehicle_manufacture
            ];
        }

        if ($request->vehicle_model != $module->vehicle_model) {
            $changes['vehicle_model'] = [
                'old' => $module->vehicle_model,
                'new' => $request->vehicle_model
            ];
        }

        if ($request->vehicle_registration != $module->vehicle_registration) {
            $changes['vehicle_registration'] = [
                'old' => $module->vehicle_registration,
                'new' => $request->vehicle_registration
            ];
        }

        if ($request->vehicle_color != $module->vehicle_color) {
            $changes['vehicle_color'] = [
                'old' => $module->vehicle_color,
                'new' => $request->vehicle_color
            ];
        }

        if ($request->flight_no != $module->flight_no) {
            $changes['flight_no'] = [
                'old' => $module->flight_no,
                'new' => $request->flight_no
            ];
        }
        if(count($changes) ==0) {
            return redirect()->to(url()->previous() . '#review-form')->withErrors(['message' => 'Please add at least one amendment to continue']);
        }


        BookingAmendment::create([
            'user_message' => $request->input('user_message'),
            'data' => $changes,
            'booking_id' => $module->id,
        ]);
        return redirect()->to(url()->previous() . '#bravo-reviews')->with('success', 'Booking Amendment Request submitted successfully!');


    }


    public function updateCancellation(Request $request,$is_return = false)
    {
        $booking_id = $request->input('cancellation_id');
        $action = $request->input('action');

        $module = BookingCancellation::find($booking_id);
        if(empty($module)){
            if($is_return){
                return $this->sendError(__("Cancellation request not found"));
            }else{
                return redirect()->to(url()->previous() . '#review-form')->with('error', __('Booking not found'));
            }
        }

        if ($action === 'approved') {
            $booking = $module->booking;
            $booking->status = Booking::CANCELLED;
            $booking->save();
            event(new BookingUpdatedEvent($booking));

        }

        $rules = [
            'admin_message' => 'required|min:10'
        ];
        $messages = [
            'admin_message.required' => __('Reason Content is required field'),
            'admin_message.min'      => __('Reason Content has at least 10 character'),
        ];
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            if($is_return){
                return $this->sendError($validator->errors());
            }else{
                return redirect()->to(url()->previous() . '#review-form')->withErrors($validator->errors());
            }
        }
        $module->update([
            'admin_message' => $request->input('admin_message'),
            'status' => $action,
        ]);
        return redirect()->to(url()->previous() . '#bravo-reviews')->with('success', 'Booking Cancellation Request updated successfully!');


    }
    public function updateAmendment(Request $request,$is_return = false)
    {
        $booking_id = $request->input('amendment_id');
        $action = $request->input('action');

        $module = BookingAmendment::find($booking_id);
        if(empty($module)){
            if($is_return){
                return $this->sendError(__("Amendment request not found"));
            }else{
                return redirect()->to(url()->previous() . '#review-form')->with('error', __('Booking not found'));
            }
        }

        $rules = [
            'admin_message' => 'required|min:10',
            'price' => 'required|integer'
        ];
        $messages = [
            'admin_message.required' => __('Reply message/invoice item description is required field'),
            'admin_message.min'      => __('Reply message/invoice item description has at least 10 character'),
        ];
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            if($is_return){
                return $this->sendError($validator->errors());
            }else{
                return redirect()->to(url()->previous() . '#review-form')->withErrors($validator->errors());
            }
        }

        if ($action === 'approved') {
            $booking = $module->booking;
            if ($request->input('price') !=0) {
                $price = $booking->total - $booking->paid;
                $price += (float)$request->input('price');
                if (($price+$booking->paid)>$booking->paid) {
                    $booking->status = Booking::UNPAID;
                }
                $invoice = json_decode($booking->buyer_fees,true);
                $invoice[] = [
                    'name' => 'Amendment Fees',
                    'desc' => $request->input('admin_message'),
                    'price' => (float) $request->input('price'),
                    'unit' => 'fixed',
                    'type' => 'one_time',
                ];
                $booking->buyer_fees = $invoice;
                $booking->total = $price+$booking->paid;
                $booking->pay_now = $price;
            }
            $data = $module->data;
            foreach($data as $key => $field) {
                if(in_array($key,['arrival_date','departure_date','arrival_time','departure_time'])) {
                    continue;
                }
                $booking[$key] = $field['new'];
            }
            $start_date = Carbon::parse($booking->start_date);
            $end_date = Carbon::parse($booking->end_date);
            if(array_key_exists('arrival_date', $data)) {
                $date = Carbon::parse($data['arrival_date']['new']);
                $start_date->setDateFrom($date);
            }
            if(array_key_exists('arrival_time', $data)) {
                $time = $data['arrival_time']['new'];
                $start_date->setTimeFromTimeString($time);
            }
            if(array_key_exists('departure_date', $data)) {
                $date = Carbon::parse($data['departure_date']['new']);
                $end_date->setDateFrom($date);
            }
            if(array_key_exists('departure_time', $data)) {
                $time = $data['departure_time']['new'];
                $end_date->setTimeFromTimeString($time);
            }
            $booking->start_date = $start_date;
            $booking->end_date = $end_date;
            $booking->save();
            event(new BookingUpdatedEvent($booking));
        }

        $module->update([
            'admin_message' => $request->input('admin_message'),
            'status' => $action,
        ]);
        return redirect()->to(url()->previous() . '#bravo-reviews')->with('success', 'Booking Amendment Request updated successfully!');


    }

}
