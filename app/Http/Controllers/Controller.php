<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class IndexController extends BaseController
{
    /**
     * Returns the index view
     * 
     * @return Response
     */
    public function indexView()
    {
        $messages = DB::select('SELECT * FROM messages');
        return view('index', compact('messages'));
    }

    /**
     * Sends a new message.
     *
     * @param  Request  $request
     * @return Response
     */
    public function sendMessage(Request $request)
    {
        $message = $request->input('message');
        DB::insert('INSERT INTO messages (msg_text) VALUES (?)', [$message]);

        $msg_id = DB::select('SELECT id FROM messages WHERE msg_text = ?', [$message]);
        $bot_token = env('BOT_TOKEN');

        sendMessageToBot($msg_id, $bot_token);

        return redirect('/');
    }
}


/**
 * @param string $msg_id mailing id for send to telebot
 * @param string $token telebot token for auth
 * @return void
 */
function sendMessageToBot($msg_id, $token)
{
    $url = "https://api.telegram.org/{$token}/sendMessage?" . http_build_query([
            'msg_id' => $msg_id,
        ]);

    // Для тестов
    // $url = "https://webhook.site/ca9c199c-fcfd-4e57-aaae-354f56a52d7f?" . http_build_query([
    //         'msg_id' => $msg_id,
    //     ]);

    $ch = curl_init();
    $optArray = [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true
    ];
    curl_setopt_array($ch, $optArray);
    curl_exec($ch);
    curl_close($ch);
}
