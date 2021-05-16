<?php
      include_once"../function/include.php";  
      include_once"adminFunction.php";

$conn =db();
if(isset($_POST["submit"])){

$schedule =cleansql( strtoUpper($_POST['schedule']));


$sqlab =get_fess_schedule($schedule,$conn);     
      if(mysqli_num_rows($sqlab) < 1){ 
      
      $query2ab = "INSERT INTO fess_schedules (`name`) VALUES('$schedule')";
      //echo $query2ab;
      $query2ab = mysqli_query( $conn, $query2ab) or die(mysqli_error($conn));
      
      if ($query2ab)  {
        $msg = "<p class='success'>Successful : Fess schedule successful</p>";  
        
      }else{

          $msg = "<p class='error'>Failed : Fess schedule failed. please try again</p>";
         }
}else{
      
      $r=mysqli_fetch_assoc($sqlab);

     
     
     $msg = "<p class='warning'>Failed : Fess  schedule  exist already in these session</p>";
    
}
header('location:manage_fess_schedule.php?s='.$msg);
}



?>