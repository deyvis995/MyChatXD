<?php
session_start();
//conector :3
include_once "config.php";

//variables xd
$fname = mysqli_real_escape_string($conn, $_POST['fname']);
$lname = mysqli_real_escape_string($conn, $_POST['lname']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

//varificamos q los datos no esten vacios
if (!empty($fname) && !empty($lname) && !empty($email) && !empty($password)) {

    //VALIDAMOS el e-mail q este en formato correcto
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        //validamos que el nuevo usuario no exista en la BD
        $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
        if (mysqli_num_rows($sql) > 0) {
            echo "$email - ¡Este e-mail ya existe!";
        } else {
            //realizamos subida de imagen como perfil de usuario
            if (isset($_FILES['image'])) {
                $img_name = $_FILES['image']['name'];
                $img_type = $_FILES['image']['type'];
                $tmp_name = $_FILES['image']['tmp_name'];

                $img_explode = explode('.', $img_name);
                $img_ext = end($img_explode);

                $extensions = ["jpeg", "png", "jpg"];
                if (in_array($img_ext, $extensions) === true) {
                    $types = ["image/jpeg", "image/jpg", "image/png"];
                    if (in_array($img_type, $types) === true) {
                        $time = time();
                        $new_img_name = $time . $img_name;
                        //mueve, Sube el archivo de imagen al 'server' o carpeta 'images'
                        if (move_uploaded_file($tmp_name, "images/" . $new_img_name)) {
                            $ran_id = rand(time(), 100000000);
                            $status = "Disponible";
                            //convertimos la pass en MD5
                            $encrypt_pass = md5($password);

                            //lo registramos en BD
                            $insert_query = mysqli_query($conn, "INSERT INTO users (unique_id, fname, lname, email, password, img, status)
                                VALUES ({$ran_id}, '{$fname}','{$lname}', '{$email}', '{$encrypt_pass}', '{$new_img_name}', '{$status}')");
                            if ($insert_query) {
                                $select_sql2 = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
                                if (mysqli_num_rows($select_sql2) > 0) {
                                    $result = mysqli_fetch_assoc($select_sql2);
                                    $_SESSION['unique_id'] = $result['unique_id'];
                                    echo "Registrado Exitosamente 👍";
                                } else {
                                    echo "¡Esta dirección de correo electrónico no existe!";
                                }
                            } else {
                                echo "No registrado!. Intentalo de nuevo";
                            }
                        }
                    } else {
                        echo "Cargue un archivo de imagen: jpeg, png, jpg";
                    }
                } else {
                    echo "Cargue un archivo de imagen: jpeg, png, jpg";
                }
            }
        }
    } else {
        echo "$email ¡No es un correo electrónico válido!";
    }
} else {
    echo "Campos obligatorios!";
}
