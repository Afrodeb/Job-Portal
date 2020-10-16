<?php
include("header.php");
$id=$_REQUEST['id'];
$jid=$_REQUEST['jid'];
$data=$model->getApplicants($id);
$job=$model->getJob($jid);
?>
<h2>Send Interview Email</h2>
<table class="table">
<tr>
<td>Title</td>
<td>Age</td>
<td>Nationality</td>
</tr>
<?php
$count=count($data);
for($x=0;$x<$count;$x++) {
	$send="applicantsend.php?id=".$data[$x]['id']."&jid=".$jid;
	//$app=$this->createUrl("applicant/job",array("id"=>$data[$x]['id']));
?>
<tr>
<td><?php echo $data[$x]['name']." ".$data[$x]['surname']; ?></td>
<td><?php echo $data[$x]['age']; ?></td>
<td><?php echo $data[$x]['nationality']; ?></td>
</tr>	
<?php
}
?>
</table>
<?php
$action="applicantsend.php";
$x=0;
?>
<form action="<?php echo $action; ?>" method="post">
<input type="hidden" value="<?php echo $data[$x]['name']." ".$data[$x]['surname']; ?>" name="name">
<input type="hidden" value="<?php echo $data[$x]['email']; ?>" name="to">
<input type="hidden" value="<?php echo $job[0]['title']; ?>" name="job">
<input type="hidden" value="<?php echo $jid; ?>" name="jid">
<input type="hidden" value="<?php echo $id; ?>" name="id">
<input type="text" name="date" class="form-control" placeholder="Date of Interview">
<input type="submit" class="btn btn-primary" value="Send Now">
</form>
<?php
include("footer.php");
?>