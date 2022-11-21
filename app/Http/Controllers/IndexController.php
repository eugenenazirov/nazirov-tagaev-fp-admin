<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use GuzzleHttp\Client;

class IndexController extends BaseController
{
    public static $client;
    private static $bot_token;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        self::$bot_token = env('BOT_TOKEN');
        self::$client = new Client([
            // Base URI is used with relative requests
            'base_uri' => "https://api.telegram.org",
            // You can set any number of default request options.
            'timeout'  => 2.0,
        ]);
    }

    /**
     * Returns the index view
     * 
     * @return \Illuminate\View\View;
     */
    /**
     * @param string $msg_id mailing id for send to telebot
     * @param string $token telebot token for auth
     * @return void
     */
    public function sendMessageToBot($msg_id, $token)
    {
        try {
            $response = self::$client->request('POST', "http://localhost:8000/message", [
                'json' => ['msg_id' => $msg_id]
            ]);
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            exit("Message was not sent!");
        }

        // Для тестов
        // $response = self::$client->request('POST', "https://webhook.site/ca9c199c-fcfd-4e57-aaae-354f56a52d7f", [
        //     'json' => ['msg_id' => $msg_id]
        // ]);
    }   
}
