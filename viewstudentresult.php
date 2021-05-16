<?php  include_once"function/include.php";  
       include_once"teacher/teacherfunction.php"; 
       include_once"function/headerTop.php"; 
       if(!isset($_SESSION['studentlogin'])){
        header("location:../result/index.php");
      }
      $conn =db();
      top();
       ?>
<style type="text/css">
  



.table{
  margin-bottom: 5px !important;
}
.table > tbody > tr > td{
  padding: 4px 3px;
}
th,td {
    text-align: center;
}
.tail{
  border: 1px solid #000 !important;
  margin:5px 0px;
  padding:5px;
}
.pad{
  padding:0px 15px !important;
}
.container{margin: 0px auto;}
@media print{
 
  body{
    font-size: 11px;
  }
  p{font-size: 11px;}
  .table-bordered > tbody > tr > td {
    border: 1px solid #000 !important;
  }

  .tail{
  border: 2px solid #000 !important;
  border-right: 2px solid #000 !important;
  border-left: 2px solid #000 !important;
  
}
.table{
  margin-bottom: 5px !important;
}
.pad{
  padding:0px 15px !important;
}
}
.c{
  background-color: #ccc;
}
</style>
       <?php
set_time_limit(0);
$sex = $_SESSION['gender'];
$name = $_SESSION['S_fullname'] ;
$option = $_SESSION['S_class_option'] ;
$std_id =$_SESSION['S_ID'];
$c =$_GET['class'];
$sc =$_GET['subclass'];
$no=$_SESSION['S_student_no'];
$term=$_GET['t'];
$s=$_GET['year'];
$splus = $s + 1;


if(!$_SESSION['superadmin']){
  // check if result is publish
$query = "SELECT * from  publish_result   WHERE term ='$term' && class_id='$c' && `session` ='$s'";
$sql = mysqli_query( $conn, $query) or die(mysqli_error($conn));
if(mysqli_num_rows($sql) == 0){ 
  echo"<div class='col-sm-8 col-sm-offset-4' style='padding-top:30px;'>
  <p class='text-centered'>your result has not be registered. contact your school adminstrator</p></div>";
  exit();
}
$p =mysqli_fetch_assoc($sql);


if($p['status'] == 3 || $p['status'] == 2)
{
  $setup ="SELECT * from fess_setup WHERE term ='$term' && fess_schedules_id=1 && `sessional` ='$s'";
$sql = mysqli_query( $conn,$setup) or die(mysqli_error($conn));
if(mysqli_num_rows($sql) == 0){ 

$all_payment =0;
}else{
$all_p =mysqli_fetch_assoc($sql);
$all_payment =$all_p['all_payment'];
}


  // check school fess
$q ="SELECT sum(fess) as f from fees WHERE term ='$term' && fess_schedules_id=1 && class_id='$c' && `session` ='$s' && student_id='$std_id' && student_no ='$no' && status=1";
$sql = mysqli_query( $conn,$q) or die(mysqli_error($conn));

if(mysqli_num_rows($sql) == 0){ 
  echo"<div class='col-sm-8 col-sm-offset-4' style='padding-top:30px;'>
  <p class='text-centered'>you have not pay your school fess for these term.</p></div>";
  exit();
}
$pp =mysqli_fetch_assoc($sql);

if($p['status'] == 3)
{
  
if($pp['f'] < $all_payment){ 
  echo"<p class='text-centered'>Full payment of School fess is required for you to be able to view report sheet. Thank you.</p></div>";
  exit();}
}
}

}

$sb1 =getsubject($c,$sc,$s,$term);
$subject_num = count($sb1);
$sb = getdtudentsubject($std_id,$c,$sc,$term,$s);
if(!$sb){  

echo"<p>No records for the information provided was found.make sure the correct information is provided</p>";
exit();
}
$sb_num = count($sb);
  
  if(empty($sb_num)){
 	$sb_num =1;
 	$sb = array('');
 }
 


 if($term =='First Term'){
  $R_term ='Second Term';
   $resumption = select_resumption($s,$R_term);

 }
 elseif($term =='Second Term'){
 $R_term ='Third Term';
   $resumption = select_resumption($s,$R_term);

 }
 elseif($term =='Third Term'){
  $R_term ='First Term';
   $resumption = select_resumption($s,$R_term);

 }
 foreach ($sb as $ksb => $vsb) {
$sb_id[] = $vsb['subject_id'];
}

 
$reg = get_reg_id($std_id,$sc,$c,$term,$s); // get reg id

if(!$reg){
  echo"<p>No records for the information provided was found.make sure the correct information is provided</p>";
exit();
}

