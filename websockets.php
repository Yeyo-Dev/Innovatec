<?php
//include("./conexion.php");
require("./ws.php");
use Ratchet\WebSocket\WsServer;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
//use MyApp\MyWebSocket;

require __DIR__ . '/vendor/autoload.php';

$config = file_get_contents('config.json');
$config = json_decode($config, true);
$servidor = "127.0.0.1";//$config['db']['host'];

$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new MyWebSocket()
        )
    ),
    3000//,
    //$servidor
);

//$server = new MyWebSocket();
echo "Servidor WebSocket iniciado en la dirección $servidor y el puerto 3000\n";

$server->run();
?>