<?php
class model{
public $conn=null;
function __construct(){
if (session_status() == PHP_SESSION_NONE ) {
    session_start();
}	
include("connect.php");
$this->conn=connect();
}
	
public function register($name,$type,$phone,$email,$password) {
$return =false;
if($this->conn != null) {
	$password=md5($password);
$stmt = $this->conn->prepare("INSERT INTO student(name,phone,email,password)
    VALUES (:name, :phone, :email, :password)");
    if($type == "teacher") {
    $stmt = $this->conn->prepare("INSERT INTO teacher(name,phone,email,password)
    VALUES (:name, :phone, :email, :password)");
    }
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
    $return =true;
}
return $return;
}


public function apply($name,$surname,$idnumber,$email,$phone,$gender,$age,$address,$status,$nationality,$religion,$languages,$license,$jid) {
$return =false;
if($this->conn != null) {
$stmt = $this->conn->prepare(
 "INSERT INTO 
 applicant(name,surname,id_number,email,phone,gender,age,address,marital_status,nationality,religion,languages,drivers_licenCe,jid)
 VALUES (:name, :surname,:id_number,:email,:phone,:gender,:age,:address,:marital_status,:nationality,:religion,:languages,:drivers_license,:jid)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':surname', $surname);
    $stmt->bindParam(':id_number', $idnumber);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':gender', $gender);
    $stmt->bindParam(':age', $age);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':marital_status', $status);
    $stmt->bindParam(':nationality', $nationality);
    $stmt->bindParam(':religion', $religion);
    $stmt->bindParam(':languages', $languages);
    $stmt->bindParam(':drivers_license', $license);
    $stmt->bindParam(':jid', $jid);
    $stmt->execute();
    $return =true;
}
return $this->conn->lastInsertId();
}

public function sendMessage($to,$from,$message) {
$return =false;
if($this->conn != null) {
$stmt = $this->conn->prepare("INSERT INTO messages(_to,_from,message)
    VALUES (:to, :from, :message)");
    $stmt->bindParam(':to', $to);
    $stmt->bindParam(':from', $from);
    $stmt->bindParam(':message', $message);
    $stmt->execute();
    $return =true;
}
return $return;
}

public function sendGroupMessage($to,$from,$message,$type) {
$return =false;
if($this->conn != null) {
$stmt = $this->conn->prepare("INSERT INTO group_chat(gid,_from,message,_type)
    VALUES (:to, :from, :message,:type)");
    $stmt->bindParam(':to', $to);
    $stmt->bindParam(':from', $from);
    $stmt->bindParam(':message', $message);
     $stmt->bindParam(':type', $type);
    $stmt->execute();
    $return =true;
}
return $return;
}

public function addCourse($name,$description) {
$return =false;
if($this->conn != null) {
$stmt = $this->conn->prepare("INSERT INTO class(name,description)
    VALUES (:name, :description)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':description', $description);
    $stmt->execute();
    $return =true;
}
return $return;
}

public function patient($name,$phone,$address,$diagnosis) {
$return =false;
if($this->conn != null) {
$stmt = $this->conn->prepare("INSERT INTO user (name,phone, address,password,diagnosis)
    VALUES (:name, :phone, :address, :password,:diagnosis)");
$password=sha1($phone);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':password',$password );
    $stmt->bindParam(':diagnosis', $diagnosis);
    $this->setNotification("New patient was added.");
    $stmt->execute();
    $return =true;
}
return $return;
}

public function addCourseTeacher($tid,$cid) {
$return =false;
if($this->conn != null) {
$stmt = $this->conn->prepare("INSERT INTO class_teacher(tid,cid)
    VALUES (:tid, :cid)");
    $stmt->bindParam(':tid', $tid);
    $stmt->bindParam(':cid', $cid);
    $stmt->execute();
    $return =true;
}
return $return;
}

public function media($description,$link,$class) {
$return =false;
if($this->conn != null) {
$stmt = $this->conn->prepare("INSERT INTO media(link,description,cid)
    VALUES (:link, :description, :cid)");
    $stmt->bindParam(':link', $link);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':cid',$class);
    $stmt->execute();
}
}


public function supervisor($name,$phone) {
$return =false;
if($this->conn != null) {
$stmt = $this->conn->prepare("INSERT INTO supervisor (name,phone,password)
    VALUES (:name, :phone, :password)");
$password=sha1($phone);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':password',$password );
    $this->setNotification("New supervisor was added.");
    $stmt->execute();
    $return =true;
}
return $return;
}

public function advice($advice,$type) {
$return =false;
if($this->conn != null) {
$stmt = $this->conn->prepare("INSERT INTO advice (type,message)
    VALUES (:type, :message)");
    $stmt->bindParam(':type', $type);
    $stmt->bindParam(':message', $advice);
    $stmt->execute();
    $this->setNotification("New advice added");
    $return =true;
}
return $return;
}

public function addContact($myphone,$name,$phone) {
$return =false;
if($this->conn != null) {
$stmt = $this->conn->prepare("INSERT INTO contacts (myphone,name,phone)
    VALUES (:myphone, :name,:phone)");
    $stmt->bindParam(':myphone', $myphone);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':phone', $phone);
    $stmt->execute();
    $return =true;
}
return $return;
}

public function getApplicant($id){
$return=null;
    $str="SELECT * FROM applicant WHERE id={$id}";
    $stmt = $this->conn->prepare($str);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    $return = $stmt->fetchAll();	
    return $return; 
}

public function addApplicantQualifications($id,$name,$description,$year,$file){
$str="INSERT into applicant_qualifications(aid,name,description,year,file) VALUES('$id','$name','$description','$year','$file')";
 $stmt = $this->conn->prepare($str);
 $stmt->execute();	
}

public function sendEmail($name,$email,$jid,$id,$url) {
$jobs=$this->getJob($jid);
$job=$jobs[0]['title'];
$message='<!doctype html>
<html>
  <head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>N.O.I.C - Thank You</title>
    <style>
      /* -------------------------------------
          GLOBAL RESETS
      ------------------------------------- */
      img {
        border: none;
        -ms-interpolation-mode: bicubic;
        max-width: 100%; }

      body {
        background-color: #f6f6f6;
        font-family: sans-serif;
        -webkit-font-smoothing: antialiased;
        font-size: 14px;
        line-height: 1.4;
        margin: 0;
        padding: 0;
        -ms-text-size-adjust: 100%;
        -webkit-text-size-adjust: 100%; }

      table {
        border-collapse: separate;
        mso-table-lspace: 0pt;
        mso-table-rspace: 0pt;
        width: 100%; }
        table td {
          font-family: sans-serif;
          font-size: 14px;
          vertical-align: top; }

      /* -------------------------------------
          BODY & CONTAINER
      ------------------------------------- */

      .body {
        background-color: #f6f6f6;
        width: 100%; }

      /* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */
      .container {
        display: block;
        Margin: 0 auto !important;
        /* makes it centered */
        max-width: 580px;
        padding: 10px;
        width: 580px; }

      /* This should also be a block element, so that it will fill 100% of the .container */
      .content {
        box-sizing: border-box;
        display: block;
        Margin: 0 auto;
        max-width: 580px;
        padding: 10px; }

      /* -------------------------------------
          HEADER, FOOTER, MAIN
      ------------------------------------- */
      .main {
        background: #ffffff;
        border-radius: 3px;
        width: 100%; }

      .wrapper {
        box-sizing: border-box;
        padding: 20px; }

      .content-block {
        padding-bottom: 10px;
        padding-top: 10px;
      }

      .footer {
        clear: both;
        Margin-top: 10px;
        text-align: center;
        width: 100%; }
        .footer td,
        .footer p,
        .footer span,
        .footer a {
          color: #999999;
          font-size: 12px;
          text-align: center; }

      /* -------------------------------------
          TYPOGRAPHY
      ------------------------------------- */
      h1,
      h2,
      h3,
      h4 {
        color: #000000;
        font-family: sans-serif;
        font-weight: 400;
        line-height: 1.4;
        margin: 0;
        Margin-bottom: 30px; }

      h1 {
        font-size: 35px;
        font-weight: 300;
        text-align: center;
        text-transform: capitalize; }

      p,
      ul,
      ol {
        font-family: sans-serif;
        font-size: 14px;
        font-weight: normal;
        margin: 0;
        Margin-bottom: 15px; }
        p li,
        ul li,
        ol li {
          list-style-position: inside;
          margin-left: 5px; }

      a {
        color: #3498db;
        text-decoration: underline; }

      /* -------------------------------------
          BUTTONS
      ------------------------------------- */
      .btn {
        box-sizing: border-box;
        width: 100%; }
        .btn > tbody > tr > td {
          padding-bottom: 15px; }
        .btn table {
          width: auto; }
        .btn table td {
          background-color: #ffffff;
          border-radius: 5px;
          text-align: center; }
        .btn a {
          background-color: #ffffff;
          border: solid 1px #3498db;
          border-radius: 5px;
          box-sizing: border-box;
          color: #3498db;
          cursor: pointer;
          display: inline-block;
          font-size: 14px;
          font-weight: bold;
          margin: 0;
          padding: 12px 25px;
          text-decoration: none;
          text-transform: capitalize; }

      .btn-primary table td {
        background-color: #3498db; }

      .btn-primary a {
        background-color: #3498db;
        border-color: #3498db;
        color: #ffffff; }

      /* -------------------------------------
          OTHER STYLES THAT MIGHT BE USEFUL
      ------------------------------------- */
      .last {
        margin-bottom: 0; }

      .first {
        margin-top: 0; }

      .align-center {
        text-align: center; }

      .align-right {
        text-align: right; }

      .align-left {
        text-align: left; }

      .clear {
        clear: both; }

      .mt0 {
        margin-top: 0; }

      .mb0 {
        margin-bottom: 0; }

      .preheader {
        color: transparent;
        display: none;
        height: 0;
        max-height: 0;
        max-width: 0;
        opacity: 0;
        overflow: hidden;
        mso-hide: all;
        visibility: hidden;
        width: 0; }

      .powered-by a {
        text-decoration: none; }

      hr {
        border: 0;
        border-bottom: 1px solid #f6f6f6;
        Margin: 20px 0; }

      /* -------------------------------------
          RESPONSIVE AND MOBILE FRIENDLY STYLES
      ------------------------------------- */
      @media only screen and (max-width: 620px) {
        table[class=body] h1 {
          font-size: 28px !important;
          margin-bottom: 10px !important; }
        table[class=body] p,
        table[class=body] ul,
        table[class=body] ol,
        table[class=body] td,
        table[class=body] span,
        table[class=body] a {
          font-size: 16px !important; }
        table[class=body] .wrapper,
        table[class=body] .article {
          padding: 10px !important; }
        table[class=body] .content {
          padding: 0 !important; }
        table[class=body] .container {
          padding: 0 !important;
          width: 100% !important; }
        table[class=body] .main {
          border-left-width: 0 !important;
          border-radius: 0 !important;
          border-right-width: 0 !important; }
        table[class=body] .btn table {
          width: 100% !important; }
        table[class=body] .btn a {
          width: 100% !important; }
        table[class=body] .img-responsive {
          height: auto !important;
          max-width: 100% !important;
          width: auto !important; }}

      /* -------------------------------------
          PRESERVE THESE STYLES IN THE HEAD
      ------------------------------------- */
      @media all {
        .ExternalClass {
          width: 100%; }
        .ExternalClass,
        .ExternalClass p,
        .ExternalClass span,
        .ExternalClass font,
        .ExternalClass td,
        .ExternalClass div {
          line-height: 100%; }
        .apple-link a {
          color: inherit !important;
          font-family: inherit !important;
          font-size: inherit !important;
          font-weight: inherit !important;
          line-height: inherit !important;
          text-decoration: none !important; }
        .btn-primary table td:hover {
          background-color: #34495e !important; }
        .btn-primary a:hover {
          background-color: #34495e !important;
          border-color: #34495e !important; } }

    </style>
  </head>
  <body class="">
    <table border="0" cellpadding="0" cellspacing="0" class="body">
      <tr>
        <td>&nbsp;</td>
        <td class="container">
          <div class="content">

            <!-- START CENTERED WHITE CONTAINER -->
            <span class="preheader">This is preheader text. Some clients will show this text as a preview.</span>
            <table class="main">

              <!-- START MAIN CONTENT AREA -->
              <tr>
                <td class="wrapper">
                  <table border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td>
                        <p>Hi there,'.$name.'</p>
                        <p>Thank you for applying for the position of '.$job.' in our organisation.</p>
                        <table border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">
                          <tbody>
                            <tr>
                              <td align="left">
                                <table border="0" cellpadding="0" cellspacing="0">
                                  <tbody>
                                    <tr>
        <td>You can always update your application <a href="'.$url.'" target="_blank">here.</a> </td>
                                    </tr>
                                  </tbody>
                                </table>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                        <p>If your application is successful, we will get in touch with you whithin two weeks to setup an interview.</p>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>

            <!-- END MAIN CONTENT AREA -->
            </table>

            <!-- START FOOTER -->
            <div class="footer">
              <table border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td class="content-block">
                    <span class="apple-link">National Oil Infrastructure Company Of Zimbabwe.</span>
                    <br> </a>.
                  </td>
                </tr>
                <tr>
                  <td class="content-block powered-by">
                    Powered by <a href="http://afrodeb.com">AfroDeb Mailer</a>.
                  </td>
                </tr>
              </table>
            </div>
            <!-- END FOOTER -->

          <!-- END CENTERED WHITE CONTAINER -->
          </div>
        </td>
        <td>&nbsp;</td>
      </tr>
    </table>
  </body>
</html>
';


$email=urlencode($email);
$url=urlencode($url);
$name=urlencode($name);
$id=urlencode("N.O.I.C");	
$url="http://deb.co.zw/noic.php?from=".$id."&url=".$url."&to=".$email."&name=".$name;
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => $url
    ));
$resp = curl_exec($curl);
curl_close($curl);
return $resp;
}

public function getJobRequirements($id){
$return=null;
    $str="SELECT 
    job_qualifications.*,qualifications.* 
    FROM 
    qualifications,job_qualifications
    WHERE 
    job_qualifications.qid=qualifications.id
    AND
    job_qualifications.jid='{$id}' 
    ";
    $stmt = $this->conn->prepare($str);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    $return = $stmt->fetchAll();	
    return $return; 
}

public function getMessages($me,$to){
$return=null;
$this->setMessagesStatus($to,$me);
    $str="SELECT * FROM messages WHERE 
          (_to={$to} AND _from={$me})
                     OR
         (_to={$me} AND _from={$to})";
    $stmt = $this->conn->prepare($str);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    $return = $stmt->fetchAll();	
    return $return; 
}

public function getGroupMessages($id){
$return=null;
//$this->setMessagesStatus($to,$me);
    $str="SELECT group_chat.*,student.*,student.name AS sname
          FROM group_chat,student 
          WHERE 
          group_chat.gid={$id}
          AND 
          group_chat._from=student.phone";
    $stmt = $this->conn->prepare($str);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    $return = $stmt->fetchAll();	
    return $return; 
}

public function getNewMessages($me,$to){
$return=null;
$this->setMessagesStatus($to,$me);
    $str="SELECT * FROM messages WHERE 
          ((_to={$to} AND _from={$me})
                     OR
         (_to={$me} AND _from={$to})) AND status='notread'";
    $stmt = $this->conn->prepare($str);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    $return = $stmt->fetchAll();	
    return $return; 
}

public function getMyNoty($me){
$return=null;
    $str="SELECT messages.*,contacts.* FROM messages,contacts WHERE messages._to={$me} AND messages.status='notread' AND contacts.phone=messages._from";
    $stmt = $this->conn->prepare($str);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    $return = $stmt->fetchAll();	
    return $return; 
}


public function getJobs(){
$return=null;
    $str="SELECT * FROM job";
    $stmt = $this->conn->prepare($str);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    $return = $stmt->fetchAll();	
    return $return; 
}

public function getJob($id){
$return=null;
    $str="SELECT * FROM job WHERE id='{$id}'";
    $stmt = $this->conn->prepare($str);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    $return = $stmt->fetchAll();	
    return $return; 
}

public function setMessagesStatus($me,$to){
$return=null;
    $str="UPDATE messages SET status='read' WHERE 
          (_to='{$to}' AND _from='{$me}') 
                      OR 
          (_to='{$me}' AND _from='{$to}')";
    $stmt = $this->conn->prepare($str);
    $stmt->execute();
    return true; 
}


public function getCourseTeacher($id){
$return=null;
    $str="SELECT teacher.*,teacher.name AS tname,class.*,class_teacher.* 
          FROM class,class_teacher,teacher WHERE 
          class.id=class_teacher.cid AND 
          class_teacher.tid=teacher.id AND 
          class.id=:id";
    $stmt = $this->conn->prepare($str);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    $return = $stmt->fetchAll();	
    return $return; 
}

public function updateadvice($id,$advice,$type){
$return =false;
if($this->conn != null) {
$stmt = $this->conn->prepare("UPDATE advice SET message=:message, type=:type WHERE id=:id");
    $stmt->bindParam(':message', $advice);
    $stmt->bindParam(':type', $type);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
        $this->setNotification("Advice updated");

    $return =true;
    
}
return $return;
}

public function courseTeacherDelete($id) {
    $stmt = $this->conn->prepare("DELETE FROM class_teacher WHERE cid=:id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();    
}

public function setNotification($message) {
$return =false;
if($this->conn != null) {
$stmt = $this->conn->prepare("INSERT INTO notifications (message)
    VALUES (:message)");
    $stmt->bindParam(':message', $message);
    $stmt->execute();
    $return =true;
}
return $return;
}

public function joinClass($uid,$cid) {
$return =false;
if($this->conn != null) {
$this->deleteClass($uid,$cid);//first remove duplicates
$stmt = $this->conn->prepare("INSERT INTO class_student(sid,cid,status)
    VALUES (:uid,:cid,'Joined')");
    $stmt->bindParam(':uid', $uid);
    $stmt->bindParam(':cid', $cid);
    $stmt->execute();
    $return =true;
}
return $return;
}

public function deleteClass($uid,$cid){
    $stmt = $this->conn->prepare("DELETE FROM class_student WHERE sid=:sid AND cid=:cid");
    $stmt->bindParam(':sid', $uid);
    $stmt->bindParam(':cid', $cid);
    $stmt->execute();
    return $return;
}

public function ulandlord($name,$email,$phone,$password,$address,$id) {
$return =false;
if($this->conn != null) {
$stmt = $this->conn->prepare("UPDATE landlord SET name=:name,phone =:phone, email=:email,password=:password,address =:address WHERE id= :id");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
    $return =true;
}
return $return;
}

public function login($phone,$idnumber){
    $return=null;
    $stmt = $this->conn->prepare("SELECT * FROM applicant WHERE phone=:phone AND id_number=:id_number");
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':id_number', $idnumber);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    $return = $stmt->fetchAll();	
    //$this->setNotification("{$phone} logged in");
    return $return; 
}

public function getCountries(){
    $return=null;
    $stmt = $this->conn->prepare("SELECT * FROM country GROUP BY name");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    $return = $stmt->fetchAll();	
    return $return; 
}

public function getContacts($phone){
	 //$this->deleteContacts($phone);
    $return=null;
    $stmt = $this->conn->prepare("SELECT * FROM contacts WHERE myphone=:phone");
    $stmt->bindParam(':phone', $phone);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    $return = $stmt->fetchAll();	
    return $return; 
}

public function deleteContacts($myphone) {
    $stmt = $this->conn->prepare("DELETE FROM user WHERE myphone='{$myphone}'");
    $stmt->execute();
    return $return;
}

public function getAllClients() {
    $stmt = $this->conn->prepare("SELECT * FROM user");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    $return = $stmt->fetchAll();
    return $return;
}



public function getAllStudents() {
    $stmt = $this->conn->prepare("SELECT * FROM student");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    $return = $stmt->fetchAll();
    return $return;
}

public function getAllCourses() {
    $stmt = $this->conn->prepare("SELECT * FROM class");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    $return = $stmt->fetchAll();
    return $return;
}

public function getAllMedia() {
    $stmt = $this->conn->prepare("SELECT media.*,class.* FROM class,media WHERE class.id=media.cid");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    $return = $stmt->fetchAll();
    return $return;
}
public function getUser($id){
 $stmt = $this->conn->prepare("SELECT * FROM student WHERE email='$id' OR phone='$id'");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    $return = $stmt->fetchAll();
    return $return;
}

public function getAllStudentsInCourse($id) {
    $stmt = $this->conn->prepare("SELECT student.*,class.*,class_student.* FROM class,class_student,student WHERE class.id=class_student.cid AND class_student.sid=student.id AND class.id=:id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    $return = $stmt->fetchAll();
    return $return;
}

public function getCourse($id) {
    $stmt = $this->conn->prepare("SELECT * FROM class WHERE id=:id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    $return = $stmt->fetchAll();
    return $return;
}

public function getAllTeachers() {
    $stmt = $this->conn->prepare("SELECT * FROM teacher");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    $return = $stmt->fetchAll();
    return $return;
}

public function getAllDrugs() {
    $stmt = $this->conn->prepare("SELECT * FROM medication");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    $return = $stmt->fetchAll();
    return $return;
}

public function drug($name,$description,$interaction){
$return =false;
if($this->conn != null) {
$stmt = $this->conn->prepare("INSERT INTO medication (name,description, interaction)
    VALUES (:name, :description, :interaction)");
$password=sha1($phone);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':interaction', $interaction);
    $this->setNotification("New drug was added.");
    $stmt->execute();
    $return =true;
}
return $return;
}

public function schedule($uid,$sid,$time,$drug){
$return =false;
if($this->conn != null) {
$stmt = $this->conn->prepare("INSERT INTO schedule (uid,did,_time,sid)
    VALUES (:uid, :drug, :time,:sid)");
$password=sha1($phone);
    $stmt->bindParam(':uid', $uid);
    $stmt->bindParam(':sid', $sid);
    $stmt->bindParam(':time', $time);
    $stmt->bindParam(':drug', $drug);
    $this->setNotification("New schedule was added.");
    $stmt->execute();
    $return =true;
}
return $return;
}

public function getUserSchedule($phone){
	$type="None";
    $stmt = $this->conn->prepare("
    SELECT 
    medication.*,schedule.*,user.*,medication.name AS mname 
    FROM 
    schedule,user,medication 
    WHERE 
    schedule.uid=user.id 
    AND 
    user.phone=:phone
    AND
    medication.id=schedule.did
    ");
    $stmt->bindParam(':phone', $phone);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    $return = $stmt->fetchAll();
    return $return;
}


public function getUserDisease($id){
	$type="None";
    $stmt = $this->conn->prepare("SELECT * FROM user_disease WHERE uid=:uid");
    $stmt->bindParam(':uid', $id);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    $return = $stmt->fetchAll();
    if(count($return) > 0) {
    	$type=$return[0]['type'];
    	}
    return $type;
}

public function getAllAdvice() {
    $stmt = $this->conn->prepare("SELECT * FROM advice");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    $return = $stmt->fetchAll();
    return $return;
}

public function getSystem() {
    $stmt = $this->conn->prepare("SELECT * FROM system");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    $return = $stmt->fetchAll();
    return $return;
}

/*public function getAllStudents() {
    $stmt = $this->conn->prepare("SELECT * FROM student");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    $return = $stmt->fetchAll();
    return $return;
}*/

public function getAllLandlords() {
    $stmt = $this->conn->prepare("SELECT * FROM landlord");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    $return = $stmt->fetchAll();
    return $return;
}

public function getAllAdmins() {
    $stmt = $this->conn->prepare("SELECT * FROM admin");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    $return = $stmt->fetchAll();
    return $return;
}

public function getNotifications() {
    $stmt = $this->conn->prepare("SELECT * FROM notifications ORDER BY id DESC LIMIT 6");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    $return = $stmt->fetchAll();
    return $return;
}

public function getLandlord($id) {
    $stmt = $this->conn->prepare("SELECT * FROM landlord WHERE id=:id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    $return = $stmt->fetchAll();
    return $return;
}

	

public function updateuser($name,$type,$phone,$password,$id) {
$stmt = $this->conn->prepare("UPDATE admin SET name=:name,password=:password,phone=:phone,type=:type WHERE id=:id");
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':type', $type);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':password', $password);
    $this->setNotification("{$name}'s profile updated.");
    $stmt->execute();
    return true;
}

public function registerClient($name,$phone,$password){
$return =false;
if($this->conn != null) {
	$type='a';
$stmt = $this->conn->prepare("INSERT INTO user (name,password,phone)
    VALUES (:name, :password, :phone)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':phone', $phone);
    $stmt->execute();
    $return =true;
}
return $return;
}


public function upatient($id,$name,$phone,$address,$diagnosis) {
$stmt = 
$this->conn->prepare(
"UPDATE user SET name=:name,phone=:phone,address=:address,diagnosis=:diagnosis,password=:password WHERE id=:id");
$password=sha1($phone);  
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':name', $name);
     $stmt->bindParam(':address', $address);
    $stmt->bindParam(':diagnosis', $diagnosis);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':password', $password);
    $this->setNotification("Client, {$name}, profile updated");
    $stmt->execute();
    return true;
}


public function usupervisor($id,$name,$phone) {
$stmt = 
$this->conn->prepare(
"UPDATE supervisor SET name=:name,phone=:phone,password=:password WHERE id=:id");
$password=sha1($phone);  
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':password', $password);
    $this->setNotification("{$name} details updated");
    $stmt->execute();
    return true;
}


public function udrug($id,$name,$description,$interaction) {
$stmt = 
$this->conn->prepare(
"UPDATE medication SET name=:name,description=:description,interaction=:interaction WHERE id=:id");
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':name', $name);
     $stmt->bindParam(':description', $description);
    $stmt->bindParam(':interaction', $interaction);
    $this->setNotification("{$name} details updated");
    $stmt->execute();
    return true;
}

public function deleteDrug($id) {
    $stmt = $this->conn->prepare("DELETE FROM medication WHERE id=:id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $this->setNotification("A drug was deleted");
    return $return;
}

public function deleteSupervisor($id) {
    $stmt = $this->conn->prepare("DELETE FROM supervisor WHERE id=:id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $this->setNotification("A supervisor was deleted");
    return $return;
}

public function deleteAdmin($id) {
    $stmt = $this->conn->prepare("DELETE FROM admin WHERE id=:id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $this->setNotification("An administrator Account was deleted");
    return $return;
}

public function deleteClient($id) {
    $stmt = $this->conn->prepare("DELETE FROM user WHERE id=:id");
    $stmt->bindParam(':id', $id);
    $return=$stmt->execute();
    $this->setNotification("Client account deleted");
    return $return;
}

public function updateSystem($name,$logo) {
    $stmt = $this->conn->prepare("UPDATE system SET name =:name, logo=:logo WHERE id=:id");
    $id=1;
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':logo', $logo);
    $stmt->execute();
    $this->setNotification("System profile updated");
    return $return;
}

public function getAdmin($id) {
    $stmt = $this->conn->prepare("SELECT * FROM admin WHERE email=:id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    $return = $stmt->fetchAll();
    return $return;
}

public function getUserMedia($id) {
	$str="SELECT 
	      student.*,class.name AS cname,media.*,media.created AS mcreated,class_student.*
	      FROM 
	      student,media,class,class_student
	      WHERE 
	      student.phone=:phone
	      AND 
	      student.id=class_student.sid
	      AND
	      media.cid=class.id";
    $stmt = $this->conn->prepare($str);
    $stmt->bindParam(':phone', $id);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    $return = $stmt->fetchAll();
    return $return;
}

public function getUserClasses($id) {
	$str="SELECT 
	      student.*,class.name AS cname,class.id AS cid,class_student.*,class_student.created AS ccreated
	      FROM 
	      student,class,class_student
	      WHERE 
	      student.phone=:phone
	      AND
	      class.id=class_student.cid  
	      AND
	      student.id=class_student.sid";
    $stmt = $this->conn->prepare($str);
    $stmt->bindParam(':phone', $id);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    $return = $stmt->fetchAll();
    return $return;
}

public function getClient($id) {
    $stmt = $this->conn->prepare("SELECT * FROM user WHERE id=:id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    $return = $stmt->fetchAll();
    return $return;
}

public function getSupervisor($id) {
    $stmt = $this->conn->prepare("SELECT * FROM supervisor WHERE id=:id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    $return = $stmt->fetchAll();
    return $return;
}

public function getDrug($id) {
    $stmt = $this->conn->prepare("SELECT * FROM medication WHERE id=:id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    $return = $stmt->fetchAll();
    return $return;
}



public function getAllRooms($uid){
	 $stmt = $this->conn->prepare("SELECT asset.*,landlord.name AS landlord FROM asset,landlord WHERE asset.user_id=landlord.id");	
     if($uid != "") {      
    $stmt = $this->conn->prepare("SELECT asset.*,landlord.name AS landlord FROM asset,landlord WHERE asset.user_id=landlord.id AND landlord.id= :uid");
    $stmt->bindParam(':uid', $uid);
    }	 
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    $return = $stmt->fetchAll();
    return $return;
}

public function ldelete($id) {
    $stmt = $this->conn->prepare("DELETE FROM landlord WHERE id=:id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
}

public function rdelete($id) {
    $stmt = $this->conn->prepare("DELETE FROM asset WHERE id=:id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
}

public function addAsset($landlord,$images,$price,$per,$description){
$return =false;
if($this->conn != null) {
	$status='a';
$stmt = $this->conn->prepare("INSERT INTO asset (user_id,images,description,status,price,per)
    VALUES (:user, :images, :description, :status,:price,:per)");
    $stmt->bindParam(':user', $landlord);
    $stmt->bindParam(':images', $images);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':price', $price);
     $stmt->bindParam(':per', $per);
    $stmt->bindParam(':description', $description);
    $stmt->execute();
    $return =true;
}
return $return;
}





public function uroom($landlord,$price,$per,$description,$id){
$return =false;
if($this->conn != null) {
$stmt = $this->conn->prepare("UPDATE asset SET user_id=:landlord,price =:price,per=:per,description=:description WHERE id= :id");
    $stmt->bindParam(':landlord', $landlord);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':per', $per);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':description', $description);
    $stmt->execute();
    $return =true;
}
return $return;
}

public function dateFormater($date){
$date = new DateTime($date);
return $date->format('F j, Y');
}

}
?>