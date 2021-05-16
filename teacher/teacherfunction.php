<?php
function linkh(){
?>
<link rel="stylesheet" type="text/css" href="../css/bootstrap.css"/>
<link href="../css/main.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="admincss.css">
<script src="../script/jquery1.js" type="text/javascript"></script>
<script src="../script/bootstrap.min.js" type="text/javascript"></script>
<script src="../script/jquery.js" type="text/javascript"></script>
<script src="../script/respond.js"></script>
<?php


}

function leftnav(){
	?>
	<div class="col-sm-2 addpadding addcolorleftnav" >
    
         <ul class="list-group">
      
            <li class="list-group-item "><a href="index.php">Home</a></li>
            <li class="list-group-item"><a href="registerstudent.php">Register Student</a></li>
            <li  class="list-group-item"><a href="viewregisterstudent.php">View Students</a></li>
            <li class="list-group-item"><a href="enter_result.php">Add Result</a></li>
            <li class="list-group-item"><a href="importresult.php">Import Result</a></li>
             <li class="list-group-item"><a href="opening_attendance.php">Opening Attendance</a></li>
            <li class="list-group-item"><a href="attendance.php">Class Attendance</a></li>
          <li class="list-group-item"><a href="w_and_h.php">Weight & Height</a></li>
          <li class="list-group-item"><a href="absent_illness.php">Absent Due To Illness</a></li>
             <li class="list-group-item"><a href="comment.php">Comment</a></li>
             <li class="list-group-item"><a href="principal_comment.php">Principal Comment</a></li>

       	</div>
       	<?php
}
function lodgincheck(){
if(!isset($_SESSION['teacherlog']) ){
      header('location:loginteacher.php');
      exit();
}
}


function load_teacher($username){

$conn =db();

        $query="SELECT `teacher`.`Teacher_id`, `teacher`.`surname`,`teacher`.`firstname`,`teacher`.`othername`,`category_of_class`.`class_category_name`,`class`.`class_name` FROM teacher LEFT JOIN category_of_class ON `category_of_class`.`class_category_id` =`teacher`.`class_category_id` LEFT JOIN class ON `class`.`class_id` = `teacher`.`class_id` where teacher.username ='".$username."' ";
     
     $sql=mysqli_query($conn,$query) or die(mysqli_query($conn));
     if(!$sql){
      echo "query failed";
     }

     if(mysqli_num_rows($sql) != 0){
      $a =array();
      while($r =mysqli_fetch_assoc($sql)){
            $a[] = $r;

            return $a;
      }
      return array();
     }

}



function teacherBanner(){




      $a= load_teacher($_SESSION['username']);
      $b = array();
      foreach ($a as $key => $value) {
       $class=$value['class_name'];
       $class_cat=$value['class_category_name'];


             # code...
      }
//var_dump($value);
      ?>
<div class="col-sm-12 headbanner2"><?php echo $_SESSION['fullname']; ?><span class="navbar-right"><?php  echo $class ."&nbsp;&nbsp;".$class_cat; ?></span></div>

<?php
}

function select_student_reg($session,$class_id,$classcat,$term){
      $conn = db();
      $std_id =array();

$query="SELECT student_id FROM student_reg WHERE session='$session' && class_id='$class_id' && class_category_id='$classcat' && subject_term='$term'";
$result = mysqli_query($conn,$query) or die(mysqli_error($conn));
if(!$result){
      echo "query failed";
}
if(mysqli_num_rows($result) != 0){

      while ($r=mysqli_fetch_assoc($result)) {
            $std_id[] = $r;
            # code...
      }
      return $std_id;
}


return array();
}


function select_student_reg_all($session,$class_id,$classcat,$term){
      $conn = db();
      $std =array();

$query="SELECT student_profile.student_id,surname,firstname,othername,student_reg.reg_id,student_reg.student_no,student_reg.subject_term,student_reg.session FROM student_profile INNER JOIN student_reg ON student_profile.student_id = student_reg.student_id WHERE student_reg.session='$session' && student_profile.class_id='$class_id' && student_profile.class_category_id='$classcat' && student_reg.subject_term='$term' && student_profile.status='present'";

$result = mysqli_query($conn,$query) or die(mysqli_error($conn));
if(!$result){
      echo "query failed";
}
if(mysqli_num_rows($result) != 0){

      while ($r=mysqli_fetch_assoc($result)) {
            $std[] = $r;
            # code...
      }
      return $std;
}


return array();
}


