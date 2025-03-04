<?php


namespace Modules\Report;

use Modules\User\Models\Wallet\DepositPayment;

class ModuleProvider extends \Modules\ModuleServiceProvider
{
    public function register()
    {

        $this->app->register(RouteServiceProvider::class);
    }
    public static function getAdminMenu()
    {
        $count = 0;
        $pending_purchase = DepositPayment::countPending();
        $count += $pending_purchase;
        return [
            'report'=>[
                "position"=>1,
                'url'        => route('report.admin.booking'),
                'title'      =>  __('Bookings :count',['count'=>$count ? sprintf('<span class="badge badge-warning">%d</span>',$count) : '']),
                'icon'       => 'icon ion-ios-pie',
                'permission' => 'report_view',
                'children'   => [
                    'booking'=>[
                        'url'        => route('report.admin.booking'),
                        'title'      => __('Booking Reports'),
                        'icon'       => 'icon ion-ios-pricetags',
                        'permission' => 'report_view',
                    ],
                    'priority'=>[
                        'url'        => route('report.admin.booking.priority'),
                        'title'      => __('Priotized Bookings'),
                        'icon'       => 'icon ion-ios-pricetags',
                        'permission' => 'report_view',
                    ],
                    'booking_amendments'=>[
                        'url'        => route('report.admin.booking.amendments'),
                        'title'      => __('Amendments'),
                        'icon'       => 'icon ion-ios-pricetags',
                        'permission' => 'report_view',
                    ],
                    'booking_cancellations'=>[
                        'url'        => route('report.admin.booking.cancel'),
                        'title'      => __('Cancellations'),
                        'icon'       => 'icon ion-ios-pricetags',
                        'permission' => 'report_view',
                    ],
                    'enquiry'=>[
                        'url'        => route('report.admin.enquiry.index'),
                        'title'      => __('Enquiry Reports'),
                        'icon'       => 'icon ion-ios-pricetags',
                        'permission' => 'contact_manage',
                    ],
                    'parsing'=>[
                        'url'        => route('report.admin.booking.parsing'),
                        'title'      => __('Parsing Report'),
                        'icon'       => 'icon ion ion-md-mail',
                        'permission' => 'contact_manage',
                    ],
                    'contact'=>[
                        'url'        => route('contact.admin.index'),
                        'title'      => __('Contact Submissions'),
                        'icon'       => 'icon ion ion-md-mail',
                        'permission' => 'contact_manage',
                    ],
                    'drafts'=>[
                        'url'        => route('report.admin.booking.drafts'),
                        'title'      => __('Booking Drafts'),
                        'icon'       => 'icon ion-ios-pricetags',
                        'permission' => 'contact_manage',
                    ],
                    /*  'statistic'=>[
                        'url'        => route('report.admin.statistic.index'),
                        'title'      => __('Booking Statistic'),
                        'icon'       => 'icon ion ion-md-podium',
                        'permission' => 'report_view',
                    ],*/
                    /*'buy_credit_report'=>[
                        'parent'=>'report',
                        'url'=>route('user.admin.wallet.report'),
                        'title'=>__("Credit Purchase Report :count",['count'=>$pending_purchase ? sprintf('<span class="badge badge-warning">%d</span>',$pending_purchase) : '']),
                        'icon'=>'fa fa-money'
                    ]*/
                ]
            ],
        ];
    }
}
