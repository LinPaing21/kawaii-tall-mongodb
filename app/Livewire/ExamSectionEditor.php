<?php

namespace App\Livewire;

use Livewire\Component;

class ExamSectionEditor extends Component
{
    public $exam;

    public $page = 1;

    public $examSections = [];
    public function render()
    {
        return view('livewire.exam-section-editor');
    }
}
