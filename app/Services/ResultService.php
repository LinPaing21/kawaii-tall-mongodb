<?php
namespace app\Services;

use App\Models\Result;
use app\Repositories\ResultRepository;

class ResultService
{

    public function __construct(
        protected ResultRepository $resultRepo
    ) {
    }

    public function getOverAllPercentage(array $results)
    {
        return round(($this->getTotalScore($results) / $this->getTotalQuestions($results)) * 100);
    }

    public function getTotalScore(array $results)
    {
        return collect($results)->sum('score');
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
        $passMark = 0;

        switch ($level) {
            case 'N1':
                $passMark = 100;
                break;
            case 'N2':
                $passMark = 90;
                break;
            case 'N3':
                $passMark = 95;
                break;
            case 'N4':
                $passMark = 90;
                break;
            case 'N5':
                $passMark = 80;
                break;
            default:
                $passMark = 0;
                break;
        }

        return $passMark;
    }

    public function isPass(Result $result)
    {
        $results = collect($result->results);
        $level = $result->exam->level;
        if($level == 'N5' || $level == 'N4') {

            $result1 = $results->firstWhere('id', 'vocabulary');
            $result2 = $results->firstWhere('id', 'grammar');
            $result3 = $results->firstWhere('id', 'listening');

            $lkTotalPoints = 0;
            $lsnTotalPoints = 0;

            if($result1 && !$result2 && !$result3) {
                $lkTotalPoints = count($result1["answers"]) > 0 ? floor(($result1["score"] / count($result1["answers"])) * 60) : 0;
                return $lkTotalPoints >= 19;
            }

            if($result2 && !$result1 && !$result3) {
                if (count($result2["answers"]) > 0) {
                    $lkTotalPoints += floor(($result2["score"] / count($result2["answers"])) * 60);
                }
                return $lkTotalPoints >= 19;
            }

            if($result3 && !$result1 && !$result2) {
                $lsnTotalPoints = count($result3["answers"]) > 0 ? floor(($result3["score"] / count($result3["answers"])) * 60) : 0;
                return $lsnTotalPoints >= 19;
            }

            if($result1 && $result2 && $result3) {
                $lkTotalPoints = (count($result1["answers"]) > 0 ? floor(($result1["score"] / count($result1["answers"])) * 60) : 0) +
                                 (count($result2["answers"]) > 0 ? floor(($result2["score"] / count($result2["answers"])) * 60) : 0);
                $lsnTotalPoints = count($result3["answers"]) > 0 ? floor(($result3["score"] / count($result3["answers"])) * 60) : 0;
                return $lkTotalPoints >= 38 && $lsnTotalPoints >= 19;
            }

            return false;
        } else {
            $isPass = false;
            $results->each(function ($result) use(&$isPass) {
                $isPass = floor(($result["score"] / count($result["answers"])) * 60) >= 39;

                if(!$isPass) return $isPass;
            });

            return $isPass;
        }
    }
}
