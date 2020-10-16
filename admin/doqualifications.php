<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include("model.php");
$model=new model;
$name=$_POST['name'];
$description=$_POST['description'];
$model->setQualification($name,$description);
header("Location: qualifications.php");
?>