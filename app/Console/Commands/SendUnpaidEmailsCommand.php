<?php

namespace App\Console\Commands;

use App\Models\SendUnpaidEmail;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Modules\Booking\Emails\NewBookingEmail;
use Modules\Booking\Models\Booking;

class SendUnpaidEmailsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emails:unpaid';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command send unpaid emails to new bookings after 30 minutes.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Unpaid booking emails sync started...');
        $unpaidEmails = SendUnpaidEmail::where('status','pending')->get();
        foreach ($unpaidEmails as $email) {
            $this->info('pending email found...');
            if(Carbon::now()->diffInMinutes($email->created_at) > 30) {
                $this->info('30 minutes passed...');
                $email->status = 'completed';
                $booking = Booking::find($email->booking_id);
                if($booking->status == 'unpaid') {
                    $this->info('booking status unpaid so sending email...');
                    Mail::to($booking->email)->send(new NewBookingEmail($booking, 'customer'));
                }
                $email->save();
            }
        }
    }
}
