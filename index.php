<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Usuarios</title>
    <link rel="stylesheet" href="CSS/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
    <div class="container">
        <img class="adj" src="Img/head.jpg" alt="Imagen de encabezado">
        <h1 class="bl">Usuarios</h1>
    </div>

    <button onclick="mostrarFormulario('formAgregar')" class="boton-agregar" style="float: right;">
        <i class="fas fa-user-plus"></i> Añadir Usuario
    </button>
    <br>

    <div id="usuariosRegistrados">
        <?php
        require_once 'Back-end/process.php';
        
        $usuarios = consultarUsuarios('name_asc');
        
        if (!empty($usuarios)) {
            $totalRegistros = count($usuarios);
            
            echo "<table border='1'><tr><th>ID</th><th>Nombre</th><th>Email</th><th>Fecha de Nacimiento</th><th>Teléfono</th><th>Rol</th><th>Editar</th><th>Eliminar</th></tr>";
            foreach ($usuarios as $usuario) {
                $usuarioJson = htmlspecialchars(json_encode($usuario), ENT_QUOTES, 'UTF-8');
                echo "<tr>";
                echo "<td>".$usuario['id']."</td>";
                echo "<td>".$usuario['name']."</td>";
                echo "<td>".$usuario['email']."</td>";
                echo "<td>".$usuario['born_date']."</td>";
                echo "<td>".$usuario['phone_number']."</td>";
                echo "<td>".$usuario['role_name']."</td>";
                echo "<td style=\"text-align: center;\"><button onclick=\"mostrarFormulario('formActualizar', ".$usuarioJson.")\" class=\"nada\"><i class='fas fa-edit'></i></button></td>";
                echo "<td><button onclick=\"mostrarFormulario('formEliminar', ".$usuario['id'].")\" class=\"nada\"><i class='fas fa-trash-alt'></i></button></td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No hay usuarios registrados.";
        }
        ?>
    </div>
    
    <form id="formAgregar" action="Back-end/process.php" method="post" style="display: none;">
        Nombre: <input type="text" name="name" required>
        Correo: <input type="email" name="email" required>
        Fecha de Nacimiento: <input type="date" name="born_date" required>
        Teléfono: <input type="text" name="phone_number" required>
        ID Rol: <input type="number" name="id_role" required>
        <input type="submit" name="agregar" value="Agregar Usuario">
    </form>
    
    <form id="formEliminar" action="Back-end/process.php" method="post" style="display: none;">
        <input type="hidden" id="eliminarId" name="id">
        <p class="centrar">¿Estás seguro de eliminar este usuario?</p>
        <input type="submit" name="eliminar" value="Eliminar Usuario">
    </form>
    
    <form id="formActualizar" action="Back-end/process.php" method="post" style="display: none;">
        <input type="hidden" id="actualizarId" name="id">
        Nombre: <input type="text" name="name" id="updateName" required>
        Correo: <input type="email" name="email" id="updateEmail" required>
        Fecha de Nacimiento: <input type="date" name="born_date" id="updateBornDate" required>
        Teléfono: <input type="text" name="phone_number" id="updatePhoneNumber" required>
        ID Rol: <input type="number" name="id_role" id="updateIdRole" required>
        <input type="submit" name="actualizar" value="Actualizar Usuario">
    </form>
    
    <?php
    if (!empty($usuarios)) {
        echo "<p>Mostrando 1 al ".$totalRegistros." de un total de ".$totalRegistros." registros.</p>";
    } else {
        echo "<p>No hay usuarios registrados.</p>";
    }
    ?>
    
    <footer style="text-align: center;margin-top:13%">
        <div class="footer-content">
            <a class="nad" href="https://github.com/Abdiel-Mejia"><i class="fab fa-github"></i> GitHub</a>
            <p>Email: <a class="nad" href="mailto:zeus_ab@otulook.com">zeus_ab@outlook.com</a></p>
            <p class="fot">© 2024 Mejia Martinez Oscar Abdiel. Todos los derechos reservados</p>   
        </div>
    </footer>

    <script>
        function mostrarFormulario(formId, userData = null) {
            const formAgregar = document.getElementById('formAgregar');
            const formActualizar = document.getElementById('formActualizar');
            const formEliminar = document.getElementById('formEliminar');

            formAgregar.style.display = 'none';
            formActualizar.style.display = 'none';
            formEliminar.style.display = 'none';

            const formToShow = document.getElementById(formId);
            formToShow.style.display = 'block';

            if (userData !== null) {
                if (formId === 'formEliminar') {
                    document.getElementById('eliminarId').value = userData;
                } else if (formId === 'formActualizar') {
                    document.getElementById('actualizarId').value = userData.id;
                    document.getElementById('updateName').value = userData.name;
                    document.getElementById('updateEmail').value = userData.email;
                    document.getElementById('updateBornDate').value = userData.born_date;
                    document.getElementById('updatePhoneNumber').value = userData.phone_number;
                    document.getElementById('updateIdRole').value = userData.id_role;
                }
            }
        }
    </script>
</body>
</html>
