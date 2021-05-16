<?php set_time_limit(0);
include_once"../function/headerTop.php"; 
 include_once"../function/include.php";  
 include_once"../teacher/teacherfunction.php";
 top();
 linkh();
 $conn=db();?>
<style type="text/css">

.row{
  padding: 0px 5px !important;
}
.table > tbody > tr > th{
	padding: 0;
}
.table > tbody > tr > td{
	padding: 0;
}

.table-bordered > tbody > tr > td {
    border: 1px solid #000;
  }
th,td {
    
    font-size: 10px;
}
th,td{
	font-size: 10px;
  text-align: center;
}
p{font-size: 11px;}
.c{
  background-color: #ccc;

}
.tail{
  border: 1px solid #000 !important;
  margin-top:5px;
  padding: 10px 5px;
}

@media print{
p{font-size: 11px;}
td{
  font-size: 10px;
}
.tail{
  border: 1px solid #000 !important;
  margin:5px 0px;
  padding: 10px 5px;
}
.table-bordered > tbody > tr > td {
    border: 1px solid #000 !important;
  }
}
</style>



 <?php

 set_time_limit(0);

 $s = $_GET['ses'];

 $c =$_GET['class_id'];

 $sc =$_GET['subclass'];
 $term=$_GET['term'];
$splus = $s+1;
 
$c_n = select_class($c);
 $std_id =array();

 $sb_id = array();

 $position =array();
