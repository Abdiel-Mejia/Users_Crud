<?php
// Se incluye el archivo de conexión a la base de datos
require 'db.php';

// Función para agregar un nuevo usuario a la base de datos
function agregarUsuario($name, $email, $born_date, $phone_number, $id_role) {
    global $conn; // Uso de la conexión global a la base de datos
    // Sentencia SQL para insertar un nuevo usuario
    $sql = "INSERT INTO users (name, email, born_date, phone_number, id_role) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql); // Preparación de la sentencia
    $stmt->bind_param("ssssi", $name, $email, $born_date, $phone_number, $id_role); // Asignación de parámetros
    $stmt->execute(); // Ejecución de la sentencia
    $stmt->close(); // Cierre del statement
    header("Location: ../index.php"); // Redirección a la página principal
}

// Función para eliminar un usuario de la base de datos
function eliminarUsuario($id) {
    global $conn; // Uso de la conexión global a la base de datos
    // Sentencia SQL para eliminar un usuario por su ID
    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql); // Preparación de la sentencia
    $stmt->bind_param("i", $id); // Asignación del parámetro ID
    $stmt->execute(); // Ejecución de la sentencia
    $stmt->close(); // Cierre del statement
    header("Location: ../index.php"); // Redirección a la página principal
}

// Función para actualizar los datos de un usuario en la base de datos
function actualizarUsuario($id, $name, $email, $born_date, $phone_number, $id_role) {
    global $conn; // Uso de la conexión global a la base de datos
    // Sentencia SQL para actualizar un usuario por su ID
    $sql = "UPDATE users SET name = ?, email = ?, born_date = ?, phone_number = ?, id_role = ? WHERE id = ?";
    $stmt = $conn->prepare($sql); // Preparación de la sentencia
    $stmt->bind_param("ssssii", $name, $email, $born_date, $phone_number, $id_role, $id); // Asignación de parámetros
    $stmt->execute(); // Ejecución de la sentencia
    $stmt->close(); // Cierre del statement
    header("Location: ../index.php"); // Redirección a la página principal
}

// Función para consultar y ordenar los usuarios de la base de datos
function consultarUsuarios($order) {
    global $conn; // Uso de la conexión global a la base de datos
    $usuarios = array(); // Inicialización del array de usuarios
    // Sentencia SQL base para consultar usuarios con su rol
    $sql = "SELECT users.*, roles.name AS role_name FROM users JOIN roles ON users.id_role = roles.id ORDER BY ";
    // Ordenamiento según el parámetro recibido
    switch ($order) {
        case 'name_asc':
            $sql .= "users.name ASC";
            break;
        case 'name_desc':
            $sql .= "users.name DESC";
            break;
        case 'date_asc':
            $sql .= "users.born_date ASC";
            break;
        case 'date_desc':
            $sql .= "users.born_date DESC";
            break;
        default:
            $sql .= "users.name ASC";
            break;
    }
    $result = $conn->query($sql); // Ejecución de la consulta
    
    if ($result->num_rows > 0) {
        // Iteración sobre los resultados de la consulta
        while ($row = $result->fetch_assoc()) {
            $usuarios[] = $row; // Almacenamiento de cada usuario en el array
        }
    }
    
    return $usuarios; // Retorno del array de usuarios
}

// Manejo de las solicitudes POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['agregar'])) {
        // Llamada a la función agregarUsuario con los datos del formulario
        agregarUsuario($_POST['name'], $_POST['email'], $_POST['born_date'], $_POST['phone_number'], $_POST['id_role']);
    } elseif (isset($_POST['eliminar'])) {
        // Llamada a la función eliminarUsuario con el ID del formulario
        eliminarUsuario($_POST['id']);
    } elseif (isset($_POST['actualizar'])) {
        // Llamada a la función actualizarUsuario con los datos del formulario
        actualizarUsuario($_POST['id'], $_POST['name'], $_POST['email'], $_POST['born_date'], $_POST['phone_number'], $_POST['id_role']);
    }
}
?>
