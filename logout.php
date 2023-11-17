<?php
require_once "config.php";
session_start();
if($_SESSION['loggin'] = true){
    session_destroy();
    header("location:login.php");
}else{
    header("location:register.php");
}
?>