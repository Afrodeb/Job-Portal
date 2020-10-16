<?php
include("header.php");
$jid=$_REQUEST['id'];
$data=$model->getApplicantsByJob($jid)
?>
<table class="table">
<tr>
<td>Title</td>
<td>Age</td>
<td>Nationality</td>
<td>Action</td>
</tr>
<?php
$count=count($data);
for($x=0;$x<$count;$x++) {
	//$view=$this->createUrl("applicant/view",array("id"=>$data[$x]['id'],"jid"=>$jid));
	//$app=$this->createUrl("applicant/job",array("id"=>$data[$x]['id']));
$app="applicant.php?id=".$data[$x]['id']."&jid=".$jid;
?>
<tr>
<td><?php echo $data[$x]['name']." ".$data[$x]['surname']; ?></td>
<td><?php echo $data[$x]['age']; ?></td>
<td><?php echo $data[$x]['nationality']; ?></td>
<td>
<a href="<?php echo $app; ?>" class="btn btn-primary">View Applicant</a>
</td>
</tr>	
<?php
}
?>
</table>
<?php
include("footer.php");
?>