$open =get_open_attendance($term,$s);


$attendance ="attendance";
$attendance1 =get_all_input($attendance,$std_id,$no,$c,$sc,$reg['reg_id'],$term,$s);

$absent_illness ="absent_illness";
$absent_illness1 =get_all_input($absent_illness,$std_id,$no,$c,$sc,$reg['reg_id'],$term,$s);

$comment ="comment";
$comment1 =get_all_input($comment,$std_id,$no,$c,$sc,$reg['reg_id'],$term,$s);

$w_h ="w_h";
$w_h1 =get_all_input($w_h,$std_id,$no,$c,$sc,$reg['reg_id'],$term,$s);

$principal_comment ="principal_comment";
$principal_comment =get_all_input($principal_comment,$std_id,$no,$c,$sc,$reg['reg_id'],$term,$s);


$rs = select_result_display($std_id,$c,$sc,$reg['reg_id'],$sb_id,$term,$s); // get result

$gt = GrandTotal($std_id,$sc,$c,$reg['reg_id'],$s,$term);  //return sum of total marks per term
$avg =getAverage($std_id,$sc,$c,$reg['reg_id'],$s,$term); // return avarage of students

$reg1 = get_reg_id($std_id,$sc,$c,'First Term',$s); // get reg id for first term

$reg2 = get_reg_id($std_id,$sc,$c,'Second Term',$s); // get reg id for first term

$per1 = select_result_display($std_id,$c,$sc,$reg1['reg_id'],$sb_id,'First Term',$s); // get percentage for first

$per2 = select_result_display($std_id,$c,$sc,$reg2['reg_id'],$sb_id,'Second Term',$s); // get percentage for first
$sub_num = select_sub_number($std_id,$c,$sc,$term,$s);
$e2 = get_subject_In_first_term($c,$sc,$s);
$e3 = get_subject_In_first_and_second_term($c,$sc,$s);
$e1 = get_subject_In_second_term($c,$sc,$s);

 $firsttermcheck = checkstudentterm($_SESSION['S_ID'],$c,$sc,$s,'First Term'); // chech if student is present for first term
 $secondtermcheck = checkstudentterm($_SESSION['S_ID'],$c,$sc,$s,'Second Term');  // chech if student is present for second term

 $position = position_first($c,$sc,$s,$term,$option);
 //var_dump($std_id);
