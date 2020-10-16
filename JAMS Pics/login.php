<?php
require 'connect2db.php';
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> Log In </title>
<link href="header.css" rel="stylesheet" type="text/css" />




</head>

<body>

<div id="a">
<img src="new logo.jpg"/>

</div>


<div id="b">

<h1> Job Application Management System </h1>

</div>

<div id="c">

<h1> J.A.M.S </h1>
</div>


<div id="d">


<form action=""   method="POST">

<table>

<tr>
<td>Username:</td>
<td><input type="text" name="username" title="Please Enter a Username" width="100" maxlength="15" placeholder="e.g TKay" align="middle"  required pattern="^[A-Za-z]+"></td>
</tr>

<br/>



<tr>
<td>Password: </td>
<td><input type="password" name="password" width="100" maxlength="15" align="middle" required pattern="^[A-Za-z0-9]+"></td>
</tr>

<br/>


<tr>
<td colspan="10" align="center"><input type="submit" name="submit" value = "LOG IN" class="bluebutton"  ><td>
</td>
</tr>

<tr>
<td><a href="forgot_password.php" class="fpass"> forgot password?</a></td>
</tr>

</table>
</form>




</div>
</body>
</html>

