<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;


class SupportUs extends Component
{
    use WithFileUploads;
    public $selectedAmount = null;
    public $customAmount;

    public $supportName;
    public $supportAmount;

    public $email;

    public $note;
    public $screenshot;

    public $donationTiers = [
        [
            'amount' => '5,000',
            'title' => 'Coffee Supporter',
            'description' => 'Buy us a coffee to keep us energized!',
            'icon' => '☕',
            'perks' => ['Our eternal gratitude', 'Supporter badge']
        ],
        [
            'amount' => '15,000',
            'title' => 'Study Buddy',
            'description' => 'Help us create more study materials',
            'icon' => '📖',
            'perks' => ['Everything above', 'Early access to new features', 'Priority support']
        ],
        [
            'amount' => '30,000',
            'title' => 'JLPT Champion',
            'description' => 'Support server costs and development',
            'icon' => '⭐',
            'perks' => ['Everything above', 'Monthly progress reports', 'Feature request priority']
        ],
        // [
        //     'amount' => 50,
        //     'title' => 'Kawaii Patron',
        //     'description' => 'Help us keep everything free forever',
        //     'icon' => '❤️',
        //     'perks' => ['Everything above', 'Direct line to developers', 'Special recognition']
        // ]
    ];

    public $impactStats = [
        // ['icon' => '👥', 'number' => '10,000+', 'label' => 'Students Helped'],
        ['icon' => '📖', 'number' => '500+', 'label' => 'Practice Questions'],
        ['icon' => '⚡', 'number' => '99.9%', 'label' => 'Uptime'],
        ['icon' => '❤️', 'number' => '100%', 'label' => 'Free Forever']
    ];

    protected $listeners = ['selectAmountFromAlpine' => 'selectAmount'];

    public function selectAmount($amount)
    {
        $this->selectedAmount = $amount;
    }

    public function donateCustom()
    {
        if ($this->customAmount >= 1) {
            session()->flash('message', 'Thank you for supporting us with $' . $this->customAmount . '!');
            $this->customAmount = null;
        }
    }

    protected $rules = [
        'supportName' => 'required|string|max:255',
        'email' => 'nullable|email:rfc,dns',
        'supportAmount' => 'required|numeric|min:2000',
        'note' => 'nullable|string|max:255',
        'screenshot' => 'required|image|max:2048', // 2MB limit
    ];

    public function submitSupport()
    {
        $this->validate();

        // Store screenshot
        $path = $this->screenshot->store('support_screenshots', 's3');

        \App\Models\Donation::create([
            'name' => $this->supportName,
            'email' => $this->email,
            'amount' => $this->supportAmount,
            'note' => $this->note,
            'path' => $path
        ]);

        // Process or store the donation info
        session()->flash('message', 'Thank you, ' . $this->supportName . '! We do appreciate your support and will use for good.');

        // Reset form
        $this->reset(['supportName', 'supportAmount', 'screenshot', 'note']);
    }
    public function render()
    {
        return view('livewire.support-us');
    }
}
