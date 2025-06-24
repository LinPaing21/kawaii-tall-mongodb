<?php
namespace App\Services;

use App\Models\Exam;
use App\Models\Result;
use Illuminate\Support\Collection;
use app\Repositories\ResultRepository;

class ResultService
{

    public function __construct(
        protected ResultRepository $resultRepo
    ) {
    }

    public function getOverAllPercentage(array $results)
    {
        return round(($this->getTotalScore($results) / $this->getTotalMaxScore($results)) * 100);
    }

    public function getSectionalPercentage($sectionResult)
    {
        return round(($sectionResult['score'] / $sectionResult['max_score']) * 100);
    }

    public function getTotalScore(array $results)
    {
        return collect($results)->sum('score');
    }

    public function getTotalMaxScore(array $results)
    {
        return collect($results)->sum('max_score');
    }

    public function getTotalPoints(array $results, Exam $exam)
    {
        $points = $this->getResultPointData($results, $exam);
        return $points['total'];
    }

    public function getResultPointData(array $results, Exam $exam)
    {
        switch ($exam->level) {
            case 'N5':
                $firstTotal = data_get($results, '0.score', 0) + data_get($results, '1.score', 0);
                $firstMaxTotal = data_get($results, '0.max_score', 0.5) + data_get($results, '1.max_score', 0.5);

                $firstPoints = round(($firstTotal / $firstMaxTotal) * 120, 1);

                $secPoints = round(data_get($results, '2.score', 0) / data_get($results, '2.max_score', 1) * 60, 1);

                return [
                    "first" => $firstPoints,
                    "second" => $secPoints,
                    "total" => $firstPoints + $secPoints
                ];
            case 'N4':
                $firstTotal = data_get($results, '0.score', 0) + data_get($results, '1.score', 0);
                $firstMaxTotal = data_get($results, '0.max_score', 0.5) + data_get($results, '1.max_score', 0.5);

                $firstPoints = round(($firstTotal / $firstMaxTotal) * 120, 1);

                $secPoints = round(data_get($results, '2.score', 0) / data_get($results, '2.max_score', 1) * 60, 1);

                return [
                    "first" => $firstPoints,
                    "second" => $secPoints,
                    "total" => $firstPoints + $secPoints
                ];
            case 'N3':
                $firstTotal = data_get($results, '0.score', 0);
                $secTotal = 0;
                $secMaxTotal = 0;
                $readingTotal = 0;
                $readingMaxTotal = 0;

                $section = collect($exam->exam_sections)->firstWhere('id', data_get($results, '1.id', 'grammar_reading'));
                $i = 0;
                foreach ($section['problems'] as $problem) {
                    foreach ($problem['questions'] as $q) {
                        if($problem['set'] <= 3){
                            $secMaxTotal += config('marking_system.' . $exam->level . '.sections.' . $section['id'] . '.problemSet' . $problem['set']);
                        } else {
                            $readingMaxTotal += config('marking_system.' . $exam->level . '.sections.' . $section['id'] . '.problemSet' . $problem['set']);
                        }
                        if ($results[1]['answers'][$i] == '-') {
                            $i++;
                            continue;
                        }
                        if ($q['options'][$results[1]['answers'][$i] - 1]['is_correct']) {
                            if($problem['set'] <= 3){
                                $secTotal += config('marking_system.' . $exam->level . '.sections.' . $section['id'] . '.problemSet' . $problem['set']);
                            } else {
                                $readingTotal += config('marking_system.' . $exam->level . '.sections.' . $section['id'] . '.problemSet' . $problem['set']);
                            }
                        }
                        $i++;
                    }
                }
                $firstPoints = round((($firstTotal + $secTotal) / (data_get($results, '0.max_score', 35) + $secMaxTotal)) * 60, 1);

                $secPoints = round(($readingTotal / $readingMaxTotal) * 60, 1);

                $thirdPoints = round(data_get($results, '2.score', 0) / data_get($results, '2.max_score', 1) * 60, 1);

                return [
                    "first" => $firstPoints,
                    "second" => $secPoints,
                    "third" => $thirdPoints,
                    "total" => $firstPoints + $secPoints + $thirdPoints
                ];
            case 'N2':
                $firstPoints = round(data_get($results, '0.score', 0) / data_get($results, '0.max_score', 1) * 60, 1);
                $secPoints = round(data_get($results, '1.score', 0) / data_get($results, '1.max_score', 1) * 60, 1);
                $thirdPoints = round(data_get($results, '2.score', 0) / data_get($results, '2.max_score', 1) * 60, 1);

                return [
                    "first" => $firstPoints,
                    "second" => $secPoints,
                    "third" => $thirdPoints,
                    "total" => $firstPoints + $secPoints + $thirdPoints
                ];
            default:
                return [
                    "first" => 0,
                    "second" => 0,
                    "third" => 0,
                    "total" => 0,
                ];
        }
    }

