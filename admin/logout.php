<?php
include("model.php");
$model=new model();
session_destroy();
header("Location: login.php");
?>