function select_student_reg_with_student_no($no,$session,$class_id,$classcat,$term){
      $conn = db();
      

$query="SELECT student_profile.student_id,surname,firstname,othername,student_reg.reg_id,student_reg.student_no,student_reg.subject_term,student_reg.session FROM student_profile INNER JOIN student_reg ON student_profile.student_id = student_reg.student_id WHERE student_reg.session='$session' && student_profile.class_id='$class_id' && student_profile.class_category_id='$classcat' && student_reg.subject_term='$term' && student_profile.status='present' && student_profile.student_no='$no'";

$result = mysqli_query($conn,$query) or die(mysqli_error($conn));
if(!$result){
      echo "query failed";
}
if(mysqli_num_rows($result) != 0){

      $r=mysqli_fetch_assoc($result);
      return $r;
}
return '';
}



function insert_student_reg($std_id,$std_no,$class_category_id,$class_id,$term,$session,$date){
  $conn = db();
  
  $query="INSERT INTO student_reg (student_id,student_no,class_category_id,class_id,subject_term,session,date_reg) VALUES('$std_id','$std_no','$class_category_id','$class_id','$term','$session','$date')";
  $result = mysqli_query($conn,$query) or die(mysqli_error($conn));
  if($result){
      return true;
  }else{
      return false;
  }



}



function select_student_profile_id($class_id,$class_category_id){
$conn =db();
$student = array();

      $query ="SELECT student_id FROM student_profile WHERE class_id ='$class_id' && class_category_id ='$class_category_id' && status='present'";
      $result = mysqli_query($conn,$query) or die (mysqli_error($conn));
      if(!$result){
            echo " query faild select";
      }

      if(mysqli_num_rows($result) != 0){

      while ($r=mysqli_fetch_assoc($result)) {
            $student[] = $r;
            # code...
      }
      return $student;
}


return array();
}


function select_student_profile($class_id,$class_category_id,$s){
$conn =db();
$student = array();

      $query ="SELECT DISTINCT sr.student_id,sp.class_option_id,sp.surname,sp.firstname,sp.othername,sp.student_no,sp.gender,sp.class_id,sp.class_category_id FROM student_profile as sp LEFT JOIN student_reg as sr ON sp.student_id = sr.student_id   WHERE sr.class_id ='$class_id' && sr.class_category_id ='$class_category_id' && sr.session ='$s'  order by sp.student_no";
      $result = mysqli_query($conn,$query) or die (mysqli_error($conn));
      if(!$result){
            echo " query faild select";
      }

      if(mysqli_num_rows($result) != 0){

      while ($r=mysqli_fetch_assoc($result)) {
            $student[] = $r;
            # code...
      }
    }
      return $student;
}

function select_student_profile_to_reg($id,$c,$sc){
  $conn =db();
  $pr =array();
  $query = "Select student_id,student_no from student_profile where student_id ='$id' && class_id ='$c' && class_category_id ='$sc'";

 $result = mysqli_query($conn,$query) or die(mysqli_error($conn));
while( $r = mysqli_fetch_assoc($result)){
 $pr[] = $r;
}
return $pr;
}



function select_result($student_id,$class_no,$class_id,$class_category_id,$reg_id,$subject_id,$term,$year){
$conn =db();
$result= array();

      $query ="SELECT * FROM student_result WHERE student_id ='$student_id' && class_no='$class_no' && class_id ='$class_id' && class_category_id ='$class_category_id' && reg_id ='$reg_id' && subject_id ='$subject_id' && result_term = '$term' && result_year = '$year'";
      $rs = mysqli_query($conn,$query) or die (mysqli_error($conn));
      if(!$rs){
            echo " <p class='text-error'>select result query failed.</p>";
      }

      if(mysqli_num_rows($rs) != 0){

      while ($r=mysqli_fetch_assoc($rs)) {
            $result[] = $r;
            # code...
      }
      return $result;
}


return array();
}

function select_attendance($student_id,$class_no,$class_id,$class_category_id,$reg_id,$term,$year){
$conn =db();
$result= array();

      $query ="SELECT * FROM attendance WHERE student_id ='$student_id' && class_no='$class_no' && class_id ='$class_id' && class_category_id ='$class_category_id' && reg_id ='$reg_id' && term = '$term' && year = '$year'";
      $rs = mysqli_query($conn,$query) or die (mysqli_error($conn));
      if(!$rs){
            echo " <p class='text-error'>select result query failed.</p>";
      }

      if(mysqli_num_rows($rs) != 0){

      while ($r=mysqli_fetch_assoc($rs)) {
            $result[] = $r;
            # code...
      }
      return $result;
}
return array();
}

