<?php
namespace Modules\Report\Admin;

use App\Models\BookingCancellation;
use App\Models\BookingUpdateReason;
use App\Models\DriverNotifications;
use App\Models\ParsedEmails;
use App\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Modules\AdminController;
use Modules\Booking\Emails\NewBookingEmail;
use Modules\Booking\Events\BookingUpdatedEvent;
use Modules\Booking\Models\Booking;
use Modules\Space\Models\Space;

class BookingController extends AdminController
{
    public function __construct()
    {
        $this->setActiveMenu(route('report.admin.booking'));
    }

    public function cancellations(Request $request) {
        $cancellations = Booking::has('cancellation_requests')
            ->with('cancellation_requests') // Optional: If you want to eager load the cancellations
            ->paginate(10);
        return view('Report::admin.booking.cancellations', ['rows' => $cancellations]);
    }
    public function amendments(Request $request) {
        $cancellations = Booking::has('amendment_requests')
            ->with('amendment_requests') // Optional: If you want to eager load the cancellations
            ->paginate(10);
        return view('Report::admin.booking.amendments', ['rows' => $cancellations]);
    }

    public function index(Request $request)
    {
        $this->checkPermission('booking_view');
        if(!$this->hasPermission('contact_manage')) {
            $query = Booking::where('status', '!=', 'draft')
                ->where(function ($query) {
                    $query->whereBetween('start_date', [
                        now()->subWeeks(3)->startOfDay(),
                        now()->addWeeks(3)->endOfDay()
                    ])->orWhereBetween('end_date', [
                        now()->subWeeks(3)->startOfDay(),
                        now()->addWeeks(3)->endOfDay()
                    ]);
                });
            //$query = Booking::where('status', '!=', 'draft')->whereBetween('created_at',[Carbon::now()->subWeeks(3),Carbon::now()->addWeeks(3)]);
        }
        else {
            $query = Booking::where('status', '!=', 'draft');
        }
        if (!empty($request->s)) {
            if( is_numeric($request->s) ){
                $query->Where('id', '=', $request->s);
            }else{
                $query->where(function ($query) use ($request) {
                    $query->where('first_name', 'like', '%' . $request->s . '%')
                        ->orWhere('last_name', 'like', '%' . $request->s . '%')
                        ->orWhere('email', 'like', '%' . $request->s . '%')
                        ->orWhere('phone', 'like', '%' . $request->s . '%')
                        ->orWhere('address', 'like', '%' . $request->s . '%')
                        ->orWhere('address2', 'like', '%' . $request->s . '%');
                });
            }
        }

        if (!empty($request->reference)) {
            $query->where('reference_no', 'like', '%' . $request->reference . '%');
        }

        if (!empty($request->registration)) {
            $query->where('vehicle_registration', 'like', '%' . $request->registration . '%');
        }

        if (!empty($request->make)) {
            $query->where('vehicle_manufacture', 'like', '%' . $request->make . '%');
        }

        if (!empty($request->model)) {
            $query->where('vehicle_model', 'like', '%' . $request->model . '%');
        }

        if (!empty($request->arrival)) {
            $range = $request->arrival;
            $range = explode('-', $range);
            $start = Carbon::parse($range[0]);
            $end = Carbon::parse($range[1])->addDay();
            $query->whereBetween('start_date',[$start,$end]);
        }

        if (!empty($request->departure)) {
            $range = $request->departure;
            $range = explode('-', $range);
            $start = Carbon::parse($range[0]);
            $end = Carbon::parse($range[1])->addDay();
            $query->whereBetween('end_date',[$start,$end]);
        }

        if (!empty($request->booking_date)) {
            $range = $request->booking_date;
            $range = explode('-', $range);
            $start = Carbon::parse($range[0]);
            $end = Carbon::parse($range[1])->addDay();
            $query->whereBetween('created_at',[$start,$end]);
        }

        if (!empty($request->supplier)) {
            if($request->supplier !='ema') {
                $query->where('customer_id',$request->supplier);
            }
            else {
                $booking_agents = User::where('role_id',3)->where('booking_agent',true)->pluck('id');
                $query->whereNotIn('customer_id',$booking_agents);
            }

        }


        if ($this->hasPermission('booking_manage_others')) {
            if (!empty($request->vendor_id)) {
                $query->where('vendor_id', $request->vendor_id);
            }
        } else {
            $query->where('vendor_id', Auth::id());
        }
        $query->whereIn('object_model', array_keys(get_bookable_services()));
        if (!empty($request->status)) {
            $query->where('status', '!=', 'cancelled');
        }

        $sort = $request->sort;
        switch ($sort) {
            case 'arrival_asc':
                $query->orderBy('start_date','ASC');
            case 'arrival_desc':
                $query->orderBy('start_date','DESC');
            case 'return_asc':
                $query->orderBy('end_date','ASC');
            case 'return_desc':
                $query->orderBy('end_date','DESC');
            default:
                $query->orderBy('id','desc');
        }

        $data = [
            'all' => $query->pluck('id'),
            'rows'                  => $query->paginate(20),
            'page_title'            => __("All Bookings"),
            'booking_manage_others' => $this->hasPermission('booking_manage_others'),
            'booking_update'        => $this->hasPermission('booking_update'),
            'statues'               => config('booking.statuses'),
            'spaces' => Space::all(),
            'customers' => User::where('role_id',3)->get(),
        ];
        return view('Report::admin.booking.index', $data);
    }

