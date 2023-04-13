<?php
//namespace MyApp;
require __DIR__ . '/vendor/autoload.php';
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Ratchet\WebSocket\WsServer;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\Wamp\WampServerInterface;

class MyWebSocket implements MessageComponentInterface, WampServerInterface{
    protected $clients;
    //private $mysqli;

    public function __construct(){
        $this->clients = new \SplObjectStorage;
        //require_once("./conexion.php");
        //$this->mysqli = $mysqli;
    }
    //publuc funtion on
    public function onOpen(ConnectionInterface $conn){
        $this->clients->attach($conn);
        echo "Nuevo cliente conectado ({$conn->resourceId})\n";
    }
    public function onSubscribe(ConnectionInterface $conn, $topic) {
        // Implementación de la suscripción a un topic
    }

    public function onUnSubscribe(ConnectionInterface $conn, $topic) {
        // Implementación de la desuscripción de un topic
    }

    public function onCall(ConnectionInterface $conn, $id, $topic, $params) {
        // Implementación de la oncall
    }

    public function onPublish(ConnectionInterface $conn, $topic, $event, $exclude, $eligible){
        // Implementación de la desuscripción de un topic
    }

    public function onClose(ConnectionInterface $conn){
        $this->clients->detach($conn);
        echo "Cliente desconectado\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e){
        echo "An error has occurred: {$e->getMessage()}\n";
        $conn->close();
    }

    public function onMessage(ConnectionInterface $from, $msg){
    // Aquí puedes obtener los datos de la base de datos y enviarlos a los clientes conectados
    $numRecv = count($this->clients) - 1;
        echo sprintf('Connection %d sending message "%s" to %d other connection%s' . "\n"
            , $from->resourceId, $msg, $numRecv, $numRecv == 1 ? '' : 's');

        foreach ($this->clients as $client) {
            if ($from !== $client) {
                // The sender is not the receiver, send to each client connected
                $client->send($msg);
            }
        }
    /*
        $data = obtener_datos($this->mysqli); 
    foreach ($this->clients as $client) {
        $client->send($data);
        }
    */
    }
    public function enviarMensajeATodos($mensaje) {
    foreach ($this->clients as $client) {
        $client->send($mensaje);
    }
}

}
?>