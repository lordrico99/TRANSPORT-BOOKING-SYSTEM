<?php
require('top.inc.php');

if(isset($_GET['type']) && $_GET['type']=='delete' && isset($_GET['id'])){
	$id=mysqli_real_escape_string($con,$_GET['id']);
	mysqli_query($con,"delete from `requests` where id='$id'");
}
if(isset($_GET['type']) && $_GET['type']=='update' && isset($_GET['id'])){
	$id=mysqli_real_escape_string($con,$_GET['id']);
	$status=mysqli_real_escape_string($con,$_GET['status']);
	mysqli_query($con,"update `requests` set request_status='$status' where id='$id'");
}
if($_SESSION['ROLE']==1){ 
	$sql="select `requests`.*, employee.fname,employee.lname,employee.telephone,employee.block_id,employee.office_no,employee.department_id,employee.id as eid from `requests`,employee where `requests`.employee_id=employee.id order by `requests`.id asc";
}else{
	$eid=$_SESSION['USER_ID'];
	$sql="select `requests`.*, employee.fname,employee.lname,employee.telephone,employee.block_id,employee.office_no,employee.department_id,employee.id as eid from `requests`,employee where `requests`.employee_id='$eid' and `requests`.employee_id=employee.id order by `requests`.id asc";
}
$res=mysqli_query($con,$sql);
?>
<div class="content pb-0">
            <div class="orders">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="card">
                        <div class="card-body">
                           <h4 class="box-title">Requests</h4>
						    <?php if($_SESSION['ROLE']==2){ ?>
						   <h4 class="box_title_link"><a href="add_request.php">Add Request</a> </h4>
						   <?php } ?>
                        </div>
                        <div class="card-body--">
                           <div class="table-stats order-table ov-h">
                              <table class="table ">
                                 <thead>
                                    <tr>
                                       <th width="5%">S.No</th>
									   <th width="5%">ID</th>
									   <th width="5%">Purpose</th>
									   <th width="5%">SLA</th>
									   <th width="5%">Request Type</th>
									   <th width="5%">Name</th>
                                       <th width="5%">Surname</th>
									   <th width="5%">Tel</th>
									   <th width="5%">Block</th>
									   <th width="5%">Department</th>
                                       <th width="5%">Office</th>
                                       <th width="5%">Destination</th>
                                       <th width=5%">From</th>
									   <th width="5%">To</th>
									   <th width="5%">Date</th>
                                       <th width=5%">Passengers</th>
                                       <th width=5%">NO# Vehicles</th>
									   <th width="5%">Description</th>
									   <th width="5%">Status</th>
									   <th width="5%">Action</th>
									  
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php 
									$i=1;
									while($row=mysqli_fetch_assoc($res)){?>
									<tr>
                                       <td><?php echo $i?></td>
									   <td><?php echo $row['id']?></td>
									   <td><?php echo $row['request_purpose']?></td>
									   <td><?php echo $row['sla_id']?></td>
									   <td><?php echo $row['requests_type']?></td>
									   <td><?php echo $row['fname']?></td>
									   <td><?php echo $row['lname']?></td>
									   <td><?php echo $row['telephone']?></td>
									   <td><?php echo $row['block_id']?></td>
									    <td><?php echo $row['department_id']?></td>
									   <td><?php echo $row['office_no']?></td>
									  
                                       <td><?php echo $row['destination']?></td>
									   <td><?php echo $row['from_time']?></td>
									   <td><?php echo $row['to_time']?></td>
									   <td><?php echo $row['book_date']?></td>
									   <td><?php echo $row['passengers']?></td>
									   <td><?php echo $row['vehicles_no']?></td>
									   <td><?php echo $row['description']?></td>
									   <td>
										   <?php
												if($row['request_status']==1){
													echo "Requested";
												}if($row['request_status']==2){
													echo "Approved";
												}if($row['request_status']==3){
													echo "Rejected";
												}if($row['request_status']==4){
													echo "Postponed";
												}
										   ?>

										   <?php if($_SESSION['ROLE']==1){ ?>
												<select class="form-control" onchange="update_request_status('<?php echo $row['id']?>',this.options[this.selectedIndex].value)">
													<option value="">Update Status</option>
													<option value="2">Approved</option>
													<option value="3">Rejected</option>
													<option value="4">Postponed</option>
												</select>
										   <?php } ?>
									   </td>
									   	<td>
												<?php if($_SESSION['ROLE']==2){ ?>
													<a href="add_request.php?id=<?php echo $row['id']?>">Edit</a> 
													<a href="requests.php?id=<?php echo $row['id']?>&type=delete">Delete</a>
												<?php } else { ?>
													<a href="requests.php?id=<?php echo $row['id']?>&type=delete">Delete</a>
													<?php } ?>
									   </td>

                                    </tr>
									<?php 
									$i++;
									} ?>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
		  </div>
         <script>
		 function update_request_status(id,select_value){
			window.location.href='requests.php?id='+id+'&type=update&status='+select_value;
		 }
		 </script>
<?php
require('footer.inc.php');
?>