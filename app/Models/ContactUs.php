<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContactUs extends Model
{
    /** @use HasFactory<\Database\Factories\ExamFactory> */
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'contact_us';

    protected $fillable = [
        'name',
        'email',
        'type',
        'subject',
        'message',
        'attachments',
    ];
}
