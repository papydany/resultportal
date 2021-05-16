<?php  include_once"../function/include.php";  
       include_once"adminFunction.php";
       admincheck();
      
      

        $conn =db();
       if(isset($_POST['update'])){
        $id = cleansql($_POST['id']);
        $all = cleansql($_POST['all']);
        $first =cleansql( $_POST['first_instalment']);
        $second =cleansql( $_POST['second_instalment']);
        $third= cleansql($_POST['third_instalment']);
        $query ="UPDATE fess_setup SET all_payment ='".$all."',first_instalment ='".$first."',second_instalment ='".$second."',third_instalment ='".$third."' WHERE id='".$id."'";
       $sql = mysqli_query($conn,$query) or die(mysqli_error($conn));
       if($sql){
       header('location:view_school_fess_setup.php?es=1');
     }else{
      header('location:view_school_fess_setup.php?es=0');
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
         <div class="col-sm-12 headbanner">Edit School Fess Setup <a href="school_fess_setup.php" class="btn btn-danger btn-sm navbar-right">Back To School Fess Setup</a></div>';

         if(isset($_GET['s'])){
             

              $query="SELECT * FROM fess_setup WHERE id='".$_GET['s']."'";
              $sql=mysqli_query($conn,$query) or die(mysqli_error($conn));
              if(mysqli_num_rows($sql) != 0){
                while($r=mysqli_fetch_assoc($sql)){

            $next_session =$r['sessional'] + 1;
            $cl = select_schedule($r['fess_schedules_id']);
                     echo'<div class="col-sm-12 formBg" style="padding-top:15px;">

                    
                     <form class="form-group" method="post" action="edit_school_fess_setup.php">
                     <input type="hidden" name="id" value="'.$r['id'].'" />
                     <div class="col-sm-6 form-group">
                     <label>Class</label>
                     <input type="text" class="form-control" name="class" value="'.$cl['name'].'" disabled /></div>
                    
                    <div class="col-sm-6 form-group">
                    <label>Session:</label>
                    <input type="text" class="form-control" name="session" value="'.$r['sessional'].' /'.$next_session.'" disabled/></div>

                    <div class="col-sm-6 form-group">
                     <label>Term</label>
                   <input type="text" class="form-control" name="term" value="'.$r['term'].'" disabled/>
                   </div>
                    
                    <div class="col-sm-6 form-group">
                     <label>All Payment</label>
                     <input type="text" class="form-control" name="all" value="'.$r['all_payment'].'" />
                     </div>
                  
                    
                     <div class="col-sm-6 form-group">
                     <label>First Instalment</label>
                     <input type="text" class="form-control" name="first_instalment" value="'.$r['first_instalment'].'"/>
                     </div>
                  
                    
                     <div class="col-sm-6 form-group">
                     <label>Second Instalment</label>
                     <input type="text" class="form-control" name="second_instalment" value="'.$r['second_instalment'].'" /></div>

                     <div class="col-sm-6 form-group">
                     <label>Third Instalment</label>
                     <input type="text" class="form-control" name="third_instalment" value="'.$r['third_instalment'].'" /></div>
                  
        
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