<?php
namespace Modules\Space\Models;

use App\BaseModel;

class SpacePlans extends BaseModel
{
    protected $table = 'bravo_space_plans';
    protected $fillable = [
        'name',
        'days',
        'partner_days',
        'create_user',
        'update_user',
    ];

    protected $casts = [
        'days'  => 'array',
        'partner_days'  => 'array',
    ];
} 
