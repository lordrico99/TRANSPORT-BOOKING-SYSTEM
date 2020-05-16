<?php
require('top.inc.php');

if(isset($_POST['submit'])){
	$request_id=mysqli_real_escape_string($con,$_POST['request_id']);
	$destination=mysqli_real_escape_string($con,$_POST['destination']);
	$from_time=mysqli_real_escape_string($con,$_POST['from_time']);
	$to_time=mysqli_real_escape_string($con,$_POST['to_time']);
	$book_date=mysqli_real_escape_string($con,$_POST['book_date']);
	$passengers=mysqli_real_escape_string($con,$_POST['passengers']);
	$vehicles_no=mysqli_real_escape_string($con,$_POST['vehicles_no']);
	$description=mysqli_real_escape_string($con,$_POST['description']);
	$employee_id=$_SESSION['USER_ID'];
	$sql="insert into `requests`(request_id,destination,from_time,to_time,book_date,passengers,vehicles_no,description,employee_id,request_status) values('$request_id','$destination','$from_time','$to_time','$book_date','$passengers','$vehicles_no','$description','$employee_id',1)";
	mysqli_query($con,$sql);
	header('location:requests.php');
	die();
}
?>
<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Transport Requesition Form</strong></div>
                        <div class="card-body card-block">
                           <form method="post">
								   
						   		<div class="form-group">
									<label class=" form-control-label">Request Purpose</label>
									<select name="id" required class="form-control">
										<option value="">Select Purpose</option>
										<?php
										$res=mysqli_query($con,"select * from requests_purpose order by purpose desc");
										while($row=mysqli_fetch_assoc($res)){
											echo "<option value=".$row['id'].">".$row['purpose']."</option>";
										}
										?>
									</select>
								</div>

								<div class="form-group">
									<label class=" form-control-label">Service Level Of Agreement (SLA)</label>
									<select name="id" required class="form-control">
										<option value="">Select SLA</option>
										<?php
										$res=mysqli_query($con,"select * from sla order by id desc");
										while($row=mysqli_fetch_assoc($res)){
											echo "<option value=".$row['id'].">".$row['sla']."</option>";
										}
										?>
									</select>
								</div>

								<div class="form-group">
									<label class=" form-control-label">Request Type</label>
									<select name="id" required class="form-control">
										<option value="">Select Request Type</option>
										<?php
										$res=mysqli_query($con,"select * from requests_type order by requests_type desc");
										while($row=mysqli_fetch_assoc($res)){
											echo "<option value=".$row['id'].">".$row['requests_type']."</option>";
										}
										?>
									</select>
								</div>

								<div class="form-group">
									<label class=" form-control-label">Destination</label>
									<input type="text" name="destination" class="form-control" required>
								</div>

								<div class="form-group">
									<label class=" form-control-label">Request Date</label>
									<input type="text" name="book_date" readonly="readonly" class="form-control" required>
								</div>

							   <div class="form-group">
									<label class=" form-control-label">From Date</label>
									<input type="datetime-local" name="leave_from"  class="form-control" required>
								</div>

								<div class="form-group">
									<label class=" form-control-label">To Date</label>
									<input type="datetime-local" name="leave_to" class="form-control" required>
								</div>

								<div class="form-group">
									<label class=" form-control-label">Passengers</label>
									<input type="text" name="passengers" class="form-control" required>
								</div>

								<div class="form-group">
									<label class=" form-control-label">Number Of Vehicles</label>
									<input type="text" name="vehicles_no" class="form-control" required>
								</div>

								<div class="form-group">
									<label class=" form-control-label">Leave Description</label>
									<textarea id="description" name="description" rows="5" cols="30" placeholder="Description" class="form-control"></textarea>
                                </div>
                                
								 <button  type="submit" name="submit" class="btn btn-lg btn-info btn-block">
							   <span id="payment-button-amount">Submit</span>
							   </button>
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