function select_w_h($student_id,$class_no,$class_id,$class_category_id,$reg_id,$term,$year){
$conn =db();
$result= array();

      $query ="SELECT * FROM w_h WHERE student_id ='$student_id' && class_no='$class_no' && class_id ='$class_id' && class_category_id ='$class_category_id' && reg_id ='$reg_id' && term = '$term' && year = '$year'";
      $rs = mysqli_query($conn,$query) or die (mysqli_error($conn));
      if(!$rs){
            echo " <p class='text-error'>select result query failed.</p>";
      }

      if(mysqli_num_rows($rs) != 0){

      while ($r=mysqli_fetch_assoc($rs)) {
            $result[] = $r;
            # code...
      }
      return $result;
}


return array();
}

function select_open_attendance_all(){
$conn =db();
$result= array();

      $query ="SELECT * FROM open_attendance ORDER BY year DESC, term DESC";
      $rs = mysqli_query($conn,$query) or die (mysqli_error($conn));
      if(!$rs){
            echo " <p class='text-error'>select result query failed.</p>";
      }

      if(mysqli_num_rows($rs) != 0){

      while ($r=mysqli_fetch_assoc($rs)) {
            $result[] = $r;
            # code...
      }
      return $result;
}


return array();
}

function select_open_attendance($open,$term,$year){
$conn =db();
$result= array();

      $query ="SELECT * FROM open_attendance WHERE  term = '$term' && year = '$year'";
      $rs = mysqli_query($conn,$query) or die (mysqli_error($conn));
      if(!$rs){
            echo " <p class='text-error'>select result query failed.</p>";
      }

      if(mysqli_num_rows($rs) != 0){

      while ($r=mysqli_fetch_assoc($rs)) {
            $result[] = $r;
            # code...
      }
      return $result;
}


return array();
}


function select_comment($student_id,$class_no,$class_id,$class_category_id,$reg_id,$term,$year){
$conn =db();
$result= array();

      $query ="SELECT * FROM comment WHERE student_id ='$student_id' && class_no='$class_no' && class_id ='$class_id' && class_category_id ='$class_category_id' && reg_id ='$reg_id' && term = '$term' && year = '$year'";
      $rs = mysqli_query($conn,$query) or die (mysqli_error($conn));
      if(!$rs){
            echo " <p class='text-error'>select result query failed.</p>";
      }

      if(mysqli_num_rows($rs) != 0){

      while ($r=mysqli_fetch_assoc($rs)) {
            $result[] = $r;
            # code...
      }
      return $result;
}
return array();
}

function select_principal_comment($student_id,$class_no,$class_id,$class_category_id,$reg_id,$term,$year){
  $conn =db();
  $result= array();
  
        $query ="SELECT * FROM principal_comment WHERE student_id ='$student_id' && class_no='$class_no' && class_id ='$class_id' && class_category_id ='$class_category_id' && reg_id ='$reg_id' && term = '$term' && year = '$year'";
        $rs = mysqli_query($conn,$query) or die (mysqli_error($conn));
        if(!$rs){
              echo " <p class='text-error'>select result query failed.</p>";
        }
  
        if(mysqli_num_rows($rs) != 0){
  
        while ($r=mysqli_fetch_assoc($rs)) {
              $result[] = $r;
              # code...
        }
        return $result;
  }
  return array();
  }

function select_absent_illness($student_id,$class_no,$class_id,$class_category_id,$reg_id,$term,$year){
$conn =db();
$result= array();

      $query ="SELECT * FROM absent_illness WHERE student_id ='$student_id' && class_no='$class_no' && class_id ='$class_id' && class_category_id ='$class_category_id' && reg_id ='$reg_id' && term = '$term' && year = '$year'";
      $rs = mysqli_query($conn,$query) or die (mysqli_error($conn));
      if(!$rs){
            echo " <p class='text-error'>select result query failed.</p>";
      }

      if(mysqli_num_rows($rs) != 0){

      while ($r=mysqli_fetch_assoc($rs)) {
            $result[] = $r;
            # code...
      }
      return $result;
}
return array();
}

