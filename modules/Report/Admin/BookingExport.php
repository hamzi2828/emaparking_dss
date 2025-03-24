<?php

namespace Modules\Report\Admin;

use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Modules\Booking\Models\Booking;

class BookingExport implements FromCollection, WithHeadings
{
    function __construct($ids = null) {
        if($ids != null)
            $this->ids = $ids;
        else
            $this->ids = [];
    }

    public function collection()
    {
        $result = array();
        $bookings = Booking::whereIn('id',$this->ids)->get();
        foreach ($bookings as $booking) {
            $result[] = array(
                'reference_no' => $booking->reference_no,
                'status' => ucfirst($booking->status) ,
                'booking_date' => display_datetime($booking->created_at),
                'start_date' =>  display_datetime($booking->start_date),
                'end_date' => display_datetime($booking->end_date),
                'vehicle_manufacture' => $booking->vehicle_manufacture,
                'vehicle_model' => $booking->vehicle_model,
                'vehicle_registration' => $booking->vehicle_registration,
                'vehicle_color' => $booking->vehicle_color,
                'product' => $booking->service != null ? $booking->service->title : '',
                'price' => $booking->total,
                'agent' => $booking->customer != null ? $booking->customer->name : 'EMA',
                'first_name' => $booking->first_name,
                'last_name' => $booking->last_name,
                'phone' => $booking->phone,
                'email' => $booking->email,
                'address' => $booking->address,
                'address2' => $booking->address2,
                'city' => $booking->city,
                'state' => $booking->state,
                'zip' => $booking->zip_code,
                'country' => $booking->country,
            );
        }
        return collect($result);
    }

    public function headings(): array
    {
        return [
            'Reference No',
            'Status',
            'Booking Date',
            'Arrival',
            'Departure',
            'Vehicle Make',
            'Vehicle Model',
            'Vehicle Registration',
            'Vehicle Color',
            'Product',
            'Price',
            'Booking Agent',
            'Firstname',
            'Lastname',
            'Phone',
            'Email',
            'Address',
            'Address2',
            'City',
            'State',
            'Zip',
            'Country'
        ];
    }
}
