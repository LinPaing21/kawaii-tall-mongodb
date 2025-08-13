<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Donation extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'donations';

    protected $fillable = [
        'name',
        'email',
        'amount',
        'note',
        'screenshot_url'
    ];
}
