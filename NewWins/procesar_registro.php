<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Verificar si se recibieron los campos obligatorios
        if (isset($_POST["nombre"]) && isset($_POST["apellido"]) && isset($_POST["nombre_user"]) && isset($_POST["correo"]) && isset($_POST["contrasena"])) {
            // Asignar valores a las variables
            $nombre_usuario = $_POST["nombre_user"];
            $nombre = $_POST["nombre"];
            $apellido = $_POST["apellido"];
            $nombre_usuario = $_POST["nombre_user"];
            $correo = $_POST["correo"];
            $contrasena = $_POST["contrasena"];
            $contrasena_encriptada = password_hash($contrasena, PASSWORD_DEFAULT);


            $conn = mysqli_connect('127.0.0.1', 'root', 'root', 'NewWins');
            $sql = "INSERT INTO usuarios_registrados (nombre_usuario,contrasena,correo_electronico,nombre,apellido ) VALUES ('$nombre_usuario', '$contrasena_encriptada', '$correo', '$nombre', '$apellido')";
            if (mysqli_query($conn, $sql)) {
                echo "Usuario registrado correctamente.";
            } else {
                echo "Error al registrar usuario: " . mysqli_error($conn);
            }
            mysqli_close($conn);
            
        } else {
            echo "Todos los campos son obligatorios.";
        }
    }
?>
