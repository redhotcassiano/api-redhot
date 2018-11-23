<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Http\Request;

Route::get('/', function () {

    return view('welcome');
    
    $query = http_build_query([
        'client_id' => 3,
        'redirect_url' => 'http://api.test/callback',
        'response_type' => 'code',
        'scope' => ''
    ]);

    return redirect("http://api.test/oauth/authorize?$query");

    dd($query);

});

Route::get('callback', function(Request $request){
    $http = new GuzzleHttp\Client;

    $response = $http->post('http://api.test/oauth/token', [
        'form_params' => [
            'grant_type' => 'authorization_code',
            'client_id' => '3',
            'client_secret' => 'pDaOml7M8DwlLIQGp6FkuvcQzvO1BtC5FX2EawdC',
            'redirect_uri' => 'http://api.test/callback',
            'code' => $request->code,
        ],
    ]);

    return json_decode((string) $response->getBody(), true);

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