function select_result_display($student_id,$class_id,$class_category_id,$reg_id,$subject_id,$term,$year){
$conn =db();

 
  if( empty($subject_id) ){
    return array();
  }
$result= array();
$sub_id=array();

      $query ="SELECT subject_id,student_ca2,student_exam,student_mark FROM student_result WHERE student_id ='$student_id'  && class_id ='$class_id' && class_category_id ='$class_category_id' && reg_id ='$reg_id' && subject_id IN (".implode(',', $subject_id).") && result_term = '$term' && result_year = '$year' order by subject_id";
      
//echo $query;
      $rs = mysqli_query($conn,$query) or die (mysqli_error($conn));
      if(!$rs){
            echo " <p class='text-error'>select result query failed.</p>";
      }

      if(mysqli_num_rows($rs) != 0){

      while ($r=mysqli_fetch_assoc($rs)) {
            $subj_id[$r['subject_id']] = $r;
            # code...
      }
    }

   // $query2 ="SELECT subject_id FROM subject WHERE "
    //if(isset($subj_id)){
     if(!empty($subj_id)){
    if(count($subj_id) != 0){
      
    $keys = array_keys($subj_id);
  }
  }else{
    $keys =array('');
  }

  foreach( $subject_id as $k=>$v ) {
    

    if( in_array($v, $keys) ) {
      /*if( empty($subj_id[$v]['student_mark']) || $subj_id[$v]['student_mark']==0 ) {
        $result[] = array( 'student_ca2'=>$subj_id[$v]['student_ca2'], 'student_exam'=>'','student_mark'=>'' );
      } else {*/
        $result[] = array( 'subject_id'=>$v,'student_ca2'=>$subj_id[$v]['student_ca2'], 'student_exam'=>$subj_id[$v]['student_exam'],'student_mark'=>$subj_id[$v]['student_mark'] );
      
      }else{
 $result[] = array('subject_id'=>$v, 'student_ca2'=>'', 'student_exam'=>'','student_mark'=>'');
      
      }
    
  }
  

      return $result;
      
}

function percentageOfFirstTerm($student_id,$class_id,$class_category_id,$reg_id,$subject_id,$term,$year){

$r =  select_result_display($student_id,$class_id,$class_category_id,$reg_id,$subject_id,$term,$year);
var_dump($r['student_mark']);
$per = round($r['student_mark'] * 0.2,2);
return $per;

}

function insert_result($student_id,$class_no,$class_id,$class_category_id,$reg_id,$subject_id,$ca,$exam,$mark,$term,$year){
  $conn =db();
  $query ="INSERT INTO student_result (student_id,class_no,class_id,class_category_id,reg_id,subject_id,student_ca2,student_exam,student_mark,result_term,result_year) VALUES('$student_id','$class_no','$class_id','$class_category_id','$reg_id','$subject_id','$ca','$exam','$mark','$term','$year')";
  $r =mysqli_query($conn,$query) or die(mysqli_error($conn));
  if(!$r){
    echo"query of insert result failed";
exit();
  }else{
    return true;
  }
}

function update_result($student_id,$class_no,$class_id,$class_category_id,$reg_id,$subject_id,$ca,$exam,$mark,$term,$year){



  $conn =db();
  $query ="UPDATE student_result SET student_ca2 = '$ca',student_exam ='$exam',student_mark='$mark' WHERE student_id='$student_id' && class_no = '$class_no' && class_id = '$class_id' && class_category_id = '$class_category_id' && reg_id = '$reg_id' && subject_id ='$subject_id' && result_term = '$term' && result_year = '$year'";

  $u = mysqli_query($conn,$query) or die(mysqli_error($conn));
  if(!$u){
    echo " update of result failed";
  }else{
    return true;
  }
}


function insert_attendance($student_id,$class_no,$class_id,$class_category_id,$reg_id,$present,$punctual,$absent,$term,$year){
  $conn =db();
  $query ="INSERT INTO attendance (student_id,class_no,class_id,class_category_id,reg_id,present,punctual,absent,term,year) VALUES('$student_id','$class_no','$class_id','$class_category_id','$reg_id','$present','$punctual','$absent','$term','$year')";
  
  $r =mysqli_query($conn,$query) or die(mysqli_error($conn));
  if(!$r){
    echo"query of insert result failed";
exit();
  }else{
    return true;
  }
}

