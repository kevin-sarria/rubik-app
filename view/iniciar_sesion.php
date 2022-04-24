<?php

include('../includes/header.php');
include('../model/conexion.php');

$conexion = conectarDB();

if(isset($_SESSION['user'])) {
    header('location: view/inicio_maestro.php');
}

$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = mysqli_real_escape_string($conexion, filter_var($_POST['correo'], FILTER_VALIDATE_EMAIL));

    $password = mysqli_real_escape_string($conexion, $_POST['password']);

    if(!$email) {
        $errores[] = "El email es obligatorio o no es válido";
    }

    if(!$password) {
        $errores[] = "La contraseña es obligatoria o no es válida";
    }

    if(empty($errores)) {
        
        // Revisar si el usuario existe
        $query = "SELECT * FROM usuarios WHERE correo = '${email}'";
        $resultado = mysqli_query($conexion, $query);

        

        if($resultado->num_rows) {
            // Revisar si el password es correcto
            $usuario = mysqli_fetch_assoc($resultado);

            // Verificar si es password es correcto o no
            $auth = password_verify($password, $usuario['password']);

            if($auth) {
                // El usuario esta autenticado
                session_start();

                // Llenar el arreglo de la sesión
                $_SESSION['usuario'] = $usuario['correo'];
                $_SESSION['login'] = true;

                header('location: /view/inicio_maestro.php');
                

            }else {
                $errores[] = "La contraseña es incorrecta";    
            }


        }else {
            $errores[] = "El usuario no existe";
        }

    }

}


?>




<!-- Esta Clase la creo para centrar el formulario con display flex -->




<?php foreach($errores as $error): ?>
        <div class="alerta error">
            
        <?php echo $error; ?>

        </div>

        <?php endforeach; ?>


    <div class="formulario__caja">

        <div class="contenedor__regresar centrar-flex">
            <a href="../"><img src="../img/x.png" alt="Icon exit"></a>
        </div>

        <div class="formulario__imagen">
            <img src="../img/rubik.png" alt="Logo Institucion">
        </div>

        <form class="formulario" action="#" method="post">


            <input type="email" name="correo" id="correo" placeholder="Correo Electronico">


            <input type="password" name="password" id="password" placeholder="Contraseña">

            <a href="#">¿Has olvidado tu contraseña?</a>

            <input type="submit" value="Ingresar">

            <a href="#">Registrarse</a>


        </form>
    </div>



<?php include('../includes/footer.php'); ?>