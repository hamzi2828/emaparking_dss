<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingUpdateReason extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $casts = ['revision' => 'array'];

    public function admin()
    {
        return $this->hasOne(User::class, "id", 'editor_id');
    }
}
