<?php error_reporting(E_ALL);
ini_set("display_errors", 1);
include_once"../function/include.php";  
include_once"adminFunction.php";
include_once"../function/headerTop.php";
$msg ='';
$conn =db();
if(isset($_POST["submit"])){
$session = cleansql($_POST['session']);
$class_id = cleansql($_POST['class_id']);
$term = cleansql($_POST['term']); 
$status = cleansql($_POST['status']);
$check = check_publish_result($class_id,$term,$session,$conn);
if(mysqli_num_rows($check) < 1){ 
$query = "INSERT INTO publish_result (`class_id`,`term`,`session`,`status`) VALUES('$class_id','$term','$session','$status')";
$query = mysqli_query( $conn, $query) or die(mysqli_error($conn));
if ($query)  {
$msg = "<p class='success'>Successful :Result successful Published</p>";  
}else{
$msg = "<p class='error'>Failed : Result publishing failed. please try again</p>";
}
}else{
    $msg = "<p class='success'>Warning: Result published Already</p>"; 
}


}
admincheck();    
top();
linkToBoostrap();
navigation2();
section2();
?>
<div class="row bc">
<?php  leftnavigation(); ?>
<div class="col-sm-10">
<div class="col-sm-12 whitecolor">
<div class="col-sm-12 headbanner" style="margin-bottom:15px;">Publish Result <a href="view_publish_result.php" class="btn btn-danger btn-sm navbar-right">View Publish Result</a></div>
<?php if(!empty($msg)){ echo $msg;}?>
<form class="form-horizontal" method="post" action="publish_result.php">
 <div class="form-group"> <label class="col-sm-2 control-label">Term</label>
          <div class="col-sm-6 col-sm-offset-2">
              <select class="form-control" name="term" required>
                    <option value=""> Select Academic Term</option>
                    <option value="First Term">First Term</option>
                    <option value="Second Term">Second Term</option>
                    <option value="Third Term">Third Term</option>
              </select>

           </div>
     </div>
<div class=" form-group">
      <label class="col-sm-2 control-label">Select Class</label>
      <div class="col-sm-6 col-sm-offset-2">
    <select class='form-control' name="class_id" id="class" required>

                        <option value="">-----  Select  class   -------</option>";
                         
                         <?php  $conn = db(); $ac = mysqli_query($conn, 'SELECT * FROM class');
                          while( $l=mysqli_fetch_assoc($ac) ) {
                                    
                        ?>
                            <option value="<?php echo $l['class_id']; ?>"><?php echo $l['class_name'];?></option>
                            
                      <?php } ?>

                  </select>
                </div>
              </div>

    
       

           <div class="form-group"> <label class="col-sm-2 control-label">Session</label>
            <div class="col-sm-6 col-sm-offset-2">
              <select class="form-control" name="session" required>
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
     <div class="form-group"> <label class="col-sm-2 control-label">School Fess Status</label>
          <div class="col-sm-6 col-sm-offset-2">
              <select class="form-control" name="status" required>
                    <option value=""> Select </option>
                    <option value="1">Allow every body</option>
                    <option value="2">Allow half payment</option>
                    <option value="3">Allow full payment</option>
              </select>

           </div>
     </div>

     <div class="form-group">
         <div class="col-sm-4 col-sm-offset-4">
              <input type="submit" name="submit" class="btn btn-warning"  value="Publish Result">

          </div>

         
    </div>
     
      </form>
	
       	</div>

       </div>
     </div>

<?php
       footer2();
       ?>

      