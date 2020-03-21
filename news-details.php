<?php
session_start();
include('includes/config.php');
error_reporting(0);
if(strlen($_SESSION['user']) == 0)
  {?>

<?php include('comment.php'); ?>

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
 $query=mysqli_query($con,"select tblposts.PostTitle as posttitle,tblposts.PostImage,tblcategory.CategoryName as category,tblcategory.id as cid,tblsubcategory.Subcategory as subcategory,tblposts.PostDetails as postdetails,tblposts.PostingDate as postingdate,tblposts.PostUrl as url from tblposts left join tblcategory on tblcategory.id=tblposts.CategoryId left join  tblsubcategory on  tblsubcategory.SubCategoryId=tblposts.SubCategoryId where tblposts.id='$pid'");
while ($row=mysqli_fetch_array($query)) {
?>

                <div class="card mb-4">

                    <div class="card-body">
                        <h2 class="card-title"><?php echo htmlentities($row['posttitle']);?></h2>
                        <p><b>Category : </b> <a
                                href="category.php?catid=<?php echo htmlentities($row['cid'])?>"><?php echo htmlentities($row['category']);?></a>
                            |
                            <b>Sub Category : </b><?php echo htmlentities($row['subcategory']);?> <b> Posted on
                            </b><?php echo htmlentities($row['postingdate']);?></p>
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
                <div class="card my-4">
                    <h5 class="card-header">Leave a Comment:</h5>
                    <div class="card-body">
                        <form name="Comment" method="post">
                            <input type="hidden" name="csrftoken"
                                value="<?php echo htmlentities($_SESSION['token']); ?>" />
                            <div class="form-group">
                                <input type="text" name="name" class="form-control" placeholder="Enter your fullname"
                                    required>
                            </div>

                            <div class="form-group">
                                <input type="email" name="email" class="form-control"
                                    placeholder="Enter your Valid email" required>
                            </div>


                            <div class="form-group">
                                <textarea class="form-control" name="comment" rows="3" placeholder="Comment"
                                    required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                        </form>
                    </div>
                </div>


                <!---Comment Display Section --->

<?php 
 $sts=1;
 $query=mysqli_query($con,"select id,name,comment,postingDate,comment_like,comment_dislike from  tblcomments where postId='$pid' and status='$sts'");
 $qul = mysqli_query($con,"select * from tblcomments where postId='$pid' and status='1' ");
 $totcomment = $qul->num_rows;

 echo '<div  style="height: auto; border: 10px solid #888888 !important; overflow: scroll; width: 98%; padding: 23px;  margin: 26px auto; background-color: white; border-radius: 20px;"> ';
  echo "Comments:- $totcomment" ;
  echo '<hr>';
 while ($row=mysqli_fetch_array($query)) {
?>
                <div class="media mb-4">
                    <img class="d-flex mr-3 rounded-circle" src="images/usericon.png" alt="">
                    <div class="media-body">
                        <h5 class="mt-0"><?php echo htmlentities($row['name']);?> <br />
                            <span style="font-size:11px;"><b>at</b>
                                <?php echo htmlentities($row['postingDate']);?></span><form  method="POST" class="d-inline"> <a href="notlogin.php" style="float: right;"><i class="fa fa-flag" aria-hidden="true"></i></a></form>
                        </h5>
                        <p><?php echo htmlentities($row['comment']);?></p>
                        <form action="notlogin.php" method="POST" class="d-inline"> <input type="hidden" name="postid" value="<?php echo $pid ?>"> <input type="hidden" name="likeid" value="<?php echo $row['id'] ?>"> <button type=" submit" style="cursor: pointer" name="like"><i class="fa fa-thumbs-up"></i></button> &nbsp; <span><?php  echo $row['comment_like']; ?></span> &nbsp;
                            <button type="submit" style="cursor: pointer" name="dislikeid" value="View"><i class="fa fa-thumbs-down"></i></button></form> &nbsp;<span><?php  echo $row['comment_dislike']; ?></span>

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

</body>

</html>
<?php } 
////////////////////////////////////////////////////////////////////////////login 
  else{
?>

<?php include('comment.php'); ?>

<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>News Portal | Home Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/modern-business.css" rel="stylesheet">

</head>

<body>

    <!-- Navigation -->
    <?php include('includes/header1.php');?>

    <!-- Page Content -->
    <div class="container">

        <div class="row" style="margin-top: 4%">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <!-- Blog Post -->
                <?php
$pid=intval($_GET['nid']);
 $query=mysqli_query($con,"select tblposts.PostTitle as posttitle,tblposts.PostImage,tblcategory.CategoryName as category,tblcategory.id as cid,tblsubcategory.Subcategory as subcategory,tblposts.PostDetails as postdetails,tblposts.PostingDate as postingdate,tblposts.PostUrl as url from tblposts left join tblcategory on tblcategory.id=tblposts.CategoryId left join  tblsubcategory on  tblsubcategory.SubCategoryId=tblposts.SubCategoryId where tblposts.id='$pid'");
while ($row=mysqli_fetch_array($query)) {
?>

                <div class="card mb-4">

                    <div class="card-body">
                        <h2 class="card-title"><?php echo htmlentities($row['posttitle']);?></h2>
                        <p><b>Category : </b> <a
                                href="category.php?catid=<?php echo htmlentities($row['cid'])?>"><?php echo htmlentities($row['category']);?></a>
                            |
                            <b>Sub Category : </b><?php echo htmlentities($row['subcategory']);?> <b> Posted on
                            </b><?php echo htmlentities($row['postingdate']);?></p>
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
                <div class="card my-4">
                    <h5 class="card-header">Leave a Comment:</h5>
                    <div class="card-body">
                        <form name="Comment" method="post">
                            <input type="hidden" name="csrftoken"
                                value="<?php echo htmlentities($_SESSION['token']); ?>" />
                            <div class="form-group">
                                <input type="text" name="name" class="form-control" value="<?php echo $row4['name'];?>"
                                    placeholder="Enter your Name" required readonly>
                            </div>

                            <div class="form-group">
                                <input type="email" name="email" value="<?php echo $Userid;  ?>" class="form-control"
                                    placeholder="Enter your Valid email" required readonly>
                            </div>


                            <div class="form-group">
                                <textarea class="form-control" value=" <?php  echo'Null'; ?>"" name=" comment" rows="3"
                                    placeholder="Comment" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                        </form>
                    </div>
                </div>


                <!---Comment Display Section --->

                <?php 
 $sts=1;
 $query=mysqli_query($con,"select id,name,comment,postingDate,comment_like,comment_dislike from  tblcomments where postId='$pid' and status='$sts'");
 $qul = mysqli_query($con,"select * from tblcomments where postId='$pid' and status='1' ");
 $totcomment = $qul->num_rows;

 echo '<div  style="height: auto; border: 10px solid #888888 !important; overflow: scroll; width: 98%; padding: 23px;  margin: 26px auto; background-color: white; border-radius: 20px;"> ';
  echo "Comments:- $totcomment" ;
  echo '<hr>';
 while ($row=mysqli_fetch_array($query)) {
?>
                <div class="media mb-4">
                    <img class="d-flex mr-3 rounded-circle" src="images/usericon.png" alt="">
                    <div class="media-body">
                        <h5 class="mt-0"><?php echo htmlentities($row['name']);?> <br />
                            <span style="font-size:11px;"><b>at</b>
                                <?php echo htmlentities($row['postingDate']);?></span>
                        </h5>
                        <p><?php echo htmlentities($row['comment']);?></p>
                        <form action="comment.php" method="POST" class="d-inline"> <input type="hidden" name="postid" value="<?php echo $pid ?>"> <input type="hidden" name="likeid" value="<?php echo $row['id'] ?>"> <button type=" submit" style="cursor: pointer" name="like"><i class="fa fa-thumbs-up"></i></button> &nbsp; <span><?php  echo $row['comment_like']; ?></span> &nbsp;
                            <button type="submit" style="cursor: pointer" name="dislikeid" value="View"><i class="fa fa-thumbs-down"></i></button></form> &nbsp;<span><?php  echo $row['comment_dislike']; ?></span>

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

</body>

</html>

<?php } ?>