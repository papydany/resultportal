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
           <div class="col-sm-12 headbanner" style="margin-bottom:15px;"> Fess Schedule </div>
           <div class="col-sm-6">
           <?php 
           if(isset($_GET['es'])){
      
            if($_GET['es'] == 1){
              echo" <p class='text-success'> Edit Of Fess Schedule Successfull .</p>";
            }elseif($_GET['es'] == 0){
                echo" <p class='text-danger'>Edit  Of Fess Schedule not Successfull.Please try again.</p>";
            }
      
      
          }
           
           if(isset($_GET['s'])){ echo $_GET['s']; } ?>
                     <form class="form-horizontal" method="post" action="manage_fess_schedule_processing.php">


      
     <div class="form-group"> 
     <label class="col-sm-13 control-label"> School Fess</label>
            <div class="col-sm-12">
            <input type="text" name="schedule" class="form-control" value="" placeholder="Enter Fess Schedule" required/>
            </div>
     </div>

   
     
    

     <div class="form-group">
         <div class="col-sm-6">
              <input type="submit" name="submit" class="btn btn-primary" id="setfess"  value="Submit">

          </div>
    </div>
     
      </form>
      </div>
      <div class="col-sm-6">
     <?php 
     $conn =db();
     $fs =get_all_fess_schedule($conn);
     
?>
<table class="table table-bordered table-striped">
<tr>
<th>S/N</th>
<th>Schedule</th>
<th>Action</th>
</tr>

<?php
$t =0;
while($r =mysqli_fetch_assoc($fs))
     {
         ++$t;
echo'<tr><td>'.$t.'</td>';
echo '<td>'.$r['name'].'</td>
<td><a href="edit_fess_schedule.php?s='.$r['id'].'" class="btn btn-primary btn-xs">Edit</a></td></tr>';
     }
     ?>
     </table>
      </div>
	
       	</div>

       </div>
     </div>

<?php
       footer2();
       ?>

     