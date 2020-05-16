<?php
require('top.inc.php');
$fname='';
$lname='';
$email='';
$telephone='';
$department_id='';
$sla_id='';
$block_id='';
$office_no='';
$id='';
if(isset($_GET['id'])){
	$id=mysqli_real_escape_string($con,$_GET['id']);
	if($_SESSION['ROLE']==2 && $_SESSION['USER_ID']!=$id){
		die('Access denied');
	}
	$res=mysqli_query($con,"select * from employee where id='$id'");
	$row=mysqli_fetch_assoc($res);
	$fname=$row['fname'];
	$lname=$row['lname'];
	$email=$row['email'];
	$telephone=$row['telephone'];
	$department_id=$row['department_id'];
	$sla_id=$row['sla_id'];
	$block_id=$row['block_id'];
	$office_no=$row['office_no'];
}
if(isset($_POST['submit'])){
	$fname=mysqli_real_escape_string($con,$_POST['fname']);
	$lname=mysqli_real_escape_string($con,$_POST['lname']);
	$email=mysqli_real_escape_string($con,$_POST['email']);
	$telephone=mysqli_real_escape_string($con,$_POST['telephone']);
	$password=mysqli_real_escape_string($con,$_POST['password']);
	$department_id=mysqli_real_escape_string($con,$_POST['department_id']);
	$sla_id=mysqli_real_escape_string($con,$_POST['sla_id']);
	$block_id=mysqli_real_escape_string($con,$_POST['block_id']);
	$office_no=mysqli_real_escape_string($con,$_POST['office_no']);
	if($id>0){
		$sql="update employee set fname='$fname',lname='$lname',email='$email',telephone='$telephone',password='$password',department_id='$department_id',sla_id='$sla_id',block_id='$block_id',office_no='$office_no' where id='$id'";
	}else{
		$sql="insert into employee(fname,lname,email,telephone,password,department_id,sla_id,block_id,office_no,role) values('$fname','$lname','$email','$telephone','$password','$department_id','$sla_id','$block_id','$office_no','2')";
	}
	mysqli_query($con,$sql);
	header('location:employee.php');
	die();
}
?>
<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Details</strong></div>
                        <div class="card-body card-block">
                           <form method="post">
						   <table width="100%" height="50%" border="0" align="center">
						    <tr>
								<td width="50" height="50">
								<div class="form-group">
									<label class=" form-control-label">First Name</label>
									<input type="text" value="<?php echo $fname?>" name="fname" placeholder="Enter employee name" class="form-control" required>
								</div>
								</td>
								<td width="10" height="50">
								</td>
								<td width="50" height="50">
								<div class="form-group">
									<label class=" form-control-label">Last Name</label>
									<input type="text" value="<?php echo $lname?>" name="lname" placeholder="Enter employee surname" class="form-control" required>
								</div>
								</td>
								<td width="10" height="50">
								</td>
								<td width="50" height="50">
								<div class="form-group">
									<label class=" form-control-label">Email</label>
									<input type="email" value="<?php echo $email?>" name="email" placeholder="Enter employee email" class="form-control" required>
								</div>
								</td>
							</tr>
							
							<tr>
								<td width="50" height="50">
								<div class="form-group">
									<label class=" form-control-label">Telephone/EXT</label>
									<input type="text" value="<?php echo $telephone?>" name="telephone" placeholder="Enter employee telephone/extension" class="form-control" required>
								</div>
								</td>
								<td width="10" height="50">
								</td>
								<td width="50" height="50">
								<div class="form-group">
									<label class=" form-control-label">Password</label>
									<input type="password"  name="password" placeholder="Enter employee password" class="form-control" required>
								</div>
								</td>
								<td width="10" height="50">
								</td>
								<td width="50" height="50">
								<div class="form-group">
									<label class=" form-control-label">Department</label>
									<select name="department_id" required class="form-control">
										<option value="">Select Department</option>
										<?php
										$res=mysqli_query($con,"select * from department order by department desc");
										while($row=mysqli_fetch_assoc($res)){
											if($department_id==$row['id']){
												echo "<option selected='selected' value=".$row['id'].">".$row['department']."</option>";
											}else{
												echo "<option value=".$row['id'].">".$row['department']."</option>";
											}
										}
										?>
									</select>
								</div>
								</td>
							</tr>
							<tr>
								<td width="50" height="50">
								<div class="form-group">
									<label class=" form-control-label">SLA</label>
									<select name="sla_id" required class="form-control">
										<option value="">Select SLA</option>
										<?php
										$res=mysqli_query($con,"select * from sla order by sla desc");
										while($row=mysqli_fetch_assoc($res)){
											if($sla_id==$row['id']){
												echo "<option selected='selected' value=".$row['id'].">".$row['sla']."</option>";
											}else{
												echo "<option value=".$row['id'].">".$row['sla']."</option>";
											}
										}
										?>
									</select>
								</div>
								</td>
								<td width="10" height="50">
								</td>
								<td width="50" height="50">
								<div class="form-group">
									<label class=" form-control-label">Block/Building</label>
									<select name="block_id" required class="form-control">
										<option value="">Select Building</option>
										<?php
										$res=mysqli_query($con,"select * from building order by block desc");
										while($row=mysqli_fetch_assoc($res)){
											if($block_id==$row['id']){
												echo "<option selected='selected' value=".$row['id'].">".$row['block']."</option>";
											}else{
												echo "<option value=".$row['id'].">".$row['block']."</option>";
											}
										}
										?>
									</select>
								</div>
								</td>
								<td width="10" height="50">
								</td>
								<td width="50" height="50">
								<div class="form-group">
									<label class=" form-control-label">Office</label>
									<input type="text" value="<?php echo $office_no?>" name="office_no" placeholder="Enter employee office number" class="form-control" required>
								</div>
								</td>
							</tr>
						   </table>
						   <div class="form-group"style="width: 100px; float:right;">
									<?php if($_SESSION['ROLE']==2 OR $_SESSION['ROLE']==1){?>
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