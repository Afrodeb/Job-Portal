<?php
include("model.php");
$idnumber=$_POST['username'];
$phone=$_POST['password'];
echo $idnumber."--".$phone;
$model=new model;
$user=$model->login($phone,$idnumber);
print_r($user);
?>