$f_class =select_class($c); // function to get class
   $s_Class = select_subclass($sc); // function to get sub class
   if(isset($s_Class['class_catgory_id']) == 1){ // check if a sub class exixt
    $s_c = "";
   }else{
    $s_c = $s_Class['class_category_name'];
   }

        ?>
         
       <div class="container" style="padding-top:50px;padding-bottom:30px;
       border: 2px solid;padding-left: 0px;padding-right: 0px;position:relative;">
       <div class="col-xs-2"></div>
       <div class="col-sx-8">
      <img src="images/padgeb.png" class="img-responsive" style="text-align:center; margin:22%;opacity: 0.10"/>
      </div>
     
      <div style="position:absolute;top:0px;left:0px; width:100%;" >
      
        <div class="row">
        
           <div class="col-xs-3">
            <img src="images/padge.png" alt='' class="img-responsive"  />
            </div>
              <div class="col-xs-9">
                <p class="result1"><span>TDDC SCHOOLS & COLLEGE</span></p>
                <P>43/47 Gideon Street,Agbaye,Ije Ododo Island,Via Ijegun, Ikotun Lagos State </P>
                <p> Tel:08080882444, 08178664999, 08138853818</p>
                
              </div>
  </div>
  <div class="row" style="padding-top:10px;">
  <div class="col-xs-4" style="text-align:center;">
  <p class="result2"><span>MINISTRY OF EDUCATION</span></p>
  <p class="result2 text-centered">REPORT SHEET</p>        
            </div>
              <div class="col-xs-4">
              <p><b>NAME :</b> <?php echo $name; ?></p>
                <p><b>Class :</b><?php echo $f_class['class_name'];?></p>
                <p><b>Term  :</b><?php echo $term ;?> </p>
  </div>
  <div class="col-xs-4">
                <p><b>Session :</b><?php echo $s.'/'.$splus; ?> </p>
                <p><b>Sex :</b> <?php echo $sex; ?> </p>
                <p><b>Reg Number : </b><?php echo $no; ?></p>
              </div>
  </div>
  <div  class=""> <!-- water mark div begings -->
  <div>
  <div class="row">
  <div class="col-sm-12" style="padding-left: 0px;padding-right: 0px;">
       <table class="table table-bordered">
       <tr>
       <td></td>
       <td>School</td>
       <td>Sport</td>
       <td>Other Organized Activities</td>
       </tr>
       <tr>
       <td style="text-align: left;">No of time school open / Activited held</td>
       <td><?php echo isset($open['open']) ? $open['open'].' days': ''; ?></td>
       <td></td>
       <td></td>
       </tr>
       <tr>
       <td style="text-align: left;">No of times Present</td>
       <td><?php echo isset($attendance1['present']) ? $attendance1['present'].' days': ''; ?></td>
       <td></td>
       <td></td>
       </tr>
       <tr>
       <td style="text-align: left;">No of times Punctual</td>
       <td><?php echo isset($attendance1['punctual']) ? $attendance1['punctual'].' days': ''; ?></td>
       <td></td>
       <td></td>
       </tr>
       <tr>
       <td style="text-align: left;">No of times Absent</td>
       <td><?php echo isset($attendance1['absent']) ? $attendance1['absent'].' days': ''; ?></td>
       <td></td>
       <td></td>
       </tr>
       </table> 
       </div>    
      </div>
      <div class="row">
    

  <div class="col-sm-12" style="padding-left: 0px;padding-right: 0px;">
  <p class="result2" style="background: #F4A460;margin: 0px;padding: 7px;"><span>2 CONDUCT</span></p>
       <table class="table table-bordered">
       <tr>
       <td colspan="2">GREEN for Exemplary Conduct</td>
       <td colspan="2">RED for Bad Conduct</td>
       <td colspan="2">comment</td>
       
       </tr>
       <tr>
       <td>number</td>
       <td>Deed</td>
       <td colspan="2">Number</td>
       <td rowspan="2"><?php echo isset($comment1['comment']) ? $comment1['comment'] : ''; ?></td>
       
       </tr>
       <tr>
       <td>&nbsp;</td>
       <td></td>
       <td colspan="2"></td>
       
       
       </tr>
       <tr>
       <td>Cleaning Rate</td>
       <td>Good</td>
       <td>Fair</td>
       <td>Poor</td>
       <td>Remarks</td>
       </tr>
     
       </table> 
       </div>    
      </div>

      <div class="row">
  <div class="col-sm-12" style="padding-left: 0px;padding-right: 0px;">
  <p class="result2" style="background: #6B8E23;margin: 0px;padding: 7px;"><span>3 PHYSICAL DEVELOPMENT & HEALTH</span></p>
       <table class="table table-bordered">
       <tr>
       <td colspan="2">HEIGHT</td>
       <td colspan="2">WEIGHT</td>
       <td>No of day absent due to illness</td>
       <td>Nature of illness</td>
       </tr>
       <tr>
       <td>Beginning of term</td>
       <td>End of term</td>
       <td>Beginning of term</td>
       <td>End of term</td>
      <td rowspan="2"><?php echo isset($absent_illness1['absent']) ? $absent_illness1['absent'] : ''; ?></td>
       <td rowspan="2"><?php echo isset($absent_illness1['reason']) ? $absent_illness1['reason'] : ''; ?></td>
       
       </tr>
       <tr>
       <td><?php echo isset($w_h1['hb']) ? $w_h1['hb'] : ''; ?>M</td>
       <td><?php echo isset($w_h1['he']) ? $w_h1['he'] : ''; ?>M</td>
       <td><?php echo isset($w_h1['wb']) ? $w_h1['wb'] : ''; ?>Kg</td>
       <td><?php echo isset($w_h1['we']) ? $w_h1['we'] : ''; ?>Kg</td>
       
       </tr>
     
     
       </table> 
       </div>    
      </div>

     <div class="row" style=" margin-top:3px;">
      <div class="col-xs-12" style="padding-left: 0px;padding-right: 0px;">
      <p class="result2" style="background: #F4A460;margin: 0px;padding: 7px;"><span>4 PERFORMANCE IN SUBJECTS</span></p>
        <table class="table table-bordered">
        	<tr>
        		<td width='10%' ><p>Total Score = <?php echo $gt; ?></p>
            <p>Average = <?php echo $avg;?></p>
            <p><b>POSITION</b> =
            <?php 

           foreach ($position as $key => $value) {

            $postion_id =$value['student_id'];
            $class_position=$value['position'];
           // var_dump($class_position);
            if($std_id == $postion_id){
              $position_in_class =$class_position;
              if($c < 4){
             echo $position_in_class;
            
            if($position_in_class == '1'){
              echo "st";
            }elseif($position_in_class == '2'){
             # code...
            echo "nd";
           }elseif($position_in_class == '3'){
             # code...
            echo "rd";
           }else{
             # code...
            echo "th";
           }
         }}
         }
           ?>
            
            </p>
            </td>
        		<td width='5%'><p class="sub_rotate2">MaxMark</p></td>
        		<?php


