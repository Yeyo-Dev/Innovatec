<?php
include './conexion.php';
// Función para encriptar la contraseña
function encriptarPassword($password) {
      return password_hash($password, PASSWORD_DEFAULT);
}

    $nickname = $_POST["nickname"];
    $password = $_POST["password"];

    // Encriptar la contraseña
    $passwordEncriptada = encriptarPassword($password);

      // Insertar los datos en la tabla usuario
      $sql = "INSERT INTO usuario (nickname, password) VALUES ('$nickname', '$passwordEncriptada')";
      if ($mysqli->query($sql) === TRUE) {
          echo "Registro exitoso.";
      } else {
          echo "Error en el registro";
      }
?>