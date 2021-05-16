<?php
      include_once"../function/include.php";  
      include_once"adminFunction.php";

$conn =db();
if(isset($_POST["submit"])){
$session = cleansql($_POST['session']);
 $section = cleansql($_POST['section']);
 $schedule = cleansql($_POST['schedule']);
$term = cleansql($_POST['term']);
$all = cleansql($_POST['all']);
$first_instalment =cleansql( $_POST['first_instalment']);
$second_instalment =cleansql( $_POST['second_instalment']);
$third_instalment= cleansql($_POST['third_instalment']);

$sqlab =get_school_fess_setup($class_id,$term,$session,$conn);     
      if(mysqli_num_rows($sqlab) < 1){ 
      
      $query2ab = "INSERT INTO fess_setup (`fess_schedules_id`,`section`,`term`,`sessional`,`all_payment`,`first_instalment`,`second_instalment`,`third_instalment`) VALUES('$schedule','$section','$term','$session','$all','$first_instalment','$second_instalment','$third_instalment')";
      //echo $query2ab;
      $query2ab = mysqli_query( $conn, $query2ab) or die(mysqli_error($conn));
      
      if ($query2ab)  {
        $msg = "<p class='success'>Successful : Fess setup successful</p>";  
        
      }else{

          $msg = "<p class='error'>Failed : Fess setup failed. please try again</p>";
         }
}else{
      
      $r=mysqli_fetch_assoc($sqlab);

     
     
     $msg = "<p class='warning'>Failed : Fess  setup for these class exist already in these session</p>";
    
}
header('location:school_fess_setup.php?s='.$msg);
}



?>