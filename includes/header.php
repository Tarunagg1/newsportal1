<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="index.php"><img src="images/logo.png" height="50"></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
            data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <?php
session_start();
error_reporting(0);
if(strlen($_SESSION['user']) == 0)
{ ?>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">News</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="livenews.php">Live Update</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="user/login.php">Sign In</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="user/register.php">Register</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about-us.php">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact-us.php">Contact us</a>
                </li>

            </ul>
        </div>
        <?php }  else {    
include('config.php');
$Userid =  $_SESSION['user'];
$sql = "SELECT * FROM `userlogin` WHERE Email ='$Userid' ";
$Result = $con->query($sql);
$row4 = $Result->fetch_assoc();
?>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php"><?php echo "Hii ",$row4['name'];?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php">News</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="user-add-post.php">Send Post</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="profile.php">Update Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>

            </ul>
        </div>

        <?php } ?>

    </div>
</nav>