<?php

namespace Database\Factories;

use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Exam>
 */
class ExamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $level = Arr::random(["N1", "N2", "N3", "N4", "N5"]);
        $year = fake()->dateTime();

        return [
            "name" => "{$level} - {$year->format('F Y')}",
            "level" => $level,
            "description" => fake()->sentences(2, true),
            "year" => $year,

            "exam_sections" => [
                [
                    "id" => "vocabulary",
                    "type" => "Vocabulary",
                    "title" => "Vocabulary",
                    "minutes" => 30,
                    "problems" => [
                        [
                            "set" => 1,
                            "problem" => "<u>の ことばは ひらがなで どう かきますか。1・2・3・4から いちばん いい ものを ひとつ えらんで ください。</u>",
                            "example" => [
                                "question" => "<u>女の子</u>が うまれました。",
                                "options" => [
                                    ["no" => 1, "body" => "おなのこ", "is_correct" => false],
                                    ["no" => 2, "body" => "おんなのこ", "is_correct" => true],
                                    ["no" => 3, "body" => "おなのこう", "is_correct" => false],
                                    ["no" => 4, "body" => "おんなのこう", "is_correct" => false],
                                ],
                            ],
                            "questions" => [
                                [
                                    "no" => 1,
                                    "question" => "いま <u>店</u>の まえにいます。",
                                    "options" => [
                                        ["no" => 1, "body" => "いえ", "is_correct" => false],
                                        ["no" => 2, "body" => "えき", "is_correct" => false],
                                        ["no" => 3, "body" => "みせ", "is_correct" => true],
                                        ["no" => 4, "body" => "へや", "is_correct" => false],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];
    }
}