function update_attendance($student_id,$class_no,$class_id,$class_category_id,$reg_id,$present,$punctual,$absent,$term,$year){



  $conn =db();
  $query ="UPDATE attendance SET present = '$present',punctual ='$punctual',absent='$absent' WHERE student_id='$student_id' && class_no = '$class_no' && class_id = '$class_id' && class_category_id = '$class_category_id' && reg_id = '$reg_id'  && term = '$term' && year = '$year'";
//echo $query.'<br/>';;
  $u = mysqli_query($conn,$query) or die(mysqli_error($conn));
  if(!$u){
    echo " update of result failed";
  }else{
    return true;
  }
}

function insert_open_attendance($open,$term,$year){
  $conn =db();
  $query ="INSERT INTO open_attendance (open,term,year) VALUES('$open','$term','$year')";
 
  $r =mysqli_query($conn,$query) or die(mysqli_error($conn));
  if(!$r){
    echo"query of insert result failed";
exit();
  }else{
    return true;
  }
}

function update_open_attendance($open,$term,$year){



  $conn =db();
  $query ="UPDATE open_attendance SET open = '$oepn' WHERE term = '$term' && year = '$year'";
//echo $query.'<br/>';;
  $u = mysqli_query($conn,$query) or die(mysqli_error($conn));
  if(!$u){
    echo " update of result failed";
  }else{
    return true;
  }
}


function insert_w_h($student_id,$class_no,$class_id,$class_category_id,$reg_id,$hb,$he,$wb,$we,$term,$year){
  $conn =db();
  $query ="INSERT INTO w_h (student_id,class_no,class_id,class_category_id,reg_id,hb,he,wb,we,term,year) VALUES('$student_id','$class_no','$class_id','$class_category_id','$reg_id','$hb','$he','$wb','$we','$term','$year')";
  
  $r =mysqli_query($conn,$query) or die(mysqli_error($conn));
  if(!$r){
    echo"query of insert result failed";
exit();
  }else{
    return true;
  }
}

function update_w_h($student_id,$class_no,$class_id,$class_category_id,$reg_id,$hb,$he,$wb,$we,$term,$year){



  $conn =db();
  $query ="UPDATE w_h SET hb = '$hb',he ='$he',wb='$wb',we='$we' WHERE student_id='$student_id' && class_no = '$class_no' && class_id = '$class_id' && class_category_id = '$class_category_id' && reg_id = '$reg_id'  && term = '$term' && year = '$year'";
//echo $query.'<br/>';;
  $u = mysqli_query($conn,$query) or die(mysqli_error($conn));
  if(!$u){
    echo " update of result failed";
  }else{
    return true;
  }
}


function insert_absent_illness($student_id,$class_no,$class_id,$class_category_id,$reg_id,$absent,$reason,$term,$year){
  $conn =db();
  $query ="INSERT INTO absent_illness (student_id,class_no,class_id,class_category_id,reg_id,absent,reason,term,year) VALUES('$student_id','$class_no','$class_id','$class_category_id','$reg_id','$absent','$reason','$term','$year')";
 
  $r =mysqli_query($conn,$query) or die(mysqli_error($conn));
  if(!$r){
    echo"query of insert result failed";
exit();
  }else{
    return true;
  }
}

function update_absent_illness($student_id,$class_no,$class_id,$class_category_id,$reg_id,$absent,$reason,$term,$year){



  $conn =db();
  $query ="UPDATE absent_illness SET absent = '$absent',reason ='$reason' WHERE student_id='$student_id' && class_no = '$class_no' && class_id = '$class_id' && class_category_id = '$class_category_id' && reg_id = '$reg_id'  && term = '$term' && year = '$year'";
//echo $query.'<br/>';;
  $u = mysqli_query($conn,$query) or die(mysqli_error($conn));
  if(!$u){
    echo " update of result failed";
  }else{
    return true;
  }
}


function insert_comment($student_id,$class_no,$class_id,$class_category_id,$reg_id,$comment,$term,$year){
  $conn =db();
  $query ="INSERT INTO comment (student_id,class_no,class_id,class_category_id,reg_id,comment,term,year) VALUES('$student_id','$class_no','$class_id','$class_category_id','$reg_id','$comment','$term','$year')";

  $r =mysqli_query($conn,$query) or die(mysqli_error($conn));
  if(!$r){
    echo"query of insert result failed";
exit();
  }else{
    return true;
  }
}

function update_comment($student_id,$class_no,$class_id,$class_category_id,$reg_id,$comment,$term,$year){



  $conn =db();
  $query ="UPDATE comment SET comment = '$comment' WHERE student_id='$student_id' && class_no = '$class_no' && class_id = '$class_id' && class_category_id = '$class_category_id' && reg_id = '$reg_id'  && term = '$term' && year = '$year'";
//echo $query.'<br/>';;
  $u = mysqli_query($conn,$query) or die(mysqli_error($conn));
  if(!$u){
    echo " update of result failed";
  }else{
    return true;
  }
}

