<?php   include_once"../function/include.php";  
       include_once"teacherfunction.php";


	if (isset($_POST['submit'])){

		$session=$_POST['session'];
		$term=$_POST['term'];
		$open=$_POST['open'];

	$r = select_open_attendance($open,$term,$session);

		if(count($r) == 0){
       //   insert result
     $insert = insert_open_attendance($open,$term,$session);
		}else{
     //  update result
      $update = update_open_attendance($open,$term,$session);
		}

		if($insert == true || $update == true){
		header('location: opening_attendance.php?s=1');
		exit();
	}else{
		header('location: opening_attendance.php?s=0');
		exit();
	}
	}else{
	header('location: opening_attendance.php?s=2');
		exit();
	}

?>