    public function priority(Request $request)
    {
        $this->checkPermission('booking_view');
        if(!$this->hasPermission('contact_manage')) {
            $query = Booking::where('priority','active')->whereBetween('created_at',[Carbon::now()->subWeeks(3),Carbon::now()->addWeeks(3)]);
        }
        else {
            $query = Booking::where('priority','active');
        }
        /*$query->;*/
        if (!empty($request->s)) {
            if( is_numeric($request->s) ){
                $query->Where('id', '=', $request->s);
            }else{
                $query->where(function ($query) use ($request) {
                    $query->where('first_name', 'like', '%' . $request->s . '%')
                        ->orWhere('last_name', 'like', '%' . $request->s . '%')
                        ->orWhere('email', 'like', '%' . $request->s . '%')
                        ->orWhere('phone', 'like', '%' . $request->s . '%')
                        ->orWhere('address', 'like', '%' . $request->s . '%')
                        ->orWhere('address2', 'like', '%' . $request->s . '%');
                });
            }
        }

        if (!empty($request->reference)) {
            $query->where('reference_no', 'like', '%' . $request->reference . '%');
        }

        if (!empty($request->registration)) {
            $query->where('vehicle_registration', 'like', '%' . $request->registration . '%');
        }

        if (!empty($request->make)) {
            $query->where('vehicle_manufacture', 'like', '%' . $request->make . '%');
        }

        if (!empty($request->model)) {
            $query->where('vehicle_model', 'like', '%' . $request->model . '%');
        }

        if (!empty($request->arrival)) {
            $range = $request->arrival;
            $range = explode('-', $range);
            $start = Carbon::parse($range[0]);
            $end = Carbon::parse($range[1])->addDay();
            $query->whereBetween('start_date',[$start,$end]);
        }

        if (!empty($request->departure)) {
            $range = $request->departure;
            $range = explode('-', $range);
            $start = Carbon::parse($range[0]);
            $end = Carbon::parse($range[1])->addDay();
            $query->whereBetween('end_date',[$start,$end]);
        }

        if (!empty($request->booking_date)) {
            $range = $request->booking_date;
            $range = explode('-', $range);
            $start = Carbon::parse($range[0]);
            $end = Carbon::parse($range[1])->addDay();
            $query->whereBetween('created_at',[$start,$end]);
        }


        if ($this->hasPermission('booking_manage_others')) {
            if (!empty($request->vendor_id)) {
                $query->where('vendor_id', $request->vendor_id);
            }
        } else {
            $query->where('vendor_id', Auth::id());
        }
        $query->whereIn('object_model', array_keys(get_bookable_services()));


        $sort = $request->sort;
        switch ($sort) {
            case 'arrival_asc':
                $query->orderBy('start_date','ASC');
            case 'arrival_desc':
                $query->orderBy('start_date','DESC');
            case 'return_asc':
                $query->orderBy('end_date','ASC');
            case 'return_desc':
                $query->orderBy('end_date','DESC');
            default:
                $query->orderBy('id','desc');
        }

        $data = [
            'all' => $query->pluck('id'),
            'rows'                  => $query->paginate(20),
            'page_title'            => __("Priotized Bookings"),
            'booking_manage_others' => $this->hasPermission('booking_manage_others'),
            'booking_update'        => $this->hasPermission('booking_update'),
            'statues'               => config('booking.statuses'),
            'spaces' => Space::all(),

            //'customers' => User::where('role_id',3)->get(),
        ];
        return view('Report::admin.booking.priority', $data);
    }
    public function priorityComplete(Request $request)
    {
        $this->checkPermission('booking_view');
        if(!$this->hasPermission('contact_manage')) {
            $query = Booking::where('priority','complete')->whereBetween('created_at',[Carbon::now()->subWeeks(3),Carbon::now()->addWeeks(3)]);
        }
        else {
            $query = Booking::where('priority','complete');
        }
        /*$query->;*/
        if (!empty($request->s)) {
            if( is_numeric($request->s) ){
                $query->Where('id', '=', $request->s);
            }else{
                $query->where(function ($query) use ($request) {
                    $query->where('first_name', 'like', '%' . $request->s . '%')
                        ->orWhere('last_name', 'like', '%' . $request->s . '%')
                        ->orWhere('email', 'like', '%' . $request->s . '%')
                        ->orWhere('phone', 'like', '%' . $request->s . '%')
                        ->orWhere('address', 'like', '%' . $request->s . '%')
                        ->orWhere('address2', 'like', '%' . $request->s . '%');
                });
            }
        }

        if (!empty($request->reference)) {
            $query->where('reference_no', 'like', '%' . $request->reference . '%');
        }

        if (!empty($request->registration)) {
            $query->where('vehicle_registration', 'like', '%' . $request->registration . '%');
        }

        if (!empty($request->make)) {
            $query->where('vehicle_manufacture', 'like', '%' . $request->make . '%');
        }

        if (!empty($request->model)) {
            $query->where('vehicle_model', 'like', '%' . $request->model . '%');
        }

        if (!empty($request->arrival)) {
            $range = $request->arrival;
            $range = explode('-', $range);
            $start = Carbon::parse($range[0]);
            $end = Carbon::parse($range[1])->addDay();
            $query->whereBetween('start_date',[$start,$end]);
        }

        if (!empty($request->departure)) {
            $range = $request->departure;
            $range = explode('-', $range);
            $start = Carbon::parse($range[0]);
            $end = Carbon::parse($range[1])->addDay();
            $query->whereBetween('end_date',[$start,$end]);
        }

        if (!empty($request->booking_date)) {
            $range = $request->booking_date;
            $range = explode('-', $range);
            $start = Carbon::parse($range[0]);
            $end = Carbon::parse($range[1])->addDay();
            $query->whereBetween('created_at',[$start,$end]);
        }


        if ($this->hasPermission('booking_manage_others')) {
            if (!empty($request->vendor_id)) {
                $query->where('vendor_id', $request->vendor_id);
            }
        } else {
            $query->where('vendor_id', Auth::id());
        }
        $query->whereIn('object_model', array_keys(get_bookable_services()));


        $sort = $request->sort;
        switch ($sort) {
            case 'arrival_asc':
                $query->orderBy('start_date','ASC');
            case 'arrival_desc':
                $query->orderBy('start_date','DESC');
            case 'return_asc':
                $query->orderBy('end_date','ASC');
            case 'return_desc':
                $query->orderBy('end_date','DESC');
            default:
                $query->orderBy('id','desc');
        }

        $data = [
            'all' => $query->pluck('id'),
            'rows'                  => $query->paginate(20),
            'page_title'            => __("Priotized Bookings"),
            'booking_manage_others' => $this->hasPermission('booking_manage_others'),
            'booking_update'        => $this->hasPermission('booking_update'),
            'statues'               => config('booking.statuses'),
            'spaces' => Space::all(),

            //'customers' => User::where('role_id',3)->get(),
        ];
        return view('Report::admin.booking.priority', $data);
    }

