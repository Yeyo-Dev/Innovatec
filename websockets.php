<?php
//include("./conexion.php");
if (!function_exists('socket_create')) {
    echo "Las extensiones de sockets no están habilitadas. Asegúrese de habilitar la extensión en el archivo php.ini.";
    exit;
}
require("./ws.php");
use Ratchet\WebSocket\WsServer;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
//use MyApp\MyWebSocket;

require __DIR__ . '/vendor/autoload.php';

$config = file_get_contents('config.json');
$config = json_decode($config, true);
$servidor = "127.0.0.1";//$config['db']['host'];
$port = $config['socket-server']['port'];

if(!$config['socket-server']['run']){
    $server = IoServer::factory(
        new HttpServer(
            new WsServer(
                new MyWebSocket()
            )
        ),
        $port,
        $servidor
    );

    echo "Servidor WebSocket iniciado en la dirección $servidor y el puerto 3000\n";

    $server->run();

    $config['socket-server']['run'] = true;
    $json = json_encode($config,true);
    file_put_contents('./config.json', $json,LOCK_EX);

}else {
    echo "El servidor ya está corriendo";
}
?>