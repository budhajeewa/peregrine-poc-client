<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    // return 149;
    // $socket = fsockopen("host.docker.internal", 23);
    // $socket = fsockopen("tls://host.docker.internal", 23, $en, $es, 30);
    $context = stream_context_create(); 
    $r = stream_context_set_option($context, 'ssl', 'local_cert', __DIR__.'/tls.crt'); 
    $r = stream_context_set_option($context, 'ssl', 'local_pk', __DIR__.'/tls.key'); 
    $socket = stream_socket_client("tls://host.docker.internal:23", $en, $es, 30, STREAM_CLIENT_CONNECT, $context); 
    var_dump($en);
    var_dump($es);
    if ($socket) {
        echo "Connected!";
        fwrite($socket, "logout t e s t rofl");
        $result = fgets($socket);
        var_dump($result);
    } else {
        echo "Could not connect to host.docker.internal:23\n";
    }
    // return view('welcome');
});
