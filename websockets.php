<?php
include("./conexion.php");
require("./ws.php");

$server = IoServer::factory(
new HttpServer(
new WsServer(
new MyWebSocket()
)
),
8080
);

$server->run();
?>