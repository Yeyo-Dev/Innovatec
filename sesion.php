<?php
session_start();
error_reporting(0);
$nickname = $_SESSION['nickname'];
    if($nickname == null || $nickname == '' || !$nickname){
        echo "false";
    }
    elseif($nickname)
    {
        echo "true";
    }
    else{
        echo "error";
    }