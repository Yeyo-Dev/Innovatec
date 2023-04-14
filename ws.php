<?php
//namespace MyApp;
require __DIR__ . '/vendor/autoload.php';
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Ratchet\WebSocket\WsServer;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\Wamp\WampServerInterface;

class MyWebSocket implements MessageComponentInterface{
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

    public function onClose(ConnectionInterface $conn){
    
        $this->clients->detach($conn);
        echo "Cliente desconectado ({$conn->resourceId})\n";
        if (count($this->clients) == 0) {
            // Detener el servidor si no hay clientes conectados
            echo "Deteniendo el servidor...\n";
            $server = $conn->httpRequest->getAttribute('server');
            $server->loop->stop();
            // Leer el archivo JSON
            $fileContents = file_get_contents('config.json');
            // Convertir el JSON en un array PHP
            $config = json_decode($fileContents, true);
            // Modificar el valor deseado
            $config['socket-server']['run'] = false;
            // Convertir el array PHP de vuelta a JSON
            $json = json_encode($config);
            // Escribir el JSON actualizado en el archivo
            file_put_contents('config.json', $json);

        }
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