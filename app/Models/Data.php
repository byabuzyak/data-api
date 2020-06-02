<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    protected $table = 'data';

    protected $fillable = [
        'page_uid',
        'name',
        'amount',
        'currency'
    ];

    protected $casts = [
        'page_uid' => 'string',
        'name'     => 'string',
        'amount'   => 'integer',
        'currency' => 'string'
    ];
}
