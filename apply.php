<?php
$id=$_REQUEST['id'];
include("model.php");
$model=new model;
$jobs=$model->getJob($id);
$count=count($jobs);
$countries=$model->getCountries();
$x=$count-1;
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $jobs[$x]['title']."-".$jobs[$x]['location']; ?></title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="header">
		<h2>Applying for: <?php echo $jobs[$x]['title']."-".$jobs[$x]['location']; ?></h2>
	</div>
	<div class="content">
		<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<form action="doapply.php" method="post" class="form">
			<div class="form-group">
			<label>Name:</label>
			<input type="text" class="form-control" name="name">
			</div>
			<div class="form-group">
			<label>Surname:</label>
			<input type="text" class="form-control" name="surname">
			</div>
			<div class="form-group">
			<label>ID Number:</label>
			<input type="text" class="form-control" name="idnumber">
			</div>
			<div class="form-group">
			<label>Phone:</label>
			<input type="text" class="form-control" name="phone">
			</div>
			<div class="form-group">
			<label>Email:</label>
			<input type="email" class="form-control" name="email">
			</div>
			<div class="form-group">
			<label>Gender:</label>
			<select name="gender" class="form-control">
			<option value="Male">Male</option>
			<option value="Female">Female</option>
			</select>
			</div>
			<div class="form-group">
			<label>Age:</label>
			<input type="number" class="form-control" name="age">
			</div>
			<div class="form-group">
			<label>Address:</label>
			<textarea name="address" class="form-control">
			
			</textarea>
			</div>
			<div class="form-group">
			<label>Marital Status:</label>
			<select name="status" class="form-control">
			<option value="Single">Single</option>
			<option value="Married">Married</option>
			<option value="Divorced">Divorced</option>
			</select>
			</div>

<div class="form-group">
			<label>Nationality:</label>
			<select name="nationality" class="form-control">
			<?php
			$c=count($countries);
			for($u=0;$u<$c;$u++) {
			?>
			<option value="<?php echo $countries[$u]['name']; ?>"><?php echo $countries[$u]['name']; ?></option>
			<?php
			}
			?>			
			</select>
			</div>			
		<div class="form-group">
			<label>Religion:</label>
			<input type="text" class="form-control" name="religion">
			</div>
			<div class="form-group">
			<label>Languages:</label>
			<input type="text" class="form-control" name="languages">
			</div>

			<div class="form-group">
			<label>Drivers License:</label>
			<input type="hidden" name="jid" value="<?php echo $id; ?>">
			<select name="license" class="form-control">
			<option value="Yes">Yes</option>
			<option value="No">No</option>			
			</select>
			</div>			
				<input type="submit" class="btn btn-primary" value="Proceed">
				<input type="reset" class="btn btn-success" value="Reset">
			</form>		
		</div>
		</div>
	</div>
		
</body>
</html>