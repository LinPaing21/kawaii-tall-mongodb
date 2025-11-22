<?php

namespace App\Livewire;

use App\Models\Exam;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class ExamSelection extends Component
{
    use WithPagination;

    public $years = ['All'];

    public $difficultyLevels = ['All'];

    #[Url]
    public ?string $search = null;

    #[Url]
    public ?string $selectedYear = null;

    #[Url]
    public ?string $selectedLevel = null;

    public Exam $selectedExam;

    public function mount()
    {
        $this->years = array_merge(
            $this->years,
            Exam::raw(function($collection) {
                return $collection->aggregate([
                    [
                        '$project' => [
                            'year' => ['$year' => '$year']
                        ]
                    ],
                    [
                        '$group' => ['_id' => '$year']
                    ],
                    [
                        '$sort' => ['_id' => 1]
                    ]
                ]);
            })->pluck('_id')->toArray()
        );

        $this->difficultyLevels = array_merge($this->difficultyLevels, Exam::raw()->distinct('level'));
    }

    public function setSelectedExam(Exam $exam) {
       $this->selectedExam = $exam;
        // return $this->redirect(route("exam-participate", ["exam" => $exam->id]), navigate: true);
    }

    public function render()
    {
        $filters = [ 'search' => $this->search, 'year' => $this->selectedYear, 'level' => $this->selectedLevel ];

        return view('livewire.exam-selection', [
            'exams' => Exam::filter($filters)->where('active', true)->orderBy('year', 'DESC')->paginate(12)
        ]);
    }

    public function setFilter($type, $val)
    {
        if($val == 'All') {
            $this->reset("selected" . ucfirst($type));
            return;
        }

        switch ($type) {
            case 'year':
                $this->selectedYear = $val;
                break;
            case 'level':
                $this->selectedLevel = $val;
                break;
            default:
                # code...
                break;
        };
    }
}
