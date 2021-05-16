<?php include_once("cpanel/adminFunction.php") ;
include_once("function/include.php");
 studentcheck();
 include_once("function/headerTop.php"); 
top();

 navigation();
 section1();
 $conn =db();
 ?>
<div class="col-sm-12 nopaddling">
	<div class="col-sm-10 col-sm-offset-1 std_main">

		<div class="col-sm-3">

		<?php 
        $std_id =$_SESSION['S_ID'];
        $c =$_SESSION['S_class_id'];

        $sc =$_SESSION['S_subclass'];
        $no=$_SESSION['S_student_no'];
    $r_sql =school_fess_history($std_id,$no,$conn);
   $f =select_class($c);
   $subClass = select_subclass($sc);
   
   
   if(isset($subClass['class_category_id']) == 1){
    $sub = " ";
   }else{
    $sub = $subClass['class_category_name'];
   }

       echo "<p><b> Welcome : ".ucwords($_SESSION['S_fullname'])."</b></p>";
		echo "<p><b>Class : ". $f['class_name']. ' ' .$sub."</b></p>";
       echo "<p><b>Reg Num : ". $no."</b></p>";

		

		?>
      </div>

<div class="col-sm-9">
	<div class="col-sm-12 spanheader">
	<span class="">PAYMENT HISTORY</span>
</div>

    <table class="table table-bordered table-striped">
    <tr>
    <td colspan="6">PAYMENT HISTORY</td>
    </tr>
    <tr>
    <th>Session</th>
    <th>Schedule</th>
    <th>Class</th>
    <th>Term</th>
    <th>Amount</th>
    <th>Action</th>
    </tr>
<?php
    while($fess = mysqli_fetch_assoc($r_sql))
    {
        
        $next = $fess['session'] + 1;
        $cl = select_class($fess['class_id']);
        $s_s = select_schedule($fess['fess_schedules_id']);
        $url ='fess_schedules_id='.$fess['fess_schedules_id'].'&class_id='.$fess['class_id'].'&student_no='.$fess['student_no'].'&student_id='.
        $fess['student_id'].'&term='.$fess['term'].'&session='.$fess['session'];
        echo'<tr>
        <td>'.$fess['session'].' / '.$next.'</td>
        <td>'.$s_s['name'].'</td>
        <td>'.$cl['class_name'].'</td>
        <td>'.$fess['term'].'</td>
        <td>&#8358; '.number_format($fess['sumfess']).'</td>
        <td><a href="print_school_fess.php?'.$url.'" class="btn btn-xs btn-primary" target="_blank">Print</a></td>
       
        </tr/>';
    }
   ?>

    </table>
    


</div>


	</div>

</div>
 

 <?php
footer();
?>


