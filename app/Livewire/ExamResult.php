<?php

namespace App\Livewire;

use App\Models\Result;
use Livewire\Component;
use app\Services\ResultService;

class ExamResult extends Component
{
    private ResultService $resultService;

    public Result $result;

    public $overAllPercentage;

    public $totalScore = 0;
    public $totalQuestions = 0;

    public $passMark = 0;
    public $isPass = false;

    public function boot(
       ResultService $resultService,
    ) {
        $this->resultService = $resultService;
    }

    public function mount()
    {
        $this->totalScore = $this->resultService->getTotalScore($this->result->results);
        $this->totalQuestions = $this->resultService->getTotalQuestions($this->result->results);

        $this->overAllPercentage = $this->resultService->getOverAllPercentage($this->result->results);

        $this->passMark = $this->resultService->getPassMark($this->result->exam->level);

        $this->isPass = $this->resultService->isPass($this->result);
    }

    public function render()
    {
        return view('livewire.exam-result');
    }
}
