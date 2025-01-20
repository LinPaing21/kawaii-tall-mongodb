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
        foreach (Exam::raw()->distinct('year') as $y) {
            $this->years[] = $y->toDateTime()->format('Y');
        }

        $this->difficultyLevels = array_merge($this->difficultyLevels, Exam::raw()->distinct('level'));
    }

    public function setSelectedExam(Exam $exam) {
       $this->selectedExam = $exam;
    }

    public function render()
    {
        $filters = [ 'search' => $this->search, 'year' => $this->selectedYear, 'level' => $this->selectedLevel ];

        return view('livewire.exam-selection', [
            'exams' => Exam::filter($filters)->orderBy('year', 'DESC')->paginate(12)
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
