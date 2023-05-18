<?php
include("./conexion.php");
session_start();
$nickname = $_SESSION['nickname'];
$idsensor = $_POST['idsensor'];
$res1 = $mysqli->query("SELECT id_sensor FROM sensor WHERE id_sensor='$idsensor'");
$tot_registros = mysqli_num_rows($res1);
if (($tot_registros) >0){
    $query = "INSERT INTO usuario_sensor (nickname,id_sensor) VALUES ('".$nickname."','".$idsensor."');";
    $res = $mysqli->query($query);
    if ($res >0){
        echo "Sensor agregado correctamente";
    }else{
        echo "No se encontro el sensor";
    }
}else{
    echo "No se encontro el sensor";
}

?>