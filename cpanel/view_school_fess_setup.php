<?php  include_once"../function/include.php";  
       include_once"adminFunction.php";
include_once"../function/headerTop.php";
admincheck();
       top();
       
       linkToBoostrap();
        navigation2(); 
       section2();
       ?>

       <div class="row bc">
       <?php  leftnavigation(); ?>
       	
       	<div class="col-sm-10">
	<?php 
      
   $conn = db();
    ?>
  <div class="col-sm-12 whitecolor">
    <?php
    if(isset($_GET['es'])){
      
      if($_GET['es'] == 1){
        echo" <p class='text-success'> Edith Of Student Record Successfull .</p>";
      }elseif($_GET['es'] == 0){
          echo" <p class='text-danger'>Edith  Of Student not Successfull.Please try again.</p>";
      }


    }


    ?>
    <div class="col-sm-12 headbanner">View School Fess Setup<a href="school_fess_setup.php" class="btn btn-danger btn-sm navbar-right">School Fess Setup</a></div>
  <div class="col-sm-12 formBg2" style="margin-bottom:20px;">
       <form class="form-group" method="post" action="view_school_fess_setup.php">
     <div class="col-sm-3">    
        <label>Term</label> 
        <select class="form-control" name="term" required>
                    <option value=""> Select Academic Term</option>
                    <option value="First Term">First Term</option>
                    <option value="Second Term">Second Term</option>
                    <option value="Third Term">Third Term</option>
              </select>
                  </div>              



               <div class="col-sm-3">
                      <label>Session</label>
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

              <div class="col-sm-2">
                  <br/> <input type="submit" value="Continue" name="submit" class="btn btn-primary">
              </div>

       </form>

  </div>
<?php
if(isset($_POST['submit'])){
    $conn =db();
    $session = cleansql($_POST['session']);
    $next_session =$session + 1;
    $term = cleansql($_POST['term']);
 $query = "SELECT * from  fess_setup  WHERE term = '$term' && sessional ='$session' ORDER BY class_id ASC";
  $sql = mysqli_query( $conn, $query) or die(mysqli_error($conn));

     if(mysqli_num_rows($sql) == 0){

      echo"<p>&nbsp;</p><p class='error'> No School fess setup  is available.</p>";
     }else{
    
      $sn =0;

        $to =mysqli_num_rows($sql);
      echo"<div class='col-sm-12' style='background-color:#ccc;padding-top:10px;'>
      <p><b>Term :&nbsp;</b>".$term."&nbsp;&nbsp;&nbsp;
      <b>Session:&nbsp;</b>".$session." / ".$next_session ."
      </p></div>";

      echo "<table class='table table-striped table-bordered'>
      <tr class='success'><th>S/N</th>
      <th>Schedule </th>
      <th>Section </th>
      <th> All Amount </th>
      <th>First Instalment</th>
      <th>Second Instalment</th>
      
      <th>Third Instalment</th>
     
      <th colspan='2'>Action</th></tr>";
    
      //echo $to;
      
     
     while ($r = mysqli_fetch_assoc($sql)) {
       $cl = select_schedule($r['fess_schedules_id']);
       
    $sn++;
     echo"<tr> <td>$sn</td>
     <td>".$cl['name']."</td>
     <td>"; if($r['section'] == 1)
    {echo' All';}
     elseif($r['section'] == 2)
      {echo' Junior ';}
        elseif($r['section'] == 3)
        {
      echo 'Senior';
        }
        echo " Section</td>
      <td>";
      if($r['all_payment'] != null) { echo number_format($r['all_payment']);}
      echo" </td>
      <td>";
      if($r['first_instalment'] != null) {echo number_format($r['first_instalment']); }
      echo "</td>
      <td>";
      if($r['second_instalment'] != null) { echo number_format($r['second_instalment']);}
      echo "</td>
      <td>";
      if($r['third_instalment'] != null){ echo number_format($r['third_instalment']);}
      echo '</td>
      <td><a href="edit_school_fess_setup.php?s='.$r['id'].'" class="btn btn-primary btn-xs">Edit</a></td>
      <td><a href="#" class="btn btn-danger btn-xs">Delete</a></td></tr>';
      
     }
echo "</table>";

     }
   }
       ?>
</div>
<div>

       	</div>

       </div>

<?php
       footer2();
       ?>


