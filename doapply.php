<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
$name=$_POST['name'];
$surname=$_POST['surname'];
$idnumber=$_POST['idnumber'];
$email=$_POST['email'];
$phone=$_POST['phone'];
$gender=$_POST['gender'];
$age=$_POST['age'];
$address=$_POST['address'];
$status=$_POST['status'];
$nationality=$_POST['nationality'];
$religion=$_POST['religion'];
$languages=$_POST['languages'];
$license=$_POST['license'];
$jid=$_POST['jid'];
include("model.php");
$model=new model;
$id=$model->apply($name,$surname,$idnumber,$email,$phone,$gender,$age,$address,$status,$nationality,$religion,$languages,$license,$jid);
header("Location: files.php?id=".$id);
?>