<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Exam extends Model
{
    /** @use HasFactory<\Database\Factories\ExamFactory> */
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'exams';

    protected $guard = [];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'year' => 'datetime',
        ];
    }

    public function scopeFilter(Builder $query, array $filters)
    {
        if($filters['search']) {
            $query = $query->where(function($q) use($filters) {
                return $q->where('name', 'LIKE', "%{$filters['search']}%")
                        ->orWhere('level', 'LIKE', "%{$filters['search']}%");
            });
        }
        if($filters['year']) $query = $query->whereYear('year', $filters['year']);
        if($filters['level']) $query = $query->where('level', $filters['level']);

        return $query;
    }
}
