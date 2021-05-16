<?php  include_once"../function/include.php";  
       include_once"teacherfunction.php";

lodgincheck();
include_once"../function/headerTop.php"; 
       top();
       linkh();
       navigation2();
       section2();


       ?>

   <div class="row bc">
       <?php  leftnav(); ?>
<div class="col-sm-10 nopaddling">

<div class="col-sm-12" style="padding-top:15px;">
<?php teacherBanner(); ?>
  <div class="col-sm-12 formBg bottom_margin">
      
            <div class="col-sm-12 teachheader">
              View Registered  Students
            
      </div>

           
</div>
            

            <?php
           
echo'<div class="col-sm-12 nopaddling formBg" style="padding:10px;">';


$open = select_open_attendance_all();


if(count($open) == 0){

 echo $msg = "<p class='exist'> No records for Open class Attendance </p>";

}else{
$s = 0;

echo"<table class='table  table-bordered'>
<tr class='success'>
<th>S/n</th>
<th>Term</th>
<th>Session</th>
<th>Open Attendance</th>

<th colspan='2'>Action</th>
</tr>";
foreach ($open as $key => $value) {
$s++;
if(($s % 2)== 0){
  echo"<tr class='warning'>";

}else{
echo"<tr class='danger'>";
}
echo"<td>".$s."</td>
<td>".$value['term']."</td>
<td>".$value['year']."</td>
<td>".$value['open']."</td>
<td>".$value['student_no']."</td>
<td>".'<a href="delete.php?open='.$value['id'].'" class="btn btn-danger btn-xs">Delete </a>&nbsp;&nbsp;
<a href="edit_open_attendance.php?open='.$value['id'].'" class="btn btn-success btn-xs">Edit</a></td>
</tr>';
  # code...
}
echo"</table>";


}
echo'</div>';
?>
      
    </div>

</div>
       	</div>

       </div>

<?php footer2(); ?>