    public function drafts(Request $request) {
        $this->checkPermission('booking_view');
        $query = Booking::where('status', 'draft');
        if (!empty($request->s)) {
            if( is_numeric($request->s) ){
                $query->Where('id', '=', $request->s);
            }else{
                $query->where(function ($query) use ($request) {
                    $query->where('first_name', 'like', '%' . $request->s . '%')
                        ->orWhere('last_name', 'like', '%' . $request->s . '%')
                        ->orWhere('email', 'like', '%' . $request->s . '%')
                        ->orWhere('phone', 'like', '%' . $request->s . '%')
                        ->orWhere('address', 'like', '%' . $request->s . '%')
                        ->orWhere('address2', 'like', '%' . $request->s . '%');
                });
            }
        }

        if (!empty($request->reference)) {
            $query->where('reference_no', 'like', '%' . $request->reference . '%');
        }

        if (!empty($request->arrival)) {
            $range = $request->arrival;
            $range = explode('-', $range);
            $start = Carbon::parse($range[0]);
            $end = Carbon::parse($range[1])->addDay();
            $query->whereBetween('start_date',[$start,$end]);
        }

        if (!empty($request->departure)) {
            $range = $request->departure;
            $range = explode('-', $range);
            $start = Carbon::parse($range[0]);
            $end = Carbon::parse($range[1])->addDay();
            $query->whereBetween('end_date',[$start,$end]);
        }

        if (!empty($request->booking_date)) {
            $range = $request->booking_date;
            $range = explode('-', $range);
            $start = Carbon::parse($range[0]);
            $end = Carbon::parse($range[1])->addDay();
            $query->whereBetween('created_at',[$start,$end]);
        }


        if ($this->hasPermission('booking_manage_others')) {
            if (!empty($request->vendor_id)) {
                $query->where('vendor_id', $request->vendor_id);
            }
        } else {
            $query->where('vendor_id', Auth::id());
        }
        $query->whereIn('object_model', array_keys(get_bookable_services()));
        $query->orderBy('id','desc');
        $data = [
            'all' => $query->pluck('id'),
            'rows'                  => $query->paginate(20),
            'page_title'            => __("All Bookings"),
            'booking_manage_others' => $this->hasPermission('booking_manage_others'),
            'booking_update'        => $this->hasPermission('booking_update'),
            'statues'               => config('booking.statuses'),
            'spaces' => Space::all(),

            //'customers' => User::where('role_id',3)->get(),
        ];
        return view('Report::admin.booking.index', $data);
    }

