<?php error_reporting(E_ALL);
ini_set("display_errors", 1);
  include_once"../function/include.php";  
  include_once"adminFunction.php";
 admincheck();
 include_once"../function/headerTop.php";
      
       
        top();
       linkToBoostrap();
       navigation2();
       section2();
       ?>

       <div class="row bc">
       <?php  leftnavigation(); ?>
       	
       	<div class="col-sm-10">

        <div class="col-sm-12 whitecolor">
           <div class="col-sm-12 headbanner" style="margin-bottom:15px;"> Fess Setup <a href="view_school_fess_setup.php" class="btn btn-danger btn-sm navbar-right">View  Fess Setup</a></div>
           <?php if(isset($_GET['s'])){ echo $_GET['s']; } ?>
                     <form class="form-horizontal" method="post" action="school_fess_setup_processing.php">
 <div class="form-group"> <label class="col-sm-3 control-label">Term</label>
          <div class="col-sm-6">
              <select class="form-control" name="term" required>
                    <option value=""> Select Academic Term</option>
                    <option value="First Term">First Term</option>
                    <option value="Second Term">Second Term</option>
                    <option value="Third Term">Third Term</option>
              </select>

           </div>
     </div>
     <div class="form-group"> <label class="col-sm-3 control-label">Section</label>
          <div class="col-sm-6">
              <select class="form-control" name="section" required>
                    <option value=""> Select Section</option>
                    <option value="1">All Section</option>
                    <option value="2">Junior Section</option>
                    <option value="3">Senior Section</option>
              </select>

           </div>
     </div>
<div class=" form-group">
      <label class="col-sm-3 control-label">Select Schedules</label>
      <div class="col-sm-6">
    <select class='form-control' name="schedule" required>

                        <option value="">-----  Select  Schedules   -------</option>";
                         
                         <?php  $conn = db(); $ac = mysqli_query($conn, 'SELECT * FROM fess_schedules');
                          while( $l=mysqli_fetch_assoc($ac) ) {
                                    
                        ?>
                            <option value="<?php echo $l['id']; ?>"><?php echo $l['name'];?></option>
                            
                      <?php } ?>

                  </select>
                </div>
              </div>

           <div class="form-group"> <label class="col-sm-3 control-label">Session</label>
            <div class="col-sm-6">
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
     <div class="form-group"> <label class="col-sm-3 control-label"> Fess</label>
            <div class="col-sm-6">
            <input type="number" name="all" class="form-control" value="" placeholder="Enter Amount" required/>
            </div>
     </div>

     <div class="form-group"> <label class="col-sm-3 control-label">First Instalment  Fess</label>
            <div class="col-sm-6">
            <input type="number" name="first_instalment" class="form-control" value="" placeholder="Enter First instalment Amount"/>
            </div>
     </div>
     <div class="form-group"> <label class="col-sm-3 control-label">Second Instalment  Fess</label>
            <div class="col-sm-6">
            <input type="number" name="second_instalment" class="form-control" value="" placeholder="Enter Second instalment Amount"/>
            </div>
     </div>
     <div class="form-group"> <label class="col-sm-3 control-label">Third Instalment  Fess</label>
            <div class="col-sm-6">
            <input type="number" name="third_instalment" class="form-control" value="" placeholder="Enter third instalment Amount"/>
            </div>
     </div>

     <div class="form-group">
         <div class="col-sm-6 col-sm-offset-3">
              <input type="submit" name="submit" class="btn btn-primary" id="setfess"  value="Submit">

          </div>
    </div>
     
      </form>
	
       	</div>

       </div>
     </div>

<?php
       footer2();
       ?>

      