<?php 
include('../includes/config.php');
// code user email availablity
if(!empty($_POST["emailid"])) {
	$email= $_POST["emailid"];
	if (filter_var($email, FILTER_VALIDATE_EMAIL)===false) {
		echo "error : You did not enter a valid email.";
	}
else {
    $sql = "SELECT Email FROM userlogin WHERE Email='$email'";
    $result = $con->query($sql);
if($result->num_rows == 1)
{
echo "<span style='color:red'> Email already exists .</span>";
echo "<script>$('#submit').prop('disabled',true);</script>";
} else{	
echo "<span style='color:green'> Email available for Registration .</span>";
echo "<script>$('#submit').prop('disabled',false);</script>";
}
}
}
?>

<!------------------------------- forgetpass---------------------- -->
<?php
if(isset($_POST["cmail"]) || isset($_POST['date']) || isset($_POST["password"])) {
	$email= $_POST["cmail"];
	$date = $_POST["date"];
	$pass = md5($_POST["pass"]);
	if (filter_var($email, FILTER_VALIDATE_EMAIL)===false) {
		echo "error : You did not enter a valid email.";
	} 
else{
		$sql = "SELECT * FROM userlogin WHERE Email='$email'";
		$res = $con->query($sql);
		$data = mysqli_fetch_array($res);
		if($res->num_rows != 1){
	       echo "<span style='color:green'> Email Not Found .</span>";     		
		}
	    else if($date !=  $data['Dob']){
			echo "<span style='color:red'> Date Not Match .</span>";
		}
		else if(!empty($pass)){
              $sql = "UPDATE `userlogin` SET `Password`='$pass' WHERE Email='$email' ";
			if($con->query($sql) == TRUE){
				echo "<span style='color:green'> Password Updated .</span>";     		
			 }
			 else{
				echo "<span style='color:green'> Somthing Went TO Wrong .</span>";     		
			 }
		}
}
}
?>

