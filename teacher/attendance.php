<?php  include_once"../function/include.php";  
       include_once"teacherfunction.php";

lodgincheck();
include_once"../function/headerTop.php"; 
       top();
       linkh();
       navigation2();
       section2();
       ?>

       <div class="row bc">
       <?php  leftnav(); ?>
       	
       	<div class="col-sm-10 nopaddling">
	
<div class="col-sm-12" style="padding-top:15px;">

      <?php teacherBanner(); ?>
     <div class="col-sm-12 formBg">

      <div class="col-sm-12 teachheader">
                  Class Attendance
            
      </div>
      <form class="form-horizontal" method="post" action="attendanceform.php">
           <div class="form-group"> <label class="col-sm-2 control-label">Session</label>
            <div class="col-sm-6 col-sm-offset-2"><select class="form-control" name="session" required="">
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
              <select class="form-control" name="term" required="">
                    <option value=""> Select Academic Term</option>
                    <option value="First Term">First Term</option>
                    <option value="Second Term">Second Term</option>
                    <option value="Third Term">Third Term</option>
              </select>

           </div>
     </div>


      
     </div>
     <div class="form-group">
         <div class="col-sm-6 col-sm-offset-4">
              <input type="submit" name="submit" class="btn btn-warning"  value="Continue">

          </div>
    </div>
     
      </form>
    </div>

</div>
       	</div>

       </div>

<?php footer2(); ?>
    