<?php
   include("model.php");
   $model=new model;
	$name=$_POST['name'];
	$id=$_POST['id'];
	$jid=$_POST['jid'];
	$date=$_POST['date'];
	$email=$_POST['to'];
	$job=$_POST['job'];
	echo $model-> sendEmail2($name,$email,$job,$date);
	header("Location: jobs.php");
?>