<!doctype html>
<html lang="es">
<head>
  <?php require_once 'templates/head.php' ?>
  <title>Inicio</title>
</head>
<body>
<?php
session_start();
require_once 'templates/footer.php';
require_once 'templates/nav.php';
require_once 'core/fdb.php';
$db = new func();
$res = $db->query("select * from products where company = '{$_SESSION['user']}'");
?>

<div class="body">
  <div class="container">
    <h1>Lista de productos</h1>
    <table class="table table-hover">
    <tr>
      <th>Nombre del producto</th>
      <th>Precio</th>
      <th>Descripcion</th>
      <th>Imagen</th>
      <th>Opciones</th>
    </tr>
    <?php
    foreach ($res as $re) {
      ?>
      <tr>
        <td><?= $re['name'] ?></td>
        <td><?= $re['price'] ?></td>
        <td><?= $re['description'] ?></td>
        <td><img style="width: 100px !important;" src="<?= $re['img'] ?>" alt="imagen" class="img img-thumbnail"></td>
        <td>
          <a href="edit.php?id=<?= $re['id_pro'] ?>"><button class="btn btn-outline-primary" id="mod">Modificar</button></a>
          <a href="del.php?id=<?= $re['id_pro'] ?>"><button class="btn btn-outline-danger" id="del">Eliminar</button></a>

        </td>
      </tr>
      <?php
    }
    ?>
    </table>
  </div>
</div>
</body>
</html>