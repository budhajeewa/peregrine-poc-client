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
    $socket = fsockopen("host.docker.internal", 23);
    if ($socket) {
        var_dump("Connected!");
        fwrite($socket, "login t e s t");
        $result = fgets($socket);
        var_dump($result);
    } else {
        echo "Could not connect to host.docker.internal:23\n";
    }
    // return view('welcome');
});
