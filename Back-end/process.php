<?php
require 'db.php';

function agregarUsuario($name, $email, $born_date, $phone_number, $id_role) {
    global $conn;
    $sql = "INSERT INTO users (name, email, born_date, phone_number, id_role) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $name, $email, $born_date, $phone_number, $id_role);
    $stmt->execute();
    $stmt->close();
    header("Location: ../index.php");
}

function eliminarUsuario($id) {
    global $conn;
    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    header("Location: ../index.php");
}

function actualizarUsuario($id, $name, $email, $born_date, $phone_number, $id_role) {
    global $conn;
    $sql = "UPDATE users SET name = ?, email = ?, born_date = ?, phone_number = ?, id_role = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssii", $name, $email, $born_date, $phone_number, $id_role, $id);
    $stmt->execute();
    $stmt->close();
    header("Location: ../index.php");
}

function consultarUsuarios($order) {
    global $conn;
    $usuarios = array();
    $sql = "SELECT users.*, roles.name AS role_name FROM users JOIN roles ON users.id_role = roles.id ORDER BY ";
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
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $usuarios[] = $row;
        }
    }
    
    return $usuarios;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['agregar'])) {
        agregarUsuario($_POST['name'], $_POST['email'], $_POST['born_date'], $_POST['phone_number'], $_POST['id_role']);
    } elseif (isset($_POST['eliminar'])) {
        eliminarUsuario($_POST['id']);
    } elseif (isset($_POST['actualizar'])) {
        actualizarUsuario($_POST['id'], $_POST['name'], $_POST['email'], $_POST['born_date'], $_POST['phone_number'], $_POST['id_role']);
    }
}
?>
