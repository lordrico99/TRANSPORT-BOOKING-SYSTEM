<?php
require('top.inc.php');
if($_SESSION['ROLE']!=1){
	header('location:add_employee.php?id='.$_SESSION['USER_ID']);
	die();
}
if(isset($_GET['type']) && $_GET['type']=='delete' && isset($_GET['id'])){
	$id=mysqli_real_escape_string($con,$_GET['id']);
	mysqli_query($con,"delete from vehicles where id='$id'");
}
$res=mysqli_query($con,"select * from vehicles order by id desc");
?>
<div class="content pb-0">
            <div class="orders">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="card">
                        <div class="card-body">
                           <h4 class="box-title">Vehicle Master </h4>
						   <h4 class="box_title_link"><a href="add_vehicle.php">Add Vehicle</a> </h4>
                        </div>
                        <div class="card-body--">
                           <div class="table-stats order-table ov-h">
                              <table class="table ">
                                 <thead>
                                    <tr>
                                       <th width="5%">S.No</th>
                                       <th width="5%">ID</th>
                                       <th width="15%">Vehicles</th>
                                       <th width="15%">Plate Number</th>
                                       <th width="15%">Capacity/ Seats</th>
                                       <th width="27%">Description</th>
                                       <th width="18%">Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php 
									$i=1;
									while($row=mysqli_fetch_assoc($res)){?>
									      <tr>
                                       <td><?php echo $i?></td>
                                       <td><?php echo $row['id']?></td>
                                       <td><?php echo $row['vehicle']?></td>
                                       <td><?php echo $row['plate_no']?></td>
                                       <td><?php echo $row['capacity']?></td>
                                       <td><?php echo $row['description']?></td>
									            
									            <td><a href="add_vehicle.php?id=<?php echo $row['id']?>">Edit</a> <a href="vehicle.php?id=<?php echo $row['id']?>&type=delete">Delete</a></td>
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
         
<?php
require('footer.inc.php');
?>