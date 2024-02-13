<?php
require_once 'config.inc.php';
require_once 'connection.php';
require_once 'functions.php';
checkLogin(false);

if(!empty($_GET['id']))
{
    $id = $_GET['id'];
    $sql = "select * from admin where id = $id";
    $resultset = mysqli_query($con,$sql);
    $result = mysqli_fetch_array($resultset);
    if($result['status'] == 1)
    {
        $sql = "update admin set status = 0 where id = $id";
        $resultset = mysqli_query($con,$sql);
    }
    else{
        
        $sql = "update admin set status = 1 where id = $id";
        $resultset = mysqli_query($con,$sql);
    }
    header("Location: admin_index.php");
}
?>