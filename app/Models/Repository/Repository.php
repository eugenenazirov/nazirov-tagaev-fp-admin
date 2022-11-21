<?php

namespace App\Models\Repository;

use Illuminate\Http\Request;
use App\Http\Controllers\IndexController as Controller;

class Repository extends Controller{
    public static $client;
    private static $bot_token;

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
}