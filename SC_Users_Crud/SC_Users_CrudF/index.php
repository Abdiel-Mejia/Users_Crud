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
        <!-- Imagen de encabezado -->
        <img class="adj" src="assets/img/head.jpg" alt="Imagen de encabezado">
        <!-- Título de la página -->
        <h1 class="bl">Usuarios</h1>
    </div>

    <!-- Botón para mostrar el formulario de añadir usuario -->
    <button onclick="mostrarFormulario('formAgregar')" class="boton-agregar" style="float: right;">
        <i class="fas fa-user-plus"></i> Añadir Usuario
    </button>
    <br>

    <div id="usuariosRegistrados">
        <?php
        // Incluye el archivo que contiene las funciones de procesamiento de usuarios
        require_once '../SC_Users_CrudB/process.php';
        
        // Consulta los usuarios ordenados por nombre ascendente
        $usuarios = consultarUsuarios('name_asc');
        
        // Verifica si hay usuarios registrados
        if (!empty($usuarios)) {
            $totalRegistros = count($usuarios);
            
            // Muestra la tabla de usuarios
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
            // Muestra un mensaje si no hay usuarios registrados
            echo "No hay usuarios registrados.";
        }
        ?>
    </div>
    
    <!-- Formulario para agregar un nuevo usuario -->
    <form id="formAgregar" action="../SC_Users_CrudB/process.php" method="post" style="display: none;">
        Nombre: <input type="text" name="name" required>
        Correo: <input type="email" name="email" required>
        Fecha de Nacimiento: <input type="date" name="born_date" required>
        Teléfono: <input type="text" name="phone_number" required>
        ID Rol: <input type="number" name="id_role" required>
        <input type="submit" name="agregar" value="Agregar Usuario">
    </form>
    
    <!-- Formulario para eliminar un usuario -->
    <form id="formEliminar" action="../SC_Users_CrudB/process.php" method="post" style="display: none;">
        <input type="hidden" id="eliminarId" name="id">
        <p class="centrar">¿Estás seguro de eliminar este usuario?</p>
        <input type="submit" name="eliminar" value="Eliminar Usuario">
    </form>
    
    <!-- Formulario para actualizar un usuario -->
    <form id="formActualizar" action="../SC_Users_CrudB/process.php" method="post" style="display: none;">
        <input type="hidden" id="actualizarId" name="id">
        Nombre: <input type="text" name="name" id="updateName" required>
        Correo: <input type="email" name="email" id="updateEmail" required>
        Fecha de Nacimiento: <input type="date" name="born_date" id="updateBornDate" required>
        Teléfono: <input type="text" name="phone_number" id="updatePhoneNumber" required>
        ID Rol: <input type="number" name="id_role" id="updateIdRole" required>
        <input type="submit" name="actualizar" value="Actualizar Usuario">
    </form>
    
    <?php
    // Muestra el número de registros encontrados
    if (!empty($usuarios)) {
        echo "<p>Mostrando 1 al ".$totalRegistros." de un total de ".$totalRegistros." registros.</p>";
    } else {
        echo "<p>No hay usuarios registrados.</p>";
    }
    ?>
    
    <!-- Pie de página -->
    <footer style="text-align: center;margin-top:13%">
        <div class="footer-content">
            <a class="nad" href="https://github.com/Abdiel-Mejia"><i class="fab fa-github"></i> GitHub</a>
            <p>Email: <a class="nad" href="mailto:zeus_ab@otulook.com">zeus_ab@outlook.com</a></p>
            <p class="fot">© 2024 Mejia Martinez Oscar Abdiel. Todos los derechos reservados</p>   
        </div>
    </footer>

    <script>
        // Función para mostrar el formulario adecuado y cargar los datos del usuario si es necesario
        function mostrarFormulario(formId, userData = null) {
            const formAgregar = document.getElementById('formAgregar');
            const formActualizar = document.getElementById('formActualizar');
            const formEliminar = document.getElementById('formEliminar');

            // Oculta todos los formularios
            formAgregar.style.display = 'none';
            formActualizar.style.display = 'none';
            formEliminar.style.display = 'none';

            // Muestra el formulario correspondiente
            const formToShow = document.getElementById(formId);
            formToShow.style.display = 'block';

            // Carga los datos del usuario en el formulario si se proporcionan
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