$sb = getsubject($c,$sc,$s,$term);
$sb_num = count($sb);
  
 if(empty($sb_num)){
 	$sb_num =1;
 	$sb = array('');

  echo"<div class='col-sm-10 col-sm-offset-1'><h3>Sorry no result for student in this session. </h3></div>";

 }else{

 foreach ($sb as $ksb => $vsb) {

$sb_id[] = $vsb['subject_id'];
 }
//var_dump($sb_id);

 ?>
  <!--<div  style="position:relative;">
     <div class="col-xs-2"></div>
       <div class="col-sx-8">
      <img src="../images/padgeb.png" class="img-responsive" style="text-align:center;margin:22%;opacity: 0.7"/>
      </div>
      <div style="position:absolute;top:0px;left:0px; width:100%;" >-->
<div class="row">
           <div class="col-xs-2 col-sm-2" style="text-align:center;">
            <img src="../images/padge.png" class="img-responsive" />
            </div>
              <div class="col-xs-7 col-sm-6 col-sm-offset-1 r" style="text-align:center;">
                <p class="result1"><span>TDDC SCHOOLS & COLLEGE</span></p>
                <P>43/47 Gideon Street,Agbaye,Ije Ododo Island,Via Ijegun, Ikotun Lagos State </P>
			<p> Tel:08080882444, 08178664999, 08138853818</p>
               
              </div>
              <div class="col-xs-3 col-sm-2 col-sm-offset-1">
                <p><b>Class :</b> <?php echo $c_n['class_name'];?></p>
                <p><b>Term  :</b> <?php echo $term ; ?> </p>
                <p><b>Session :</b> <?php echo $s.' / '.$splus; ?> </p>
                
              </div>
              <div class="col-xs-12 resultbg" style="text-align:center;">
                <p><b>
                <?php if( $c > 3){
                  echo "SENIOR SECONDARY SCHOOL BROAD SHEET";
                }else{
                     echo" JUNIOR SECONDARY SCHOOL BROAD SHEET";
                }
                ?>
                </b></p>

              </div>
            
             
        </div>

<div class="row">
 <table class='table table-bordered table-condensed table-responsive'>
 <tr>
 <td width="1%">S/N</td>
 <td width="7%" >Name</td>
 <td width="5%">Reg No</td>
 <?php
if($term=="Third Term")
{
  echo'<td width="2%">Term</td>';
}
?>
 <td width="3%"><p class='sub_rotate'>MAXIMUM OBTAINABLE</</td>
 
 
 
<?php
$sub_total =(int)$sb_num;
$width = 70/$sub_total;
$width =$width;
 for ($i=0; $i < $sub_total ; $i++) {

 	# code...
 
 echo"<td width='$width%'> <p class='sub_rotate'>",isset($sb[$i]['subject_name']) ? str_replace(" ","",$sb[$i]['subject_name']) : '',"</p></td>";
}
if($term=="Third Term")
{
  echo"<td width='3%'> <p class='sub_rotate'>TOTAL</p></td>";
  echo"<td width='3%'> <p class='sub_rotate'>AVERAGE</p></td>";
  echo"<td width='3%'> <p class='sub_rotate'>GRADE</p></td>";
}else{
 echo"<td width='4%'> <p class='sub_rotate'>TOTAL</p></td>";
 echo"<td width='4%'> <p class='sub_rotate'>AVERAGE</p></td>";
 echo"<td width='4%'> <p class='sub_rotate'>GRADE</p></td>";
}
 echo"<td width='3%'> <p class='sub_rotate'>POSITION</p></td>";

$no =0;
$sn =select_student_profile($c,$sc,$s);

$total_num_of_student = count($sn);

foreach ($sn as $k => $v) {
 
$reg1 = get_reg_id($v['student_id'],$sc,$c,'First Term',$s);
$reg2 = get_reg_id($v['student_id'],$sc,$c,'Second Term',$s);
$reg3 = get_reg_id($v['student_id'],$sc,$c,'Third Term',$s);

$rs = select_result_display($v['student_id'],$c,$sc,$reg1['reg_id'],$sb_id,'First Term',$s);
$rss = select_result_display($v['student_id'],$c,$sc,$reg2['reg_id'],$sb_id,'Second Term',$s);
$rsss = select_result_display($v['student_id'],$c,$sc,$reg3['reg_id'],$sb_id,'Third Term',$s);

$e2 = get_subject_In_first_term($c,$sc,$s);
$e3 = get_subject_In_first_and_second_term($c,$sc,$s);
$e1 = get_subject_In_second_term($c,$sc,$s);

$sub_num = select_sub_number($v['student_id'],$c,$sc,$term,$s);

 $firsttermcheck = checkstudentterm($v['student_id'],$c,$sc,$s,'First Term'); // chech if student is present for first term
 $secondtermcheck = checkstudentterm($v['student_id'],$c,$sc,$s,'Second Term');  // chech if student is present for second term




$fullname = $v['surname'].'  '.$v['firstname'].'  '.$v['othername'];
$reg_no =$v['student_no'];

if($term == "First Term"){  //first term result display
if($reg1){
  $no ++;
  $dd =$no;
echo"<tr>
<td  rowspan='4'>".$no."</td>
 <td rowspan='4' >".strtoupper($fullname)."</td>
 <td  rowspan='3'>".$reg_no."</td>
 <td>40</td>";

 $total =''; 
for ($i=0; $i < $sub_total; $i++) {
  
  echo"
  <td>",isset($rs[$i]['student_ca2']) ? $rs[$i]['student_ca2'] : '',"</td>";
  $total = select_sub_total($v['student_id'],$c,$sc,$sb_id,$term,$s);
 // $total += $rs[$i]['student_mark'];
}
$average =  round($total/$sub_num ,1);
 echo"
 <td  rowspan='4' style='padding-top:20;'>".$total."</td>
 <td  rowspan='4'>".$average ."</td>
 <td  rowspan='4'>";get_grade($average); echo"</td>
 <td  rowspan='4'>";
 final_position($c,$sc,$s,$term,$v['class_option_id'],$v['student_id']);
 
echo"</td>
<tr>
<td>60</td>";

for ($i=0; $i < $sub_total; $i++) {
  echo"<td>",isset($rs[$i]['student_exam']) ? $rs[$i]['student_exam'] : '',"</td>";
}

echo"</tr>
<tr style='color:#000;' class='resultbg'>
<td><b>100</b></td>";

for ($i=0; $i < $sub_total; $i++) {
  echo"<td><b>",isset($rs[$i]['student_mark']) ? $rs[$i]['student_mark'] : '',"</b></td>";
}
echo"<tr class='resultbg'>
<td colspan='2'>Subject position</td>";

for ($i=0; $i < $sub_total; $i++) {
  echo"<td>";
final_subject_position($c,$sc,$s,$rs[$i]['subject_id'],$term,$v['student_id']);
  echo"</td>";
} 
echo"</tr>";

}

}elseif ($term == "Second Term") {
if($reg2){
  $no ++;
  $dd =$no;
echo"<tr>
<td  rowspan='4'>".$no."</td>
 <td rowspan='4' >".strtoupper($fullname)."</td>
 <td  rowspan='3'>".$reg_no."</td>
 <td>40</td>";

 $total =''; 
for ($i=0; $i < $sub_total; $i++) {
  
  echo"
  <td>",isset($rss[$i]['student_ca2']) ? $rss[$i]['student_ca2'] : '',"</td>";
  $total = select_sub_total($v['student_id'],$c,$sc,$sb_id,$term,$s);
}
$average =  round($total/$sub_num ,1);
 echo"
 <td  rowspan='4' style='padding-top:20;'>".$total."</td>
 <td  rowspan='4'>".$average ."</td>
 <td  rowspan='4'>";get_grade($average); echo"</td>
 <td  rowspan='4'>";
 final_position($c,$sc,$s,$term,$v['class_option_id'],$v['student_id']);
 
echo"</td>
<tr>
<td>60</td>";

for ($i=0; $i < $sub_total; $i++) {
  echo"<td>",isset($rss[$i]['student_exam']) ? $rss[$i]['student_exam'] : '',"</td>";
}

echo"</tr>
<tr style='color:#000;' class='resultbg'>
<td><b>100</b></td>";

for ($i=0; $i < $sub_total; $i++) {
  echo"<td><b>",isset($rss[$i]['student_mark']) ? $rss[$i]['student_mark'] : '',"</b></td>";
}
echo"<tr class='resultbg'>
<td colspan='2'>Subject position</td>";

for ($i=0; $i < $sub_total; $i++) {
  echo"<td>";
final_subject_position($c,$sc,$s,$rss[$i]['subject_id'],$term,$v['student_id']);
  echo"</td>";
} 
echo"</tr>";
}
}

          

elseif ($term == "Third Term") {
if($reg3){
  $no ++;
  $dd =$no;
//$firstsubject = get_subject_student_took_per_term($c,$sc,$s,'First Term',$v['student_id']);

//$secondsubject = get_subject_student_took_per_term($c,$sc,$s,'Second Term',$v['student_id']);

//$thirdsubject = get_subject_student_took_per_term($c,$sc,$s,'Third Term',$v['student_id']);
echo"<tr>
<td  rowspan='6'>".$no."</td>
 <td rowspan='6' >".strtoupper($fullname)."</td>
 <td  rowspan='3'>".$reg_no."</td>
 <td>1ST</td>
 <td>100</td>";
 $average_total ='';
for ($i=0; $i < $sub_total; $i++) {
  
  echo"
 
  <td>",isset($rs[$i]['student_mark']) ? $rs[$i]['student_mark'] : '',"</td>";

  $t3 =isset($rsss[$i]['student_mark']) ? $rsss[$i]['student_mark'] : '';
  $t2 =isset($rss[$i]['student_mark']) ? $rss[$i]['student_mark'] : '';
  $t1 =isset($rs[$i]['student_mark']) ? $rs[$i]['student_mark'] : '';
  if($firsttermcheck == true && $secondtermcheck ==true){
    $avaerage =$t3;
   
  }
  elseif($firsttermcheck == true && $secondtermcheck ==false){
    if(!in_array($rsss[$i]['subject_id'], $e1)){
      $avaerage =$t3;
    }else{
      $avaerage =$t3 + $t2;  
      $avaerage =round($avaerage/2,1);
  }
   
  }
    else{
      if(!in_array($rsss[$i]['subject_id'], $e2) && in_array($rsss[$i]['subject_id'], $e1)){
        $avaerage =$t3 + $t2;  
        $avaerage =round($avaerage/2,1);
     
      }
      elseif(!in_array($rsss[$i]['subject_id'], $e3)){
        $avaerage =$t3;
      }else{
     
        $avaerage =$t3 + $t2 + $t1;  
        $avaerage =round($avaerage/3,1);
   }
  }
  $average_total += $avaerage;

}
$average_average =  round($average_total/$sub_num ,1);

 echo"
 <td  rowspan='6' style='padding-top:20;'>".$average_total."</td>
 <td  rowspan='6'>".$average_average."</td>
 <td  rowspan='6'>";get_grade($average_average);  echo"</td>
 <td  rowspan='6'>";
 final_position($c,$sc,$s,$term,$v['class_option_id'],$v['student_id']);
 
echo"</td>
<tr>
<td>2ND</td>
<td>100</td>";
for ($i=0; $i < $sub_total; $i++) {
echo"<td>",isset($rss[$i]['student_mark']) ? $rss[$i]['student_mark'] : '',"</td>";
}
echo"<tr>
<td>3RD</td>
<td>100</td>";
for ($i=0; $i < $sub_total; $i++) {
echo"<td>",isset($rsss[$i]['student_mark']) ? $rsss[$i]['student_mark'] : '',"</td>";
}

echo"<tr>
<td colspan='2'>CUMMULATIVE</td>
<td>300</td>";
$total ='';
for ($i=0; $i < $sub_total; $i++) {
 $t3 =isset($rsss[$i]['student_mark']) ? $rsss[$i]['student_mark'] : '';
 $t2 =isset($rss[$i]['student_mark']) ? $rss[$i]['student_mark'] : '';
 $t1 =isset($rs[$i]['student_mark']) ? $rs[$i]['student_mark'] : '';
 $total =$t3 + $t2 + $t1;
 if($total== 0)
 {
  $total ='';
 }
echo"<td>",$total,"</td>";
}
$avaerage ='';

echo"<tr>
<td colspan='2'>CUMMULATIVE Average</td>
<td>100</td>";
for ($i=0; $i < $sub_total; $i++) {
  $t3 =isset($rsss[$i]['student_mark']) ? $rsss[$i]['student_mark'] : '';
  $t2 =isset($rss[$i]['student_mark']) ? $rss[$i]['student_mark'] : '';
  $t1 =isset($rs[$i]['student_mark']) ? $rs[$i]['student_mark'] : '';
  if($firsttermcheck == true && $secondtermcheck ==true){
    $avaerage =$t3;
   }
  elseif($firsttermcheck == true && $secondtermcheck ==false){
    if(!in_array($rsss[$i]['subject_id'], $e1)){
      $avaerage =$t3;
    }else{
      $avaerage =$t3 + $t2;  
      $avaerage =round($avaerage/2,1);
  }
   
  }
    else{
      if(!in_array($rsss[$i]['subject_id'], $e2) && in_array($rsss[$i]['subject_id'], $e1)){
        $avaerage =$t3 + $t2;  
        $avaerage =round($avaerage/2,1);
     
      }
      elseif(!in_array($rsss[$i]['subject_id'], $e3)){
        $avaerage =$t3;
      }else{
     
        $avaerage =$t3 + $t2 + $t1;  
        $avaerage =round($avaerage/3,1);
   }
  }
 
echo"<td>",$avaerage,"</td>";
}

echo"<tr>
<td colspan='3'>Subject position</td>";
for ($i=0; $i < $sub_total; $i++) {
echo"<td>",final_subject_position($c,$sc,$s,$rsss[$i]['subject_id'],$term,$v['student_id']),"</td>";
}



echo"<tr><td>";



 echo"</td>";


  
    


echo"</td></tr>";


}
}
 



}

}

