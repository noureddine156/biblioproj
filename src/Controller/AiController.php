<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class AiController extends AbstractController{
    #[Route('/analyseBookAI')]
    public function analyseBookAI(Request $req): JsonResponse{
        
        $data = json_decode($req->getContent(), true);
        $prompt = $data["prompt"] ?? null;
        $client = HttpClient::create();
        $response = $client->request('POST', "https://openrouter.ai/api/v1/chat/completions", [
            'headers' => [
                'Authorization' => 'Bearer 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',
                'Content-Type' => 'application/json',
                'HTTP-Referer' => 'Book',
                'X-Title' => 'Description_Generator',
            ],
            'json' => [
                'model' => "nousresearch/deephermes-3-mistral-24b-preview:free",
                // 'model' => "google/gemma-3-27b-it:free",
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => `
                        Provide a concise general overview of the book based on its title and description. Detect the language of the description and write your response in that language. Only return the overview.
                        `
                    ],
                    [
                        'role' => 'user',
                        'content' => $prompt
                    ],
                ],
            ],
        ]);
        $data = $response->toArray(false);
        return $this->json([
            'response' => $data['choices'][0]['message']['content'] ?? 'No reply',
        ]);
    }
}