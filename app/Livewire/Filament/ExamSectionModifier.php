<?php

namespace App\Livewire\Filament;

use Livewire\Component;
use Livewire\Attributes\Modelable;

class ExamSectionModifier extends Component
{
    #[Modelable]
    public $examSections;

    public $page = 1;
    public function render()
    {
        return view('livewire.filament.exam-section-modifier');
    }

    public function handleNext()
    {
        if($this->page < count($this->examSections)){
            $this->page++;
        } else {
            $this->page = 1;
        }
    }

    public function handlePrevious()
    {
        if($this->page == 1){
            $this->page = count($this->examSections);
        } else {
            $this->page--;
        }
    }

    public function handleSave()
    {
        dd($this->examSections);
    }
}
