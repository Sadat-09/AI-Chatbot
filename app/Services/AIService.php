<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class AIService
{
    public function generateAnswer(string $question): string
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . config('services.openrouter.key'),
        ])->post('https://openrouter.ai/api/v1/chat/completions', [
            'model' => 'openai/gpt-3.5-turbo',
            'messages' => [
                [
                    'role' => 'system',
                    'content' => 'You are a helpful doubt solving assistant. Provide clear, concise answers to technical questions.'
                ],
                [
                    'role' => 'user',
                    'content' => $question
                ]
            ],
        ]);

        return $response->json('choices.0.message.content') ?? 'Sorry, something went wrong.';
    }
}
