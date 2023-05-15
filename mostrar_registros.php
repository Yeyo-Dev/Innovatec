<?php
// Conexión a la base de datos
include("./conexion.php");
// Consulta a la base de datos
//$sql = "SELECT * FROM datoscircuito";
$idsensor = $_POST['idsensor'];
$sql = "SELECT * FROM lecturas WHERE id_Sensor = '$idsensor';";
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
echo json_encode($data);
// Cerrar la conexión a la base de datos
?>
