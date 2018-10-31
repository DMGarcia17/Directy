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
  <h1>Registrarse</h1>
  <div class="row">
    <div class="form-control">
      <form action="" method="post" enctype="multipart/form-data">
        <label for="username">Nombre de usuario</label>
        <input class="form-control" type="text" name="username" id="username" required>
        <label for="passwd">Contrase&ntilde;a</label>
        <input class="form-control" type="password" name="passwd" id="passwd">
        <label for="comp">Nombre de la empresa</label>
        <input class="form-control" type="text" name="comp" id="comp">
        <label for="locat">Ubicaci&oacute;n de la empresa</label>
        <input class="form-control" type="text" name="locat" id="locat">
        <label for="logo">Logo de la empresa</label>
        <input type="file" name="logo" id="logo" class="form-control">
        <label for="desc">Descripci&oacute;n de la empresa</label>
        <input type="text" name="desc" id="" class="form-control">
        <hr>
        <input type="checkbox" name="acepta">
        <label for="acepta">Acepto los terminos y condiciones</label>
        <hr>
        <button class="btn btn-outline-primary" name="btn">Registrarse</button>
      </form>
    </div>
  </div>
</div>
<?php require_once 'templates/footer.php'; ?>


<?php

if(isset($_POST['btn'])){
  if(!empty($_POST['username']) && !empty($_POST['passwd']) && !empty($_POST['comp']) && !empty($_POST['locat']) && !empty($_FILES['logo']) && !empty($_POST['desc']) && $_POST['acepta'] != false ){
    if($_FILES['logo']['type'] == 'image/png'){
      require_once 'core/fdb.php';
      $passwd=base64_encode($_POST['passwd']);
      $username = $_POST['username'];
      $comp = $_POST['comp'];
      $file = $_FILES['logo'];
      $locat = $_POST['locat'];
      $logo = 'users/'.$username.'/logo.png';
      $desc = $_POST['desc'];
      $db = new func();
      
      if (move_uploaded_file($_FILES['logo']['tmp_name'], $logo)) {
        if($db->insert("insert into users values ('$username', '$passwd', '$comp', '$locat', '$logo', '$desc')")){
          echo "Registro exitoso";
        }else{
          echo "Registro fallido";
          unlink($logo);
        }
      }else{
        echo "Error al subir la imagen";
      }
    }
  }
}


?>
</body>

</html>