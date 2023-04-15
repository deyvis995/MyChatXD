<?php
session_start();
if (isset($_SESSION['unique_id'])) {
  header("location: users.php");
}
?>

<?php include_once "header.php"; ?>

<body>
  <div class="wrapper">
    <section class="form login">
      <header>Sistema de Chat en Línea en PHP y MySQL</header>

      <!--formulario POST-->
      <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
        <div class="error-text"></div>
        <div class="field input">

        <!--Recogemos los datos del usuario y los enviamos por POST-->
          <label>Dirección de Correo Electrónico</label>
          <input type="text" name="email" placeholder="Ingresa tu Correo" required>
        </div>
        <div class="field input">
          <label>Contraseña</label>
          <input type="password" name="password" placeholder="Ingresa tu Contraseña" required>
          <i class="fas fa-eye"></i>
        </div>
        <div class="field button">
          <input type="submit" name="submit" value="Ingresar">
          <!--script>window.location.reload();</script-->
        </div>
      </form>
      <div class="link">Aún no te has registrado? <a href="index.php">Regístrate</a></div>
    </section>
  </div>

  <script src="javascript/pass-show-hide.js"></script>
  <script src="javascript/login.js"></script>
  <script>
    function refrescar(){
      window.location.reload();
    }
  </script>

</body>

</html>