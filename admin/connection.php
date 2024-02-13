<?php
session_start();
require_once 'config.inc.php';
//mysqli
$con = mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
if(mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}
?>