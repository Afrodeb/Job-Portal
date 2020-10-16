<?php
include("header.php");
?>
<div class="signup-page-main">
     <div class="signup-main">  	
    	 <div class="signup-head">
				<h1>Add New User</h1>
			</div>

<div class="signup-block">

<form action="douser.php" method="post">
	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<div class="row">
		Name
		<input type="text" class="form-control" name="name" required="">
	</div>

<div class="row">
		Email
		<input type="email" name="email" class="form-control" required="">		
	</div>

<div class="row">
Password
		<input type="password" name="password" class="form-control" required="">
	</div>



	<div class="row buttons">
<input type="submit" class="btn btn-primary" value="Add User">
	</div>

</form>

</div><!-- form -->
</div>
</div>
<?php
include("footer.php");
?>