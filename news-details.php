<?php
session_start();
include('includes/config.php');
error_reporting(0);
include('comment.php');
if(strlen($_SESSION['user']) != 0){
    $user = $_SESSION['user'];
    $res = mysqli_query($con,"SELECT name,Email FROM userlogin WHERE Email='$user'");
    $data = mysqli_fetch_array($res);
    $name = $data['name'];
    $email = $data['Email'];
    $img = $data['Profile_Img'] ? $data['Profile_Img'] : "usericon.png";
}


$ip = $_SERVER['REMOTE_ADDR'];
$pid =  intval($_GET['nid']);
$insetview = mysqli_query($con,"INSERT INTO `views`(`ip`, `postid`) VALUES ('$ip','$pid') ON DUPLICATE KEY UPDATE ip='$ip'"); 
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/modern-business.css" rel="stylesheet">

</head>

<body>

    <!-- Navigation -->
    <?php include('includes/header.php');?>

    <!-- Page Content -->
    <div class="container">
        <div class="row" style="margin-top: 4%">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <!-- Blog Post -->
                <?php
$pid=intval($_GET['nid']);

$ret = mysqli_query($con,"SELECT * FROM postratting WHERE post_id='$pid' AND user='$user'");
$rataar = mysqli_fetch_array($ret);
$rat = $rataar['ratting'];
$rat--;

$query=mysqli_query($con,"select tblposts.PostTitle as posttitle,tblposts.PostImage,tblcategory.CategoryName as category,tblcategory.id as cid,tblsubcategory.Subcategory as subcategory,tblposts.PostDetails as postdetails,tblposts.PostingDate as postingdate,tblposts.PostUrl as url from tblposts left join tblcategory on tblcategory.id=tblposts.CategoryId left join  tblsubcategory on  tblsubcategory.SubCategoryId=tblposts.SubCategoryId where tblposts.id='$pid'");
while ($row=mysqli_fetch_array($query)) {
  $res = mysqli_query($con,"SELECT COUNT(*) FROM views WHERE postid='$pid'");
  $arr = mysqli_fetch_array($res);
?>
                <div class="card mb-4">
                    <div class="card-body">
                        <h2 class="card-title"><?php echo htmlentities($row['posttitle']);?></h2>
                        <p><b>Category : </b> <a
                                href="category.php?catid=<?php echo htmlentities($row['cid'])?>"><?php echo htmlentities($row['category']);?></a>
                            |
                            <b>Sub Category : </b><?php echo htmlentities($row['subcategory']);?> <b> Posted on
                            </b><?php echo htmlentities($row['postingdate']);?> <span>Views (<?php echo $arr[0]; ?>)
                            </span></p>
                        <hr />

                        <img class="img-fluid rounded" style="height: 251px; width: 75%;" ;
                            src="admin/postimages/<?php echo htmlentities($row['PostImage']);?>"
                            alt="<?php echo htmlentities($row['posttitle']);?>">
                        <p class="card-text"><?php 
                  $pt=$row['postdetails'];
                  echo  (substr($pt,0));?></p>
                </div>
                    <div class="card-footer text-muted">
                        Posted on <?php echo $row['postingdate'];?>
            <?php if(isset($_SESSION['user'])){ ?>
                   <div id="ratting-sys" style="display: initial;padding-left: 100px; cursor:pointer;" class="ratting-sys">
                   <span style=" margin-right: 40px;font-weight: bold; font-size: 21px;"> Your Ratting</span>  <i class="fa fa-star fa-2x" data-index="0"></i>
                            <i class="fa fa-star fa-2x" data-index="1"></i>
                            <i class="fa fa-star fa-2x" data-index="2"></i>
                            <i class="fa fa-star fa-2x" data-index="3"></i>
                            <i class="fa fa-star fa-2x" data-index="4"></i>
                        </div>
            <?php  }?>
                    </div>
                </div>
                <?php } ?>

            </div>

            <!-- Sidebar Widgets Column -->
        </div>
        <!-- /.row -->
        <!---Comment Section --->

        <div class="row" style="margin-top: auto">
            <div class="col-md-8">
                <?php  if(strlen($_SESSION['user']) != 0) {?>
                <div class="card my-4">
                    <h5 class="card-header">Leave a Comment:</h5>
                    <div class="card-body">
                        <form name="Comment" method="post">
                            <input type="hidden" name="csrftoken"
                                value="<?php echo htmlentities($_SESSION['token']); ?>" />

                            <div class="form-group">
                                <input type="email" name="email" value="<?php echo $email; ?>" class="form-control"
                                    placeholder="Enter your Valid email" readonly>
                            </div>
                            <div class="form-group">
                                <input type="text" name="name" class="form-control" placeholder="Enter your fullname"
                                    required>
                            </div>


                            <div class="form-group">
                                <textarea class="form-control" name="comment" rows="3" placeholder="Comment"
                                    required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                        </form>
                    </div>
                </div>
                <?php }else{ ?>
                <h5>Please Login For Comment</h5>
                <?php  }?>
                <!---Comment Display Section --->
                <?php 
