<?php

namespace App\Livewire;

use App\Enums\ExamMode;
use App\Models\Exam;
use App\Models\Result;
use Livewire\Component;
use Livewire\Attributes\Url;
use App\Services\ResultService;

class ExamParticipate extends Component
{
    public Exam $exam;
    public $selectedSection;
    public $examSelections = [];

    // Add these properties for locked mode
    #[Url]
    public ExamMode $examMode = ExamMode::RESTRICTED; // 'restricted' or 'practice'
    public $currentSectionIndex = 0;
    public $completedSections = [];
    public $sectionStartTime;
    public $canNavigateBack = false;

    // Add these timer properties
    public $currentSectionTimeRemaining;
    public $isTimerActive = false;
    public $showTimeWarning = false;

    public function boot(ResultService $resultService)
    {
        $this->resultService = $resultService;
    }

    public function mount()
    {
        $this->selectedSection = $this->exam->exam_sections[0];
        // $this->sectionStartTime = now();
        foreach ($this->exam->exam_sections as $section) {
            $answers = [];
            $questionNos = [];
            foreach ($section['problems'] as $problem) {
                foreach ($problem['questions'] as $q) {
                    $answers[] = '-';
                    $questionNos[] = $problem['set'] . '-' . $q['no'];
                }
            }
            $this->examSelections[] = [
                "id" => $section['id'],
                "title" => $section['title'],
                "answers" => $answers,
                "questionNos" => $questionNos
            ];
        }

        $this->examSelections = collect($this->examSelections);

        // Initialize completed sections tracking
        $this->completedSections = array_fill(0, count($this->exam->exam_sections), false);

        // Initialize timer for first section
        $this->currentSectionTimeRemaining = $this->selectedSection['minutes'] * 60;
        $this->sectionStartTime = now();
        $this->isTimerActive = true;
    }

    public function selectSection($index)
    {
        if ($this->examMode === 'restricted') {
            // In restricted mode, only allow access to current section
            if ($index !== $this->currentSectionIndex) {
                $this->dispatch('show-submit-error', [
                    'type' => 'Warning',
                    'message' => 'You can only access the current section in exam mode.',
                ]);
                return;
            }
        }

        $this->selectedSection = $this->exam->exam_sections[$index];
    }

    public function nextSection()
    {
        if ($this->currentSectionIndex < count($this->exam->exam_sections) - 1) {
            // Mark current section as completed
            $this->completedSections[$this->currentSectionIndex] = true;

            // Move to next section
            $this->currentSectionIndex++;
            $this->selectedSection = $this->exam->exam_sections[$this->currentSectionIndex];

            $this->dispatch('section-changed', [
                'sectionIndex' => $this->currentSectionIndex,
                'sectionTitle' => $this->selectedSection['title']
            ]);

            // Reset timer for new section
            $this->currentSectionTimeRemaining = $this->selectedSection['minutes'] * 60;
            $this->sectionStartTime = now();
            $this->showTimeWarning = false;

            $this->dispatch('section-timer-reset', [
                'newDuration' => $this->currentSectionTimeRemaining,
                'sectionTitle' => $this->selectedSection['title']
            ]);
        }
    }

    public function handleSectionTimeUp()
    {
        if($this->currentSectionIndex < count($this->exam->exam_sections) -1) {
            $this->dispatch('timeup');
        }
        // Auto-advance to next section when time is up
        $this->dispatch('show-submit-error', [
            'type' => 'Warning',
            'message' => 'Time is up for ' . $this->selectedSection['title'] . '! Moving to next section.',
        ]);

        // Small delay then move to next section
        $this->dispatch('auto-advance-section');
    }

    public function canAccessSection($index)
    {
        if ($this->examMode === ExamMode::PRACTICE) {
            return true;
        }

        // In restricted mode, only current section is accessible
        return $index === $this->currentSectionIndex;
    }

    public function isRestrictedMode() {
        return $this->examMode === ExamMode::RESTRICTED;
    }

    public function isCurrentSection($index)
    {
        return $index === $this->currentSectionIndex;
    }

    public function isSectionCompleted($index)
    {
        return isset($this->completedSections[$index]) && $this->completedSections[$index];
    }

    // Rest of your existing methods...
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
            $result = $this->resultService->saveResult($this->exam, $this->examSelections, $this->examMode);
        } catch (\Throwable $th) {
            \Log::error($th->getMessage());
            return $this->dispatch('show-submit-error', [
                'type' => 'Error',
                'message' => 'Something went wrong while saving data!',
            ]);
        }

        $this->redirect(route('exam-result', ['result' => $result->id]));
    }

    public function render()
    {
        return view('livewire.exam-participate')->layout('layouts.app', [
            'examParticipate' => true,
        ]);
    }
}
