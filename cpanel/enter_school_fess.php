<?php error_reporting(E_ALL);
ini_set("display_errors", 1);
  include_once"../function/include.php";  
  include_once"adminFunction.php";
 
 include_once"../function/headerTop.php";

 $conn =db();$msg ='';$msg1 ='';
if(isset($_POST["Continue"])){
    $student_no = cleansql($_POST['student_no']);
  

$sql = get_student_profile($student_no,$conn);

if(mysqli_num_rows($sql) == 0 ){ 
    $msg = "<p class='error'>Students Number does not exist. please check and enter the correct number.</p>";
}else{
    $student=mysqli_fetch_assoc($sql);  
    
}
}
// pay school fess code
if(isset($_POST["pay_school_fess"])){
    $schedule =$_POST['schedule'];
    $class_id =$_POST['class_id'];
    $student_no =$_POST['student_no'];
    $student_id =$_POST['student_id'];
    $term =$_POST['term'];
    $session =$_POST['session'];
    $amount =cleansql($_POST['amount']);
    $status =1; //  payment status confirm 1 0 still pending
    $py =1; // manual 1 while 2 is for online payment
    $date =$_POST['date'];
    $sql1 = get_school_fess_setup($schedule,$term,$session,$conn);
    $sql = get_student_profile($student_no,$conn);
    $student=mysqli_fetch_assoc($sql);  
if(mysqli_num_rows($sql1) == 0 ){ 
    $msg = "<p class='error'> Fess Setup is not available for the session , term and Class Seleted</p>";
}else{
   $pay= payschool($student_id,$student_no,$schedule,$class_id,$term,$session,$amount,$status,$py,$date,$conn); 
    
   if ($pay)  {
    $msg = "<p class='success'>Successful : fess payment successful</p>";  
    
  }
}
}
    top();
       linkToBoostrap();
       admincheck();
       navigation2();
       section2();
       ?>

       <div class="row bc">
       <?php  leftnavigation(); ?>
       	
       	<div class="col-sm-10">

        <div class="col-sm-12 whitecolor">
           <div class="col-sm-12 headbanner" style="margin-bottom:15px;">Enter  Fess<a href="view_school_fess_setup.php" class="btn btn-danger btn-sm navbar-right">View  Fess Setup</a></div>
           <?php if(!empty($msg)){ echo $msg;}?>


                     <form class="form-horizontal" method="post" action="enter_school_fess.php">
                     <div class="form-group"> <label class="col-sm-3 control-label"> Student Number</label>
            <div class="col-sm-6">
            <input type="text" name="student_no" class="form-control" value="" placeholder="Enter Student Number" required/>
            </div>
     </div>
     <div class="form-group">
     <div class="col-sm-6 col-sm-offset-3">
              <input type="submit" name="Continue" class="btn btn-primary" value="Continue">

          </div>
    </div>
     
      </form>
      
	
       	</div>
<?php
if(isset($student)){
    $r_sql =school_fess_history($student['student_id'],$student['student_no'],$conn);
    ?>
    <div class="col-sm-12 whitecolor">
   
    <div class="col-sm-5" style="border:2px solid #cec; padding:30px;">
   
    <form class="form-horizontal" method="post" action="enter_school_fess.php">
    <input type="hidden" name="student_no" class="form-control" value="<?php echo $student['student_no'];?>"/>
    <input type="hidden" name="student_id" class="form-control" value="<?php echo $student['student_id'];?>"/>
    <div class=" form-group">
  
     
    <select class='form-control' name="schedule" required>

                        <option value="">-----  Select  Schedules   -------</option>";
                         
                         <?php  $conn = db(); $ac = mysqli_query($conn, 'SELECT * FROM fess_schedules');
                          while( $l=mysqli_fetch_assoc($ac) ) {
                                    
                        ?>
                            <option value="<?php echo $l['id']; ?>"><?php echo $l['name'];?></option>
                            
                      <?php } ?>

                  </select>
             
              </div>      
          
    <div class="form-group"> 
    <select class="form-control" name="term" required>
    <option value=""> Select Academic Term</option>
    <option value="First Term">First Term</option>
    <option value="Second Term">Second Term</option>
    <option value="Third Term">Third Term</option>
    </select>
   </div>
   <div class=" form-group">
<select class='form-control' name="class_id" required>
<option value="">-----  Select  class   -------</option>";
<?php  
$conn = db(); $ac = mysqli_query($conn, 'SELECT * FROM class');
while( $l=mysqli_fetch_assoc($ac) ) {
?>
<option value="<?php echo $l['class_id']; ?>"><?php echo $l['class_name'];?></option>
<?php } ?>
</select>
</div>
<div class="form-group">
<select class="form-control" name="session" required>
<option value=""> Select Academic Session</option>
<?php
for ($year = (date('Y')); $year >= 2012; $year--) {
$yearnext =$year+1;
echo "<option value=\"$year\">$year/$yearnext</option>\n";
 }
?> 
</select>
</div>
<div class="form-group"> 
<input type="number" name="amount" class="form-control" placeholder="Enter Amount" required/>
</div>
<div class="form-group"> 
<input type="date" name="date" class="form-control" required/>
</div>
<div class="form-group">
<input type="submit" name="pay_school_fess" class="btn btn-danger btn-block" value="Click To Pay School Fess">
 </div>

</div>
    <?php
    echo'<div class="col-sm-7">
    <table class="table table-bordered table-striped">
    <tr>
    <td>Name</td>
    <td>'.$student['surname'].' '.$student['firstname'].''.$student['othername'].'</td>
    </tr/>
    <tr>
    <td>Student Reg Number</td>
    <td>'.$student['student_no'].'</td>
    </tr/>';

    echo'</table>
    <table class="table table-bordered table-striped">
    <tr>
    <td colspan="6">School Fess History</td></tr>
    <tr>
    <th>Session</th>
    <th>Schedule</th>
    <th>Class</th>
    <th>Term</th>
    <th>Amount</th>
    <th>Action</th>
    </tr>';

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
   

    echo'</table>
    
    
    </div>';

    echo'</div>';
}
?>
    

       </div>
     </div>

<?php
       footer2();
       ?>

       