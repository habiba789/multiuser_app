<?php
require_once "config.php";
$errorMsg= false;
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $deleteSql = "DELETE FROM data WHERE id = '$id'";

    $result = mysqli_query($conn, $deleteSql);

    if($result){
        header("location:dashboard.php");
    }else{
        $errorMsg = "Got some issue in deleting record. Please Try again";
        header("location:dashboard.php");
    }
}
?>