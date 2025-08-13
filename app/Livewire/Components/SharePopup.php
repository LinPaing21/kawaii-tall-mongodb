<?php

namespace App\Livewire\Components;

use Livewire\Component;

class SharePopup extends Component
{
    public $url;
    public $title;
    public $image;

    public $hashTag;

    protected $listeners = ['openSharePopup' => 'open'];

    public function mount($url = '', $title = '', $image = '', $hashTag = '')
    {
        $this->url = $url ?: url()->current();
        $this->title = $title ?: config('app.name');
        $this->image = $image;
        $this->hashTag = $hashTag;
    }

    public function open($url, $title = '', $image = '')
    {
        $this->url = $url;
        $this->title = $title ?: $this->title;
        $this->image = $image ?: $this->image;
        $this->dispatchBrowserEvent('open-share-popup');
    }

    public function copyLink()
    {
        $this->dispatchBrowserEvent('copy-link', ['url' => $this->url]);
    }

    public function render()
    {
        return view('livewire.components.share-popup');
    }
}
