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


$router->get('/', 'IndexController@indexView');
$router->post('/send', 'IndexController@sendMessage');

// $router->get('/', function () use ($router) {
//     $messages = DB::select('SELECT * FROM messages');
//     return view('index', compact('messages'));
// });

// $router->post('/send', function (Request $request) use ($router) {
//     $message = $request->input('message');
//     DB::insert('INSERT INTO messages (msg_text) VALUES (?)', [$message]);

//     $msg_id = DB::select('SELECT id FROM messages WHERE msg_text = ?', [$message]);
//     $bot_token = env('BOT_TOKEN');

//     sendMessage($msg_id, $bot_token);

//     return redirect('/');
// });
