<?php  include_once"../function/include.php";  
       include_once"teacherfunction.php";

lodgincheck();
include_once"../function/headerTop.php"; 
       top();
       linkh();
       navigation2();
       section2();

       if( !empty($_GET['open'] ) ) {
       	$conn =db();
$query ='SELECT * FROM open_attendance WHERE id='.$_GET['open'];

$s = mysqli_query($conn,$query) or die(mysqli_error($conn));
$r=mysqli_fetch_assoc($s);

}
       ?>

       <div class="row bc">
       <?php  leftnav(); ?>
       	
       	<div class="col-sm-10 nopaddling">
	
<div class="col-sm-12" style="padding-top:15px;">

      <?php teacherBanner(); ?>
     <div class="col-sm-12 formBg">

      <div class="col-sm-12 teachheader">
                Edit  Opening Class Attendance
            
      </div>
      <form class="form-horizontal" method="post" action="update_open_attendance.php">

     

    

        <div class="form-group"> <label class="col-sm-4 control-label">Opening Class Attendance</label>
          <div class="col-sm-6">
          	<input type="hidden" name="id" class="form-control" value="<?php echo $r['id']; ?>">
             <input type="number" name="open" class="form-control" value="<?php echo $r['open']; ?>" required="">

           </div>
     </div>


      
     </div>
     <div class="form-group">
         <div class="col-sm-6 col-sm-offset-4">
              <input type="submit" name="submit" class="btn btn-warning"  value="Update">

          </div>
    </div>
     
      </form>
    </div>

</div>
       	</div>

       </div>

<?php footer2(); ?>
    