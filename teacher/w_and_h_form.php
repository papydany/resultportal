<?php  include_once"../function/include.php";  
       include_once"teacherfunction.php";

lodgincheck();
include_once"../function/headerTop.php"; 
       top();
       linkh();
       navigation2(); 
         section2();
       ?>
<style type="text/css">
.table > tbody > tr > td{
  padding: 4px;
}
</style>
       <div class="row bc">
       <?php  leftnav(); ?>
       	
       	<div class="col-sm-10 nopadding">
	
<div class="col-sm-12" style="padding-top:15px;">
    

      <?php teacherBanner(); 
 echo' <div class="col-sm-12 formBg">
    <div class="col-sm-12 teachheader">
                  Weight nd Height
            
      </div>';


        if(isset($_GET['s'])){
     echo"<div class='col-sm-10 col-sm-offset-1'>";

        switch ($_GET['s']) {
          case '0':
          echo "<p class='error'> failed to insert .please try again or contact admin.</p>";
            break;

             case '1':
          echo "<p class='success'>   Input Successfull .</p>";
            break;

            case '2':
          echo "<p class='error'>  you did not insert or update any thing .</p>";
            break;

          
          default:
            # code...
            break;
        }

        echo" <a href='w_and_h.php' class='btn btn-success'>Go Back </a>
        </div>";
         }

    echo'<div class="col-sm-12" style="background-color:#fff;">';
 if(isset($_POST['submit'])){

      $_SESSION['session'] = $_POST['session'];
      $yearplus =  $_SESSION['session'] + 1;
     $_SESSION['term'] = $_POST['term'];

$student_info = select_student_reg_all($_SESSION['session'] ,$_SESSION['class_id'], $_SESSION['subclass'], $_SESSION['term']);

    if(count($student_info) == 0){

 echo $msg = "<p class='exist'> No Students is available in " .$_SESSION['term']. " &nbsp;".$_SESSION['session']. " / " .$yearplus. " session.</p>

 <a href='enter_result.php' class='btn btn-success btn-block'> Click To Go Back </a>";

}else{
 


$s = 0;
$i=0;
echo "<p class='text-success'><b>".$_SESSION['term']."&nbsp;".$_SESSION['session']."/".$yearplus."</b></p>
<p class='text-success'><b>Subject : </b>".$_SESSION['subject_name']."</p>";

 
       

    

echo"<table class='table table-striped  table-bordered'>
<tr class='success'>
<th width='2%'></th>
<th width='3%'>S/n</th>
<th>Surname</th>
<th>First Name</th>

<th>Class Num</th>
<th>Heigh beg</th>
<th>Height end</th>
<th>Weight beg</th>
<th>Weight end</th>

</tr>
<form class='form-group' method='post' action='insert_w_h.php'>";
foreach ($student_info as $key => $value) {

$s++;

$r= select_w_h($value['student_id'],$value['student_no'],$_SESSION['class_id'],$_SESSION['subclass'],$value['reg_id'],$_SESSION['term'],$_SESSION['session']);
$i++;
$no =count($r);
if(count($r) == 0){
//e#
//  echo "3";

  if(($s % 2)== 0){
  echo"<tr class='warning'>";

}else{
echo"<tr class='danger'>";
}
echo"
<td><input type=\"checkbox\" name=\"check[$i]\"  id=\"check[$i]\" value=\"$i\" /></td>
<td>".$s."<input type='hidden' name='reg[$i]' value='".$value['reg_id']."'></td>
<td>".$value['surname']."<input type='hidden' name='student_id[$i]' value='".$value['student_id']."'></td>
<td>".$value['firstname']."</td>

<td>".$value['student_no']."<input type='hidden' name='student_no[$i]' value='".$value['student_no']."'></td>
<td><input class='form-control navbar-right' type='text' name='hb[$i]' id='hb$i' onKeyUp=\"CA(this,'check[$i]') \"  value=''></td>
<td><input class='form-control navbar-right' type='text' name='he[$i]' id='he$i' onKeyUp=\"CA(this,'check[$i]') \"  value=''></td>
<td><input class='form-control' type='text' name='wb[$i]' value='' id='wb$i' onKeyUp=\"CA(this,'check[$i]') \"></td>

<td><input class='form-control' type='text' name='we[$i]' onKeyUp=\"CA(this,'check[$i]') \" value='' id='we$i' ></td>


</tr>";
}else{
foreach ($r as $k => $v) {
  //echo "string";

  if(($s % 2)== 0){
  echo"<tr class='warning'>";

}else{
echo"<tr class='danger'>";
}
echo"
<td><input type=\"checkbox\" name=\"check[$i]\"  id=\"check[$i]\" value=\"$i\" /></td>
<td>".$s."<input type='hidden' name='reg[$i]' value='".$value['reg_id']."'></td>
<td>".$value['surname']."<input type='hidden' name='student_id[$i]' value='".$value['student_id']."'></td>
<td>".$value['firstname']."</td>

<td>".$value['student_no']."<input type='hidden' name='student_no[$i]' value='".$value['student_no']."'></td>
<td><input class='form-control' type='text' size='20' name='hb[$i]' id='hb$i' onKeyUp=\"CA(this,'check[$i]') \"  value='".$v['hb']."'></td>
<td><input class='form-control' type='text' size='20' name='he[$i]' id='he$i' onKeyUp=\"CA(this,'check[$i]') \"  value='".$v['he']."'></td>
<td><input class='form-control' type='text' name='wb[$i]'  id='wb$i' onKeyUp=\"CA(this,'check[$i]') \" value='".$v['wb']."'></td>
<td><input class='form-control' type='text' name='we[$i]' value='".$v['we']."' id='we$i' onKeyUp=\"CA(this,'check[$i]') \" ></td>
</tr>";

}
  # code...
}
}

echo"
<tr>
<td colspan='9'><input type='submit' name='result' value='Send Result' id='result' class='btn btn-success'></td></tr>
</form>";

?>


</table>";

<?php
}

 
}

echo'</div></div>';

      ?>

</div>
       	</div>

       </div>
       <script type="text/javascript">

 function CA(e,h){
var chk=document.getElementById(h);
if(e.value!='')
  {chk.checked=true;}
else{chk.checked=false;}
}
</script>

<?php
      // footer2();
       ?>
     