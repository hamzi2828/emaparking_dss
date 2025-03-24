<?php

namespace App\Console\Commands;

use App\Models\ParsedEmails;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Modules\Booking\Models\Booking;
use Modules\Booking\Models\Service;
use Modules\User\Models\UserPlan;

class ParseEmailCommand extends Command
{
    protected $signature = 'emails:parse';

    protected $description = 'This command is used to parse emails on the background.';

    public function handle()
    {

        $this->info('Email parsing started...');

        $emails = ParsedEmails::where('status','pending')->get();

        foreach ($emails as $email) {
            $email->status = 'processing';
            $email->save();
            if ($email->email == 'noreply@compareparkingdeals.co.uk' || $email->email == 'noreply@compareairportparkings.co.uk') {

                try {
                    $csv_data = [];
                    if (($open = fopen(Storage::disk('public')->path($email->attachments[0]), "r")) !== FALSE) {
                        while (($data = fgetcsv($open, 1000, ",")) !== FALSE) {
                            $csv_data[] = $data;
                        }
                        fclose($open);
                    }

                    $successful = 0;
                    $booking = null;
                    foreach ($csv_data as  $index => $row) {
                        if($index == 0)
                            continue; //Ignore header row
                        $data = [
                            'start_date' => Carbon::parse($row[7]),
                            'end_date' => Carbon::parse($row[8]),
                            'reference_no' => $row[4],
                            'object_model' => 'space',
                            'total' => $row[20],
                            'status' => $row[5] != 'Cancelled' ? 'confirmed' : Booking::CANCELLED,
                            'first_name' => $row[6],
                            'last_name' => '',
                            'customer_id' => 9,
                            'total_guests' => 1,
                            'commission' => '0.00',
                            'coupon_amount' => "0.00",
                            'total_before_discount' => $row[20],
                            'total_before_fees' => $row[20],
                            'create_user' => 9,
                            'vehicle_registration' => $row[13],
                            'vehicle_model' => $row[15],
                            'vehicle_manufacture' => $row[14],
                            'vehicle_color' => $row[16],
                            'email' => '',
                            'phone' => $row[18],
                            'address' => '',
                            'address2' => '',
                            'city' => '',
                            'state' => '',
                            'zip_code' => '',
                            'country' => '',
                            'created_at' => Carbon::now(),
                            'flight_no' => $row[12],
                        ];

                        if ($row[2] == 'Midland Airport Parking') {
                            $data['object_id'] = 14;
                        }
                        else if ($row[2] == 'Midland Parking - Non Flex') {
                            $data['object_id'] = 15;
                        }
                        else {
                            $data['object_id'] = 16;
                        }


                        $booking = Booking::where('reference_no',$data['reference_no'])->first();

                        if ($booking == null) {
                            $booking = Booking::create($data);
                        }
                        else {
                            $booking->update($data);
                        }

                        if($booking != null) {
                            $successful +=1;
                        }

                    }
                    if ($successful >=1) {
                        $email->status = 'success';
                        $email->error = 'Booking Reference #'.$booking->reference_no;
                        $email->save();
                    }
                    continue;
                }
                catch (\Exception $e) {
                    $email->status='failed';
                    $email->error =  $e->getMessage();
                    $email->save();
                }
            }
            /*else if ($email->email == 'hmalik31@gmail.com') {*/
            else if($email->email == 'reservations@bookfhr.com') {

                try {
                    $csv_data = [];
                    if (($open = fopen(Storage::disk('public')->path($email->attachments[0]), "r")) !== FALSE) {
                        while (($data = fgetcsv($open, 1000, ",")) !== FALSE) {
                            $csv_data[] = $data;
                        }
                        fclose($open);
                    }

                    $successful = 0;
                    $booking = null;
                    foreach ($csv_data as  $index => $row) {
                        if($index == 0)
                            continue; //Ignore header row
                        //$this->info(print_r($row));
                        if (empty($row[0])) {
                            continue;
                        }

                        $data = [
                            'start_date' => Carbon::createFromFormat('d/m/Y H:i',$row[2]),
                            'end_date' => Carbon::createFromFormat('d/m/Y H:i',$row[3]),
                            'reference_no' => $row[16],
                            'object_model' => 'space',
                            'total' => $row[1],
                            'status' => $row[5] != 'CANX' ? 'confirmed' : Booking::CANCELLED,
                            'first_name' => $row[17],
                            'last_name' => '',
                            'customer_id' => 8,
                            'total_guests' => 1,
                            'commission' => '0.00',
                            'coupon_amount' => "0.00",
                            'total_before_discount' => $row[1],
                            'total_before_fees' => $row[1],
                            'create_user' => 8,
                            'vehicle_registration' => $row[4],
                            'vehicle_model' => $row[12],
                            'vehicle_manufacture' => $row[11],
                            'vehicle_color' => $row[13],
                            'email' => '',
                            'phone' => $row[14],
                            'address' => '',
                            'address2' => '',
                            'city' => '',
                            'state' => '',
                            'zip_code' => '',
                            'country' => '',
                            'created_at' => Carbon::now(),
                            'object_id' => strtolower($row[0]) === 'vip' ? 16 /*All Inclusive*/ : 14 /*Flexible*/,
                            'flight_no' => $row[9],
                        ];


                        $booking = Booking::where('reference_no',$data['reference_no'])->first();

                        if ($booking == null) {
                            $booking = Booking::create($data);
                        }
                        else {
                            $booking->update($data);
                        }

                        if($booking != null) {
                            $successful +=1;
                        }

                    }
                    if ($successful >=1) {
                        $email->status = 'success';
                        $email->error = 'Booking Reference #'.$booking->reference_no;
                        $email->save();
                    }
                    continue;
                }
                catch (\Exception $e) {
                    $email->status='failed';
                    $email->error =  $e->getMessage();
                    $email->save();
                }

            }

            /*else if($email->email == 'yourbooking@trustedtravel.com') {
                try {
                    $csv_data = [];
                    if (($open = fopen(Storage::disk('public')->path($email->attachments[0]), "r")) !== FALSE) {
                        while (($data = fgetcsv($open, 1000, ",")) !== FALSE) {
                            $csv_data[] = $data;
                        }
                        fclose($open);
                    }

                    $successful = 0;
                    $booking = null;
                    foreach ($csv_data as  $index => $row) {
                        if($index == 0)
                            continue; //Ignore header row

                        $data = [
                            'start_date' => Carbon::parse($row[7]),
                            'end_date' => Carbon::parse($row[8]),
                            'reference_no' => $row[2],
                            'object_model' => 'space',
                            'total' => $row[9],
                            'status' => 'confirmed',
                            'first_name' => $row[11],
                            'last_name' => '',
                            'customer_id' => 6,
                            'total_guests' => 1,
                            'commission' => '0.00',
                            'coupon_amount' => "0.00",
                            'total_before_discount' => $row[9],
                            'total_before_fees' => $row[9],
                            'create_user' => 6,
                            'vehicle_registration' => $row[13],
                            'vehicle_model' => $row[15],
                            'vehicle_manufacture' => $row[14],
                            'vehicle_color' => $row[16],
                            'email' => '',
                            'phone' => $row[12],
                            'address' => '',
                            'address2' => '',
                            'city' => '',
                            'state' => '',
                            'zip_code' => '',
                            'country' => '',
                            'created_at' => Carbon::now(),
                            'flight_no' => $row[19],
                        ];
                        $data['object_id'] = 14;



                        $booking = Booking::where('reference_no',$data['reference_no'])->first();

                        if ($booking == null) {
                            $booking = Booking::create($data);
                        }
                        else {
                            $booking->update($data);
                        }

                        if($booking != null) {
                            $successful +=1;
                        }

                    }
                    if ($successful >=1) {
                        $email->status = 'success';
                        $email->error = 'Booking Reference #'.$booking->reference_no;
                        $email->save();
                    }
                    continue;
                }
                catch (\Exception $e) {
                    $email->status='failed';
                    $email->error =  $e->getMessage();
                    $email->save();
                }

            }
            else if($email->email == 'tap@travelairportplus.co.uk') {
                try {
                    $csv_data = [];
                    if (($open = fopen(Storage::disk('public')->path($email->attachments[0]), "r")) !== FALSE) {
                        while (($data = fgetcsv($open, 1000, ",")) !== FALSE) {
                            $csv_data[] = $data;
                        }
                        fclose($open);
                    }

                    $successful = 0;
                    $booking = null;
                    foreach ($csv_data as  $index => $row) {
                        if($index == 0)
                            continue; //Ignore header row

                        $data = [
                            'start_date' => Carbon::parse($row[5])->setTimeFromTimeString($row[6]),
                            'end_date' => Carbon::parse($row[7])->setTimeFromTimeString($row[8]),
                            'reference_no' => $row[1],
                            'object_model' => 'space',
                            'total' => $row[16],
                            'status' => $row[24] !='Cancel' ? 'confirmed' : Booking::CANCELLED,
                            'first_name' => $row[13],
                            'last_name' => $row[14],
                            'customer_id' => 3,
                            'total_guests' => 1,
                            'commission' => '0.00',
                            'coupon_amount' => "0.00",
                            'total_before_discount' => $row[16],
                            'total_before_fees' => $row[16],
                            'create_user' => 3,
                            'vehicle_registration' => $row[23],
                            'vehicle_model' => $row[21],
                            'vehicle_manufacture' => $row[20],
                            'vehicle_color' => $row[22],
                            'email' => '',
                            'phone' => $row[15],
                            'address' => '',
                            'address2' => '',
                            'city' => '',
                            'state' => '',
                            'zip_code' => '',
                            'country' => '',
                            'created_at' => Carbon::now(),
                            'flight_no' => $row[18],
                        ];
                        $data['object_id'] = 14;



                        $booking = Booking::where('reference_no',$data['reference_no'])->first();

                        if ($booking == null) {
                            $booking = Booking::create($data);
                        }
                        else {
                            $booking->update($data);
                        }

                        if($booking != null) {
                            $successful +=1;
                        }

                    }
                    if ($successful >=1) {
                        $email->status = 'success';
                        $email->error = 'Booking Reference #'.$booking->reference_no;
                        $email->save();
                    }
                    continue;
                }
                catch (\Exception $e) {
                    $email->status='failed';
                    $email->error =  $e->getMessage();
                    $email->save();
                }
            }*/
            else if($email->email == 'noreply@parking4you.co.uk') {
                try {
                    $csv_data = [];
                    if (($open = fopen(Storage::disk('public')->path($email->attachments[0]), "r")) !== FALSE) {
                        while (($data = fgetcsv($open, 1000, ",")) !== FALSE) {
                            $csv_data[] = $data;
                        }
                        fclose($open);
                    }

                    $successful = 0;
                    $booking = null;
                    foreach ($csv_data as  $index => $row) {
                        if($index == 0)
                            continue; //Ignore header row

                        $data = [
                            'start_date' => Carbon::parse($row[7]),
                            'end_date' => Carbon::parse($row[8]),
                            'reference_no' => $row[4],
                            'object_model' => 'space',
                            'total' => $row[20],
                            'status' => $row[5] != 'Cancelled' ? 'confirmed' : Booking::CANCELLED,
                            'first_name' => $row[6],
                            'last_name' => $row[14],
                            'customer_id' => 11,
                            'total_guests' => 1,
                            'commission' => '0.00',
                            'coupon_amount' => "0.00",
                            'total_before_discount' => $row[20],
                            'total_before_fees' => $row[20],
                            'create_user' => 11,
                            'vehicle_registration' => $row[13],
                            'vehicle_model' => $row[15],
                            'vehicle_manufacture' => $row[14],
                            'vehicle_color' => $row[16],
                            'email' => '',
                            'phone' => $row[18],
                            'address' => '',
                            'address2' => '',
                            'city' => '',
                            'state' => '',
                            'zip_code' => '',
                            'country' => '',
                            'created_at' => Carbon::now(),
                            'flight_no' => $row[12],
                        ];
                        if ($row[2] == 'Midland Parking - Undercover') {
                            $data['object_id'] = 16;
                        }
                        else if ($row[2] == 'Midland Parking - Non Flex') {
                            $data['object_id'] = 15;
                        }
                        else {
                            $data['object_id'] = 14;
                        }

                        $booking = Booking::where('reference_no',$data['reference_no'])->first();

                        if ($booking == null) {
                            $booking = Booking::create($data);
                        }
                        else {
                            $booking->update($data);
                        }

                        if($booking != null) {
                            $successful +=1;
                        }

                    }
                    if ($successful >=1) {
                        $email->status = 'success';
                        $email->error = 'Booking Reference #'.$booking->reference_no;
                        $email->save();
                    }
                    continue;
                }
                catch (\Exception $e) {
                    $email->status='failed';
                    $email->error =  $e->getMessage();
                    $email->save();
                }
            }
            else if($email->email == 'bookings@skyparkingservices.co.uk') {
                try {
                    $csv_data = [];
                    if (($open = fopen(Storage::disk('public')->path($email->attachments[0]), "r")) !== FALSE) {
                        while (($data = fgetcsv($open, 1000, ",")) !== FALSE) {
                            $csv_data[] = $data;
                        }
                        fclose($open);
                    }

                    $successful = 0;
                    $booking = null;
                    foreach ($csv_data as  $index => $row) {
                        if($index == 0)
                            continue; //Ignore header row

                        $data = [
                            'start_date' => Carbon::parse($row[10])->setTimeFromTimeString($row[11]),
                            'end_date' => Carbon::parse($row[12])->setTimeFromTimeString($row[13]),
                            'reference_no' => $row[0],
                            'object_model' => 'space',
                            'total' => $row[22],
                            'status' => $row[5] != 'cancelled' ? 'confirmed' : Booking::CANCELLED,
                            'first_name' => $row[7],
                            'last_name' => $row[8],
                            'customer_id' => 7,
                            'total_guests' => 1,
                            'commission' => '0.00',
                            'coupon_amount' => "0.00",
                            'total_before_discount' => $row[22],
                            'total_before_fees' => $row[22],
                            'create_user' => 7,
                            'vehicle_registration' => $row[19],
                            'vehicle_model' => '',
                            'vehicle_manufacture' => $row[18],
                            'vehicle_color' => $row[20],
                            'email' => '',
                            'phone' => $row[9],
                            'address' => '',
                            'address2' => '',
                            'city' => '',
                            'state' => '',
                            'zip_code' => '',
                            'country' => '',
                            'created_at' => Carbon::now(),
                            'flight_no' => $row[17],
                        ];
                        if ($row[2] == 'Midlands Parking Meet and Greet UNDERCOVER') {
                            $data['object_id'] = 16;
                        }
                        else if ($row[2] == 'Midlands Parking Meet and Greet NON FLEX') {
                            $data['object_id'] = 15;
                        }
                        else {
                            $data['object_id'] = 14;
                        }

                        $booking = Booking::where('reference_no',$data['reference_no'])->first();

                        if ($booking == null) {
                            $booking = Booking::create($data);
                        }
                        else {
                            $booking->update($data);
                        }

                        if($booking != null) {
                            $successful +=1;
                        }

                    }
                    if ($successful >=1) {
                        $email->status = 'success';
                        $email->error = 'Booking Reference #'.$booking->reference_no;
                        $email->save();
                    }
                    continue;
                }
                catch (\Exception $e) {
                    $email->status='failed';
                    $email->error =  $e->getMessage();
                    $email->save();
                }
            }
            else if($email->email == 'noreply@mail.ca.vu') {
                try {
                    $csv_data = [];
//                    if (($open = fopen(Storage::disk('public')->path('SPSAPI-153563.csv'), "r")) !== FALSE) {
                    if (($open = fopen(Storage::disk('public')->path($email->attachments[0]), "r")) !== FALSE) {
                        while (($data = fgetcsv($open, 1000, ",")) !== FALSE) {
                            $csv_data[] = $data;
                        }
                        fclose($open);
                    }

                    $successful = 0;
                    $booking = null;
                    foreach ($csv_data as  $index => $row) {
                        if($index == 0)
                            continue; //Ignore header row

                        $data = [
                            'start_date' => Carbon::parse($row[2]),
                            'end_date' => Carbon::parse($row[3]),
                            'reference_no' => $row[0],
                            'object_model' => 'space',
                            'total' => $row[1],
                            'status' => strtolower($row[5]) == 'confirmed' || strtolower($row[5]) == 'active' ? 'confirmed' : Booking::CANCELLED,
                            'first_name' => $row[17],
                            'last_name' => '',
                            'customer_id' => 437,
                            'total_guests' => 1,
                            'commission' => '0.00',
                            'coupon_amount' => "0.00",
                            'total_before_discount' => $row[1],
                            'total_before_fees' => $row[1],
                            'create_user' => 13,
                            'vehicle_registration' => $row[4],
                            'vehicle_model' => $row[12],
                            'vehicle_manufacture' => $row[11],
                            'vehicle_color' => $row[13],
                            'email' => '',
                            'phone' => $row[14],
                            'address' => '',
                            'address2' => '',
                            'city' => '',
                            'state' => '',
                            'zip_code' => '',
                            'country' => '',
                            'created_at' => Carbon::now(),
                            'flight_no' => $row[7] ?? $row[9],
                        ];

                        $productName = isset($row[24]) ? $row[24] : null;

                        if (strtolower($productName) == 'ema midlands parking cov' || strtolower($productName) == 'ema midlands parking ai') {
                            $data['object_id'] = 16; // All Inclusive
                        }
                        else if (strtolower($productName) == 'ema midlands parking' || strtolower($productName) == 'ema midlands parking flex') {
                            $data['object_id'] = 14; // Flexible
                        }
                        else {
                            $data['object_id'] = 15; // Non-Flexible;
                        }

                        $booking = Booking::where('reference_no',$data['reference_no'])->first();

                        if ($booking == null) {
                            $booking = Booking::create($data);
                        }
                        else {
                            $booking->update($data);
                        }

                        if($booking != null) {
                            $successful +=1;
                        }

                    }
                    if ($successful >=1) {
                        $email->status = 'success';
                        $email->error = 'Booking Reference #'.$booking->reference_no;
                        $email->save();
                    }
                    continue;
                }
                catch (\Exception $e) {
                    $email->status='failed';
                    $email->error =  $e->getMessage();
                    $email->save();
                }
            }
            else if($email->email == 'reports@looking4.com') {
                try {
                    $csv_data = [];
                    if (($open = fopen(Storage::disk('public')->path($email->attachments[0]), "r")) !== FALSE) {
                        while (($data = fgetcsv($open, 1000, ",")) !== FALSE) {
                            $csv_data[] = $data;
                        }
                        fclose($open);
                    }

                    $successful = 0;
                    $booking = null;
                    foreach ($csv_data as  $index => $row) {
                        if($index == 0)
                            continue; //Ignore header row

                        $data = [
                            'start_date' => Carbon::parse($row[2]),
                            'end_date' => Carbon::parse($row[3]),
                            'reference_no' => $row[0],
                            'object_model' => 'space',
                            'total' => $row[1],
                            'status' => $row[5] == 'ACTIVE' || $row[5] == 'AMENDMENT' ? 'confirmed' : Booking::CANCELLED,
                            'first_name' => $row[17],
                            'last_name' => '',
                            'customer_id' => 13,
                            'total_guests' => 1,
                            'commission' => '0.00',
                            'coupon_amount' => "0.00",
                            'total_before_discount' => $row[1],
                            'total_before_fees' => $row[1],
                            'create_user' => 13,
                            'vehicle_registration' => $row[4],
                            'vehicle_model' => $row[12],
                            'vehicle_manufacture' => $row[11],
                            'vehicle_color' => $row[13],
                            'email' => '',
                            'phone' => $row[14],
                            'address' => '',
                            'address2' => '',
                            'city' => '',
                            'state' => '',
                            'zip_code' => '',
                            'country' => '',
                            'created_at' => Carbon::now(),
                            'flight_no' => $row[9],
                        ];

                        $data['object_id'] = 14;

                        $booking = Booking::where('reference_no',$data['reference_no'])->first();

                        if ($booking == null) {
                            $booking = Booking::create($data);
                        }
                        else {
                            $booking->update($data);
                        }

                        if($booking != null) {
                            $successful +=1;
                        }

                    }
                    if ($successful >=1) {
                        $email->status = 'success';
                        $email->error = 'Booking Reference #'.$booking->reference_no;
                        $email->save();
                    }
                    continue;
                }
                catch (\Exception $e) {
                    $email->status='failed';
                    $email->error =  $e->getMessage();
                    $email->save();
                }
            }
            else if($email->email == 'sales@parkandgo.co.uk') {
                try {
                    $csv_data = [];
                    if (($open = fopen(Storage::disk('public')->path($email->attachments[0]), "r")) !== FALSE) {
                        while (($data = fgetcsv($open, 1000, ",")) !== FALSE) {
                            $csv_data[] = $data;
                        }
                        fclose($open);
                    }

                    $successful = 0;
                    $booking = null;
                    foreach ($csv_data as  $index => $row) {
                        if($index == 0)
                            continue; //Ignore header row

                        $data = [
                            'start_date' => Carbon::createFromFormat('d/m/Y H:i', $row[6] . ' ' . $row[7]),
                            'end_date' => Carbon::createFromFormat('d/m/Y H:i', $row[8] . ' ' . $row[9]),
                            'reference_no' => $row[0],
                            'object_model' => 'space',
                            'total' => 0,
                            'status' => 'confirmed',
                            'first_name' => $row[1],
                            'last_name' => '',
                            'customer_id' => 12,
                            'total_guests' => 1,
                            'commission' => '0.00',
                            'coupon_amount' => "0.00",
                            'total_before_discount' => 0,
                            'total_before_fees' => 0,
                            'create_user' => 12,
                            'vehicle_registration' => $row[10],
                            'vehicle_model' => '',
                            'vehicle_manufacture' => '',
                            'vehicle_color' => '',
                            'email' => '',
                            'phone' => '',
                            'address' => '',
                            'address2' => '',
                            'city' => '',
                            'state' => '',
                            'zip_code' => '',
                            'country' => '',
                            'created_at' => Carbon::now(),
                            'flight_no' => '',
                        ];
                        /*if ($row[2] == 'Midland Parking - Flex') {
                            $data['object_id'] = 14;
                        }
                        else if ($row[2] == 'Midland Parking - Non Flex') {
                            $data['object_id'] = 15;
                        }
                        else {*/
                        $data['object_id'] = 14;
                        /*}*/

                        $booking = Booking::where('reference_no',$data['reference_no'])->first();

                        if ($booking == null) {
                            $booking = Booking::create($data);
                        }
                        else {
                            $booking->update($data);
                        }

                        if($booking != null) {
                            $successful +=1;
                        }

                    }
                    if ($successful >=1) {
                        $email->status = 'success';
                        $email->error = 'Booking Reference #'.$booking->reference_no;
                        $email->save();
                    }
                    continue;
                }
                catch (\Exception $e) {
                    $email->status='failed';
                    $email->error =  $e->getMessage();
                    $email->save();
                }
            }
            else if ($email->email == 'noreply@airportparkwithus.co.uk') {

                try {
                    $csv_data = [];
                    if (($open = fopen(Storage::disk('public')->path($email->attachments[0]), "r")) !== FALSE) {
                        while (($data = fgetcsv($open, 1000, ",")) !== FALSE) {
                            $csv_data[] = $data;
                        }
                        fclose($open);
                    }

                    $successful = 0;
                    $booking = null;
                    foreach ($csv_data as  $index => $row) {
                        if($index == 0)
                            continue; //Ignore header row

                        $data = [
                            'start_date' => Carbon::parse($row[4]),
                            'end_date' => Carbon::parse($row[5]),
                            'reference_no' => $row[0],
                            'object_model' => 'space',
                            'total' => $row[3],
                            'status' => 'confirmed',
                            'first_name' => $row[18],
                            'last_name' => '',
                            'customer_id' => 46,
                            'total_guests' => 1,
                            'commission' => '0.00',
                            'coupon_amount' => "0.00",
                            'total_before_discount' => $row[3],
                            'total_before_fees' => $row[3],
                            'create_user' => 46,
                            'vehicle_registration' => $row[6],
                            'vehicle_model' => $row[14],
                            'vehicle_manufacture' => $row[13],
                            'vehicle_color' => $row[15],
                            'email' => '',
                            'phone' => $row[16],
                            'address' => '',
                            'address2' => '',
                            'city' => '',
                            'state' => '',
                            'zip_code' => '',
                            'country' => '',
                            'created_at' => Carbon::now(),
                            'flight_no' => $row[11],
                        ];

                        if ($row[2] == 'East Midlands Airport Parking - Meet and Greet') {
                            $data['object_id'] = 14;
                        }
                        else if ($row[2] == 'East Midlands Airport Parking - M&G - Non Flex') {
                            $data['object_id'] = 15;
                        }
                        else {
                            $data['object_id'] = 16;
                        }


                        $booking = Booking::where('reference_no',$data['reference_no'])->first();

                        if ($booking == null) {
                            $booking = Booking::create($data);
                        }
                        else {
                            $booking->update($data);
                        }

                        if($booking != null) {
                            $successful +=1;
                        }

                    }
                    if ($successful >=1) {
                        $email->status = 'success';
                        $email->error = 'Booking Reference #'.$booking->reference_no;
                        $email->save();
                    }
                    continue;
                }
                catch (\Exception $e) {
                    $email->status='failed';
                    $email->error =  $e->getMessage();
                    $email->save();
                }
            }
            else if($email->email == 'admin@aph.com' || $email->email=='bookings@emaparking.co.uk' || $email->email=='aph@emaparking.co.uk') {
                try {
                    $successful = 0;
                    $references = [];
                    foreach($email->attachments as $attachment) {
                        $csv_data = [];
                        if (($open = fopen(Storage::disk('public')->path($attachment), "r")) !== FALSE) {
                            while (($data = fgetcsv($open, 1000, ",")) !== FALSE) {
                                $csv_data[] = $data;
                            }
                            fclose($open);
                        }


                        $booking = null;
                        foreach ($csv_data as  $index => $row) {
                            /*if($index == 0)
                                continue; //Ignore header row*/
                            $name = $row[6].' '.$row[21];
                            $data = [
                                'start_date' => Carbon::createFromFormat('d/m/y H:i', $row[4] . ' ' . $row[11]),
                                'end_date' => Carbon::createFromFormat('d/m/y H:i', $row[15] . ' ' . $row[16]),
                                'reference_no' => $row[2],
                                'object_model' => 'space',
                                'total' => $row[13],
                                'status' => 'confirmed',
                                'first_name' => $name,
                                'last_name' => '',
                                'customer_id' => 89,
                                'total_guests' => 1,
                                'commission' => '0.00',
                                'coupon_amount' => "0.00",
                                'total_before_discount' => $row[13],
                                'total_before_fees' => $row[13],
                                'create_user' => 89,
                                'vehicle_registration' => $row[7],
                                'vehicle_model' => '',
                                'vehicle_manufacture' => $row[8],
                                'vehicle_color' => $row[9],
                                'email' => '',
                                'phone' => $row[31],
                                'address' => '',
                                'address2' => '',
                                'city' => '',
                                'state' => '',
                                'zip_code' => '',
                                'country' => '',
                                'created_at' => Carbon::now(),
                                'flight_no' => $row[12],
                            ];

                            /*if ($row[2] == 'Midland Parking - Flex') {
                                $data['object_id'] = 14;
                            }
                            else if ($row[2] == 'Midland Parking - Non Flex') {
                                $data['object_id'] = 15;
                            }
                            else {*/
                            if ($row[0] == '104') {
                                $data['object_id'] = 16 /*All Inclusive*/;
                            }
                            else {
                                $data['object_id'] = 14 /*Flexible*/;
                                if ($row[0] != '103') {
                                    Mail::send([], [], function ($message) use ($row, $name) {
                                        $message->to("bookings@emaparking.co.uk")
                                            ->subject("Action Required: Missing Product Category Code for Booking APH (Ref: {$row[2]})")
                                            ->setBody("Please review the booking of APH with reference number {$row[2]} and customer name $name as the product category code is not assigned in CSV.");
                                        });
                                }
                            }
                            /*}*/

                            $booking = Booking::where('reference_no',$data['reference_no'])->first();

                            if ($booking == null) {
                                $booking = Booking::create($data);
                            }
                            else {
                                $booking->update($data);
                            }

                            if($booking != null) {
                                $successful +=1;
                                $references[] = $booking->reference_no;
                            }

                        }

                    }
                    if ($successful >=1) {
                        $message ='';
                        foreach ($references as $reference) {
                            $message.='Booking Reference #'.$reference.'\n';
                        }
                        $email->status = 'success';
                        $email->error = $message;
                        $email->save();
                    }
                    continue;
                }
                catch (\Exception $e) {
                    $email->status='failed';
                    $email->error =  $e->getMessage();
                    $email->save();
                }
            }
            else {
                $email->status = 'failed';
                $email->error='Unknown sender';
                $email->save();
            }

        }
    }

}
