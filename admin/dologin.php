<?php
include("model.php");
$model=new model;
if($model->login($_POST['email'],$_POST['password'])){
				$loggedIn=$model->login($_POST['email'],$_POST['password']);
				$_SESSION['id']=$loggedIn[0]['id'];
				$_SESSION['name']=$loggedIn[0]['name'];
				$_SESSION['email']=$loggedIn[0]['email'];
				header("Location: index.php");
			}else {
           header("Location: index.php?e=failed");
				}
?>