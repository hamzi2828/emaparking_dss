<?php
namespace Modules\Dashboard\Admin;

use App\Models\ContactInfo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Modules\AdminController;
use Modules\Booking\Models\Booking;
use Modules\Space\Models\Space;

class DashboardController extends AdminController
{
    public function index()
    {
        $f = strtotime('monday this week');
        if(!$this->hasPermission('contact_manage')) {
            $all = Booking::where('status', '!=', 'draft')->whereBetween('created_at',[Carbon::now()->subWeeks(3),Carbon::now()->addWeeks(3)])->count();
        }
        else {
            $all = Booking::where('status', '!=', 'draft')->count();

        }
        $pickups = Booking::where('status', '!=', 'draft')->whereDate('end_date',Carbon::now())->orderBy('end_date','ASC');
        $arrivals = Booking::where('status', '!=', 'draft')->whereDate('start_date',Carbon::now())->orderBy('start_date','ASC');

        $today = Carbon::now()->format('m/d/Y - m/d/Y');
        $data = [
            //'recent_bookings'    => Booking::getRecentBookings(),
            'recent_pickups'    => $pickups->get(),
            'recent_arrivals'    => $arrivals->get(),
            'today' => $today,
            'top_cards'          => [
                [
                    'title' => 'Check-ins',
                    'amount' => $arrivals->where('status','!=','cancelled')->count(),
                    'desc' => 'Today\'s Arrivals',
                    'icon' => 'icon ion-ios-log-in',
                    'class' => 'bg-success',
                    'url' => route('report.admin.booking').'?arrival='.$today.'&status=notCancelled'
                ],
                [
                    'title' => 'Check-outs',
                    'amount' => $pickups->where('status','!=','cancelled')->count(),
                    'desc' => 'Today\'s Returns',
                    'icon' => 'icon ion-ios-log-out',
                    'class' => 'bg-danger',
                    'url' => route('report.admin.booking').'?departure='.$today.'&status=notCancelled'
                ],
                [
                    'title' => 'Bookings',
                    'amount' => $all,
                    'desc' => 'Total Bookings',
                    'icon' => 'icon ion-ios-pricetags',
                    'class' => 'bg-primary',
                    'url' => route('report.admin.booking')
                ],
                [
                    'title' => 'Products',
                    'amount' => Space::count(),
                    'desc' => 'Total Parkings',
                    'icon' => 'ion ion-md-basket',
                    'class' => 'bg-secondary',
                    'url' => $this->hasPermission('contact_manage') ? route('space.admin.index') : '#'
                ],
            ],
            /*'earning_chart_data' => Booking::getDashboardChartData($f, time())*/
        ];
        return view('Dashboard::index', $data);
    }

    public function reloadChart(Request $request)
    {
        $chart = $request->input('chart');
        switch ($chart) {
            case "earning":
                $from = $request->input('from');
                $to = $request->input('to');
                return $this->sendSuccess([
                    'data' => Booking::getDashboardChartData(strtotime($from), strtotime($to))
                ]);
                break;
        }
    }
    public function getContacts () {
        $contacts = ContactInfo::with('partners')->get();
        return view('Dashboard::contact_infos', compact('contacts'));
    }
}
