<?php
require "./websockets.php";
require __DIR__ . '/vendor/autoload.php';
use WebSocket\Client;
use WebSocket\Connection;

$client = new Client('ws://localhost:3000');

$client->send('Se actualizó la tabla de lecturas');

$response = $client->receive();

echo "Recibido: " . $response . "\n";

$client->close();

?>