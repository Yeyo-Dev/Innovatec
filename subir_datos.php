<?php
include("./conexion.php");
//declaracion de variables
// Decodifica el JSON enviado por Arduino
//$data = json_decode($_POST['data']);

// Accede a los valores del JSON
//$Corriente=	$data->corriente;
//$Potencia =$data->potencia;
$idsensor = $_POST['idsensor'];
$Corriente=	$_POST['corriente'];
$Potencia =$_POST['potencia'];

//imprime los datos en el servidor
echo "La corriente es: ".$Corriente."<br>La potencia es: ".$Potencia;

$res = guardar_datos($mysqli, $idsensor, $Corriente, $Potencia);

if ($res>0){
    echo "Datos guardados correctamente";
    include("./client.php");
    // Iterar sobre la lista de conexiones y enviar un mensaje a cada uno
}else {
    echo"Error al guardar los datos";
}
?>