<?php
    session_start();
    //connector :3
    include_once "config.php";
    $outgoing_id = $_SESSION['unique_id'];

    //lista todos los usuarios excepto al usuario de session xd (todo en un array)
    $sql = "SELECT * FROM users WHERE NOT unique_id = {$outgoing_id} ORDER BY user_id DESC";
    $query = mysqli_query($conn, $sql);
    $output = "";

    //Lista los usuarios en pantalla
    if(mysqli_num_rows($query) == 0){
        $output .= "No hay usuarios disponibles para chatear";
    }elseif(mysqli_num_rows($query) > 0){
        include_once "data.php";
    }
    echo $output;
?>