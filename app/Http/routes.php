<?php
use Illuminate\Support\Facades\Redis;
use App\Events\UserSignedUp;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
	// 1. Publish event with Redis

	$data = [
		'event' => 'UserSignedUp',
		'data' => [
			'username' => 'JohnDoe'
		],
	];

	Redis::publish('test-channel', json_encode($data));
	// 2. Node.js + Redis subscribes to the event
	// 3. Use socket.io to emit to all clients.

	return view('welcome');
});


Route::get('/ep4', function () {

	event(new UserSignedUp(Request::query('name')));

	return view('welcome');
});
