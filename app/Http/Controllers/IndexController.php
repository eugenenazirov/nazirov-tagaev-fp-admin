<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
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
    public function indexView()
    {
        $messages = \DB::select('SELECT * FROM messages');
        return view('index', compact('messages'));
    }

    /**
     * Sends a new message.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendMessage(Request $request)
    {
        $message = $request->input('message');
        \DB::insert('INSERT INTO messages (msg_text) VALUES (?)', [$message]);

        $msg_id_query = \DB::select('SELECT id FROM messages WHERE msg_text = ? LIMIT 1', [$message]);
        $msg_id = $msg_id_query[0]->id ?? null;

        if ($msg_id === null) {
            return response('Not Found', 404);
        }

        self::sendMessageToBot($msg_id, self::$bot_token);

        return redirect('/');
    }

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
