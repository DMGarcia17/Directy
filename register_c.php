<!DOCTYPE html>
<html lang="es">
<?php
session_start();
if(isset($_SESSION['user'])){
  header("locion: home.php");
}else{
  session_unset();
  session_destroy();
  header("locion: index.php");
}
?>
<head>
  <?php require_once 'templates/head.php' ?>
  <title>Modificar datos</title>
</head>

<body>
  <?php
require_once 'templates/footer.php';
require_once 'templates/nav.php';

require_once 'core/fdb.php';
$db = new func();
if(isset($_GET['id'])){
  $res=$db->query("select * from users where username='{$_GET['id']}'");

  ?>
<div class="container">
  <h1>Modificar datos</h1>
  <div class="row">
    <div class="form-control">
      <form action="" method="post" enctype="multipart/form-data">
        <label for="user">Nombre de usuario</label>
        <input value="<?=$res[0]['username']?>" class="form-control" type="text" name="user" id="user" required>
        <label for="pass">Contrase&ntilde;a</label>
        <input value="<?=$res[0]['passwd']?>" class="form-control" type="password" name="pass" id="pass">
        <label for="comp">Nombre de la empresa</label>
        <input value="<?=$res[0]['c_name']?>" class="form-control" type="text" name="comp" id="comp">
        <label for="loc">Ubicaci&oacute;n de la empresa</label>
        <input value="<?=$res[0]['ubication']?>" class="form-control" type="text" name="loc" id="loc">
        <label for="img">img de la empresa</label>
        <input type="file" name="img" id="img" class="form-control">
        <label for="des">desripci&oacute;n de la empresa</label>
        <input value="<?=$res[0]['description']?>" type="text" name="des" id="" class="form-control">
        <button class="but but-outline-primary" name="but">Registrarse</button>
      </form>
    </div>
  </div>
</div>


<?php
}
if(isset($_POST['but'])){
  if(!empty($_POST['user']) && !empty($_POST['pass']) && !empty($_POST['comp']) && !empty($_POST['loc']) && !empty($_FILES['img']) && !empty($_POST['des']) && $_POST['but'] != false ){
    if($_FILES['img']['type'] == 'image/png'){
      $pass=base64_encode($_POST['pass']);
      $user = $_POST['user'];
      $comp = $_POST['comp'];
      $file = $_FILES['img'];
      $loc = $_POST['loc'];
      $img = 'users/'.$user.'/img.png';
      $des = $_POST['des'];
      
      
      if (move_uploaded_file($_FILES['img']['tmp_name'], $img)) {
        if($db->insert("update users
          set username='$user' and passwd='$passwd'
          and c_name='$comp' and ubication='$loc' 
          and logo='$img' and description='$des'")){
          echo "Registro exitoso";
        unlink($res[0]['logo']);
        }else{
          echo "Registro fallido";
          unlink($img);
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