<?php
// Definición de las variables para la conexión a la base de datos
$servername = "localhost"; // Nombre del servidor de base de datos
$username = "root"; // Nombre de usuario de la base de datos
$password = ""; // Contraseña del usuario de la base de datos
$dbname = "manager"; // Nombre de la base de datos

// Creación de una nueva instancia de la clase mysqli para establecer la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Comprobación de la conexión
if ($conn->connect_error) {
    // Si la conexión falla, muestra un mensaje de error y detiene la ejecución del script
    die("Connection failed: " . $conn->connect_error);
}

// Si la conexión es exitosa, el script continúa su ejecución
?>

