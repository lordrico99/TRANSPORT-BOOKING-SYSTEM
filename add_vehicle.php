<?php
require('top.inc.php');
$vehicle='';
$plate_no='';
$capacity='';
$description='';
$id='';
if(isset($_GET['id'])){
	$id=mysqli_real_escape_string($con,$_GET['id']);
	if($_SESSION['ROLE']==2 && $_SESSION['USER_ID']!=$id){
		die('Access denied');
	}
	$res=mysqli_query($con,"select * from vehicles where id='$id'");
	$row=mysqli_fetch_assoc($res);
    $vehicle=$row['vehicle'];
    $plate_no=$row['plate_no'];
	$capacity=$row['capacity'];
	$description=$row['description'];
}
if(isset($_POST['submit'])){
    $vehicle=mysqli_real_escape_string($con,$_POST['vehicle']);
    $plate_no=mysqli_real_escape_string($con,$_POST['plate_no']);
	$capacity=mysqli_real_escape_string($con,$_POST['capacity']);
	$description=mysqli_real_escape_string($con,$_POST['description']);
	if($id>0){
		$sql="update vehicles set vehicle='$vehicle',plate_no='$plate_no',capacity='$capacity',description='$description' where id='$id'";
	}else{
		$sql="insert into vehicles(vehicle,plate_no,capacity,description,role) values('$vehicle','$plate_no','$capacity','$description','1')";
	}
	mysqli_query($con,$sql);
	header('location:vehicle.php');
	die();
}
?>
<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Vehicles Form</strong></div>
                        <div class="card-body card-block">
                           <form method="post">
						   <table width="100%" height="100%" border="0" align="center">
						    <tr>
								<td width="50" height="50">
							    <div class="form-group"style="width: auto;">
									<label class=" form-control-label">Vehicle</label>
									<input type="text" value="<?php echo $vehicle?>" name="vehicle" placeholder="Enter vehicle name" class="form-control" required>
                                </div>
								</td>
								<td width="10" height="50">
								</td>

								<td width="50" height="50">
                                <div class="form-group"style="width: auto;">
									<label class=" form-control-label">Plate Number</label>
									<input type="text" value="<?php echo $plate_no?>" name="plate_no" placeholder="Enter vehicle late number" class="form-control" required>
								</div>
								</td>
							</tr>
							
						    <tr>
								<td width="50" height="50">						
								<div class="form-group"style="width:auto;">
									<label class=" form-control-label">Capacity</label>
									<input type="text" value="<?php echo $capacity?>" name="capacity" placeholder="Enter vehicle capacity/seats" class="form-control" required>
								</div>
								</td>

								<td width="10" height="50">
								</td>

								<td width="50" height="50">		
								<div class="form-group"style="width: auto; height: auto;">
									<label class=" form-control-label">Description</label>
									<textarea id="description" value="<?php echo $description?>" name="description" rows="1" cols="10" placeholder="Enter Vehicle Description" class="form-control" required></textarea>
								</div>
								</td>
								
							</tr>
						   </table>
						   		<div class="form-group" style="width: 100px; float:right;">
									<?php if($_SESSION['ROLE']==1){?>
										<button  type="submit" name="submit" class="btn btn-lg btn-info btn-block">
										<span id="payment-button-amount">Submit</span>
										</button>
									<?php } ?>
								</div>
							  </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
                  
<?php
require('footer.inc.php');
?>