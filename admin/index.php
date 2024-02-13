<?php
require_once 'config.inc.php';
require_once 'connection.php';

if(!empty($_SESSION['admin']))
{
    header("Location: dashboard.php");
    exit;
}
else{
    header("Location: login.php");
    exit;
}