echo"</table>";
?>
</div>
<div class="row">
<div class="col-sm-12 tail">
<div class="col-sm-4">
  <p>Number Of Registered Students <b>&nbsp;: &nbsp; <?php echo $dd; ?></b></p>
  <p>Number Of Registered Subjects <b>&nbsp;: &nbsp; <?php echo $sb_num; ?></b></p>
</div>
<div class="col-sm-4">
  <p>Class Teacher`s Name <b>&nbsp;:&nbsp;</b>-------------------------------------</p>
  <p>Class Teacher`s Sign <b>&nbsp;:&nbsp;</b>-------------------------------------</p>
</div>
<div class="col-sm-3">
  <p>Principal`s Name <b>&nbsp;:&nbsp; Mrs. Tunde-Adetula Oshionela</b></p>
  <p><img src="../images/principal.png" class="img-responsive" with="50%"/></p>
  <p>Principal`s Sign</p>
</div>
</div>
</div>
<!--</div>
</div>-->
</body>
</html>

<?php

function final_position($c,$sc,$s,$term,$v,$student_id)
{
  $position = position_first($c,$sc,$s,$term,$v);

  foreach ($position as $key => $value) {

   $postion_id =$value['student_id'];
   $class_position=$value['position'];
   if($student_id == $postion_id){
     $position_in_class =$class_position;
     
    echo $position_in_class;
   
   if($position_in_class == '1'){
     echo "ST";
   }elseif($position_in_class == '2'){
    # code...
   echo "ND";
  }elseif($position_in_class == '3'){
    # code...
   echo "RD";
  }else{
    # code...
   echo "TH";
  }
}
}
}

function final_subject_position($c,$sc,$s,$rs,$term,$student_id)
{
  $u =subject_position($c,$sc,$s,$rs,$term);

 if(!empty($u)){
  foreach ($u as $key => $value) {
    # code...
    $p =isset($value['position'])? $value['position'] : '';
    $sub=isset($value['subject']) ? $value['subject'] :'';
    $id=isset($value['student_id']) ? $value['student_id']:'';
  
    if($student_id == $id){
      echo $p;

     if($p == '1'){
              echo "ST";
            }elseif($p == '2'){
             # code...
            echo "ND";
           }elseif($p == '3'){
             # code...
            echo "RD";
           }else{
             # code...
            echo "TH";
           }

   }
  }
 }
}

function get_grade($total)
{
  switch($total) {
   
              case $total < 40:
                echo 'F';
               break; 
               
           case $total >= 70:
           echo 'A';
               break;
           case $total >= 60:
           echo 'B';
               break;
           case $total >= 50:
         echo 'C';
               break;
           case $total >= 45:
            echo'D';
               break;
           case $total >= 40:
         Echo 'E';
               break;
           
           }
}

?>
