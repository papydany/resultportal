<?php error_reporting(E_ALL);
ini_set("display_errors", 1);
include_once"../function/include.php";  
include_once"adminFunction.php";
include_once"../function/headerTop.php";
include_once"../teacher/teacherfunction.php";
admincheck();

$s = $_GET['session'];
$c =$_GET['class_id'];
$sc =$_GET['subclass'];
$term=$_GET['term'];
$sn =select_student_profile($c,$sc,$s);

top();
linkToBoostrap();
navigation2();
section2();
?>

<div class="row bc">
<?php  leftnavigation(); ?>
<div class="col-sm-10">
<div class="col-sm-12 whitecolor">
<div class="col-sm-12 headbanner" style="margin-bottom:15px;">View Individual Report Sheet </div>
<table class="table table-bordered table-striped"> 
<tr>
<th>Names</th>
<th>Class Reg</th>
<th>Action</th>
<th></th>
</tr>
<?php

foreach ($sn as $k => $v) {
$reg = get_reg_id($v['student_id'],$sc,$c,$term,$s);
if($reg){
$parameter ="student_no=".$v['student_no']."&class_id=".$c."&class_category_id=".
$sc."&class_option_id=".$v['class_option_id']."&student_id=".$v['student_id'].
"&gender=".$v['gender']."&name=".$v['surname'].'&nbsp;'.$v['firstname'].'&nbsp;'.$v['othername']."&term=".
$term."&session=".$s;
echo"<tr>
<td>".$v['surname'].'  '.$v['firstname'].'  '.$v['othername']."</td>
<td>".$v['student_no']."</td>
<td><a href='individual_report_reg_id.php?".$parameter."' class='btn btn-primary'>view Result</a></td>
<td></td>
</tr>";
}
}
?>
</table>
</div>
</div>
</div>
<?php
footer2();
?>

      