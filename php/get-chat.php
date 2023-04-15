<?php
session_start();
//verificamos la sesion y que el usuario exista :3
if (isset($_SESSION['unique_id'])) {
    //usamos la verificacion del conector a BD
    include_once "config.php";
    $outgoing_id = $_SESSION['unique_id'];
    $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
    $output = "";
    //seleccionamos todos los mensajes de un usuario a usuario y los montamos en la pantalla (consulta SQL)
    $sql = "SELECT * FROM messages LEFT JOIN users ON users.unique_id = messages.outgoing_msg_id
                WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id})
                OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id}) ORDER BY msg_id";
    //enviamos la consulta al conector xd
    $query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            if ($row['outgoing_msg_id'] === $outgoing_id) {
                $output .= '<div class="chat outgoing">
                                <div class="details">
                                    <p>' . $row['msg'] . '</p>
                                </div>
                                </div>';
            } else {
                $output .= '<div class="chat incoming">
                                <img src="php/images/' . $row['img'] . '" alt="">
                                <div class="details">
                                    <p>' . $row['msg'] . '</p>
                                </div>
                                </div>';
            }
        }
    } else {
        //si no se encuentra 'mensajes' en la BD...
        $output .= '<div class="text">No hay mensajes aun 😳</div>';
    }
    echo $output;
} else {
    //si no estas logeado.. te vota como ella te votó a ti xd
    header("location: ../login.php");
}
