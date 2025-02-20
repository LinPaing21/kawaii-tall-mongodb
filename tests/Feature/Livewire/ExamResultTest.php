<?php

namespace Tests\Feature\Livewire;

use App\Livewire\ExamResult;
use App\Models\Result;
use App\Models\Exam;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ExamResultTest extends TestCase
{
    use RefreshDatabase;

    protected Exam $exam;
    protected Result $result;

    protected function setUp(): void
    {
        parent::setUp();

        $this->exam = Exam::factory()->create(['name' => 'JLPT N5', 'level' => 'N5']);
        $this->result = Result::factory()->create([
            'exam_id' => $this->exam->id,
            'results' => [
                ['id' => 'vocabulary', 'title' => 'Vocabulary' ,'score' => 5, 'answers' => [1, 2, 3, 4, 5]],
                ['id' => 'grammar', 'title' => 'Grammar', 'score' => 7, 'answers' => [1, 2, 3, 4, 5, 6, 7]],
            ]
        ]);
    }
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(ExamResult::class, ['result' => $this->result])
            ->assertStatus(200);
    }

    /** @test */
    public function shows_passed_if_is_pass_true()
    {
        $result = Result::factory()->create([
            'exam_id' => $this->exam->id,
            'results' => [
                ['id' => 'vocabulary', 'title' => 'Vocabulary' ,'score' => 5, 'answers' => [1, 2, 3, 4, 5]],
                ['id' => 'grammar', 'title' => 'Grammar', 'score' => 7, 'answers' => [1, 2, 3, 4, 5, 6, 7]],
                ['id' => 'listening', 'title' => 'Listening', 'score' => 7, 'answers' => [1, 2, 3, 4, 5, 6, 7]],
            ]
        ]);

        Livewire::test(ExamResult::class, ['result' => $result])
            ->assertSee('Passed')
            ->assertDontSee('Failed');
    }

    /** @test */
    public function shows_failed_if_is_pass_false()
    {
        Livewire::test(ExamResult::class, ['result' => $this->result])
            ->assertSee('Failed')
            ->assertDontSee('Passed');
    }

    /** @test */
    public function shows_correct_exam_name_and_level()
    {
        Livewire::test(ExamResult::class, ['result' => $this->result])
            ->assertSee('JLPT N5')
            ->assertSee('Level: JLPT N5');
    }

    /** @test */
    public function shows_donation_text()
    {
        Livewire::test(ExamResult::class, ['result' => $this->result])
            ->assertSee('Support JLPT Master')
            ->assertSee('Your donations help us improve and create more study materials');
    }
}
