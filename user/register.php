<?php
include('../includes/config.php');
if(isset($_POST['submit'])){
  // Checking for Empty Fields
  if(($_POST['name'] == "") || ($_POST['email'] == "") || ($_POST['date'] == "") || ($_POST['password'] == "") ){
    echo "<script>alert('All Fields are Required.');</script>";  
  } else {
      // Assigning User Values to Variable
      $rName = $_POST['name'];
      $rEmail = $_POST['email'];
      $rdate = $_POST['date'];
      $rPassword = md5($_POST['password']);
      $sql = "INSERT INTO userlogin(Name, Email, Dob, Password) VALUES ('$rName','$rEmail', '$rdate', '$rPassword')";
      if($con->query($sql) == TRUE){
        echo "<script>alert('Account Succefully Created.');</script>"; 
       echo"<script>document.location = 'login.php'</script>";  
      } else {
        echo "<script>alert('Unable to Create Account.');</script>";       
      }
    }
  }
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register || News Portal</title>
    <link href="../admin/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="scripts/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="../css/form.css">
    <style type="text/css">
    body {
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
                        <center>
                            <h5 style="font-family: Noto Sans;">Register</h5>
                            <h4 style="font-family: Noto Sans;">News Portal!!</h4>
                        </center><br>
                        <form method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Enter Your Name Id:</label>
                                <input type="name" name="name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Enter Your Email Id:</label>
                                <input type="email" name="email" id="email" onBlur="checkAvailability()" class="form-control" required>
                                <span id="user-status" style="font-size:12px;"></span>
                            </div>
                            <div class="form-group">
                                <label>Enter Your Date Of Birth:</label>
                                <input type="date" name="date" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Enter Your Password:</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Confirm Your Password:</label>
                                <input type="password" name="confpassword" id="confpassword" onBlur="valid()" class="form-control" required>
								<span id="user-status1" style="font-size:15px;"></span>
                            </div>
                            <div class="form-group text-right">
                                <button class="btn btn-primary btn-block" id="submit" name="submit">Register</button>
                            </div>
                            <div class="form-group text-center">
                                <span class="text-muted">Don't have an account?</span> <a
                                    href="register.php">Register</a> Here..
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script>
function checkAvailability() {
    $("#loaderIcon").show();
    jQuery.ajax({
        url: "validate.php",
        data: 'emailid=' + $("#email").val(),
        type: "POST",
        success: function(data) {
            $("#user-status").html(data);
            $("#loaderIcon").hide();
        },
        error: function() {}
    });
}
function valid(){
	pass = $('#password').val();
	confpass = $('#confpassword').val()
	if(pass != confpass){
		$("#user-status1").html("data");
		$('#submit').prop('disabled',true);
	}else{
		$("#user-status1").html("");
		$('#submit').prop('disabled',false);
	}	
	
}
</script>
</html>