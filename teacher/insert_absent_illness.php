<?php   include_once"../function/include.php";  
       include_once"teacherfunction.php";


	$allcheck =$_POST['check'];
	
$all=count($allcheck);
//echo $all;

	if($all != 0){

		

	foreach ($allcheck as $value) {
        $check=$value; 
		$no=$check;

		$reg_id=$_POST['reg'][$no];
		
		
		$student_id=$_POST['student_id'][$no];
		
		$present=cleansql($_POST['present'][$no]);
		
		$student_no=$_POST['student_no'][$no];
		
		$reason=cleansql($_POST['reason'][$no]);
		
		$absent=cleansql($_POST['absent'][$no]);
        
        $class_id=$_SESSION['class_id'];

		$class_category_id=$_SESSION['subclass'];
		
		$term=$_SESSION['term'];

		$session= $_SESSION['session'];

		

		$r = select_absent_illness($student_id,$student_no,$class_id,$class_category_id,$reg_id,$term,$session);

		if(count($r) == 0){
       //   insert result
     $insert = insert_absent_illness($student_id,$student_no,$class_id,$class_category_id,$reg_id,$absent,$reason,$term,$session);
		}else{
     //  update result
      $update = update_absent_illness($student_id,$student_no,$class_id,$class_category_id,$reg_id,$absent,$reason,$term,$session);
		}

		# code...
	}
	if($insert == true || $update == true){
		header('location: absent_illness_form.php?s=1');
		exit();
	}else{
		header('location: absent_illness_form.php?s=0');
		exit();
	}
}else{
	header('location: absent_illness_form.php?s=2');
		exit();
}

?>