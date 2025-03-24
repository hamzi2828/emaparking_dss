<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Booking\Models\Booking;

class BookingCancellation extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function booking() {
        return $this->hasOne(Booking::class,'id','booking_id');
    }

    public function getStatusBadge() {
        $status = $this->status;
        switch ($status) {
            case 'pending':
                $class = 'badge-warning';
                break;
            case 'approved':
                $class = 'badge-success';
                break;
            default:
                $class = 'badge-danger';

        }
        return '<div class="badge badge-sm '.$class.' text-white">'.$status.'</div>';
    }
}