    public function getTotalQuestions(array $results)
    {
        $totalQuestions = 0;
        foreach ($results as $result) {
            $totalQuestions += count($result['answers']);
        }

        return $totalQuestions;
    }

    public function getPassMark($level)
    {
        return config("marking_system.{$level}.overAllPassMark", 100);
    }

    public function isPass(Result $result, $type = 'overall')
    {
        $level = $result->exam->level;
        $points = $this->getResultPointData($result->results, $result->exam);

        if ($type == 'overall') {
            // Check if passed overall
            $passedOverall = $points['total'] >= $this->getPassMark($level);

            if (!$passedOverall)
                return false;
        }

        if ($level == 'N5' || $level == 'N4') {
            return $points['first'] >= 38 && $points['second'] >= 19;
        } else {
            return $points['first'] >= 19 && $points['second'] >= 19 && $points['third'] >= 19;
        }
    }

    public function saveResult(Exam $exam, Collection $examSelections)
    {
        $sections = collect($exam->exam_sections);

        $examSelections->transform(function ($item, $key) use ($sections, $exam) {
            $item['score'] = 0;
            $item['max_score'] = 0;
            $i = 0;

            $section = $sections->firstWhere('id', $item['id']);
            foreach ($section['problems'] as $problem) {
                $item['max_score'] += config('marking_system.' . $exam->level . '.sections.' . $section['id'] . '.problemSet' . $problem['set']) * count($problem['questions']);
                foreach ($problem['questions'] as $q) {
                    if ($item['answers'][$i] == '-') {
                        $i++;
                        continue;
                    }
                    if ($q['options'][$item['answers'][$i] - 1]['is_correct'])
                        $item['score'] += config('marking_system.' . $exam->level . '.sections.' . $section['id'] . '.problemSet' . $problem['set']);
                    $i++;
                }
            }

            return $item;
        });

        $data = [
            "exam_id" => $exam->id,
            "user_id" => auth()->user()?->id ?? 'test_user',
            "results" => $examSelections->toArray()
        ];

        $result = $this->resultRepo->create($data);

        $result->is_pass = $this->isPass($result, 'overall');
        $result->save();

        return $result;
    }

    public function getProblemMark($level, $qNo, $problemNo, $sectionId) {

    }

    public function getDataForResultDetail($result)
    {
        $exam = $result->exam;
        $sections = collect($exam->exam_sections);

        $examResults = collect($result->results)->map(function ($item) use ($sections) {
            $section = $sections->firstWhere('id', $item['id']);
            $i = 0;
            foreach ($section['problems'] as $index => $problem) {
                foreach ($problem['questions'] as $k => $q) {
                    // $q['selected'] = $item['answers'][$i++];
                    \Arr::set($section, 'problems.' . $index . '.questions.' . $k . '.selected', $item['answers'][$i++]);
                }
            }
            return $section;
        });

        return $examResults;
    }
}
