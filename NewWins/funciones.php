<?php

function registrarUsuario($conn, $nombre_usuario, $contrasena, $correo_electronico, $nombre = null, $foto_perfil = null, $ubicacion = null) {
    // Preparar la sentencia SQL
    $sql = $conn->prepare("INSERT INTO usuarios_registrados (nombre_usuario, contrasena, correo_electronico, nombre, foto_perfil, ubicacion) VALUES (?, ?, ?, ?, ?, ?)");

    // Encriptar la contraseña
    $contrasena_encriptada = password_hash($contrasena, PASSWORD_BCRYPT);

    // Ligar los parámetros
    $sql->bind_param("ssssss", $nombre_usuario, $contrasena_encriptada, $correo_electronico, $nombre, $foto_perfil, $ubicacion);

    // Ejecutar la sentencia
    if ($sql->execute()) {
        echo "Usuario registrado con éxito.";
    } else {
        echo "Error: " . $sql->error;
    }

    // Cerrar la sentencia
    $sql->close();
}


registrarUsuario($conn, "usuario1234", "mi_contraseña_segura123", "correo2@ejemplo.com", "Nombre Usuario3", "foto.jpg", "Ubicación Ejemplo");
?>



