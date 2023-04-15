<?php
    session_start();
    //connector
    include_once "config.php";

    //recogemos los datos de busqueda de usuarios
    $outgoing_id = $_SESSION['unique_id'];
    $searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']);

    //lo buscamos por en la BD
    $sql = "SELECT * FROM users WHERE NOT unique_id = {$outgoing_id} AND (fname LIKE '%{$searchTerm}%' OR lname LIKE '%{$searchTerm}%') ";
    $output = "";
    $query = mysqli_query($conn, $sql);

    //lista todos los usuarios de busqueda, bajo reglas de data.php
    if(mysqli_num_rows($query) > 0){
        include_once "data.php";
    }else{
        $output .= 'Sin resutados 😥';
    }
    echo $output;
?>