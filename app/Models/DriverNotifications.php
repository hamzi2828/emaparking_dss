<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DriverNotifications extends Model
{
    use HasFactory;
    protected $guarded=['id'];
    public static function notifications() {
        return DriverNotifications::orderBy('id','desc')->take(5);
    }
}
