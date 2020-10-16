<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
include("model.php");
$model=new model;
$fname=$_POST['id'].str_replace(" ","",strtolower($_POST['fname']));	
$id=$_POST['uid'];
$jid=$_POST['jid'];
$email=$_POST['email'];
$fullname=$_POST['fname'];
$valid_formats = array("pdf","zip");
$max_file_size = 2048*100; //100 kb
$path = "admin/uploads/"; // Upload directory
$count = 0;
	foreach ($_FILES['files']['name'] as $f => $name) { 
	$qname="Application";
	$qyear=date("Y");
	$description="Application";
	if(isset($_POST['year'][$f])) { 
	$qname=$_POST['name'][$f];
	$qyear=$_POST['year'][$f]; 	
	$description=$_POST['description'][$f];
}   
	    if ($_FILES['files']['error'][$f] == 4) {
	        continue; // Skip file if any error found
	    }	       
if( ! in_array(pathinfo($name, PATHINFO_EXTENSION), $valid_formats) ){
				$message[] = "$name is not a valid format";
				continue; // Skip invalid file formats
			}
	        else{ // No error found! Move uploaded files 
	            if(move_uploaded_file($_FILES["files"]["tmp_name"][$f], $path.$fname."_".$name))
	            $count++; // Number of successfully uploaded file
	            $model->addApplicantQualifications($id,$qname,$description,$qyear,$path.$fname."_".$name);
	        }
	}
//	$url=$this->createUrl("applicant/update",array("id"=>$uid));
$url="http://deb.co.zw";
$model->sendEmail($fullname,$email,$jid,$id,$url);
//$this->redirect(array('thankyou','email'=>$email));
header("Location: thankyou.php");
?>