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
      <label for="nname">Nombre del producto *</label>
      <input type="text" name="nname" id="nname" value="<?=$res[0]['name']?>" class="form-control" required>
      <label for="nprice">Precio *</label>
      <input type="number" step="0.01" value="<?=$res[0]['price']?>" name="nprice" id="nprice" required class="form-control">
      <label for="ndesc">Descripci&oacute;n *</label>
      <input type="text" name="ndesc" id="ndesc" value="<?=$res[0]['description']?>" class="form-control" required>
      <label for="nimg">Imagen *</label>
      <input type="file" name="nimg" id="nimg" class="form-control" required>
      <h5>Imagen Actual</h5>
      <span class="text-muted">Al darle modificar debe llenar todos los campos de nuevo incluyendo la imagen
      o bien puede cancelar el proceso
      </span><br>
      <img src="<?= $res[0]['img'] ?>" alt="imagen" class="img-thumbnail" style="width: 100px !important;">
      <hr>
      <button class="btn" name="read" type="submit">Agregar producto</button>
    </form>
  </div>
  <?php
  if (isset($_POST['read'])) {
    if (!empty($_POST['nname']) && !empty($_POST['nprice']) && !empty($_POST['ndesc'])) {
      $name_with = str_replace(' ', '', $_POST['nname']);
      $name = $name_with . "." . $db->get_extension($_FILES['nimg']['name']);
      $final = 'users/' . $_SESSION['user'] . '/products/' . $name;
      if (move_uploaded_file($_FILES['nimg']['tmp_name'], $final)) {
        unlink($res[0]['img']);
        try{
          if($db->insert("UPDATE products set 
            name='{$_POST['nname']}' AND description='{$_POST['ndesc']}' AND img='{$final}' AND 
            price='{$_POST['nprice']}' WHERE id_pro={$_GET['id']}")>=1){
            echo "Producto Actualizado<br>";
            echo $final."<br>";
            echo "<img src='{$_FILES['nimg']['tmp_name']}'>";
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