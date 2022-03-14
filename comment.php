<?php 
include('includes/config.php');
//Genrating CSRF Token
if (empty($_SESSION['token'])) {
 $_SESSION['token'] = bin2hex(random_bytes(32));
}
if(isset($_POST['submit']))
{
  //Verifying CSRF Token
if (!empty($_POST['csrftoken'])) {
  if (hash_equals($_SESSION['token'], $_POST['csrftoken'])) {
$name=$_POST['name'];
$email=$_POST['email'];
$comment=$_POST['comment'];
$postid=intval($_GET['nid']);
$time = time();
$st1='1';
$parent = "null";
$query=mysqli_query($con,"insert into tblcomments(postId,name,email,comment,status,lasttime,parent) values('$postid','$name','$email','$comment','$st1','$time','$parent')");
if($query):
  echo "<script>alert('comment successfully submit.');</script>";
  else :
 echo "<script>alert('Something went wrong. Please try again.');</script>";  
endif;

}
}
}
/////////////reply
if(isset($_POST['reply']))
{
$name=$_POST['name'];
$email=$_POST['email'];
$comment=$_POST['comment'];
$parent = $_POST['parent'];
$postid=intval($_GET['nid']);
$time = time();
$st1='1';
$query=mysqli_query($con,"insert into tblcomments(postId,name,email,comment,status,lasttime,parent) values('$postid','$name','$email','$comment','$st1','$time','$parent')");
if($query):
  echo "<script>alert('Reply successfully submit.');</script>";
  else :
 echo "<script>alert('Something went wrong. Please try again.');</script>";  
endif;

}
?>

<?php
  $commentid = $_POST['likeid'];
  $postid = $_POST['postid'];
if(isset($_POST['like'])){
   $qury1 = mysqli_query($con,"SELECT `comment_like` FROM `tblcomments` WHERE id='$commentid'");
    $row = mysqli_fetch_array($qury1);
    $like = $row['comment_like'];
   $qury = mysqli_query($con,"UPDATE `tblcomments` SET `comment_like`=$like+1  WHERE id='$commentid'");
   if($qury){
     echo "<script>alert('like added');</script>";  
     echo "<script> location.href='news-details.php?nid=$postid'; </script>";
   }else{
    echo "<script>alert('Something went wrong. Please try again.');</script>";  
   }
}
else if(isset($_POST['dislikeid'])){
   $qury1 = mysqli_query($con,"SELECT `comment_dislike` FROM `tblcomments` WHERE id='$commentid'");
    $row = mysqli_fetch_array($qury1);
    $like = $row['comment_dislike'];
   $qury = mysqli_query($con,"UPDATE `tblcomments` SET `comment_dislike`=$like+1 WHERE id='$commentid'");
   if($qury){
     echo "<script>alert('dislike added');</script>";  
     echo "<script> location.href='news-details.php?nid=$postid'; </script>";
   }else{
    echo "<script>alert('Something went wrong. Please try again.');</script>";  
   }
}

?>