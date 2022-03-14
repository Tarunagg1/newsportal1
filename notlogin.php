<?php

if(isset($_POST['like']) || isset($_POST['dislikeid'])){
  $postid = $_POST['postid'];
        echo "<script>alert('Please login for like');</script>";  
        echo "<script> location.href='news-details.php?nid=$postid'; </script>";
}
echo "<script>alert('Please login for like');</script>";  
echo "<script> location.href='index.php'; </script>";

?>