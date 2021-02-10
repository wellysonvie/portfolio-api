<?php

namespace Source\Controllers;

use Source\Models\Message;
use Source\Models\Project;

class APIController
{
    public function getProjects()
    {
        $projects = (new Project())->find()->order("created_at DESC")->fetch(true);

        $projects = array_map(function ($item) {
            return $item->data();
        }, $projects);
        
        json_response(200, $projects);
    }

    public function sendContact($data)
    {
        $contactName = trim(filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRIPPED));
        $contactEmail = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);;
        $contactText = trim(filter_input(INPUT_POST, "message", FILTER_SANITIZE_STRIPPED));

        if (!$contactEmail || empty($contactName) || empty($contactText)) {
            json_response(400, 'Bad request! Invalid email or empty name and message.');
            return;
        }

        $message = new Message();
        $message->name = $contactName;
        $message->email = $contactEmail;
        $message->text = $contactText;

        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', 'https://api.telegram.org/bot' . TELEGRAM['bot_token'] . '/sendMessage', [
            'json' => [
                'chat_id' => TELEGRAM['chat_id'],
                'text' => "Contato enviado pelo site\n*Nome:* {$contactName}\n*E-mail:* {$contactEmail}\n*Mensagem:*\n{$contactText}",
                'parse_mode' => 'Markdown'
            ]
        ]);

        if($message->save() && $response->getStatusCode() == 200){
            json_response(200, 'Message sent successfully!');
        }else{
            json_response(500, (DEBUG ? json_decode($response->getBody()) : 'Internal Server Error'));
        }
    }
}
