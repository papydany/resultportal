<?php  include_once"../function/include.php";  
       include_once"teacherFunction.php";

$conn =db();
if( !empty($_GET['delete'] ) ) {
		mysqli_query( $conn, 'DELETE FROM student_reg WHERE reg_id = '.$_GET['delete'].' LIMIT 1');
		mysqli_query( $conn, 'OPTIMIZE table');
	   
	   mysqli_query( $conn, 'DELETE FROM student_result WHERE reg_id = '.$_GET['delete']);
	   mysqli_query( $conn, 'OPTIMIZE table');
		header('HTTP/1.1 301 Moved Permanently');
		header('Location:viewregisterstudent.php?del="1"');
		
}

if( !empty($_GET['open'] ) ) {
		mysqli_query( $conn, 'DELETE FROM open_attendance WHERE id = '.$_GET['open'].' LIMIT 1');
		mysqli_query( $conn, 'OPTIMIZE table');
	   
	  
		header('HTTP/1.1 301 Moved Permanently');
		header('Location:view_open_attendance.php?del="1"');
		
}

?>