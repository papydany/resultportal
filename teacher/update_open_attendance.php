<?php   include_once"../function/include.php";  
       include_once"teacherfunction.php";


	if (isset($_POST['submit'])){

		
		$id=$_POST['id'];
		$open=$_POST['open'];

		$conn =db();

$update ="UPDATE open_attendance SET `open` ='$open' WHERE `id`=".$id;
$success = mysqli_query($conn,$update) or die(mysqli_error($conn));
if($success){
header('Location:view_open_attendance.php?up="1"');
}else{
header('Location:view_open_attendance.php?up="0"');
}
}



?>