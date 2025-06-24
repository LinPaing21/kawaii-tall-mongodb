<?php

namespace Tests\Feature\Livewire;

use App\Livewire\ResultHistory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class ResultHistoryTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(ResultHistory::class)
            ->assertStatus(200);
    }
}