    public function import(Request $request)
    {
        $this->checkPermission('booking_manage_others');
        $data = [
            'page_title'            => __("All Bookings"),
            'booking_manage_others' => $this->hasPermission('booking_manage_others'),
            'booking_update'        => $this->hasPermission('booking_update'),
        ];
        return view('Report::admin.booking.import', $data);
    }

    public function run_import(Request $request) {
        $this->checkPermission('booking_manage_others');
        //save the file to disk
        $path = $request->file('import')->store('/import_bookings', 'public');
        try {
            $csv_data = [];
            if (($open = fopen(Storage::disk('public')->path($path), "r")) !== FALSE) {
                while (($data = fgetcsv($open, 1000, ",")) !== FALSE) {
                    $csv_data[] = $data;
                }
                fclose($open);
            }

            $duplicates = 0;
            $errors = [];
            $errors_table = [];
            $successful = 0;
            foreach ($csv_data as  $index => $row) {
                if($index == 0)
                    continue; //Ignore header row
                $validation_rules = [
                    '0' => 'required | unique:bravo_bookings,reference_no',
                    '1' => 'required ',
                    '2' => 'required ',
                    '3' => 'required ',
                    '4' => 'required',
                    '5' => 'required',
                    '6' => 'required',
                    '7' => 'required',
                    '8' => 'required',
                    '9' => 'required|numeric',
                    '10' => 'required',
                    '11' => 'required',
                    '13' => 'required',
                ];

                $messages = array(
                    '0.required' => 'Reference number is required',
                    '0.unique' => 'Reference number already found',
                    '1.required' => 'Booking date & time is required',
                    '2.required' => 'Arrival date & time is required',
                    '3.required' => 'Departure date & time is required',
                    '3.unique' => 'Phone number already exists',
                    '4.required' => 'Vehicle make is required',
                    '5.required' => 'Vehicle model is required',
                    '6.required' => 'Vehicle registration number is required',
                    '7.required' => 'Vehicle color is required',
                    '8.required' => 'Product is required',
                    '9.required' => 'Price is required',
                    '10.required' => 'Booking Agent is required',
                    '11.required' => 'Firstname is required',
                    '13.required' => 'Phone number is required',
                );
                $messages_duplicates = [
                    'Reference number already found',
                ];
                $validator = Validator::make($row, $validation_rules, $messages);

                if ($validator->fails()) {
                    //if(in_array($validator->errors()->first(),$messages_duplicates)) {
                    if (count(array_intersect($validator->errors()->all(), $messages_duplicates)) > 0) {
                        $duplicates+=1;
                        $error = [
                            'error' => $validator->errors()->all(),
                            'row' => $row
                        ];
                        $errors_table[] = $error;
                        continue;
                    }
                    else {
                        $error = [
                            'error' => $validator->errors()->all(),
                            'row' => $row
                        ];
                        $errors[] = $error;
                        $errors_table[] = $error;
                        continue;
                    }
                }

                if ($row[10] == 'Trusted Travel') {
                    $customer_id = 6;
                }
                elseif ($row[10] == 'Sky Parking Services') {
                    $customer_id = 7;
                }
                else {
                    $customer_id = 3;
                }

                $data = [
                    'start_date' => Carbon::parse($row[2]),
                    'end_date' => Carbon::parse($row[3]),
                    'reference_no' => $row[0],
                    'object_model' => 'space',
                    'object_id' => 14,
                    'total' => $row[9],
                    'status' => 'confirmed',
                    'first_name' => $row[11],
                    'last_name' => $row[12],
                    'customer_id' => $customer_id,
                    'total_guests' => 1,
                    'commission' => '0.00',
                    'coupon_amount' => "0.00",
                    'total_before_discount' => $row[9],
                    'total_before_fees' => $row[9],
                    'create_user' => \auth()->user()->id,
                    'vehicle_registration' => $row[6],
                    'vehicle_model' => $row[5],
                    'vehicle_manufacture' => $row[4],
                    'vehicle_color' => $row[7],
                    'email' => $row[14],
                    'phone' => $row[13],
                    'address' => $row[15],
                    'address2' => $row[16],
                    'city' => $row[17],
                    'state' => $row[18],
                    'zip_code' => $row[19],
                    'country' => $row[20],
                    'created_at' => $row[1],
                ];

                $booking = Booking::create($data);

                if($booking->id != null) {
                    $successful +=1;
                }

            }

            if(!empty($errors)) {
                return back()->with('error_table' , $errors_table)->withErrors(['import' => '('.count($errors).') bookings failed to import due to missing information while other ('.$successful.') bookings imported successfully & found ('.$duplicates.') duplicates']);
            }
            else if($duplicates > 0) {
                if($successful >0) {
                    return back()->with('error_table' , $errors_table)->withErrors(['import' => "We found (".$duplicates.") duplicates that were not imported , however the other (".$successful.") bookings were imported successfully"]);
                }
                else {
                    return back()->with('error_table' , $errors_table)->withErrors(['import' => "We found ".$duplicates." duplicates that were not uploaded"]);
                }
            }
            else {
                return redirect()->route('report.admin.booking')->with('success','All ('.$successful.') bookings Imported Successfully.');
            }
        }
        catch (\Exception $e) {
            return back()->withErrors(['import' => $e->getMessage()]);
        }
    }

