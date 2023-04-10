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

function guardar_datos($mysqli,$co,$pot){
    $query = "INSERT INTO datoscircuito (Corriente,Potencia) VALUES (".$co.",".$pot.");";
    return $mysqli->query($query);
}

function obtener_datos($mysqli){
    $sql = "SELECT MAX(Fecha) FROM datoscircuito";
    
    $res=$mysqli->query($sql);
    $tot_registros = mysqli_num_rows($res);
    
    //$row = array();
    if ($tot_registros>0) {
        return json_encode($res);
        //while ($rowCunt = mysqli_fetch_array($res)) {
        //    $row['registros'][] = $rowCunt;
        //}
    
    //echo json_encode($row);
    }
    else{
        echo "No se encontraron registros";
        return; 
    }
}

?>