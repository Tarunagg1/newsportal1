<?php
include('../includes/config.php');
if(isset($_POST['submit'])){
  // Checking for Empty Fields
  if(($_POST['name'] == "") || ($_POST['email'] == "") || ($_POST['date'] == "") || ($_POST['password'] == "") ){
    echo "<script>alert('All Fields are Required.');</script>";  
  } else {
    $sql = "SELECT Email FROM userlogin WHERE Email='".$_POST['email']."'";
    $result = $con->query($sql);
    if($result->num_rows == 1){
        echo "<script>alert('Email ID Already Registered.');</script>";  
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
}
?>
 

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="News Portal.">
        <meta name="author" content="PHPGurukul">


        <!-- App title -->
        <title>News Portal | Admin Panel</title>

        <!-- App css -->
        <link href="../admin/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../admin/assets/css/core.css" rel="stylesheet" type="text/css" />
        <link href="../admin/assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="../admin/assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="../admin/assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="../admin/assets/css/menu.css" rel="stylesheet" type="text/css" />
        <link href="../admin/assets/css/responsive.css" rel="stylesheet" type="text/css" />

        <script src="../assets/js/modernizr.min.js"></script>

    </head>


    <body class="bg-transparent">

        <!-- HOME -->
        <section>
        <h1 class="text-center mx-4 bg-dark text-white">Welcome To User Registration Panal</h1>
            <div class="container-alt">
                <div class="row">
                    <div class="col-sm-12">

                        <div class="wrapper-page">

                            <div class="m-t-40 account-pages">
                                <div class="text-center account-logo-box">
                                    <h2 class="text-uppercase">
                                        <a href="#" class="text-success">
                                            <span><h4 class="text-white">News Portal</h4></span>
                                            <span><h4 class="text-white">Registration Form</h4></span>

                                        </a>
                                    </h2>
                                    <!--<h4 class="text-uppercase font-bold m-b-0">Sign In</h4>-->
                                </div>
                                <div class="account-content">
                                    <form class="form-horizontal" method="post">

                                        <div class="form-group ">
                                            <div class="col-xs-12">
                                                <input class="form-control" type="email" required="" name="email" placeholder="Enter email" autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-xs-12">
                                                <input class="form-control" type="text" name="name" required="" placeholder="Enter Name" autocomplete="off">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <div class="col-xs-12">
                                                <input class="form-control" type="date" name="date" required="" placeholder="Date" autocomplete="off">
                                            </div>
                                        </div>
                                       
                                        
                                        <div class="form-group">
                                            <div class="col-xs-12">
                                                <input class="form-control" type="password" name="password" required="" placeholder="Password" autocomplete="off">
                                            </div>
                                        </div>

                     
                                        <div class="form-group account-btn text-center m-t-10">
                                            <div class="col-xs-12">
                                                <button class="btn w-md btn-bordered btn-danger waves-effect waves-light" type="submit" name="submit">Submit</button>
                                            </div>
                                        </div>

                                    </form>

                                    <div class="clearfix"></div>

                                </div>
                            </div>
                            <!-- end card-box-->


                    

                        </div>
                        <!-- end wrapper -->

                    </div>
                </div>
            </div>
          </section>
          <!-- END HOME -->

        <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>

        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

    </body>
</html>