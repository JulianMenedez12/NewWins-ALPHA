<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (isset($_POST["email"]) && isset($_POST["password"])) {
        
        $email = $_POST["email"];
        $password = $_POST["password"];

        $conn = mysqli_connect('127.0.0.1', 'root', 'root', 'NewWins');

        // Consulta para obtener el usuario por su correo electrónico
        $sql = "SELECT * FROM usuarios_registrados WHERE correo_electronico = '$email'";
        $result = mysqli_query($conn, $sql);

        // Verificar si se encontró el usuario
        if (mysqli_num_rows($result) == 1) {
            // Obtener los datos del usuario
            $row = mysqli_fetch_assoc($result);
            // Verificar la contraseña
            if (password_verify($password, $row['contrasena'])) {
                // Guardar información del usuario en la sesión
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['user_nombre'] = $row['nombre'];
                $_SESSION['user_apellido'] = $row['apellido'];
                // Redirigir al usuario a otra página (puedes cambiar 'dashboard.php' por la página que desees)
                header("Location: v.html");
                exit;
            } else {
                // Contraseña incorrecta
                header("Location: index.php?error=contrasena");
            }
        } else {
            // Usuario no encontrado
            echo "Usuario no encontrado";
        }

        // Cerrar la conexión
        mysqli_close($conn);
    } else {
        // Todos los campos son obligatorios
        echo "Todos los campos son obligatorios.";
    }
}
