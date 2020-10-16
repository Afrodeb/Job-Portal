<?php
include("header.php");
$data=$model->getQualifications();
?>
<div class="signup-page-main">
     <div class="signup-main">  	
    	 <div class="signup-head">
				<h1>Qualifications</h1>
			</div>

<table class="table">
<thead>
<tr>
<th>Name</th>
<th>Description</th>
<!--<th>Action</th>-->
</tr>
</thead>
<tbody>
<?php
$count=count($data);
for($x=0;$x<$count;$x++) {
$update="qualificationsupdate.php?id=".$data[$x]['id'];
?>
<tr>
<td>
<?php
echo $data[$x]['name'];
?>
</td>
<td>
<?php
echo $data[$x]['description'];
?>
</td>
<!--<td>
<a href="<?php echo $update;?>" class="btn btn-warning">Update</a>
</td>-->
</tr>
<?php
}
?>
</tbody>
</table>

</div>
</div>
<?php
include("footer.php");
?>
