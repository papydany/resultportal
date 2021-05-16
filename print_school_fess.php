<?php  set_time_limit(0);
 include_once("cpanel/adminFunction.php") ;
 include_once("function/include.php");
  studentcheck();
  include_once("function/headerTop.php"); 

top();
linkToBoostrap();
echo'<div class="container" style="padding-top:20px;border:2px solid #cec;">';      
top2();
$conn=db();
$schedule =$_GET['fess_schedules_id'];
$class_id =$_GET['class_id'];
$student_no =$_GET['student_no'];
$student_id =$_GET['student_id'];
$term =$_GET['term'];
$session =$_GET['session'];
// get class name
$cl = select_class($class_id);
// students profile
$student =get_student_profile($student_no,$conn);
if(mysqli_num_rows($student) != 0 ){ 
  $student=mysqli_fetch_assoc($student);
}
// school setup
$school_setup =get_school_fess_setup($schedule,$term,$session,$conn);
if(mysqli_num_rows($school_setup) != 0 ){ 
  $school_setup=mysqli_fetch_assoc($school_setup);
}
// school fess pain per term
$sql =get_school_fess_($schedule,$class_id,$student_id,$student_no,$term,$session,$conn); 
?>
<div class="row">
<div class="col-sm-12">
<h4 style="text-align:center;padding-top:20px;padding-bottom:20px;"><b>Receipt Of School Fess Payment</b></h4>
</div>
<div class="col-xs-4">
<p><b>NAME :</b> 
<?php echo $student['surname'].' '.$student['firstname'].''.$student['othername']; ?></p>
</div>
<div class="col-xs-3">
<p><b>Reg Number :</b><?php echo $student_no;?></p>
</div>
<div class="col-xs-2">
<p><b>Class :</b><?php echo $cl['class_name'];?></p>
</div>
<div class="col-xs-3">
<p><b>Term  :</b><?php echo $term ;?> </p>
</div>
<div class="col-xs-6" style="padding:30px;">
<?php
$total ='';
       if(mysqli_num_rows($sql) != 0 ){
       echo'<table class="table table-bordered table-striped">
       <tr>
        <th>Amount</th>
        <th>Date paid</th>
        </tr>';       
        while($fess = mysqli_fetch_assoc($sql))
    {
      $total +=$fess['fess'];
 echo'<tr>
  <td>&#8358;'.number_format($fess['fess']).'</td>
  <td>'.$fess['date_paid'].'</td>
  </tr>';
  }
  echo'</table>';
}
$balance =$school_setup['all_payment'] - $total;
echo'</div>
<div class="col-xs-6" style="padding:30px;">
<table class="table table-bordered table-striped">
<tr>
<th>Balance</th>
<th>&#8358; '.number_format($balance).'</th>
</tr>
</table> 
</div>
</div>
</div>';
?>