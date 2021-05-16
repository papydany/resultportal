<?php  include_once"../function/include.php";  
       include_once"adminFunction.php";
       admincheck();
      
      

        $conn =db();
       if(isset($_POST['update'])){
        $id = cleansql($_POST['id']);
        $all = cleansql(strtoUpper($_POST['schedule']));
       
        $query ="UPDATE fess_schedules SET name ='".$all."' WHERE id='".$id."'";
       $sql = mysqli_query($conn,$query) or die(mysqli_error($conn));
       if($sql){
       header('location:manage_fess_schedule.php?es=1');
     }else{
      header('location:manage_fess_schedule.php?es=0');
     }

       }
    include_once"../function/headerTop.php";
 top();
  linkToBoostrap();
       navigation2();
        section2();
       ?>
        <div class="row bc">
       
       <?php  leftnavigation(); ?>
       	
       	<div class="col-sm-10">
	<?php 

        echo'<div class="col-sm-12 whitecolor">
         <div class="col-sm-12 headbanner">Edit  Fess Schedule <a href="manage_fess_schedule.php" class="btn btn-danger btn-sm navbar-right">Back To  Fess Schedule</a></div>';

         if(isset($_GET['s'])){
             

              $query="SELECT * FROM fess_schedules WHERE id='".$_GET['s']."'";
              $sql=mysqli_query($conn,$query) or die(mysqli_error($conn));
              if(mysqli_num_rows($sql) != 0){
                while($r=mysqli_fetch_assoc($sql)){

           
           
                     echo'<div class="col-sm-12 formBg" style="padding-top:15px;">

                    
                     <form class="form-group" method="post" action="edit_fess_schedule.php">
                     <input type="hidden" name="id" value="'.$r['id'].'" />
                      
                    <div class="col-sm-6 form-group">
                     <label>Schedule</label>
                     <input type="text" class="form-control" name="schedule" value="'.$r['name'].'" />
                     </div>
                     <div class="col-sm-6">
                       <input type="submit" class="btn btn-warning " name="update" value="Update"/></div>
                       </form></div>';
                       

              }
       }





         }
       ?>
</div>
       	</div>

       </div>

<?php
       footer2();
       ?>