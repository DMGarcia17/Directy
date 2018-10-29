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
  <title>Iniciar Sesión</title>
  <style>
    .pt{
      padding-top: 25vh;
    }
  </style>
</head>

<body>
<div class="container">
  <div class="row">
    <div id="col">
      <img src="assets/img/logo_Desp.jpg" alt="" class="img img-fluid">
    </div>
    <div class="col">
      <div class="pt">
        <form action="config/auten.php" method="post">
          <div class="form-group">
            <label>Usuario:
              <input type="text" name="user" class="form-control">
            </label>
          </div>
          <div class="form-group">
            <label>
              <input type="password" name="passwd" class="form-control">
            </label>
          </div>
          <div class="form-group">
            <button class="btn" type="submit">Iniciar Sesión</button>
          </div>
        </form>
      </div>
      <div class="row">

      </div>
    </div>
  </div>
</div>
<?php require_once 'templates/footer.php'; ?>

</body>

</html>