function insert_principal_comment($student_id,$class_no,$class_id,$class_category_id,$reg_id,$comment,$term,$year){
  $conn =db();
  $query ="INSERT INTO principal_comment (student_id,class_no,class_id,class_category_id,reg_id,comment,term,year) VALUES('$student_id','$class_no','$class_id','$class_category_id','$reg_id','$comment','$term','$year')";

  $r =mysqli_query($conn,$query) or die(mysqli_error($conn));
  if(!$r){
    echo"query of insert result failed";
exit();
  }else{
    return true;
  }
}

function update_principal_comment($student_id,$class_no,$class_id,$class_category_id,$reg_id,$comment,$term,$year){



  $conn =db();
  $query ="UPDATE principal_comment SET comment = '$comment' WHERE student_id='$student_id' && class_no = '$class_no' && class_id = '$class_id' && class_category_id = '$class_category_id' && reg_id = '$reg_id'  && term = '$term' && year = '$year'";
//echo $query.'<br/>';;
  $u = mysqli_query($conn,$query) or die(mysqli_error($conn));
  if(!$u){
    echo " update of result failed";
  }else{
    return true;
  }
}


function getsubject($class_id,$subclass,$year,$term){
$conn = db();
$sb = array();
  $query = "SELECT DISTINCT student_result.subject_id,subject.subject_name FROM student_result INNER JOIN subject ON student_result.subject_id=subject.subject_id WHERE student_result.class_id ='$class_id' && student_result.class_category_id='$subclass' && student_result.result_term='$term' && student_result.result_year='$year' order by subject.subject_id";

  $r=mysqli_query($conn,$query) or die(mysqli_error($conn));
  if(!$r){
    echo "query to fetch subject failed";
    exit();
  }

  if(mysqli_num_rows($r) != 0){

   while($f= mysqli_fetch_assoc($r)){
    $sb [] = $f;
   }
  }
  return $sb;


}

function get_reg_id($student_id,$sc,$c,$term,$s){
$conn =db();
$reg_id =0;
$query =" SELECT student_reg.reg_id FROM student_reg,student_result WHERE student_reg.reg_id=student_result.reg_id &&  student_reg.student_id ='$student_id' && student_reg.class_category_id ='$sc' && student_reg.class_id='$c' && subject_term='$term' && session ='$s'";

$r =mysqli_query($conn, $query) or die (mysqli_error($conn));

if(!$r){
  echo "query to get student reg_id failed";
}

if(mysqli_num_rows($r) != 0){

   while($f= mysqli_fetch_assoc($r)){
    $reg_id = $f;
   }
  }
  
return $reg_id;

}

function get_all_input($table,$student_id,$class_no,$c,$sc,$reg_id,$term,$s){
$conn =db();

$query =" SELECT * FROM $table WHERE class_no ='$class_no' && reg_id='$reg_id' && student_id ='$student_id' && class_category_id ='$sc' && class_id='$c' && term='$term' && year ='$s'";


$r =mysqli_query($conn, $query) or die (mysqli_error($conn));

if(!$r){
  echo "query to get student reg_id failed";
}

if(mysqli_num_rows($r) != 0){

   while($f= mysqli_fetch_assoc($r)){
    $rr = $f;
   }
  }
  
return $rr;

}

function get_open_attendance($term,$s){
$conn =db();

$query =" SELECT * FROM open_attendance WHERE  term='$term' && year ='$s'";


$r =mysqli_query($conn, $query) or die (mysqli_error($conn));

if(!$r){
  echo "query to get student reg_id failed";
}

if(mysqli_num_rows($r) != 0){

   while($f= mysqli_fetch_assoc($r)){
    $rr = $f;
   }
  }
  
return $rr;

}

function fetch_annual_result2($std_id,$c,$sc,$sub,$s){

  
  $conn =db();
  $query =" SELECT sum(student_mark) as sm FROM student_result WHERE student_id ='$std_id' && class_id='$c' && class_category_id ='$sc'  && subject_id ='$sub' && result_term IN('First Term','Second Term','Third Term')  && result_year ='$s'";
$r =mysqli_query($conn,$query) or die(mysqli_query($conn));
while( 
  $rs = mysqli_fetch_assoc($r)){
  $a = $rs;
   }
//var_dump($a);
return $a;

}



