<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApiSourceCredential extends Model
{
    protected $table = 'ApiSourceCredentials';
    protected $primaryKey = 'Id';
    protected $guarded = ['_token'];
    const CREATED_AT = 'CreateDate';
    const UPDATED_AT = 'LastModified';

    public static function getTableName()
    {
        return with(new static)->getTable();
    }

    
}
