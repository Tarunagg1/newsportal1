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