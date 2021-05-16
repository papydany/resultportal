<?php
function linkToBoostrap(){
?>
<link rel="stylesheet" type="text/css" href="../css/bootstrap.css"/>
<link href="../css/main.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="admincss.css">
<script src="../script/jquery1.js" type="text/javascript"></script>
<script src="../script/bootstrap.min.js" type="text/javascript"></script>
<script src="../script/jquery.js" type="text/javascript"></script>

<link rel="stylesheet" type="text/css" href="../script/jquery-ui-1.11.2.custom/jquery-ui.min.css">

<script type="text/javascript" src="../script/jquery-ui-1.11.2.custom/external/jquery/jquery.js"></script>
<script type="text/javascript" src="../script/jquery-ui-1.11.2.custom/jquery-ui.min.js"></script>
<script type="text/javascript">
$(function(){
$( "#datepicker" ).datepicker();
});
       </script>
<script src="../script/respond.js"></script>
<?php


}

function leftnavigation(){
	?>
	<div class="col-sm-2 addpadding addcolorleftnav">
         <ul class="list-group">
      
            <li class="list-group-item"><a href="index.php">Manage Result</a></li>
            <li class="list-group-item"><a href="publish_result.php">Manage Publish Result</a></li>
            <li class="list-group-item"><a href="manage_fess_schedule.php">Manage fess Schedule</a></li>
            <li class="list-group-item"><a href="school_fess_setup.php">fess Setup</a></li>
            <li class="list-group-item"><a href="enter_school_fess.php">Manage School fess </a></li>
            
            <li  class="list-group-item"><a href="ViewTeacher.php">Manage Teacher</a></li>
            <li  class="list-group-item"><a href="classTeacher.php"> Reasign Class Teacher</a></li>
            <li class="list-group-item"><a href="addclasscategory.php"> Manage Class</a></li>
            <li class="list-group-item"><a href="subject.php">Manage Subject</a></li>
          
             <li class="list-group-item"><a href="student.php">Manage Student</a></li>
            <li class="list-group-item"><a href="pinmanagement.php">Pin Management</a></li>
              <li class="list-group-item"><a href="resumptionDate.php">Set Resumption Date</a></li>
            <li class="list-group-item"><a href="Changepassword.php">Change Password</a></li>
            <li class="list-group-item"><a href="promotion.php">Promote Students</a></li>
            <li class="list-group-item"><a href="logout.php">Logout</a></li>


       	</div>
       	<?php
}

function admincheck(){
if(!isset($_SESSION['superadmin'])){
header('location:../cpanel/login.php');
     exit();
}
}

function school_fess_history($id,$reg,$conn)
{
     $query = "SELECT SUM(fess) AS sumfess, class_id,term,session, student_id,student_no,fess_schedules_id, fess from  fees  WHERE student_no ='$reg' and student_id ='$id' GROUP BY fess_schedules_id, class_id,term,session";
     $sql = mysqli_query($conn, $query) or die(mysqli_error($conn));
     return $sql;
    
}


function get_school_fess_($schedules,$class_id,$student_id,$student_no,$term,$session,$conn)
{
     $query = "SELECT *  from  fees  WHERE fess_schedules_id='$schedules' and class_id='$class_id' and student_id='$student_id' and
      student_no ='$student_no' and term ='$term' and session='$session'";
     $sql = mysqli_query($conn, $query) or die(mysqli_error($conn));
     return $sql;
}

function get_student_profile($student_no,$conn)
{
     $query = "SELECT * from  student_profile  WHERE student_no ='$student_no'";
     $sql = mysqli_query($conn, $query) or die(mysqli_error($conn)); 

     return $sql;
}

function get_school_fess_setup($schedule,$term,$session,$conn)
{
     $query = "SELECT * from  fess_setup  WHERE term = '$term' && fess_schedules_id = '$schedule' && sessional ='$session'";
$sql = mysqli_query( $conn, $query) or die(mysqli_error($conn));

     return $sql;
}

function get_fess_schedule($name,$conn)
{
     $query = "SELECT * from  fess_schedules  WHERE  name= '$name'";
$sql = mysqli_query( $conn, $query) or die(mysqli_error($conn));

     return $sql;
}

function get_all_fess_schedule($conn)
{
     $query = "SELECT * from  fess_schedules order by 'name'";
$sql = mysqli_query( $conn, $query) or die(mysqli_error($conn));


     return $sql;
}
function payschool($student_id,$student_no,$schedule,$class_id,$term,$session,$amount,$status,$py,$date,$conn)
{
$query ="INSERT INTO fees 
(`student_id`,`student_no`,`fess_schedules_id`,`class_id`,`term`,`session`,`fess`,`status`,`payment_type`,`date_paid`)
 VALUES('$student_id','$student_no','$schedule','$class_id','$term','$session','$amount','$status','$py','$date')";
  
      $query = mysqli_query( $conn, $query) or die(mysqli_error($conn));
      return $query;
}

function check_publish_result($class_id,$term,$session,$conn)
{
     $query = "SELECT * from  publish_result   WHERE term ='$term' && class_id='$class_id' && `session` ='$session'";
$sql = mysqli_query( $conn, $query) or die(mysqli_error($conn));
return $sql;
}
?>