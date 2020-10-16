<?php
include("model.php");
$model=new model;
$jobs=$model->getJobs();
$count=count($jobs);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="header">
		<h2>Job Listings</h2>
	</div>
	<div class="content">
		<div class="row">
		<?php
		for($x=0;$x<$count;$x++) {
			$url="job.php?id=".$jobs[$x]['id'];
		?>
		<div class="col-md-4">
		<img src="logo.jpg" alt="">
		<a href="<?php echo $url; ?>"><h3><?php echo $jobs[$x]['title']; ?></h3></a>
		<p><?php 
		echo "<b>Type:</b> ".$jobs[$x]['level']."<br>"; 
      echo "<b>Added:<b/> ". $model->dateFormater($jobs[$x]['created'])."<br>";
      echo "<b>Location:<b/> ". $jobs[$x]['location']."<br>";	
      echo "<b>Type:<b/> ". $jobs[$x]['type'];		
		?>
		
		</p>
		
		</div>
		<?php
		}
		?>
		</div>
	</div>
		
</body>
</html>