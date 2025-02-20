<?php

namespace App\Livewire;

use App\Models\Exam;
use App\Models\Result;
use Livewire\Component;

class ExamParticipate extends Component
{
    public Exam $exam;

    public $selectedSection;

    public $examSelections = [];

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

    public function selectAnswer($title, $qIndex, $answer)
    {
        $this->examSelections->transform(function($item, $key) use ($title, $qIndex, $answer) {
            if($item['title'] == $title) $item['answers'][$qIndex] = $answer;

            return $item;
        });
    }

    public function submit()
    {
        $sections = collect($this->exam->exam_sections);

        $this->examSelections->transform(function($item, $key) use($sections) {
            $item['score'] = 0;
            $i = 0;

            $section = $sections->firstWhere('id', $item['id']);
            foreach ($section['problems'] as $problem) {
                foreach ($problem['questions'] as $q) {
                    if($item['answers'][$i] == '-') {
                        $i++;
                        continue;
                    }
                    if($q['options'][$item['answers'][$i]-1]['is_correct']) $item['score'] += 1;
                    $i++;
                }
            }

            return $item;
        });

        $result = Result::create([
            "exam_id" => $this->exam->id,
            "user_id" => auth()->user()?->id ?? 'test_user',
            "results" => $this->examSelections->toArray()
        ]);

        $this->redirect(route('exam-result', ['result' => $result->id]));
    }
}
