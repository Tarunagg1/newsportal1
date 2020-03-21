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