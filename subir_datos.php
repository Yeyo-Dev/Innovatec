<?php
include("./conexion.php");
//declaracion de variables
// Decodifica el JSON enviado por Arduino
//$data = json_decode($_POST['data']);

// Accede a los valores del JSON
//$Corriente=	$data->corriente;
//$Potencia =$data->potencia;
$Corriente=	$_POST['corriente'];
$Potencia =$_POST['potencia'];

//imprime los datos en el servidor
echo "La corriente es: ".$Corriente."<br>La potencia es: ".$Potencia;

$res = guardar_datos($mysqli, $Corriente, $Potencia);

if ($res>0){
    echo "Datos guardados correctamente";
}else {
    echo"Error al guardar los datos";
} 
?>