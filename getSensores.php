<?php
include "./conexion.php";

session_start();
error_reporting(0);
$nickname = $_SESSION['nickname'];
/*
SELECT sensor.*
FROM sensor
JOIN usuario_sensor ON sensor.id_sensor = usuario_sensor.id_sensor
WHERE usuario_sensor.nickname = 'nickname_deseado';

SELECT * FROM usuario_sensor WHERE nickname = "nickname_deseado";
*/

//$sql = "SELECT sensor.* FROM sensor JOIN usuario_sensor ON sensor.id_sensor = usuario_sensor.id_sensor WHERE usuario_sensor.nickname = $nickname;";
$sql = "SELECT * FROM usuario_sensor WHERE nickname = '$nickname';";
$res = $mysqli->query($sql);
$tot_registros = mysqli_num_rows($res);
// Crear array con los datos
$data = array();
if ($tot_registros > 0) {
  while($row = $res->fetch_assoc()) {
    $data[] = $row;
  }
}
// Enviar los datos en formato JSON
//echo $nickname;
echo json_encode($data);
// Cerrar la conexión a la base de datos
?>