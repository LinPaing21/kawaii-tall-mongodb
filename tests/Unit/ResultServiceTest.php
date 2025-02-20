<?php

namespace Tests\Unit;

use App\Models\Exam;
use App\Models\Result;
use app\Services\ResultService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use app\Repositories\ResultRepository;


class ResultServiceTest extends TestCase
{
    use RefreshDatabase;
    protected $resultService;
    protected $resultRepoMock;

    protected function setUp(): void
    {
        parent::setUp();

        $this->resultRepoMock = $this->createMock(ResultRepository::class);
        $this->resultService = new ResultService($this->resultRepoMock);
    }

    public function test_get_overall_percentage_100()
    {
        $results = [
            ['score' => 5, 'answers' => [1, 2, 3, 4, 5]],
            ['score' => 7, 'answers' => [1, 2, 3, 4, 5, 6, 7]],
        ];

        $percentage = $this->resultService->getOverAllPercentage($results);

        $this->assertEquals(100, $percentage);
    }

    public function test_get_overall_percentage_75()
    {
        $results = [
            ['score' => 4, 'answers' => [1, 2, 3, 4, 5]],
            ['score' => 5, 'answers' => [1, 2, 3, 4, 5, 6, 7]],
        ];

        $percentage = $this->resultService->getOverAllPercentage($results);

        $this->assertEquals(75, $percentage);
    }

    public function test_get_total_score()
    {
        $results = [
            ['score' => 50],
            ['score' => 70],
        ];

        $totalScore = $this->resultService->getTotalScore($results);

        $this->assertEquals(120, $totalScore);
    }

    public function test_get_total_questions()
    {
        $results = [
            ['answers' => [1, 2, 3, 4, 5]],
            ['answers' => [1, 2, 3, 4, 5, 6, 7]],
        ];

        $totalQuestions = $this->resultService->getTotalQuestions($results);

        $this->assertEquals(12, $totalQuestions);
    }

    public function test_get_pass_mark()
    {
        $this->assertEquals(100, $this->resultService->getPassMark('N1'));
        $this->assertEquals(90, $this->resultService->getPassMark('N2'));
        $this->assertEquals(95, $this->resultService->getPassMark('N3'));
        $this->assertEquals(90, $this->resultService->getPassMark('N4'));
        $this->assertEquals(80, $this->resultService->getPassMark('N5'));
        $this->assertEquals(0, $this->resultService->getPassMark('Unknown'));
    }

    public function test_is_pass_for_N4_and_N5()
    {
        $exam = Exam::factory()->create(['level' => 'N4']);
        $result = Result::factory()->create(['exam_id' => $exam->id]);
        $result->results = [
            ['id' => 'vocabulary', 'score' => 4, 'answers' => [1, 2, 3, 4, 5]],
            ['id' => 'grammar', 'score' => 5, 'answers' => [1, 2, 3, 4, 5, 6, 7]],
            ['id' => 'listening', 'score' => 3, 'answers' => [1, 2, 3, 4, 5]],
        ];

        $this->assertTrue($this->resultService->isPass($result));
    }

    public function test_is_pass_for_other_levels()
    {
        $exam = Exam::factory()->create(['level' => 'N1']);
        $result = Result::factory()->create(['exam_id' => $exam->id]);
        $result->results = [
            ['score' => 5, 'answers' => [1, 2, 3, 4, 5]],
            ['score' => 7, 'answers' => [1, 2, 3, 4, 5, 6, 7]],
        ];

        $this->assertTrue($this->resultService->isPass($result));
    }

    public function test_is_failed_for_N4_and_N5()
    {
        $exam = Exam::factory()->create(['level' => 'N4']);
        $result = Result::factory()->create(['exam_id' => $exam->id]);
        $result->results = [
            ['id' => 'vocabulary', 'score' => 1, 'answers' => [1, 2, 3, 4, 5]],
            ['id' => 'grammar', 'score' => 1, 'answers' => [1, 2, 3, 4, 5, 6, 7]],
            ['id' => 'listening', 'score' => 1, 'answers' => [1, 2, 3, 4, 5]],
        ];

        $this->assertFalse($this->resultService->isPass($result));
    }

    public function test_is_failed_for_other_levels()
    {
        $exam = Exam::factory()->create(['level' => 'N1']);
        $result = Result::factory()->create(['exam_id' => $exam->id]);
        $result->results = [
            ['score' => 1, 'answers' => [1, 2, 3, 4, 5]],
            ['score' => 1, 'answers' => [1, 2, 3, 4, 5, 6, 7]],
        ];

        $this->assertFalse($this->resultService->isPass($result));
    }
}
