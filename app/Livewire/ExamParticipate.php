<?php

namespace App\Livewire;

use App\Models\Exam;
use App\Models\Result;
use Livewire\Component;
use app\Services\ResultService;

class ExamParticipate extends Component
{
    public Exam $exam;

    public $selectedSection;

    public $examSelections = [];

    public function boot(
        ResultService $resultService,
    ) {
        $this->resultService = $resultService;
    }


    public function mount()
    {
        $this->selectedSection = $this->exam->exam_sections[0];

        foreach ($this->exam->exam_sections as $section) {
            $answers = [];
            foreach ($section['problems'] as $problem) {
                foreach ($problem['questions'] as $q) {
                    $answers[] = '-';
                }
            }

            $this->examSelections[] = ["id" => $section['id'], "title" => $section['title'], "answers" => $answers];
        }

        $this->examSelections = collect($this->examSelections);
    }


    public function render()
    {
        return view('livewire.exam-participate')->layout('layouts.app', ['examParticipate' => true]);
    }

    public function selectSection($index)
    {
        $this->selectedSection = $this->exam->exam_sections[$index];
    }

    public function selectAnswer($id, $qIndex, $answer)
    {
        $this->examSelections->transform(function ($item, $key) use ($id, $qIndex, $answer) {
            if ($item['id'] == $id)
                $item['answers'][$qIndex] = $answer;

            return $item;
        });
    }

    public function submit()
    {
        try {
            $result = $this->resultService->saveResult($this->exam, $this->examSelections);
        } catch (\Throwable $th) {
            \Log::error($th->getMessage());

             // Your logic for saving data
            return $this->dispatch('show-submit-error', [
                'type' => 'Error',  // Can be 'success', 'error', 'warning', etc.
                'message' => 'Something went wrong while saving data!',
            ]);
        }

        $this->redirect(route('exam-result', ['result' => $result->id]));
    }
}