    public function bulkEdit(Request $request)
    {
        $ids = $request->input('ids');
        $action = $request->input('action');
        if (empty($ids) or !is_array($ids)) {
            return redirect()->back()->with('error', __('No items selected'));
        }
        if (empty($action)) {
            return redirect()->back()->with('error', __('Please select action'));
        }
        if ($action == "delete") {
            foreach ($ids as $id) {
                $query = Booking::where("id", $id);
                if (!$this->hasPermission('booking_manage_others')) {
                    $query->where("vendor_id", Auth::id());
                }
                $row = $query->first();
                if(!empty($row)){
                    $row->delete();
                    event(new BookingUpdatedEvent($row));

                }
            }
        } else {
            foreach ($ids as $id) {
                $query = Booking::where("id", $id);
                if (!$this->hasPermission('booking_manage_others')) {
                    $query->where("vendor_id", Auth::id());
                    $this->checkPermission('booking_update');
                }
                $item = $query->first();
                if(!empty($item)){
                    $item->status = $action;
                    $item->save();

                    if($action == Booking::CANCELLED) $item->tryRefundToWallet();
                    event(new BookingUpdatedEvent($item));
                }
            }
        }
        return redirect()->back()->with('success', __('Update success'));
    }

    public function parsing(Request $request)
    {
        $this->checkPermission('booking_manage_others');
        $data = [
            'page_title'            => __("Parsing Report"),
            'booking_manage_others' => $this->hasPermission('booking_manage_others'),
            'booking_update'        => $this->hasPermission('booking_update'),
            'rows' => ParsedEmails::orderBy('id','DESC')->paginate(20),
        ];
        return view('Report::admin.booking.parsing', $data);
    }

