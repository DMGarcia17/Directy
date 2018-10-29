<?php
require_once 'core/fdb.php';
$db = new func();
$res = $db->filtered_query("products", "img", "id_pro=".$_GET['id']);

unlink($res[0]['img']);

if($db->insert("delete from products where id_pro='".$_GET['id']."'") == 1){
  header("location: home.php");
}else{
  echo "error";
}