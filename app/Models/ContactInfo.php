<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactInfo extends Model
{
    use HasFactory;

    public function partners()
    {
        return $this->belongsTo('App\Models\Partner', 'partner_id');
    }
}