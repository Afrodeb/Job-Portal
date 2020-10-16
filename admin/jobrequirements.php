<?php
include("header.php");
$jid=$_REQUEST['id'];
$job=$model->getJob($jid);
?>
<div class="signup-page-main">
     <div class="signup-main">  	
    	 <div class="signup-head">
				<h1>Add The Requirements for : <?php echo $job[0]['title']; ?></h1>
			</div>
<div class="signup-block">

<form action="dojobqualifications.php" method="post">
	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<div class="row">
		<input type="hidden" name="jid" value="<?php echo $jid; ?>">
	</div>

	<div class="row">
		Qualifications<br>		
		<?php //echo $form->dropDownList($model,'qid',CHtml::listData(Qualifications::model()->findAll(),'id','name'),array('class'=>'form-control','id'=>'q')); ?>
		<?php
		$qualifications=$model->getQualifications();
		$count=count($qualifications);
		for($x=0;$x<$count;$x++) {
			echo "<input type='checkbox' name='qualification[]' value='".$qualifications[$x]['id']."'>".$qualifications[$x]['name']."<br>";
		}
		?>		
	</div>
<br><br><br><br>
<div class="row">
	<div class="row buttons">		
		<input type="submit" class="btn btn-primary" value="Save">
	</div>
</div>
</form>

</div><!-- form -->
</div>
</div>
<?php
include("footer.php");
?>