$sub_total =(int)$sb_num;
 for ($i=0; $i < $sub_total ; $i++) { 
 	# code...
 
 echo"<td width='4%'> <p class='sub_rotate2'>",isset($sb[$i]['subject_name']) ? $sb[$i]['subject_name'] : '',"</p></td>";
}?>


        	</tr>
        	<tr>
        		<td>Cont. Assess</td>
        		<td>40</td>
        		<?php
        		for ($i=0; $i <$sub_total ; $i++) {
  
  echo"
  <td>",isset($rs[$i]['student_ca2']) ? str_replace(" ","",$rs[$i]['student_ca2']): '',"</td>";
}
?>
        	</tr>
        	<tr>
        		<td>Examination</td>
        		<td>60</td>
        		<?php
        		for ($i=0; $i <$sub_total ; $i++) {
  
  echo"
  <td>",isset($rs[$i]['student_exam']) ? $rs[$i]['student_exam'] : '',"</td>";
}
?>
        	</tr>

        	<tr class="t">
        		<td>Total</td>
        		<td>100</td>
        		<?php
for ($i=0; $i <$sub_total ; $i++) {
  $T = $rs[$i]['student_mark'];
  echo"
  <td><b>",isset($T) ? $rs[$i]['student_mark'] : '',"</b></td>";
}
?>
</tr>
<?php

        	
        
//=============================            if its third term          ============================



        	if($term =='Third Term'){

            if( $firsttermcheck == true && $secondtermcheck == true){ // if student is not present for first and second term

             } 
              elseif ($firsttermcheck == true && $secondtermcheck != true) {  //if student is not presnt for first term

        echo" <tr>
            <td>2nd Term</td>
            <td>100</td>";
                    
for ($i=0; $i <$sub_total ; $i++) {
  $Rt2 =round($per2[$i]['student_mark'],1);
  echo"
  <td>",!empty($Rt2) ? $Rt2 : '',"</td>";
}

echo"</tr>
<tr>
<td>3rd Term</td>
<td></td>";
                 
for ($i=0; $i <$sub_total ; $i++) {

  if(!in_array($rs[$i]['subject_id'], $e1)){
 $Rt3=$rs[$i]['student_mark'];

echo"<td>",!empty($Rt3) ?$Rt3 : '',"</td>";


  }else{
   $Rt3 = round($rs[$i]['student_mark'],1);
 
  
  echo"
  <td>",!empty($Rt3) ? $Rt3 : '',"</td>";
}
}

echo"</tr>";
}
elseif($firsttermcheck != true && $secondtermcheck == true){ // if student is not present for second term but was present for firstern and third term
echo"<tr>
<td>1st Term</td>
<td>100</td>";
                    
for ($i=0; $i <$sub_total ; $i++) {
  $Rt1 =round($per1[$i]['student_mark']);
  echo"
  <td>" ,isset($Rt1) ? round($per1[$i]['student_mark'],1)  : '', "</td>";
}

echo"</tr>
<tr>
<td>3rd Term</td>
<td></td>";
                    
for ($i=0; $i <$sub_total ; $i++) {
   $Rt3 = round($rs[$i]['student_mark'],1);
  
  echo"
  <td>",isset($Rt3) ? round($rs[$i]['student_mark'],1)  : '',"</td>";
}

echo"</tr>";
}
else{
echo"<tr>
<td>1st Term</td>
<td>100</td>";
        		        
for ($i=0; $i <$sub_total ; $i++) {
  $Rt1 =round($per1[$i]['student_mark']);
  echo"
  <td>" ,isset($Rt1) ? $Rt1  : '', "</td>";
}

echo"</tr>
<tr>
<td>2nd Term</td>
<td>100</td>";
        		        
for ($i=0; $i <$sub_total ; $i++) {
//if(in_array($rs[$i]['subject_id'], $e1)) {
  $Rt2 =round($per2[$i]['student_mark'],1);
/*}else{
  $Rt2 =round($per2[$i]['student_mark'] * 0.8,2);
}*/
  //var_dump($per2[$i]['subject_id']);
  echo"
  <td>",isset($Rt2) ?  $Rt2 : '',"</td>";
}

echo"
</tr>";
}
}
?>
<tr class='c'>
<?php
if($term =='Third Term'){
 echo'<td>Annual Scores</td>
  <td>100</td>';
if($firsttermcheck == true && $secondtermcheck ==true){
  $Totalaverage3 = 0;
  $thd = 0;
for ($i=0; $i <$sub_total ; $i++) {
 $rt3 = round($rs[$i]['student_mark'],1);
   $rrt = round($rt3,1);
  $Totalaverage3 += $rrt;
echo"
  <td><b>",!empty($rrt) ? $rrt : '',"</b></td>";
  }
}elseif($firsttermcheck == true && $secondtermcheck ==false){  //student not present for first term

 $Totalaverage3 = 0;
 //$thd = 0;
for ($i=0; $i <$sub_total ; $i++) {
if(!in_array($rs[$i]['subject_id'], $e1)){
$rt3 = $rs[$i]['student_mark'];
   $rrt =round($rt3,1);
}else{
   $rt2 =round($per2[$i]['student_mark'],1 );
   $rt3 = round($rs[$i]['student_mark'],1);
   $rrt =$rt2 + $rt3;
   $rrt = round($rrt/2,1);
 }
 $Totalaverage3 += $rrt;
echo"
  <td><b>",!empty($rrt) ? $rrt : '',"</b></td>";
}

}else{

$thd = 0;
 $Totalaverage3 = 0;
for ($i=0; $i <$sub_total ; $i++) {

if(!in_array($rs[$i]['subject_id'], $e2) && in_array($rs[$i]['subject_id'], $e1)){

 $rt2 =round($per2[$i]['student_mark'],1);
 $rt3 = round($rs[$i]['student_mark'],1);
$rrt =$rt2 + $rt3;
$rrt = round($rrt/2,1);


}
elseif(!in_array($rs[$i]['subject_id'], $e3)){
$rt3 = $rs[$i]['student_mark'];
   $rrt =round($rt3,1);
  
}else{



  $rt1 =round($per1[$i]['student_mark'],1);
   $rt2 =round($per2[$i]['student_mark'],1);
   $rt3 = round($rs[$i]['student_mark'],1);
   $rrt =$rt1 + $rt2 + $rt3;
   $rrt = round($rrt/3,1);
 }
   $Totalaverage3 += $rrt;



  echo"
  <td><b>",$rrt,"</b></td>";
}
}

} 

