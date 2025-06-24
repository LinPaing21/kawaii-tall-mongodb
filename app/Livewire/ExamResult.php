<?php

namespace App\Livewire;

use App\Models\Result;
use Livewire\Component;
use App\Services\ResultService;

class ExamResult extends Component
{
    protected ResultService $resultService;

    public Result $result;

    public $overAllPercentage;
    public $totalScore = 0;

    public $totalMaxScore = 0;

    public $totalQuestions = 0;
    public $totalPoints = 0;

    public $passMark = 0;
    public $isPass = false;

    // New properties for encouraging messaging
    public $encouragingMessage = [];
    public $sectionalResults = [];
    public $passedOverall = false;
    public $allSectionsPassed = false;
    public $passingCriteria = [];

    public $showShareMessage = false;

    public function boot(ResultService $resultService)
    {
        $this->resultService = $resultService;
    }

    public function mount()
    {
        $this->totalScore = $this->resultService->getTotalScore($this->result->results);
        $this->totalMaxScore = $this->resultService->getTotalMaxScore($this->result->results);
        $this->totalQuestions = $this->resultService->getTotalQuestions($this->result->results);
        $this->overAllPercentage = $this->resultService->getOverAllPercentage($this->result->results);
        $this->passMark = $this->resultService->getPassMark($this->result->exam->level);
        $this->isPass = $this->resultService->isPass($this->result);

        // Calculate total points (0-180 scale)
        $this->totalPoints = $this->resultService->getTotalPoints($this->result->results, $this->result->exam);

        $this->passedOverall = $this->totalPoints >= $this->resultService->getPassMark($this->result->exam->level);

        $this->sectionalResults = $this->resultService->getResultPointData($this->result->results, $this->result->exam);
        // Generate encouraging message and analysis
        $this->generateEncouragingMessage();
    }

    private function generateEncouragingMessage()
    {
        if ($this->isPass) {
            $this->encouragingMessage = [
                'status' => 'Congratulations! 🎉',
                // 'message' => 'You passed! You met both the overall score and all sectional requirements!',
                'message' => 'You passed! You\'re ready for the real JLPT exam!',
                'color' => 'green',
                'icon' => '🏆',
                'type' => 'success'
            ];
        } elseif ($this->passedOverall && !$this->isPass) {
            $this->encouragingMessage = [
                'status' => 'So Close! 💪',
                'message' => 'You achieved the overall score but need to improve some sections. You\'re almost there!',
                'color' => 'yellow',
                'icon' => '⭐',
                'type' => 'sectional_focus'
            ];
        } elseif (!$this->passedOverall && $this->resultService->isPass($this->result, 'sectional')) {
            $this->encouragingMessage = [
                'status' => 'Great Balance! 📚',
                'message' => 'You passed all sections! Just need a bit more overall improvement.',
                'color' => 'orange',
                'icon' => '🌟',
                'type' => 'overall_focus'
            ];
        } else {
            $this->encouragingMessage = [
                'status' => 'Keep Building! 🚀',
                'message' => 'Every expert started as a beginner. Let\'s strengthen your foundation!',
                'color' => 'blue',
                'icon' => '💡',
                'type' => 'foundation'
            ];
        }
    }

    // Helper methods for the view
    public function getPointsNeededForOverall()
    {
        $level = $this->result->exam->level;
        $required = $this->passingCriteria[$level]['overall'];
        return max(0, $required - $this->totalPoints);
    }

    // public function getFailingSections()
    // {
    //     return collect($this->sectionalResults)->filter(function ($section) {
    //         return !$section['passed'];
    //     });
    // }

    // public function getStudyRecommendations()
    // {
    //     $recommendations = [];

    //     foreach ($this->getFailingSections() as $section) {
    //         $sectionTitle = $section['title'];

    //         if (str_contains($sectionTitle, 'Letters') || str_contains($sectionTitle, 'Vocabulary')) {
    //             $recommendations[$sectionTitle] = [
    //                 'priority' => 'high',
    //                 'tips' => [
    //                     'Practice Hiragana/Katakana daily (15 min)',
    //                     'Learn 10 new vocabulary words per day',
    //                     'Use flashcards for kanji recognition'
    //                 ]
    //             ];
    //         } elseif (str_contains($sectionTitle, 'Grammar')) {
    //             $recommendations[$sectionTitle] = [
    //                 'priority' => 'high',
    //                 'tips' => [
    //                     'Review basic sentence patterns',
    //                     'Practice particle usage (は, が, を, に)',
    //                     'Study verb conjugations'
    //                 ]
    //             ];
    //         } elseif (str_contains($sectionTitle, 'Listening')) {
    //             $recommendations[$sectionTitle] = [
    //                 'priority' => 'high',
    //                 'tips' => [
    //                     'Listen to Japanese podcasts daily',
    //                     'Practice with audio drills',
    //                     'Watch Japanese content with subtitles'
    //                 ]
    //             ];
    //         }
    //     }

    //     return $recommendations;
    // }

    public function render()
    {
        return view('livewire.exam-result');
    }

    public function share()
    {
        $this->showShareMessage = true;

        $this->dispatch('copy-to-clipboard', [
            'text' => "I just completed the JLPT pratice exam with a score of {$this->totalPoints} points! " .
                      "Check out my results: " . route('exam-result', $this->result->id),
            'message' => 'Result link copied to clipboard!'
        ]);
    }

    public function viewDetailResult()
    {
        return redirect(route('exam-result-detail', $this->result->id));
    }
}
