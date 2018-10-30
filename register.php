<!DOCTYPE html>
<html lang="es">
<?php
session_start();
if(isset($_SESSION['user'])){
  header("location: home.php");
}else{
  session_unset();
  session_destroy();
}
?>
<head>
  <?php require_once 'templates/head.php' ?>
  <title>Registrase</title>
</head>

<body>
<div class="container">
  <div class="row">
    <div class="form-control">
      <form action="" method="post" enctype="multipart/form-data">
        <label for="username">Nombre de usuario</label>
        <input class="form-control" type="text" name="username" id="username" required>
        <label for="passwd">Contrase&ntilde;a</label>
        <input class="form-control" type="password" name="passwd" id="passwd">
        <label for="comp">Nombre de la empresa</label>
        <input class="form-control" type="text" name="comp" id="comp">
        <label for="logo">Logo de la empresa</label>
        <input type="file" name="logo" id="logo" class="form-control">
        <label for="desc">Descripci&oacute;n de la empresa</label>
        <input type="text" name="desc" id="" class="form-control">
        <label for="acepta">Acepto los terminos y condiciones</label>
        <input type="checkbox" name="acepta">
        <button class="btn btn-outline-primary">Registrarse</button>
      </form>
    </div>
  </div>
</div>
<?php require_once 'templates/footer.php'; ?>

</body>

</html>