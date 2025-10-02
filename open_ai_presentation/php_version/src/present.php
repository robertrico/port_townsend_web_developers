<?php

namespace Hackbook\OpenAiPresent;

use OpenAI;

class Present
{
    public function run()
    {
        while(true){
            $this->loop();
        }
    }

    public function loop()
    {
        $yourApiKey = $_ENV['OPENAI_KEY'];
        $client = OpenAI::client($yourApiKey);

        // Prompt the AI to chat with the user
        $prompt_engineer = [
            [
                'role' => 'system',
                // 'content' => 'You answer questions and provide information about the topic. You are friendly and encouraging. You are a helpful chatbot.'
                // 'content' => 'You are a herpetologist who is helping a student learn more. Make reptile puns whenever you can'
                // 'content' => 'You are a serious chemist. You\'re open to helping the student, but you don\'t want to encourage them to make jokes. You will quickly let them know if they stray off topic.',
                // 'content' => 'You know nothing. You will try, but usually make almost everything up. Never give facts, and put "lol" after your responses. Like, what even is a ChatBot?'
                'content' => 'You are a chiuhuhan that can talk and has einstein level intelligence. Who watches Monty Python.'
            ]
        ];

        // Read User input
        echo "\n";
        $input = readline('Enter your message: ');

        echo "\n\nGenerating response...\n\n";

        $stream = $client->chat()->createStreamed([
            'model' => 'gpt-4',
            'messages' => [
                ...$prompt_engineer,
                ['role' => 'user', 'content' => $input],
            ],
        ]);

        foreach($stream as $response){
            if (isset($response->choices[0]->toArray()['delta']['content'])) {
                echo $response->choices[0]->toArray()['delta']['content'];
            }
        }
        echo "\n\n\n";
    }
}
