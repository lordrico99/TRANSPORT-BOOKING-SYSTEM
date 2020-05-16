<?php
require('db.inc.php');
$msg="";
$msgp="";
if(isset($_POST['email']) && isset($_POST['password'])){
	$email=mysqli_real_escape_string($con,$_POST['email']);
	$password=mysqli_real_escape_string($con,$_POST['password']);
	$res=mysqli_query($con,"select * from employee where email='$email' and password='$password'");
	$count=mysqli_num_rows($res);
	if($count>0){
		$row=mysqli_fetch_assoc($res);
		$_SESSION['ROLE']=$row['role'];
		$_SESSION['USER_ID']=$row['id'];
      $_SESSION['USER_NAME']=$row['lname'];
		header('location:index.php');
		die();
	}else{
      $msg="Please enter correct login details";
      $msgp="Forgotten Password";
	}
}
?>	
<!doctype html>
<html class="no-js" lang="">
   <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Login Page</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="assets/css/normalize.css">
      <link rel="stylesheet" href="assets/css/bootstrap.min.css">
      <link rel="stylesheet" href="assets/css/font-awesome.min.css">
      <link rel="stylesheet" href="assets/css/themify-icons.css">
      <link rel="stylesheet" href="assets/css/pe-icon-7-filled.css">
      <link rel="stylesheet" href="assets/css/flag-icon.min.css">
      <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
      <link rel="stylesheet" href="assets/css/style.css">
      <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
   </head>
   <body class="bg-dark" style="background-image: url('images/fullback.jpg');
              background-repeat: no-repeat; background-position: center; 
              background-size: cover;">
      <div class="sufee-login d-flex align-content-center flex-wrap">
         <div class="container">
            <div class="login-content">
               <div class="login-form mt-150"style="height: 300px;">
                  <form method="post">
                  <div class="form-group" style="float: right;margin-top: 0px;font-size: 14px;font-family: 
                              MingLiU_HKSCS-ExtB;"><a href='add_employee.php'>Sign Up here!!!</a>
                  </div>
                     <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Enter your Email" required>
                     </div>
                     <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Enter your Password" required>
                     </div>

                     <div class="form-group"style="width: 200px; float:right;">
                     <button type="submit" class="btn btn-primary">Sign in</button>
                     </div>
                     <div class="form-group"style="width: 200px; float:left;">
                     <button type="reset" class="btn btn-Danger">Clear</button>
                      </div>
                      <div class="result_msg" style="float: left;margin-top: 0px;font-size: 14px;font-family: themify;"><?php echo $msg?></div>
                      <div class="form-group" style="float: right;margin-top: 0px;font-size: 14px;font-family: 
                              MingLiU_HKSCS-ExtB;"><a href='forgotten_password.php'><?php echo $msgp?></a>
                  </div>

					</form>
               </div>
            </div>
         </div>
      </div>
      <script src="assets/js/vendor/jquery-2.1.4.min.js" type="text/javascript"></script>
      <script src="assets/js/popper.min.js" type="text/javascript"></script>
      <script src="assets/js/plugins.js" type="text/javascript"></script>
      <script src="assets/js/main.js" type="text/javascript"></script>
   </body>
</html>