    public function retry_parsing($id) {
        $parsing = ParsedEmails::findOrFail($id);
        $parsing->status = 'pending';
        $parsing->save();
        return redirect()->back()->with('success', __('Parsing successfully queued to retry.'));
    }

    public function email_preview(Request $request, $id)
    {
        $booking = Booking::find($id);
        return (new NewBookingEmail($booking))->render();
    }

    public function checkIn($id, Request $request) {
        $date = $request->validate(['date' => 'date|required', 'driver'=>'required']);
        $booking = Booking::findOrFail($id);
        $booking['collection_time'] = Carbon::parse($date['date'])->format('m/d/Y H:i');
        $booking['collection_driver'] = $date['driver'];
        $booking->save();
        return redirect()->back()->with('success', __('Check-in successful'));
    }
    public function priortize($id, Request $request) {
        $booking = Booking::findOrFail($id);
        $booking['priority']='active';
        $booking->save();
        $not= new DriverNotifications();
        $not['message']='New Priotized Booking #'. $booking->id;
        $not['url']=route('report.admin.booking.priority').'?&reference='.$booking->reference_no;
        $not->save();
        return redirect()->back()->with('success', __('Priotize successful'));

    }
    public function complete($id, Request $request) {
        $booking = Booking::findOrFail($id);
        $booking['priority']='complete';
        $booking->save();
        return redirect()->back()->with('success', __('Priotize complete successful'));
    }
    public function repriortize($id, Request $request) {
        $booking = Booking::findOrFail($id);
        $booking['priority']='active';
        $booking->save();
        return redirect()->back()->with('success', __('Re priotize  successful'));
    }

    public function checkOut($id, Request $request) {
        $date = $request->validate(['date' => 'date', 'driver'=>'required']);
        $booking = Booking::findOrFail($id);
        $booking['return_time'] = Carbon::parse($date['date'])->format('m/d/Y H:i');
        $booking['return_driver'] = $date['driver'];
        $booking->save();
        return redirect()->back()->with('success', __('Check-out successful'));
    }

