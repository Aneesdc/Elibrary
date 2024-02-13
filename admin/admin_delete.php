<?php
require_once 'config.inc.php';
require_once 'connection.php';
require_once 'functions.php';
checkLogin(false);
if(!empty($_GET['id']))
{
    $id = $_GET['id'];
    $sql = "delete from admin where id = $id";
    $resultset = mysqli_query($con,$sql);
    if($resultset)
    {
        header("Location: admin_index.php?success=".urlencode('Record has been deleted.'));
    }
}
?>