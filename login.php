<?php
include './conexion.php';
// Función para encriptar la contraseña
function encriptarPassword($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}
function verificarPassword($password, $hash) {
    return password_verify($password, $hash);
}

$nickname = $_POST["nickname"];
$password = $_POST["password"];

$sql = "SELECT password FROM usuario WHERE nickname = '$nickname'";
    $result = $mysqli->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $passwordEncriptada = $row["password"];

        // Verificar si la contraseña ingresada coincide con la contraseña encriptada
        if (verificarPassword($password, $passwordEncriptada)) {
            // Iniciar sesión
            session_start();
            $_SESSION["nickname"] = $nickname;
            $_SESSION["password"] = $password;
            echo "Usuario encontrado";
        } else {
            echo "Contraseña incorrecta";
        }
    } else {
        echo "Usuario no encontrado";
    }


?>