    public function store(Request $request) {
        $request->validate(
            [
                'arrival' => 'required|date',
                'booking_date' => 'required|date',
                'departure' => 'required|date',
                'reference' => 'required',
                'vehicle_registration' => 'required',
                'vehicle_manufacture' => 'required',
                'vehicle_model' => 'required',
                'vehicle_color' => 'required',
                'object_id' => 'required',
                'customer_id' => 'required',
                'price' => 'required',
                'first_name' => 'required',
            ]
        );

        $data = [
            'start_date' => $request['arrival'],
            'end_date' => $request['departure'],
            'reference_no' => $request['reference'],
            'object_model' => 'space',
            'object_id' => $request['object_id'],
            'total' => $request['price'],
            'status' => 'confirmed',
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'customer_id' => $request['customer_id'],
            'total_guests' => 1,
            'commission' => '0.00',
            'coupon_amount' => "0.00",
            'total_before_discount' => $request['price'],
            'total_before_fees' => $request['price'],
            'create_user' => \auth()->user()->id,
            'vehicle_registration' => $request['vehicle_registration'],
            'vehicle_model' => $request['vehicle_model'],
            'vehicle_manufacture' => $request['vehicle_manufacture'],
            'vehicle_color' => $request['vehicle_color'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'address' => $request['address'],
            'address2' => $request['address2'],
            'city' => $request['city'],
            'state' => $request['state'],
            'zip_code' => $request['zip'],
            'country' => $request['country'],
            'customer_notes' => $request['notes'],
            'created_at' => $request['booking_date'],
            'flight_no' => $request['flight_no'],
        ];
        $booking = Booking::create($data);


        return redirect()->back()->with('success', __('Booking added successfully'));
    }

    public function update(Request $request) {
        $request->validate(
            [
                'start_date' => 'required|date',
                'end_date' => 'required|date',
                'created_at' => 'required|date',
                'reference_no' => 'required',
                'vehicle_registration' => 'required',
                'vehicle_manufacture' => 'required',
                'vehicle_model' => 'required',
                'vehicle_color' => 'required',
                'object_id' => 'required',
                'customer_id' => 'nullable',
                'total' => 'required',
                'first_name' => 'required',
                'id' => 'required',
                'reason' => 'required',
            ]
        );

        $booking = Booking::findOrFail($request['id']);

        $data = [
            'start_date' => $request['start_date'],
            'end_date' => $request['end_date'],
            'reference_no' => $request['reference_no'],
            'object_model' => 'space',
            'object_id' => $request['object_id'],
            'total' => $request['total'],
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'customer_id' => $request['customer_id'],
            'total_before_discount' => $request['total'],
            'total_before_fees' => $request['total'],
            'vehicle_registration' => $request['vehicle_registration'],
            'vehicle_model' => $request['vehicle_model'],
            'vehicle_manufacture' => $request['vehicle_manufacture'],
            'vehicle_color' => $request['vehicle_color'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'address' => $request['address'],
            'address2' => $request['address2'],
            'city' => $request['city'],
            'state' => $request['state'],
            'zip_code' => $request['zip_code'],
            'country' => $request['country'],
            'customer_notes' => $request['customer_notes'],
            'created_at' => $request['created_at'],
            'flight_no' => $request['flight_no'],
        ];

        BookingUpdateReason::create([
            'reason' => $request['reason'],
            'revision' => $booking->toArray(),
            'booking_id' => $booking->id,
            'editor_id' => \auth()->user()->id,
        ]);

        $booking->update($data);


        return redirect()->back()->with('success', __('Booking updated successfully'));
    }

    public function print(Request $request) {
        $bookings = Booking::whereIn('id', json_decode($request->bookings))->where('status','!=','unpaid')->where('status','!=','cancelled')->get();
        $data = [
            'bookings' => $bookings,
        ];
        $pdf = PDF::loadView('Report::admin.booking.print', $data);
        // download PDF file with download method
        return $pdf->download('Booking_key_logs_'.Carbon::now()->toDateString().'.pdf');
    }

    public function export(Request $request){
        $bookings = json_decode($request->bookings);
        //dd($users);
        $file_name = 'bookings_'.date('Y_m_d_H_i_s').'.csv';
        return Excel::download(new BookingExport($bookings), $file_name);
    }

    public function noShow($id, Request $request) {
        $booking = Booking::findOrFail($id);
        $booking['status']='no_show';
        $booking->save();
        return redirect()->back()->with('success', __('Booking status updated'));
    }
    public function resendConfirmation($id, Request $request) {
        $booking = Booking::findOrFail($id);
        Mail::to($booking->email)->send(new NewBookingEmail($booking,'customer'));

        return redirect()->back()->with('success', __('Booking confirmation email resent.'));
    }

    public function apiStoreBooking(Request $request)
    {
        
        dd($request,'ssss');
            // $request->validate(
            // [
            //     'arrival' => 'required|date',
            //     'booking_date' => 'required|date',
            //     'departure' => 'required|date',
            //     'reference' => 'required',
            //     'vehicle_registration' => 'required',
            //     'vehicle_manufacture' => 'required',
            //     'vehicle_model' => 'required',
            //     'vehicle_color' => 'required',
            //     'object_id' => 'required',
            //     'customer_id' => 'required',
            //     'price' => 'required',
            //     'first_name' => 'required',
            // ]);

        $data = [
            'start_date' => $request['arrival'],
            'end_date' => $request['departure'],
            'reference_no' => $request['reference'],
            'object_model' => 'space',
            'object_id' => $request['object_id'],
            'total' => $request['price'],
            'status' => 'confirmed',
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'customer_id' => $request['customer_id'],
            'total_guests' => 1,
            'commission' => '0.00',
            'coupon_amount' => '0.00',
            'total_before_discount' => $request['price'],
            'total_before_fees' => $request['price'],
            'create_user' => 0,
            'vehicle_registration' => $request['vehicle_registration'],
            'vehicle_model' => $request['vehicle_model'],
            'vehicle_manufacture' => $request['vehicle_manufacture'],
            'vehicle_color' => $request['vehicle_color'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'address' => $request['address'],
            'address2' => $request['address2'],
            'city' => $request['city'],
            'state' => $request['state'],
            'zip_code' => $request['zip'],
            'country' => $request['country'],
            'customer_notes' => $request['notes'],
            'created_at' => $request['booking_date'],
            'flight_no' => $request['flight_no'],
        ];

        $booking = Booking::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Booking created successfully',
            'data' => $booking
        ], 201);
    


    }
}
