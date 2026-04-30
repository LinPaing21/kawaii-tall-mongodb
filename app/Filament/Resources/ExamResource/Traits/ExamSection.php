<?php

namespace App\Filament\Resources\ExamResource\Traits;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

trait ExamSection
{
    public function generateExamSections(){
        $client = new Client();

        try {
            session()->remove('error');

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

    public function uploadToLambda() {
        try {
            session()->remove('error');

            $file = reset($this->data['pdf_file']);
            $filename = $file->getClientOriginalName();

            // 1. Get the Pre-signed URL from your FastAPI Lambda
            $response = \Http::get(config('services.lambda.url') . "generate-upload-url", [
                'filename' => $filename
            ]);

            logger('response json', [$response->json()]);
            $uploadUrl = $response->json()['upload_url'];
            $fileKey = $response->json()['file_key'];

            // 2. Upload the file to S3 using the Pre-signed URL
            $uploadResponse = \Http::withBody(
                file_get_contents($file->getRealPath()), 'application/pdf'
            )->put($uploadUrl);
                logger('upload response', [$uploadResponse]);
            if ($uploadResponse->successful()) {
                // 3. Trigger the processing Lambda
                $processResponse = \Http::timeout(600)->post(config('services.lambda.url') . "pdf-extract", [
                    'file_key' => $fileKey
                ]);

                if ($processResponse->failed()) {
                    \Log::error('Processing failed', ['response' => $processResponse->body()]);
                    session()->flash('error', 'Exam Sections Generation Failed.');
                    return;
                }

                logger('process response', [$processResponse]);

                $this->data['exam_sections'] = json_decode($processResponse->getBody(), true);
            } else {
                \Log::error('File upload failed', ['response' => $uploadResponse->body()]);
                session()->flash('error', 'Exam Sections Generation Failed.');
            }
        } catch (\Exception $err) {
            logger('Error in uploadToLambda', [$err->getMessage()]);
            session()->flash('error', 'Exam Sections Generation Failed.');

        }
    }
}
