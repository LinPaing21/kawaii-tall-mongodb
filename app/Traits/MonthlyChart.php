<?php

namespace App\Traits;

use Carbon\Carbon;

trait MonthlyChart
{
    protected function prepareData($data = [], $year = null) {
        $prepare = [];
        if ($year && $year != now()->year) {
            $start = Carbon::create($year)->startOfYear();
            $end = Carbon::create($year)->endOfYear();
        } else {
            $start = Carbon::now()->startOfYear();
            $end = Carbon::now();
        }


        while ($start->lte($end)) {
            $prepare[$start->format('M')] = $data[$start->format('M')] ?? 0;
            $start->addMonth();
        }

        return $prepare;
    }

    protected function filterYears(string $model)
    {
        return $model::raw(function ($collection) {
            return $collection->aggregate([
                [
                    '$project' => [
                        '_id' => 0,
                        'year' => ['$year' => '$created_at']
                    ]
                ],
                [
                    '$group' => [
                        '_id' => '$year',
                    ]
                ],
                [
                    '$project' => [
                        'year' => '$_id',
                    ]
                ],
                [
                    '$sort' => ['year' => -1]
                ],
            ]);
        })->pluck('year', 'id')->toArray();
    }

    protected function queryData(string $model)
    {
        return $model::raw(function ($collection) {
            return $collection->aggregate([
                [
                    '$match' => [
                        'created_at' => [
                            '$gte' => new \MongoDB\BSON\UTCDateTime(Carbon::create($this->filter)->startOfYear()),
                            '$lte' => new \MongoDB\BSON\UTCDateTime(now()->year == $this->filter ? now() : Carbon::create($this->filter)->endOfYear()),
                        ],
                    ],
                ],
                [
                    '$group' => [
                        '_id' => [
                            'month' => ['$month' => '$created_at'],
                        ],
                        'count' => ['$sum' => 1],
                    ],
                ],
                [
                    '$project' => [
                        'date' => [
                            '$dateToString' => [
                                'format' => '%b',
                                'date' => [
                                    '$dateFromParts' => [
                                        'year' => 2025,
                                        'month' => '$_id.month',
                                        'day' => 1,
                                    ],
                                ],
                            ],
                        ],
                        'aggregate' => '$count',
                        '_id' => 0,
                    ],
                ],
                [
                    '$sort' => ['date' => -1],
                ],
            ]);
        })->pluck('aggregate', 'date')->toArray();
    }
}
