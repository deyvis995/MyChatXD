<?php
session_start();

//vuelta al conector xd
include_once "config.php";

//recogemos los datos de usuario/contraseña y lo enviamos por POST
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

//validamos q todos los datos ingresados y ande bien xd
if (!empty($email) && !empty($password)) {
    $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");

    //verificamos q no exista otros usuarios ya registrados con los mismos datos
    if (mysqli_num_rows($sql) > 0) {
        $row = mysqli_fetch_assoc($sql);

        //convertimos el Password en un MD5 y procedemos a verificar en la BD
        $user_pass = md5($password);
        $enc_pass = $row['password'];

        if ($user_pass === $enc_pass) {
            $status = "Disponible";
            //actualizamos el ESTADO
            $sql2 = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id = {$row['unique_id']}");
            if ($sql2) {
                //validamos el logeo
                $_SESSION['unique_id'] = $row['unique_id'];
                
                echo "Proceso Exitoso";
                //header("Location: ../users.php")
                //session_start();
                /*if(!isset($_SESSION['already_refreshed'])){
                    $ActualizarDespues = 5;
                    header('Refresh:'.$ActualizarDespues);
                    $_SESSION['already_refreshed']=true;
                }*/

            } else {
                //echo "Algo salió mal. ¡Inténtalo de nuevo!";
            }
        } else {
            //echo "¡Correo electrónico o la contraseña son incorrectos!";
        }
    } else {
        //echo "$email - ¡Este correo electrónico no existe!";
    }
} else {
    //echo "¡Todos los campos de entrada son obligatorios!";
}
