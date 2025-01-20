<?php

namespace Tests\Feature\Livewire;

use Tests\TestCase;
use App\Models\Exam;
use Livewire\Livewire;
use App\Livewire\ExamSelection;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExamSelectionTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(ExamSelection::class)
            ->assertStatus(200)
            ->assertSee('Search')
            ->assertSee('All');
    }

    public function test_page_does_not_contain_exam_data()
    {
        $response = $this->get('/exam-selection');

        $response->assertSuccessful();
        $response->assertSee('No Results Found!');
    }

    public function test_page_contains_exam_data()
    {
        $exam = Exam::factory()->create();

        Livewire::test(ExamSelection::class)
            ->assertStatus(200)
            ->assertDontSee('No Results Found!')
            ->assertViewHas('exams', function ($collection) use ($exam) {
                return $collection->contains($exam);
            });
    }


    public function test_pagination_works_successfully()
    {
        $exams = Exam::factory(13)->create();

        Livewire::test(ExamSelection::class)
            ->assertStatus(200)
            ->assertViewHas('exams', function ($collection) use ($exams) {
                return !$collection->contains($exams->sortByDesc('year')->last());
            });
    }

    public function test_does_select_dropdown_component_work()
    {
        $years = ['All', '2022', '2023'];
        $view = $this->blade(
            '<x-utilities.select-dropdown :options="$years" id="year" :selected="$selectedYear" />',
            ['years' => $years, 'selectedYear' => null]
        );

        foreach ($years as $year) {
            $view->assertSee($year);
        }
    }
}
