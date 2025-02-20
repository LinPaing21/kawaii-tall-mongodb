<?php

namespace App\Models;

use App\Models\Exam;
use App\Models\User;
use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Result extends Model
{
    /** @use HasFactory<\Database\Factories\ResultFactory> */
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'results';

    protected $guarded = [];

    /**
     * Get the user that owns the Result
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }
}
