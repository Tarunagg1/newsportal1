<?php
include('includes/header.php');
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['user']) == 0)
 { ?>
echo "<script type='text/javascript'>
document.location = '../index.php';
</script>";
<?php } 
else{ 
    $email = $_SESSION['user'];
    if(isset($_REQUEST['update'])){
        $rname = $_REQUEST['name'];
        $rdob = $_REQUEST['dob'];
        $rgen = $_REQUEST['gender'];
        $sql = "UPDATE userlogin SET name ='$rname', Dob = '$rdob', Gender='$rgen' WHERE Email = '$email' ";
        if($con->query($sql) == TRUE){
            $msg="profile updated Successfully !!";
        }else{
            $error="Unable to Update profile !!";
        }
    }    
    
if(isset($_REQUEST['change'])){
        if($_REQUEST['newpass'] != $_REQUEST['confirm']){
        $error="new passwod or confirm password not match !!";
        }
        else{
        $oldpass = md5($_REQUEST['old']);
        $newpass = md5($_REQUEST['newpass']);
        $sql1 = "UPDATE userlogin SET Password='$newpass' WHERE Password ='$oldpass'";
        if($con->query($sql1) == TRUE){
                $msg="Password Changed Successfully !!";
            }else{
                $error="Unable to Update Password !!";
            }
        }

}

if(isset($_REQUEST['img'])){
    $email = $_SESSION['user'];
    $imagename = $_FILES['simg']['name'];
	$tempname = $_FILES['simg']['tmp_name'];
	
    $check=move_uploaded_file($tempname,"images/$imagename");

    $sql1 = "UPDATE userlogin SET Profile_Img ='$imagename' WHERE Email = '$email' ";
    if($con->query($sql1) == TRUE){
            $msg="image Changed Successfully !!";
        }else{
            $error="Unable to Change Picture !!";
 }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>News Portal | Home Page</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="profile.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/modern-business.css" rel="stylesheet">

</head>

<body>
    <!-- Navigation -->

    <!-- Page Content -->
    <div class="container">
        <div class="row" style="margin-top: 30px;">
            <div class="col-md-6">
                <!---Success Message--->
                <?php if($msg){ ?>
                <div class="alert alert-success" role="alert">
                    <strong>Well done!</strong> <?php echo htmlentities($msg);?>
                </div>
                <?php } ?>

                <!---Error Message--->
                <?php if($error){ ?>
                <div class="alert alert-danger" role="alert">
                    <strong>Oh snap!</strong> <?php echo htmlentities($error);?></div>
                <?php } ?>
                <div class="card my-4">
                    <h5 class="card-header">Edit Your Profile!!</h5>
                    <div class="card-body">

                        <form method="post">

                            <div class="form-group">
                                <input type="text" name="email" class="form-control"
                                    value="<?php if(isset($row4['Email'])) {echo $row4['Email']; }?>"
                                    placeholder="Enter your Email" required readonly>
                            </div>
                            <div class="form-group">
                                <input type="text" name="name"
                                    value="<?php if(isset($row4['name'])) {echo $row4['name']; }?>" class="form-control"
                                    placeholder="Enter your fullname" required>
                            </div>

                            <div class="form-group">
                                <input type="date" name="dob"
                                    value="<?php if(isset($row4['Dob'])) {echo $row4['Dob']; }?>" class="form-control"
                                    placeholder="date of birth" required>
                            </div>

                            <div class="row">
                                <div class="col-sm-15">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="get" value="male"
                                            checked>
                                        <label class="form-check-label" for="get"> Male </label>
                                    </div>
                                    <div class="form-check">

                                        <input class="form-check-input" type="radio" name="gender" id="post"
                                            value="female">
                                        <label class="form-check-label" for="post">Female </label>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary" name="update">Update</button>
                        </form>
                    </div>
                </div>

                <br>
                <div class="card my-3">
                    <h5 class="card-header">Update Password</h5>
                    <div class="card-body">

                        <form method="post">
                            <div class="form-group">
                                <input type="text" name="old" class="form-control" placeholder="Enter Old Password"
                                    required>
                            </div>

                            <div class="form-group">
                                <input type="password" name="newpass" class="form-control"
                                    placeholder="Enter New Password" required>
                            </div>

                            <div class="form-group">
                                <input type="text" name="confirm" class="form-control" placeholder="Conform Password"
                                    required>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary" name="change">Update Password</button>
                        </form>
                    </div>

                </div>

            </div>


            <div class="col-md-1"></div>

            <div class="col-md-4">
                <div class="card my-4">
                    <h5 class="card-header">Your Profile !!</h5>
                    <div class="card-body">
                        <img src="images/<?php echo $row4['Profile_Img'] ?>" style="height: 150px; width: 230px; " alt="img not found">
                        <hr>
                        <b> &nbsp;&nbsp;&nbsp;NAME: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row4['name'];?> </b>
                        <hr></b>

                       <b>&nbsp;&nbsp;&nbsp;EMAIL: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <?php echo $row4['Email']; ?></b>
                        <hr>
                        <b>&nbsp;&nbsp;&nbsp;DATE OF BIRTH: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <?php  $var = $row4['Dob'] ? : 'default'; echo $var; ?></b>
                        <hr>
                        <b>&nbsp;&nbsp;&nbsp;GENDER: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <?php $var = $row4['Gender'] ? : 'default'; echo $var; ?></b>
                        <hr>
                        <b>&nbsp;&nbsp;&nbsp;ACCOUNT STATUS: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Running</b>
                        <hr>
                        <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </form>
                    </div>
                </div>

                <div class="card my-4">
                    <h5 class="card-header">Update Profile Image</h5>
                    <div class="card-body">

                        <form method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <input type="file" name="simg" class="form-control" placeholder="Enter Old Password"
                                    required>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary" name="img">Update image</button>
                        </form>
                    </div>
                </div>


            </div>
        </div>

    </div>

    <br /><br />
    <?php include('includes/footer.php');?>


    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
<?php  }  ?>