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
		
		$comment=cleansql($_POST['comment'][$no]);
		
		$student_no=$_POST['student_no'][$no];
	   
	    $class_id=$_SESSION['class_id'];

		$class_category_id=$_SESSION['subclass'];
		
		$term=$_SESSION['term'];

		$session= $_SESSION['session'];

		

		$r = select_principal_comment($student_id,$student_no,$class_id,$class_category_id,$reg_id,$term,$session);

		if(count($r) == 0){
       //   insert result
     $insert = insert_principal_comment($student_id,$student_no,$class_id,$class_category_id,$reg_id,$comment,$term,$session);
		}else{
     //  update result
      $update = update_principal_comment($student_id,$student_no,$class_id,$class_category_id,$reg_id,$comment,$term,$session);
		}

		# code...
	}
	if($insert == true || $update == true){
		header('location: principal_commentform.php?s=1');
		exit();
	}else{
		header('location: principal_commentform.php?s=0');
		exit();
	}
}else{
	header('location:principal_commentform.php?s=2');
		exit();
}

?>