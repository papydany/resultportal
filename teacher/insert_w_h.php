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
		
		$hb=cleansql($_POST['hb'][$no]);
		$he=cleansql($_POST['he'][$no]);
		
		$student_no=$_POST['student_no'][$no];
		
		$wb=cleansql($_POST['wb'][$no]);
		
		$we=cleansql($_POST['we'][$no]);
        
        $class_id=$_SESSION['class_id'];

		$class_category_id=$_SESSION['subclass'];
		
		$term=$_SESSION['term'];

		$session= $_SESSION['session'];

		

		$r = select_w_h($student_id,$student_no,$class_id,$class_category_id,$reg_id,$term,$session);

		if(count($r) == 0){
       //   insert result
     $insert = insert_w_h($student_id,$student_no,$class_id,$class_category_id,$reg_id,$hb,$he,$wb,$we,$term,$session);
		}else{
     //  update result
      $update = update_w_h($student_id,$student_no,$class_id,$class_category_id,$reg_id,$hb,$he,$wb,$we,$term,$session);
		}

		# code...
	}
	if($insert == true || $update == true){
		header('location: w_and_h_form.php?s=1');
		exit();
	}else{
		header('location: w_and_h_form.php?s=0');
		exit();
	}
}else{
	header('location: attendanceform.php?s=2');
		exit();
}

?>