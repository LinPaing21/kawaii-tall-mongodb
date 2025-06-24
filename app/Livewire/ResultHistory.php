<?php

namespace App\Livewire;

use App\Models\Result;
use Livewire\Component;
use Livewire\WithPagination;

class ResultHistory extends Component
{
    use WithPagination;

    public $selectedLevel = 'all';
    public $selectedStatus = 'all';

    // protected $paginationTheme = 'bootstrap';

    // public function updatingSelectedLevel()
    // {
    //     $this->resetPage();
    // }

    // public function updatingSelectedStatus()
    // {
    //     $this->resetPage();
    // }

    public function render()
    {
        $results = Result::where('user_id', auth()->id())
            ->with(['exam'])
            ->when($this->selectedLevel !== 'all', function ($query) {
                return $query->whereHas('exam', function ($q) {
                    $q->where('level', $this->selectedLevel);
                });
            })
            ->when($this->selectedStatus !== 'all', function ($query) {
                return $query->where('is_pass', $this->selectedStatus === 'passed');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);


        $totalScoreAggregate = Result::where('user_id', auth()->id())->raw(function ($collection) {
            return $collection->aggregate([
                [
                    '$project' => [
                        'total_score' => ['$sum' => '$results.score'],
                        'total_questions' => [
                            '$sum' => [
                                '$map' => [
                                    'input' => '$results',
                                    'as' => 'r',
                                    'in' => ['$size' => '$$r.answers']
                                ]
                            ]
                        ]
                    ]
                ],
                [
                    '$project' => [
                        'total_score' => 1,
                        'total_questions' => 1,
                        'overAllPercentage' => [
                            '$round' => [
                                '$multiply' => [
                                    ['$divide' => ['$total_score', '$total_questions']],
                                    100
                                ]
                            ]
                        ]
                    ]
                ]
            ]);
        });

        // dd($totalScoreAggregate);
        // Calculate stats
        $stats = [
            'total' => Result::where('user_id', auth()->id())->count(),
            'passed' => Result::where('user_id', auth()->id())->where('is_pass', true)->count(),
            'average' => $totalScoreAggregate->avg('overAllPercentage') ?? 0,
            'best' => $totalScoreAggregate->max('overAllPercentage') ?? 0,
        ];

        return view('livewire.result-history', [
            'results' => $results,
            'stats' => $stats
        ]);
    }

    public function viewDetail(Result $result)
    {
        return $this->redirect(route('exam-result', ['result' => $result->id]), navigate: true);
    }
}
