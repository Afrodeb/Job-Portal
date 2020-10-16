

--------------------------------------------
<?php
if (@isset($_POST['submit'])) 
   
	$link = mysqli_connect('localhost', 'root', '', 'jams'); 
	mysqli_query($link,"insert into admin values ('', '$_POST[username]','$_POST[password]', '', '') ") 
	   
   else 
    {
		}
?>

--------------------------------------------
<script type="text/javascript">
alert("Your Message");


</script>
--------------------------------------------
if (@isset($_POST['username']) &&isset($_POST['password']))
  {
	$username = $POST['username'];
	$password = $POST['password'];
	
	  if (!@empty($username) && !empty($password))
	       {
			 echo 'Username and Password Correct';  
			   }  
	  else
	  {
		echo 'You must supply a Username and Password ';  
		  }       
	  }
