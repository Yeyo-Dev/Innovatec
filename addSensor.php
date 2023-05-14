<?php
session_start();
$nickname = $_SESSION['nickname'];
$idsensor = $_POST['idsensor'];

if (($mysqli->query("SELECT id_sensor FROM sensor WHERE id_sensor='$idsensor'"))){
    $query = "INSERT INTO usuario_sensor (nickname,id_sensor) VALUES (".$nickname.",".$idsensor.");";
    $mysqli->query($query);
}else{
    echo "No se encontro el sensor";
}

?>