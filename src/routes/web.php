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

function call($m) {
    $context = stream_context_create([
        'ssl' => [
            // 'verify_peer' => false,
            // 'verify_peer_name' => false
        ]
    ]);

    $socket = stream_socket_client("tls://host.docker.internal:23", $errno, $errstr, ini_get("default_socket_timeout"), STREAM_CLIENT_CONNECT, $context);

    $result = null;

    if ($socket) {
        fwrite($socket, $m);
        $result = fgets($socket);
        $result = fgets($socket);
    } else {
        echo "Could not connect to host.docker.internal:23\n";
    }

    fclose($socket);

    return $result;
}

Route::get('/', function () {
    var_dump(call('login t e s t 7'));
    var_dump(call('login t e s t 8'));
    // return view('welcome');

    // $connector = new React\Socket\Connector([
    //     'tls' => [
    //         'verify_peer' => false,
    //         'verify_peer_name' => false,
    //     ],
    // ]);

    // $connector->connect('tls://host.docker.internal:23')->then(function (React\Socket\ConnectionInterface $connection) {
    //     $connection->write('test 1');
    //     $connection->end();
    //     $connection->on('data', function($data) {
    //         var_dump($data);
    //     });
    // }, function (Exception $e) {
    //     echo 'Error: ' . $e->getMessage() . PHP_EOL;
    // });

    // $secureConnector = new React\Socket\SecureConnector($dnsConnector);

    // $secureConnector->connect('www.google.com:443')->then(function (React\Socket\ConnectionInterface $connection) {
    //     $connection->write("GET / HTTP/1.0\r\nHost: www.google.com\r\n\r\n");
    // });
});
