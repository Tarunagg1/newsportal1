<form action="notlogin.php" method="POST" class="d-inline"> <input type="hidden" name="postid" value="<?php echo $row['pid']; ?>"> <button type=" submit" style="cursor: pointer" name="postlike"><i class="fa fa-thumbs-o-up"></i></button> &nbsp; <span><?php  echo $row['post_like'] ?></span> &nbsp;
                    <button type="submit" style="cursor: pointer" name="postdislikeid" value="View"><i class="fa fa-thumbs-o-down"></i></button></form> &nbsp;<span><?php  echo $row['post_dislike']; ?></span>&nbsp;&nbsp;
              
               <?php }  else { ?>
                <form  action ="postlike.php" method="POST" class="d-inline"> 
                   <input type="hidden" name="userid" id="userid" value="<?php echo $_SESSION['user']; ?>"> <input type="hidden" id="postid" name="postid" value="<?php echo $row['pid']; ?>"> 
                 <?php   
                   $email = $_SESSION['user'];
                   $res = mysqli_query($con,"SELECT * FROM `postlike` WHERE useremail = '$email'  and postid = ".$row['pid']." and ratingaction = 'like'  ");
                   if(mysqli_num_rows($res) == 1){  ?>
                 <button type=" submit" style="cursor: pointer;" name="postlikeremove"><i class="fa fa-thumbs-up"></i></button> &nbsp; <span><?php  echo $row['post_like'] ?></span> &nbsp;
                   <?php } else { ?> 
                 <button type="submit" style="cursor: pointer" name="postlikeadd" onclick="likeaad()" value="View"><i class="fa fa-thumbs-o-up"></i></button> &nbsp;<span><?php  echo $row['post_like']; ?></span>&nbsp;&nbsp;
                  <?php } ?>

                  <?php   
                   $email = $_SESSION['user'];
                   $res = mysqli_query($con,"SELECT * FROM `postlike` WHERE useremail = '$email'  and postid = ".$row['pid']." and ratingaction = 'dislike' ");
                   if(mysqli_num_rows($res) == 1){  ?>
                 <input type="hidden" name="userid" value="<?php echo $_SESSION['user']; ?>"> <input type="hidden" name="postid" value="<?php echo $row['pid']; ?>"> 
                 <button type=" submit" style="cursor: pointer;" name="postdislikeremove"><i class="fa fa-thumbs-down"></i></button> &nbsp; <span><?php  echo $row['post_dislike'] ?></span> &nbsp;
                 <?php } else { ?> 
                  <button type="submit" style="cursor: pointer" name="postdislikeadd" value="View"><i class="fa fa-thumbs-o-down"></i></button> &nbsp;<span><?php  echo $row['post_dislike']; ?></span>&nbsp;&nbsp;
                  <?php } ?>
                   </form>

<?php
include('includes/config.php');
  $postid = $_POST['postid'];
  $email = $_POST['userid'];

  extract($_POST);


if(isset($_POST['postlikeremove'])){
   $qury = mysqli_query($con,"SELECT `post_like` FROM `tblposts` WHERE id = '$postid'");
   $qury1 = mysqli_query($con,"UPDATE `postlike` SET `ratingaction`='none' WHERE postid='$postid' ");
   $row = mysqli_fetch_array($qury);
    $like = $row['post_like'];
   $qury = mysqli_query($con,"UPDATE `tblposts` SET `post_like`=$like-1  WHERE id='$postid'");
   if($qury){
     //echo "<script>alert('post Unlike');</script>";  
     echo "<script> location.href='index.php'; </script>";
   }else{
    echo "<script>alert('Something went wrong. Please try again.');</script>";  
   }
}

else if(isset($_POST['postlikeadd'])){
  $qury1 = mysqli_query($con,"SELECT `post_like` FROM `tblposts` WHERE id = '$postid'");

  $qur5 = mysqli_query($con,"SELECT * FROM `postlike` WHERE postid = '$postid' and useremail = '$email' and ratingaction = 'dislike'");
  if($qur5->num_rows > 0){
      $q = mysqli_query($con,"SELECT * FROM `tblposts` WHERE id = '$postid'");
    $row1 = mysqli_fetch_array($q);
    $like = $row1['post_dislike'];
    mysqli_query($con,"UPDATE `tblposts` SET `post_dislike`=$like-1  WHERE id='$postid'");
}

 $re = "SELECT * FROM `postlike` WHERE postid = '$postid' and useremail = '$email'";
 $res = mysqli_query($con,$re);
 if($res->num_rows > 0){
   mysqli_query($con,"UPDATE `postlike` SET `ratingaction`='like' WHERE postid='$postid'");
}else{
  mysqli_query($con,"INSERT INTO `postlike`(`postid`, `useremail`, `ratingaction`) VALUES ('$postid','$email','like')");
}
   $row = mysqli_fetch_array($qury1);
   $like = $row['post_like'];
  $qury = mysqli_query($con,"UPDATE `tblposts` SET `post_like`=$like+1  WHERE id='$postid'");
  if($qury){
    //echo "<script>alert('post like added');</script>";  
    echo "<script> location.href='index.php'; </script>";
  }else{
   echo "<script>alert('Something went wrong. Please try again.');</script>";  
  }
}


else if(isset($_POST['postdislikeadd'])){
  $qury = mysqli_query($con,"SELECT `post_dislike` FROM `tblposts` WHERE id = '$postid'");

  $qur5 = mysqli_query($con,"SELECT * FROM `postlike` WHERE postid = '$postid' and useremail = '$email' and ratingaction = 'like'");
  if($qur5->num_rows > 0){
      $q = mysqli_query($con,"SELECT * FROM `tblposts` WHERE id = '$postid'");
    $row1 = mysqli_fetch_array($q);
    $like = $row1['post_like'];
    mysqli_query($con,"UPDATE `tblposts` SET `post_like`=$like-1  WHERE id='$postid'");
}
  
  $re = "SELECT * FROM `postlike` WHERE postid = '$postid' and useremail = '$email' ";
  $res = mysqli_query($con,$re);
  if($res->num_rows > 0){
    $qury1 = mysqli_query($con,"UPDATE `postlike` SET `ratingaction`='dislike' WHERE postid='$postid'");
 }else{
   mysqli_query($con,"INSERT INTO `postlike`(`postid`, `useremail`, `ratingaction`) VALUES ('$postid','$email','dislike')");
 }
    $row = mysqli_fetch_array($qury);
    $like = $row['post_dislike'];
   $qury = mysqli_query($con,"UPDATE `tblposts` SET `post_dislike`=$like+1  WHERE id='$postid'");
   if($qury){
    // echo "<script>alert('post dislike added');</script>";  
    echo "<script> location.href='index.php'; </script>";
   }else{
    echo "<script>alert('Something went wrong. Please try again.');</script>";  
   }
}

else if(isset($_POST['postdislikeremove'])){    
  $qury = mysqli_query($con,"SELECT `post_dislike` FROM `tblposts` WHERE id = '$postid'");
  $qury1 = mysqli_query($con,"UPDATE `postlike` SET `ratingaction`='none' WHERE postid='$postid' ");
  $row = mysqli_fetch_array($qury);
  $like = $row['post_dislike'];
 $qury = mysqli_query($con,"UPDATE `tblposts` SET `post_dislike`=$like-1  WHERE id='$postid'");
 if($qury){
  // echo "<script>alert('post dislike added');</script>";  
   echo "<script> location.href='index.php'; </script>";
 }else{
  echo "<script>alert('Something went wrong. Please try again.');</script>";  
 }
}


?>