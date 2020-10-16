<?php
include("model.php");
$model=new model;
$qualifications=$_POST['qualification'];
$jid=$_POST['jid'];
			$count=count($qualifications);						
			for($x=0;$x<$count;$x++) {
				$qid=$qualifications[$x];
         $model->setJobQualification($jid,$qid);
			}			
			header("Location: jobs.php");		
?>