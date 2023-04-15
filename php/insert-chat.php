<?php 
    session_start();
    //volvemos a verificar la session
    if(isset($_SESSION['unique_id'])){
        //verificamos el conector a BD xd
        include_once "config.php";
        //insertamos los datos de session y todo lo necesario para el envio del mensaje y su introduccion en BD
        $outgoing_id = $_SESSION['unique_id'];
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
        $message = mysqli_real_escape_string($conn, $_POST['message']);
        //lo guardamos en BD
        if(!empty($message)){
            $sql = mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg)
                                        VALUES ({$incoming_id}, {$outgoing_id}, '{$message}')") or die();
        }
    }else{
        //si no estas logeado.. te vota como ella te votó a ti xd
        header("location: ../login.php");
    }


    
?>