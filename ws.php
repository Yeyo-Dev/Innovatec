<?php
require __DIR__ . '/vendor/autoload.php';

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Ratchet\WebSocket\WsServer;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;

class MyWebSocket implements MessageComponentInterface{
    protected $clients;
    private $mysqli;

    public function __construct(){
        $this->clients = new \SplObjectStorage;
        require("./conexion.php");
        $this->mysqli = $mysqli;
    }

    public function onOpen(ConnectionInterface $conn){
        $this->clients->attach($conn);
        echo "Nuevo cliente conectado\n";
    }

    public function onClose(ConnectionInterface $conn){
        $this->clients->detach($conn);
        echo "Cliente desconectado\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e){
        echo "An error has occurred: {$e->getMessage()}\n";
        $conn->close();
    }

    public function onMessage(ConnectionInterface $conn, $msg){
    // Aquí puedes obtener los datos de la base de datos y enviarlos a los clientes conectados
        try{
            $data = obtener_datos($this->mysqli); 
            foreach ($this->clients as $client) {
                $client->send($data);
            }
        }catch(Throwable $e){
            echo "Captured Throwable: " . $e->getMessage() . PHP_EOL;
        }
    }
}
?>