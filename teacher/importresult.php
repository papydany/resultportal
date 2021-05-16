<?php  include_once"../function/include.php";  
       include_once"teacherfunction.php";
require_once('../vendor/php-excel-reader/excel_reader2.php');
require_once('../vendor/SpreadsheetReader.php');

lodgincheck();
include_once"../function/headerTop.php"; 
       top();
       linkh();
       navigation2();
       section2();
       ?>

       <div class="row bc">
       <?php  leftnav(); 

 if(isset($_POST['submit'])){

      list($subject_id,$subject_name) = explode(',', $_POST['subject']);
      $_SESSION['session'] = $_POST['session'];
      $yearplus =  $_SESSION['session'] + 1;
      $_SESSION['subject_id'] = $subject_id;
      $_SESSION['subject_name'] =$subject_name;
      $_SESSION['term'] = $_POST['term'];

  $student_info_all = select_student_reg_all($_SESSION['session'] ,$_SESSION['class_id'], $_SESSION['subclass'], $_SESSION['term']);

    if(count($student_info_all) == 0){


 echo $msg = "<p class='exist'> No Students is available in " .$_SESSION['term']. " &nbsp;".$_SESSION['session']. " / " .$yearplus. " session.</p>

 <a href='enter_result.php' class='btn btn-success btn-block'> Click To Go Back </a>";

}else{
      
  $allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
  
  if(in_array($_FILES["file"]["type"],$allowedFileType)){
     $targetPath = 'uploads/'.$_FILES['file']['name'];
    move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);
       
$Reader = new SpreadsheetReader($targetPath);
        
  $sheetCount = count($Reader->sheets());
        
        for($i=0;$i<$sheetCount;$i++)
        {
            $Reader->ChangeSheet($i);
            
            foreach ($Reader as $row)
            {
        $student_info = select_student_reg_with_student_no($row[0],$_SESSION['session'] ,$_SESSION['class_id'], $_SESSION['subclass'], $_SESSION['term']);

    $reg_id=$_POST['reg'][$no];
    
    $student_id=$student_info['student_id'];
    
    $ca=cleansql($row[1]);
    
    $student_no=cleansql($row[0]);
    
    $exam=cleansql($row[2]);
    
    $total=$ca + $exams;
        
    $subject=$_SESSION['subject_id'];
    
    $class_id=$_SESSION['class_id'];

    $class_category_id=$_SESSION['subclass'];
    
    $term=$_SESSION['term'];

    $session= $_SESSION['session'];

        $r = select_result($student_id,$student_no,$class_id,$class_category_id,$reg_id,$subject,$term,$session);

    if(count($r) == 0){
       //   insert result
     $insert = insert_result($student_id,$student_no,$class_id,$class_category_id,$reg_id,$subject,$ca,$exam,$total,$term,$session);
    }else{
     //  update result
      $update = update_result($student_id,$student_no,$class_id,$class_category_id,$reg_id,$subject,$ca,$exam,$total,$term,$session);
    }

            }
          }


 


}
     }
   }



       ?>
       	
       	<div class="col-sm-10 nopaddling">
	
<div class="col-sm-12" style="padding-top:15px;">

      <?php teacherBanner(); ?>
     <div class="col-sm-12 formBg">

      <div class="col-sm-12 teachheader">
                  Import Students Result
            
      </div>
      <form class="form-horizontal" method="post" action="importresult.php" enctype="multipart/form-data">
           <div class="form-group"> <label class="col-sm-2 control-label">Session</label>
            <div class="col-sm-6 col-sm-offset-2">
              <select class="form-control" name="session" id="session" required="">
               <option value=""> Select Academic Session</option>
               <?php
                    for ($year = (date('Y')); $year >= 2012; $year--) {
                        $yearnext =$year+1;
                         echo "<option value=\"$year\">$year/$yearnext</option>\n";
                            
                            }
                 ?> 


            </select>

           </div>
     </div>
     

      <div class="form-group"> <label class="col-sm-2 control-label">Term</label>
          <div class="col-sm-6 col-sm-offset-2">
              <select class="form-control" name="term" id="term" required="">
                    <option value=""> Select Academic Term</option>
                    <option value="First Term">First Term</option>
                    <option value="Second Term">Second Term</option>
                    <option value="Third Term">Third Term</option>
              </select>

           </div>
     </div>


      <div class="form-group"> <label class="col-sm-2 control-label">Subject</label>
            <div class="col-sm-6 col-sm-offset-2">
              <select class="form-control" name="subject" id="subject" required="">
               <option value=""> Select Subject</option>
               <?php
               $conn = db();
               $subject=mysqli_query($conn,"select * from subject order by subject_name") or die(mysqli_error($conn));

              while( $r=mysqli_fetch_assoc($subject)){
                  unset($_SESSION['subject_id'], $_SESSION['term'],$_SESSION['session'],$_SESSION['subject_name']);
                  


                 echo' <option value="'.$r['subject_id'].','.$r['subject_name'].'"> '.$r['subject_name'].'</option>';
              }
                   
                 ?> 


            </select>

           </div>
     </div>

    <div class="form-group"> 
    <label class="col-sm-2 control-label">Import file</label>
            <div class="col-sm-6 col-sm-offset-2">
            <h3>Import format,student number, ca score, exams score</h3>
                <input type="file" name="file"
                    id="file" accept=".xls,.xlsx" class="form-control">
                  </div>
                </div>
     <div class="form-group">
         <div class="col-sm-6 col-sm-offset-4">
              <input type="submit" name="submit" class="btn btn-warning" id="enter_result" value="Submit">

          </div>
    </div>
     
      </form>
    </div>

</div>
       	</div>

       </div>

<?php
       footer2();
       ?>
    