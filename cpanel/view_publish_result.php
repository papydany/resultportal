<?php error_reporting(E_ALL);
ini_set("display_errors", 1);
include_once"../function/include.php";  
include_once"adminFunction.php";
include_once"../function/headerTop.php";

$conn =db();
$query = "SELECT * from  publish_result ORDER BY `session` ASC, class_id ASC ";
$sql = mysqli_query( $conn, $query) or die(mysqli_error($conn));


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
<div class="col-sm-12 headbanner" style="margin-bottom:15px;">View Publish Result <a href="publish_result.php" class="btn btn-danger btn-sm navbar-right">Publish Result</a></div>
<table class="table table-striped">
<tr>
<th>sn</th>
<th>session</th>
<th>class</th>
<th>term</th>
<th>School Fess Status</th>
</tr>
<?php 
$no =0;
if(mysqli_num_rows($sql) != 0){ 
    
    while($p =mysqli_fetch_assoc($sql)){
    $no ++;
    $cl = select_class($p['class_id']);
echo"<tr>
<th>".$no."</th>
<td>".$p['session']."</td>
<td>".$cl['class_name']."</td>
<td>".$p['term']."</td>
<td>";
if($p['status'] == 1 || $p['status'] == 0)
{
    echo 'Allowed every one';
}elseif($p['status'] == 2){
    echo 'half payment is allowed';
}
    elseif($p['status'] == 3){ echo 'only full payment';}
        echo"</td>
</tr>";
    }
}else{
echo "<p class='error'> No records available</p>";  
}
?>
</table>
</div>
</div>
</div>
<?php footer2(); ?>

      