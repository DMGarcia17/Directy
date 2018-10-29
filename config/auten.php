<?php
session_start();
require_once '../core/fdb.php';

$db = new func();

$user = $_POST['user'];
$passwd = $_POST['passwd'];

$res = $db->val_user($user, $passwd);

if ($res == 1) {
    echo 'Login successful';
    $r = $db->query('select * from users where users.username=\''.$user.'\'');
    $_SESSION['user'] = $r[0]['username'];

    header('location: ../home.php');
} else {
    echo 'Login failed';
}
