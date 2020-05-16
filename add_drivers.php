<?php
require('top.inc.php');
$fname='';
$lname='';
$email='';
$mobile='';
$id='';
if(isset($_GET['id'])){
	$id=mysqli_real_escape_string($con,$_GET['id']);
	if($_SESSION['ROLE']==2 && $_SESSION['USER_ID']!=$id){
		die('Access denied');
	}
	$res=mysqli_query($con,"select * from drivers where id='$id'");
	$row=mysqli_fetch_assoc($res);
    $fname=$row['fname'];
    $lname=$row['lname'];
	$email=$row['email'];
	$mobile=$row['mobile'];
}
if(isset($_POST['submit'])){
    $fname=mysqli_real_escape_string($con,$_POST['fname']);
    $lname=mysqli_real_escape_string($con,$_POST['lname']);
	$email=mysqli_real_escape_string($con,$_POST['email']);
	$mobile=mysqli_real_escape_string($con,$_POST['mobile']);
	if($id>0){
		$sql="update drivers set fname='$fname',lname='$lname',email='$email',mobile='$mobile' where id='$id'";
	}else{
		$sql="insert into drivers(fname,lname,email,mobile,role) values('$fname','$lname','$email','$mobile','2')";
	}
	mysqli_query($con,$sql);
	header('location:drivers.php');
	die();
}
?>
<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Drivers Form</strong></div>
                        <div class="card-body card-block">
                           <form method="post">
						   <table width="100%" height="100%" border="0" align="center">
						    <tr>
								<td width="50" height="50">
									<div class="form-group">
										<label class=" form-control-label">First Name</label>
										<input type="text" value="<?php echo $fname?>" name="fname" placeholder="Enter driver name" class="form-control" required>
									</div>
								</td>
								<td width="10" height="50">
								</td>

								<td width="50" height="50">
                                <div class="form-group">
									<label class=" form-control-label">Last Name</label>
									<input type="text" value="<?php echo $lname?>" name="lname" placeholder="Enter driver surname" class="form-control" required>
								</div>
								</td>
							</tr>
							
						    <tr>
								<td width="50" height="50">						
								<div class="form-group">
									<label class=" form-control-label">Email</label>
									<input type="email" value="<?php echo $email?>" name="email" placeholder="Enter driver email" class="form-control" required>
								</div>
								</td>
								<td width="10" height="50">
								</td>
								<td width="50" height="50">		
								<div class="form-group">
									<label class=" form-control-label">Mobile</label>
									<input type="text" value="<?php echo $mobile?>" name="mobile" placeholder="Enter driver mobile" class="form-control" required>
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