?>
</tr>
</table>
      </div>
    </div>
    <div class="row">
  <div class="col-sm-12" style="padding-left: 0px;padding-right: 0px;">
  <p class="result2" style="background: #6B8E23;margin: 0px;padding: 7px;"><span>5 SPORTS</span></p>
       <table class="table table-bordered">
       <tr>
       <td>Events</td>
       <td>Indoor Games</td>
       <td>Ball Games</td>
       <td>Combatives Games</td>
       <td>Tracks</td>
       <td>Jumps</td>
       <td>Throws</td>
       <td>Swimming</td>
       <td>Weight Lifting</td>
       </tr>

       <tr>
       <td>Level Attained</td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       </tr>
       </table> 
       </div>    
      </div>

      <div class="row">
  <div class="col-sm-12" style="padding-left: 0px;padding-right: 0px;">
  <p class="result2" style="background: #F4A460;margin: 0px;padding: 7px;"><span>6 CLUB YOUTH ORGANIZATION ETC</span></p>
       <table class="table table-bordered">
       <tr>
       <td>Organization</td>
    
       <td>Office Held</td>
       <td colspan="2">Significant Contribution</td>
       </tr>
       <tr>
       <td>&nbsp;</td>
       <td>&nbsp;</td>
       <td colspan="2">&nbsp;</td>
      </tr>
      
       </table> 
       </div>    
      </div>
      </div>
      </div><!-- water mark div ends -->
    <div class="row" >
    <div class="col-xs-12 tail" style="padding-left: 0px;padding-right: 0px;">
      
      <div class="col-xs-8">
          <p><b>Principal's Comments  :</b>
          <?php echo isset($principal_comment['comment']) ? $principal_comment['comment'] : ''; ?> </p>
            <p><b>RESUMPTION DATE : </b>&nbsp;&nbsp;<?php echo $resumption;?></p>
      </div>
      <div class="col-xs-4">
        <p>Principal`s Name <b>&nbsp;:&nbsp;Mrs. Tunde-Adetula Oshionela </b>
        <br/><img src="images/principal.png" class="img-responsive"/>
        <br/>Principal`s Signature</p>
  
      </div>
     

    </div>
  </div>
  </div>
  

