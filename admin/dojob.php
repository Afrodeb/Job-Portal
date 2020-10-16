<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include("model.php");
$model=new model;
$title=$_POST['title'];
$location=$_POST['location'];
$type=$_POST['type'];
$level=$_POST['level'];
$experience=$_POST['experience'];
$description=$_POST['description'];
$id=$model->setJobAdvert($title,$description,$type,$location,$level,$experience);
//if($id != 0) {
		header("Location: jobrequirements.php?id=".$id)	
/*	}else {
		header("Location: addjob.php?e=Could+not+save+job")
		}*/
?>