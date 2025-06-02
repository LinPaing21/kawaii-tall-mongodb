<?php

namespace App\Filament\Resources\ExamResource\Traits;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

trait ExamSection
{
    public function generateExamSections(){
        $client = new Client();

        try {
            $response = $client->request('GET', config('services.lambda.url'), [
                'query' => [
                    'level' => $this->data['level'],
                    'path' => $this->data['path'],
                ],
            ]);

            $this->data['exam_sections'] = json_decode($response->getBody(), true);
        } catch(RequestException $e) {
            \Log::error($e->getMessage());
            if($e->hasResponse()) {
                $response = $e->getResponse();
                $body = json_decode($response->getBody(), true);
                session()->flash('error', 'Exam Sections Generation Failed. ' . @$body['message'] . '.');
            } else {
                session()->flash('error', 'Exam Sections Generation Failed.');
            }
        }
        catch (\Exception $e) {
            \Log::error($e->getMessage());
            session()->flash('error', 'Exam Sections Generation Failed.');
        }
    }
}