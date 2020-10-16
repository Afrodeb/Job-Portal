<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include("model.php");
$model=new model;
$name=$_POST['name'];
$email=$_POST['email'];
$password=$_POST['password'];
$model->setUser($name,$email,$password);
header("Location: users.php")	
?>