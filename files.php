<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
$id=$_REQUEST['id'];
include("model.php");
$model=new model;
$applicant=$model->getApplicant($id);
$q=$model->getJobRequirements($applicant[0]['jid']);
$name=$applicant[0]['name']." ".$applicant[0]['surname'];
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $name; ?> : Upload Your Qualifications</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="header">
		<h2><?php echo $name; ?><br>(<?php echo $applicant[0]['id_number']; ?>) <br>Uploading Qualifications.</h2>
	</div>
	<div class="content">
<form action="dofiles.php" method="post" class="form" enctype="multipart/form-data">
<p class="note">Fields with <span class="required">*</span> are required.</p>
<div class="form-group">
<input type="hidden" value="<?php echo $applicant[0]['name']." ".$applicant[0]['surname']; ?>" class="form_control" name="fname" readonly="">
<input type="hidden"   value="<?php echo $applicant[0]['id_number']; ?>" class="form_control" name="id" readonly="">
<input type="hidden" value="<?php echo $applicant[0]['email']; ?>" class="form_control" name="email">
<input type="hidden" value="<?php echo $applicant[0]['id']; ?>" name="uid">
<input type="hidden" value="<?php echo $applicant[0]['jid']; ?>" name="jid">
</div>
<table class="table">
<tr>
<th>Name</th>
<th>Brief Description</th>
<th>Year Completed</th>
<th>File</th>
</tr>
<?php
$c=count($q);
for($x=0;$x<$c;$x++) {
	?>
	<tr>
	<td>
	<input type="text" required="" name="name[]" value="<?php echo $q[$x]['name']; ?>" readonly="" class="form-control">
	</td>
		<td>
	<input type="text" required="" name="description[]" class="form-control">
	</td>
	<td>
	<input type="number" required="" name="year[]" class="form-control">
	</td>
	<td>
	<input type="file" required="" name="files[]" class="form-control">
	</td>

	</tr>
	<?php
	}
?>
<tr>
	<td>
	<input type="text" required="" name="name[]" value="Carriculum Vitae" readonly="" class="form-control">
	</td>
	<td>
	</td>
	<td>
	</td>
	<td>
	<input type="file" required="" name="files[]" class="form-control">
	</td>

	</tr>
</table>
<input type="submit" class="btn btn-primary" value="Complete">
</form>
</div>
		
</body>
</html>
