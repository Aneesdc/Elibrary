<?php
function checkLogin($moderatorAllow = true)
{
    if (empty($_SESSION['admin'])) {
        header("Location: login.php");
        exit();
    }
    
    if(!$moderatorAllow)
    {
        $type = $_SESSION['admin']['type'];
        if($type == 'moderator')
        {
            header("Location: dashboard.php?error=".urlencode('This page is not allowed'));
            exit;
        }
    }
    
}
function getFileName($filenames = [])
{
    //current url
    $url = $_SERVER['REQUEST_URI'];
    $url =  pathinfo($url);
    $filename = $url['filename'].".php";
    if(in_array($filename, $filenames))
    {
        return true;
    }
    else{
        return false;
    }
}
?>