function fetch_annual_result($std_id,$c,$sc,$sub,$s){

   
  $conn =db();
  $query =" SELECT student_mark FROM student_result WHERE student_id ='$std_id' && class_id='$c' && class_category_id ='$sc'  && subject_id = '$sub' && result_term IN('First Term')  && result_year ='$s' GROUP BY subject_id";

$query2 = "SELECT student_mark  FROM student_result WHERE student_id ='$std_id' && class_id='$c' && class_category_id ='$sc'  && subject_id = '$sub' && result_term ='Second Term' && result_year ='$s' GROUP BY subject_id";

$query3 =" SELECT student_mark  FROM student_result WHERE student_id ='$std_id' && class_id='$c' && class_category_id ='$sc' && subject_id = '$sub'  && result_term ='Third Term' && result_year ='$s'";







  $r =mysqli_query($conn,$query) or die(mysqli_query($conn));

  if(!$r){
    echo "query failed to select result first term";
  }
 //while( 
  $rs = mysqli_fetch_assoc($r);//){
  $annual = $rs['student_mark'];
  
// }

 
//------------------------------------------------------
$r2 =mysqli_query($conn,$query2) or die(mysqli_query($conn));

  if(!$r2){
    echo "query failed to select result first term";
  }
 
// while(  
  $rs2 = mysqli_fetch_assoc($r2);//){
  $annual2 =$rs2['student_mark'];
   
// }
  $a =$annual + $annual2;
//echo $a ;
//echo $annual2;
 //var_dump($annual2);
 
//---------------------------------------------------------------
 $r3 =mysqli_query($conn,$query3) or die(mysqli_query($conn));

  if(!$r3){
    echo "query failed to select result first term";
  }
  
  //while(
    $rs3 = mysqli_fetch_assoc($r3);//){
  $annual3 =$rs3['student_mark'];
    $aa =$a  + $annual3;
    
 // }
//var_dump($aa);

 
 //---------------------------------------

 

 return $aa;
}


function select_sub_number($std_id,$c,$sc,$term,$s){
  $conn =db();
 $sum = array();
  $query =" SELECT * FROM student_result WHERE student_id ='$std_id' && class_id='$c' && class_category_id ='$sc' && result_term ='$term' && result_year ='$s'";
 // echo $query;
  $r=mysqli_query($conn,$query) or die(mysqli_error($conn));
  if(!$r){
    echo "query failed to select subject total";
  }
  while($rs = mysqli_fetch_assoc($r)){
    $sum []= $rs['result_id'];
  }
 return $sum =count($sum);

}


function select_sub_total($std_id,$c,$sc,$sub,$term,$s){
 if( empty($sub) ){
    return array();
  }
//var_dump($sub);
  $conn =db();
  
 //$elect_sub = get_all_elective_subject($c,$sc,$class_option,$term,$s);
 $sum = 0;
  $query =" SELECT sum(student_mark) as tm  FROM student_result WHERE student_id ='$std_id' && class_id='$c' && class_category_id ='$sc'  && subject_id IN (".implode(',', $sub).") && result_term ='$term' && result_year ='$s'";
 // echo $query;
  $r=mysqli_query($conn,$query) or die(mysqli_error($conn));
  if(!$r){
    echo "query failed to select subject total";
  }
  while($rs = mysqli_fetch_assoc($r)){
    $sum = $rs['tm'];
  }
  if($s < 2017)
  {
  if($c >3){
    $s_m = array();

 $query =" SELECT student_mark   FROM student_result WHERE student_id ='$std_id' && class_id='$c' && class_category_id ='$sc'  && subject_id NOT IN (".implode(',', $sub).") && result_term ='$term' && result_year ='$s'";
 //echo $query;
  $r=mysqli_query($conn,$query) or die(mysqli_error($conn));
  if(!$r){
    echo "query failed to select subject total";
  }
  if(mysqli_num_rows($r) != 0){
   
  while($rs = mysqli_fetch_assoc($r)){
    $s_m[] = $rs['student_mark'];
  }
  mysqli_free_result($r);
  $max =max(array_values($s_m));
  $sum =$sum + $max;
  }else{
    $sum =$sum;
  }
}
}
  
  return $sum;

}



