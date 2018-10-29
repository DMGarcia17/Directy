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

$db = new func();

$res = $db->query("select * from products where id_pro = '{$_GET['id']}'");
?>
<div class="container">
  <h1>Editar producto</h1>
  <div class="form-control">
    <form action="" method="post" enctype="multipart/form-data">
      <label for="name">Nombre del producto *</label>
      <input type="text" name="name" id="name" value="<?=$res[0]['name']?>" class="form-control" required>
      <label for="price">Precio *</label>
      <input type="number" step="0.01" value="<?=$res[0]['price']?>" name="price" id="price" required class="form-control">
      <label for="desc">Descripci&oacute;n *</label>
      <input type="text" name="desc" id="desc" value="<?=$res[0]['description']?>" class="form-control" required>
      <label for="img">Imagen *</label>
      <input type="file" name="img" id="img" class="form-control" required>
      <h5>Imagen Actual</h5>
      <span class="text-muted">Al darle modificar debe llenar todos los campos de nuevo incluyendo la imagen
      o bien puede cancelar el proceso
      </span><br>
      <img src="<?= $res[0]['img'] ?>" alt="imagen" class="img-thumbnail" style="width: 100px !important;">
      <hr>
      <button class="btn" name="ready" type="submit">Agregar producto</button>
    </form>
  </div>
  <?php
  if (isset($_POST['ready'])) {
    if (!empty($_POST['name']) && !empty($_POST['price']) && !empty($_POST['desc'])) {
      $name_with = str_replace(' ', '', $_POST['name']);
      $name = $name_with . "." . $db->get_extension($_FILES['img']['name']);
      $final = 'users/' . $_SESSION['user'] . '/products/' . $name;
      if (move_uploaded_file($_FILES['img']['tmp_name'], $final)) {
        unlink($res[0]['img']);
        try{
          if($db->insert("UPDATE products set 
            name='{$_POST['name']}' AND description='{$_POST['desc']}' AND img='{$final}' AND 
            price='{$_POST['price']}' WHERE id_pro={$_GET['id']}")>=1){
            echo "Producto Registrado";
          }else{
            echo "Error al registrar";
            unlink($name);
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