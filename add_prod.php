<!doctype html>
<html lang="es">
<head>
  <?php require_once 'templates/head.php' ?>
  <title>Agregar nuevo producto</title>
</head>
<body>
<?php
session_start();
require_once 'templates/footer.php';
require_once 'templates/nav.php';
require_once 'core/fdb.php';
?>
<div class="container">
  <h1>Agregar nuevo producto</h1>
  <div class="form-control">
    <form action="" method="post" enctype="multipart/form-data">
      <label for="name">Nombre del producto *</label>
      <input type="text" name="name" id="name" class="form-control" required>
      <label for="price">Precio *</label>
      <input type="number" step="0.01" value="0.00" name="price" id="price" required class="form-control">
      <label for="desc">Descripci&oacute;n *</label>
      <input type="text" name="desc" id="desc" class="form-control" required>
      <label for="img">Imagen *</label>
      <input type="file" name="img" id="img" class="form-control" required>
      <hr>
      <button class="btn" name="ready" type="submit">Agregar producto</button>
    </form>
  </div>
  <?php

  $db = new func();
  if (isset($_POST['ready'])) {
    if (!empty($_POST['name']) && !empty($_POST['price']) && !empty($_POST['desc'])) {
      $name_with = str_replace(' ', '', $_POST['name']);
      $name = $name_with . "." . $db->get_extension($_FILES['img']['name']);
      $final = 'users/' . $_SESSION['user'] . '/products/' . $name;
      if (move_uploaded_file($_FILES['img']['tmp_name'], $final)) {
        try{
          if($db->insert("insert into products values (null, '{$_POST['name']}',
          '{$_POST['desc']}', '{$final}', '{$_POST['price']}', 
          '{$_SESSION['user']}')")>=1){
            echo "Producto Registrado";
          }else{
            echo "Error al registrar";
            unset($name);
          }
        }catch (Exception $e){
          echo "Error al registrar ".$e->getMessage();
          unset($name);
        }

      }
    }
  }
  ?>
</div>

</body>
</html>
