<?php

namespace App\Livewire;

use Livewire\Component;

class ContactUs extends Component
{
    public $name = '';
    public $email = '';
    public $type = '';
    public $subject = '';
    public $message = '';
    public function render()
    {
        return view('livewire.contact-us');
    }

    public function submit()
    {
        // Handle form submission logic here
        // For example, you can validate the input and send an email
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'type' => 'required|string|max:50',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
        ]);

        \App\Models\ContactUs::create([
            'name' => $this->name,
            'email' => $this->email,
            'type' => $this->type,
            'subject' => $this->subject,
            'message' => $this->message,
            // Handle attachments if needed
            'attachments' => [], // Placeholder for attachments logic
        ]);

        session()->flash('message','Your message has been sent successfully!');

        $this->reset(['name', 'email', 'type', 'subject', 'message']);
    }
}