function p_f($std_id,$c,$sc,$sub,$term,$s){
 if( empty($sub) ){
    return array();
  }
  $ab =array();
  $conn =db();
   $num = total_subject_number($std_id,$c,$sc,$term,$s);
 $sum = array();
  $query_id =" SELECT DISTINCT student_id FROM student_result WHERE   class_id='$c' && class_category_id ='$sc'  && subject_id IN (".implode(',', $sub).") && result_term ='$term' && result_year ='$s'  ";
 // echo $query;
  $r_id=mysqli_query($conn,$query_id) or die(mysqli_error($conn));
  if(!$r_id){
    echo "query failed to select subject total";
  }
  if(mysqli_num_rows($r_id) != 0){
  while($rs_id = mysqli_fetch_assoc($r_id)){
    
    $id[] =$rs_id['student_id'];
  }


}
$len = count($id);


foreach ($id as $key => $value) {
  # code...

 $num = total_subject_number($value,$c,$sc,$term,$s);




  $query =" SELECT sum(student_mark) as sm, student_id FROM student_result WHERE student_id ='$value' && class_id='$c' && class_category_id ='$sc'  && subject_id IN (".implode(',', $sub).") && result_term ='$term' && result_year ='$s'  ";
// echo $query;
  $r=mysqli_query($conn,$query) or die(mysqli_error($conn));
  if(!$r){
    echo "query failed to select subject total";
  }
  
  if(mysqli_num_rows($r) != 0){
  while($rs = mysqli_fetch_assoc($r)){
    
   $sum[]=$rs;
   $mark[] =$rs['sm'];


  }
 // var_dump($sum);


}
}

$m = max($mark); 
rsort($sum);
$i =0;
foreach ($sum as $k => $v) {
  # code...
$i++;
//for ($i=0; $i < $len ; $i++) { 
if(max($mark )>= $v['sm']  ){
//$m=$v['sm'];
  $z[]=array('student_id'=>$v['student_id'],'position'=>$i);
  

//}
}
}
//$s=array();
 // $ss =array_sum($sum);
//var_dump($z);
 




 return $z;

}
/*function student_with_result($c,$sc,$term,$s){
 
  $conn =db();
 //$num = 0;
  $query =" SELECT DISTINCT student_id FROM student_result WHERE  class_id='$c' && class_category_id ='$sc' && result_term ='$term' && result_year ='$s'";
// echo $query;
  $r=mysqli_query($conn,$query) or die(mysqli_error($conn));
  if(!$r){
    echo "query failed to select subject total";
  }
  while($rs = mysqli_fetch_assoc($r)){
    $num[] = $rs['student_id'];
  }
 
 //var_dump($num); 
  return $num;

}*/
/*function student_with_result_inall_term($c,$sc,$s){
 
  $conn =db();
 //$num = 0;
  $query =" SELECT DISTINCT student_id FROM student_result WHERE  class_id='$c' && class_category_id ='$sc' && result_term IN('First Term','Second Term','Third Term') && result_year ='$s'";
// echo $query;
  $r=mysqli_query($conn,$query) or die(mysqli_error($conn));
  if(!$r){
    echo "query failed to select subject total";
  }
  while($rs = mysqli_fetch_assoc($r)){
    $num[] = $rs['student_id'];
  }
 
 //var_dump($num); 
  return $num;

}*/

function total_subject_number($std_id,$c,$sc,$term,$s){
 
  $conn =db();
 //$num = 0;
  $query =" SELECT DISTINCT count(subject_id) as sb  FROM student_result WHERE student_id ='$std_id' && class_id='$c' && class_category_id ='$sc' && result_term ='$term' && result_year ='$s'";
// echo $query;
  $r=mysqli_query($conn,$query) or die(mysqli_error($conn));
  if(!$r){
    echo "query failed to select subject total";
  }
  while($rs = mysqli_fetch_assoc($r)){
    $num = $rs['sb'];
  }
 
  if($num != 0){
  return $num;
}
//echo $num;
//var_dump($num);
}

function all_subject_number($std_id,$c,$sc,$s){
 
  $conn =db();
 //$num = 0;
  $query =" SELECT  subject_id FROM student_result WHERE student_id ='$std_id' && class_id='$c' && class_category_id ='$sc'  && result_year ='$s'";
// echo $query;
  $r=mysqli_query($conn,$query) or die(mysqli_error($conn));
  if(!$r){
    echo "query failed to select subject total";
  }
  while($rs = mysqli_fetch_assoc($r)){
    $num[] = $rs['subject_id'];
  }
 //$rr =array_unique($num);

  $rr =count($num);
  return $rr;

//var_dump($num);
}
?>