function get_time_ago( $time )
{
    $time_difference = time() - $time;

    if( $time_difference < 1 ) { return 'less than 1 second ago'; }
    $condition = array( 12 * 30 * 24 * 60 * 60 =>  'year',
                30 * 24 * 60 * 60       =>  'month',
                24 * 60 * 60            =>  'day',
                60 * 60                 =>  'hour',
                60                      =>  'minute',
                1                       =>  'second'
    );

    foreach( $condition as $secs => $str )
    {
        $d = $time_difference / $secs;

        if( $d >= 1 )
        {
            $t = round( $d );
            return 'about ' . $t . ' ' . $str . ( $t > 1 ? 's' : '' ) . ' ago';
        }
    }
}
 $sts=1;
 $query=mysqli_query($con,"select id,name,comment,postingDate,comment_like,comment_dislike ,lasttime from  tblcomments where postId='$pid' and status='$sts'and parent ='null' ");
 $qul = mysqli_query($con,"select * from tblcomments where postId='$pid' and status='1' and parent ='null'");
 $totcomment = $qul->num_rows;

 echo '<div  style="height: auto;  width: 120%; padding: 23px;  margin: 26px auto; background-color: white; border-radius: 20px;"> ';
  echo "Comments:- $totcomment" ;
  echo '<hr>';
 while ($row=mysqli_fetch_array($query)) {
?>
                <div class="media mb-4">
                    <img class="d-flex mr-3 rounded-circle" src="images/<?php echo $img; ?>" alt="">
                    <div class="media-body">
                        <h5 class="mt-0"><?php echo htmlentities($row['name']);?> <br />
                            <span style="font-size:11px;"><b>
                                    <?php echo get_time_ago($row['lasttime']); ?></b></span>
                        </h5>
                        <p><?php echo htmlentities($row['comment']);?></p>
                        <?php if(!isset($_SESSION['user'])){ ?>
                        <form action="notlogin.php" method="POST" class="d-inline"> <input type="hidden" name="postid"
                                value="<?php echo $pid ?>"> <input type="hidden" name="likeid"
                                value="<?php echo $row['id'] ?>"> <button type=" submit" style="cursor: pointer"
                                name="like"><i class="fa fa-thumbs-up"></i></button> &nbsp;
                            <span><?php  echo $row['comment_like']; ?></span> &nbsp;
                            <button type="submit" style="cursor: pointer" name="dislikeid" value="View"><i
                                    class="fa fa-thumbs-down"></i></button></form>
                        &nbsp;<span><?php  echo $row['comment_dislike']; ?></span>
                        <a href="" style="margin-left: 7px;" type="button" data-toggle="collapse"
                            data-target="#reply<?php echo $row['id']?>" aria-expanded="false"
                            aria-controls="collapseExample">Reply</a>
                        <div class="reply">
                            <div class="collapse" id="reply<?php echo $row['id']?>">
                                <h1>You Must Login For Reply</h1>
                            </div>
                        </div>
                        <?php } else { ?>
                        <form action="comment.php" method="POST" class="d-inline"> <input type="hidden" name="postid"
                                value="<?php echo $pid ?>"> <input type="hidden" name="likeid"
                                value="<?php echo $row['id'] ?>"> <button type=" submit" style="cursor: pointer"
                                name="like"><i class="fa fa-thumbs-up"></i></button> &nbsp;
                            <span><?php  echo $row['comment_like']; ?></span> &nbsp;
                            <button type="submit" style="cursor: pointer" name="dislikeid" value="View"><i
                                    class="fa fa-thumbs-down"></i></button></form>
                        &nbsp;<span><?php  echo $row['comment_dislike']; ?></span>

                        <a href="" style="margin-left: 7px;" type="button" data-toggle="collapse"
                            data-target="#reply<?php echo $row['id']?>" aria-expanded="false"
                            aria-controls="collapseExample">Reply</a>
                        <div class="reply">
                            <div class="collapse" id="reply<?php echo $row['id']?>">
                                <form method="post" class="mt-3">
                                    <input type="hidden" class="form-control" value="<?php echo $name; ?>" name="name">
                                    <input type="hidden" class="form-control" value="<?php echo $email; ?>"
                                        name="email">
                                    <textarea name="comment" placeholder="Write your reply" cols="115"
                                        rows="3"></textarea>
                                    <input type="hidden" name="parent" class="form-control"
                                        value="<?php echo $row['id'] ?>">
                                    <button type="submit" name="reply" class="btn btn-primary btn-sm">Submit</button>
                                </form>
                            </div>
                        </div>
                        <?php
                            $rep=mysqli_query($con,"select id,name,comment,postingDate,comment_like,comment_dislike ,lasttime from  tblcomments where parent='".$row['id']."' and status='1' and postid='".$_GET['nid']."'");
                          if ($rep->num_rows) {
                        ?>
                        <a href="" class="dropdown-toggle text-dark " style="margin: 8px;" type="button"
                            data-toggle="collapse" data-target="#viewreply<?php echo $row['id']?>" aria-expanded="false"
                            aria-controls="collapseExample">View <?php echo $rep->num_rows; ?> replies </a>

                        <div class="collapse" id="viewreply<?php echo $row['id']?>">
                            <?php while($repdata = mysqli_fetch_array($rep)){ ?>
                            <div class="media mt-3 ml-5">
                                <img class="d-flex mr-3 rounded-circle" src="images/usericon.png" alt="">
                                <div class="media-body">
                                    <h5 class="mt-0"><?php echo htmlentities($repdata['name']);?> <br />
                                        <span style="font-size:11px;"><b>
                                                <?php echo get_time_ago($repdata['lasttime']); ?></b></span>
                                    </h5>
                                    <p><?php echo htmlentities($repdata['comment']);?></p>
                                </div>
                            </div>
                            <?php  } ?>
                        </div>

                        <?php }} ?>
                    </div>
                </div>
                <hr>
                <?php } ?>
            </div>
        </div>
    </div>
    </div>


    <?php include('includes/footer.php');?>


    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script>
var retedindex = -1;
var pid = $('#pid').val();

$(document).ready(function(){
setstar(<?php echo $rat; ?>);
    $('.fa-star').on('click',function(){
     retedindex = parseInt($(this).data('index'))
        savetodb();
    })
    $('.fa-star').mouseover(function(){
        let currentindex = parseInt($(this).data('index'))
        setstar(currentindex)
    }) 
    $('.fa-star').mouseleave(function(){
        $('.fa-star').css('color',''); 
        if(retedindex != -1){
               setstar(retedindex)
        }  
    })
});
function savetodb(){
    $.ajax({
        url:"like1.php",
        method:"POST",
        data:{retedindex:retedindex ,post_id:<?php echo $pid; ?>},
        success: function(data){
            setstar(data)
        }
    });
}
function setstar(max){
    for(i=0; i<=max; i++)
            $('.fa-star:eq('+i+')').css('color','greenyellow');
}
</script>

</body>

</html>