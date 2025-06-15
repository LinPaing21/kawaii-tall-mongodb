<?php

namespace App\Livewire;

use App\Models\Result;
use Livewire\Component;

class ResultDetail extends Component
{
    public ?Result $result;
    public $examResults;

    public function mount($resultId = null)
    {
        $this->result ??= Result::find($resultId);
        if (!$this->result) {
            abort(404, 'Result not found');
        }
        $this->examResults = app(\App\Services\ResultService::class)->getDataForResultDetail($this->result);
    }

    public function render()
    {
        return view('livewire.result-detail');
    }
}
