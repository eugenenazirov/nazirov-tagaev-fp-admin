<?php

/** @var \Laravel\Lumen\Routing\Router $router */
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/


$router->get('/', function () use ($router) {
    $messages = DB::select('SELECT * FROM messages');
    return view('index', compact('messages'));
});

$router->post('/send', function (Request $request) use ($router) {
    $message = $request->input('message');
    DB::insert('INSERT INTO messages (msg_text) VALUES (?)', [$message]);

    $msg_id = DB::select('SELECT id FROM messages WHERE msg_text = ?', [$message]);
    $bot_token = env('BOT_TOKEN');

    sendMessage($msg_id, $bot_token);

    return redirect('/');
});


/**
 * @param string $msg_id mailing id for send to telebot
 * @param string $token telebot token for auth
 * @return void
 */
function sendMessage($msg_id, $token)
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
