<?php
session_start();

switch ($_SESSION['privileges']) {
    case '1':
        define('priv', '1');
        break;
    default:
        session_unset();
        session_destroy();
        header('location: http://server/Electronic-Dossiers');
        break;
}
