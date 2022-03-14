<?php
session_start();
//Database Configuration File
include('../includes/config.php');
//error_reporting(0);
date_default_timezone_set('Asia/kolkata'); 
if(isset($_SESSION['user']) == 0){ 
if(isset($_POST['login']))
  {
    // Getting username/ email and password
     $email=$_POST['email'];
    $password = md5($_POST['password']);
    $lastlogin = $_POST['lastlogin'];
    // Fetch data from database on the basis of username/email and password
$sql = mysqli_query($con,"SELECT Email,Password FROM userlogin WHERE (Email='$email')");
$sql1 = mysqli_query($con,"UPDATE userlogin  SET LastLogin = '$lastlogin' WHERE (Email='$email')");
$num = mysqli_fetch_array($sql);
if($num > 0)
{
$dbpass = $num['Password']; // md5 password fething from database
//verifying Password
if ($password ==  $dbpass) {
$_SESSION['user'] =  $_POST['email'];
echo "<script type='text/javascript'> document.location = '../index'; </script>";
} else {
echo "<script>alert('Wrong Password');</script>";
  }
}
//if username or email not found in database
else{
echo "<script>alert('User not registered with us');</script>";
  }
}
}else{
    echo "<script type='text/javascript'> document.location = '../index'; </script>";
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>Login | Online News Portal</title>
		<link href="../admin/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="scripts/ionicons/css/ionicons.min.css">
		<link rel="stylesheet" href="../css/form.css">
        <style type="text/css">
            body{
                  width: 100%;
                  background: url(down.jpg);
                  background-position: center center;
                  background-repeat: no-repeat;
                  background-attachment: fixed;
                  background-size: cover;
                }
          </style>
	</head>

	<body>
		<section class="login first grey">
			<div class="container">
				<div class="box-wrapper">				
					<div class="box box-border">
						<div class="box-body">
						<center> <h5 style="font-family: Noto Sans;">Login to </h5><h4 style="font-family: Noto Sans;">Online News Portal</h4></center><br>
							<form method="post" action="login.php" enctype="multipart/form-data">
								<div class="form-group">
									<label>Enter Your Email Id:</label>
									<input type="email" name="email" class="form-control" required	>
								</div>
								<div class="form-group">
									<label class="fw">Enter Your Password:
										<a href="forgetpass.php" class="pull-right">Forgot Password?</a>
									</label>
									<input type="password" name="password" class="form-control" required>
								</div> 
								<div class="form-group text-right">
									<button class="btn btn-primary btn-block" name="login">Login</button>
								</div>
								<input type="hidden" value="<?php echo date("d-m-y h-i-s") ?>" name="lastlogin" class="form-control">

								<div class="form-group text-center">
									<span class="text-muted">Don't have an account?</span> <a href="register.php">Register</a> Here..
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>

		<script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
	</body>
</html>