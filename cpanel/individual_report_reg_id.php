<?php
session_start();
$_SESSION['studentlogin'] =1;
$_SESSION['S_student_no'] =$_GET['student_no'];
$_SESSION['S_class_id'] =$_GET['class_id'];
$_SESSION['S_subclass'] =$_GET['class_category_id'];
$_SESSION['S_class_option'] =$_GET['class_option_id'];
$_SESSION['S_ID'] =$_GET['student_id'];
$_SESSION['S_fullname'] =$_GET['name'];
$_SESSION['gender'] = $_GET['gender'];
$term =$_GET['term'];
$session=$_GET['session'];
//echo $_SESSION['S_student_no'];
$url ="../viewstudentresult.php?t=".$term."&year=".$session."&subclass=".$_GET['class_category_id']."&class=".$_GET['class_id'];
header("Location:".$url); 
?>