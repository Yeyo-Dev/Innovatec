<?php

$config = file_get_contents('config.json');
$config = json_decode($config, true);

//variables para la conexion a bd
$usuario = $config['db']['username'];
$contraseña = $config['db']['password'];
$servidor = $config['db']['host'];
$basededatos = $config['db']['dbname'];//nombre de la base da datos

$mysqli = new mysqli($servidor, $usuario, $contraseña,$basededatos);

if (mysqli_connect_errno()) {
    echo 'error al conectar:', mysqli_connect_error();
    exit();
}

function guardar_datos( $mysqli, $id, $co, $pot){
    if (!($mysqli->query("SELECT id_sensor FROM sensor WHERE id_sensor='$id'"))){
        $res = $mysqli->query("INSERT INTO sensor (id_sensor) VALUES ('$id')");
        }

    $query = "INSERT INTO lecturas ( corriente, potencia, id_sensor) VALUES ('$co','$pot','$id');";
    return $mysqli->query($query);
}

//exec("php websockets.php &");
?>