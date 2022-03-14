<?php
session_start();
include('includes/config.php');

extract($_POST);

if(isset($_POST['action'])){
    $action = $_POST['action'];
    $email = $_SESSION['user'];
    $postid = $_POST['postid'];
	
    switch ($action) {
        case 'like':
            $sql = "INSERT INTO `postlike`(`postid`, `useremail`, `ratingaction`) VALUES ('$postid','$email','$action')
              ON DUPLICATE KEY UPDATE ratingaction='like'";
            break;
        case 'dislike':
            $sql = "INSERT INTO `postlike`(`postid`, `useremail`, `ratingaction`) VALUES ('$postid','$email','$action')
               ON DUPLICATE KEY UPDATE ratingaction='dislike'";
            break;
        case 'unlike':
            $sql = "DELETE FROM `postlike` WHERE useremail='$email' AND postid='$postid'";
            break;
        case 'undislike':
            $sql = "DELETE FROM `postlike` WHERE useremail='$email' AND postid='$postid'";
            break;
        
        default:
            break;
    }
    mysqli_query($con,$sql);
    echo getratting($postid);
    exit(0);
}


function getratting($postid){
    global $con;
    $ratting = array();
    $likeq = "SELECT count(*) FROM `postlike` WHERE postid = '$postid' and ratingaction = 'like'";
    $dislikeq = "SELECT count(*) FROM `postlike` WHERE postid = '$postid' and ratingaction = 'dislike'";
    $likeres = mysqli_query($con,$likeq);
    $dislikeres = mysqli_query($con,$dislikeq);
    $likearr = mysqli_fetch_array($likeres);
    $dislikearr = mysqli_fetch_array($dislikeres);
    $ratting = ['likes'=> $likearr[0], 'dislike'=> $dislikearr[0]];
    return json_encode($ratting);
}

function getlike($id){
    global $con;
    $likeq = "SELECT count(*) FROM `postlike` WHERE postid = '$id' and ratingaction = 'like'";
    $likeres = mysqli_query($con,$likeq);
    $likearr = mysqli_fetch_array($likeres);
    return $likearr[0];
}
function getdislike($id){
    global $con;
    $dislikeq = "SELECT count(*) FROM `postlike` WHERE postid = '$id' and ratingaction = 'dislike'";
    $dislikeres = mysqli_query($con,$dislikeq);
    $dislikearr = mysqli_fetch_array($dislikeres);
   return $dislikearr[0];
}

function userlike($id){
    $email = $_SESSION['user'];
    global $con;
    $qur5 = mysqli_query($con,"SELECT * FROM `postlike` WHERE postid = '$id' and useremail = '$email' and ratingaction = 'like'");
    if(mysqli_num_rows($qur5) > 0){
         return true;
    }else{
        return false;
}}

function disuserlike($id){
    $email = $_SESSION['user'];
    global $con;
    $qur5 = mysqli_query($con,"SELECT * FROM `postlike` WHERE postid = '$id' and useremail = '$email' and ratingaction = 'dislike'");
    if(mysqli_num_rows($qur5) > 0){
         return true;
    }else{
        return false;
}}

?>
<?php
    global $con;
    if(isset($_POST['retedindex'])){
    $rating = $_POST['retedindex'];
    $pid = $_POST['post_id'];
    $email = $_SESSION['user'];
    $ip = "::1";
    $rating++;
    mysqli_query($con,"INSERT INTO `postratting`(`post_id`, `ratting`, `user`, `ip`) VALUES ('$pid','$rating','$email','$ip') ON DUPLICATE KEY UPDATE ratting='$rating'");
    echo $rating;
}

?>

