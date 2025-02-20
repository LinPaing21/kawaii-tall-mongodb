<?php

namespace Tests\Feature\Livewire;

use Tests\TestCase;
use App\Models\Exam;
use App\Models\Result;
use Livewire\Livewire;
use App\Livewire\ExamParticipate;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExamParticipateTest extends TestCase
{
    use RefreshDatabase;

    protected Exam $exam;
    protected function setUp(): void
    {
        parent::setUp();

        $this->exam = Exam::factory()->create([
            'exam_sections' => [
                [
                    'title' => 'Section 1',
                    'id' => 'section1',
                    'minutes' => 30,
                    'problems' => [
                        [
                            'set' => 1,
                            'problem' => 'Problem 1',
                            'questions' => [
                                [
                                    'no' => 1,
                                    'question' => 'Question 1',
                                    'options' => [
                                        ['no' => 1, 'body' => 'Option 1', 'is_correct' => false],
                                        ['no' => 2, 'body' => 'Option 2', 'is_correct' => true],
                                    ]
                                ]
                            ]
                        ]
                    ]
                ],
                ['title' => 'Section 2', 'id' => 'section2', 'problems' => [], "minutes" => 30,],
                ['title' => 'Section 3', 'id' => 'section3', 'problems' => [], "minutes" => 30,],
            ]
        ]);
    }

    /** @test */
    public function renders_successfully()
    {
        Livewire::test(ExamParticipate::class, params: ['exam' => $this->exam])
            ->assertStatus(200);
    }

    /** @test */
    public function shows_three_buttons_if_three_exam_sections()
    {
        Livewire::test(ExamParticipate::class, ['exam' => $this->exam])
            ->assertSeeInOrder(['Section 1', 'Section 2', 'Section 3']);
    }

    /** @test */
    public function select_section_method_works()
    {
        Livewire::test(ExamParticipate::class, ['exam' => $this->exam])
            ->call('selectSection', 1)
            ->assertSet('selectedSection.title', 'Section 2');
    }

    /** @test */
    public function select_answer_method_works()
    {
        Livewire::test(ExamParticipate::class, ['exam' => $this->exam])
            ->call('selectAnswer', 'Section 1', 0, 2)
            ->assertSet('examSelections.0.answers.0', 2);
    }

    /** @test */
    public function submit_method_works()
    {
        Livewire::test(ExamParticipate::class, ['exam' => $this->exam])
            ->call('selectAnswer', 'Section 1', 0, 2)
            ->call('submit');

        $this->assertDatabaseHas('results', [
            'exam_id' => $this->exam->id,
            'results' => [
                [
                    'id' => 'section1',
                    'title' => 'Section 1',
                    'answers' => [2],
                    'score' => 1
                ],
                [
                    'id' => 'section2',
                    'title' => 'Section 2',
                    'answers' => [],
                    'score' => 0
                ],
                [
                    'id' => 'section3',
                    'title' => 'Section 3',
                    'answers' => [],
                    'score' => 0
                ]
            ]
        ]);
    }
}
