<?php
// session_start();
// include('includes/config.php');
include('like1.php');
date_default_timezone_set('Asia/Kolkata');
error_reporting(0);
$ip = $_SERVER['REMOTE_ADDR'];
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
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Custom styles for this template -->
    <link href="css/modern-business.css" rel="stylesheet">

</head>

<body>

    <!-- Navigation -->
    <?php include('includes/header.php'); ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row" style="margin-top: 3%">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <!-- Blog Post -->
                <?php
                if (isset($_GET['pageno'])) {
                    $pageno = $_GET['pageno'];
                } else {
                    $pageno = 1;
                }
                $no_of_records_per_page = 8;
                $offset = ($pageno - 1) * $no_of_records_per_page;

                $total_pages_sql = "SELECT COUNT(*) FROM tblposts";
                $result = mysqli_query($con, $total_pages_sql);
                $total_rows = mysqli_fetch_array($result)[0];
                $total_pages = ceil($total_rows / $no_of_records_per_page);


                $query = mysqli_query($con, "select tblposts.postedby as name, tblposts.id as pid,tblposts.PostTitle as posttitle,tblposts.PostImage,post_like,post_dislike,tblcategory.CategoryName as category,tblcategory.id as cid,tblsubcategory.Subcategory as subcategory,tblposts.PostDetails as postdetails,tblposts.PostingDate as postingdate,tblposts.PostUrl as url from tblposts left join tblcategory on tblcategory.id=tblposts.CategoryId left join  tblsubcategory on  tblsubcategory.SubCategoryId=tblposts.SubCategoryId where tblposts.Is_Active=1 order by tblposts.id desc  LIMIT $offset, $no_of_records_per_page");
                while ($row = mysqli_fetch_array($query)) {
                    $res = mysqli_query($con, "SELECT COUNT(*) FROM views WHERE postid='" . $row["pid"] . "'");
                    $arr = mysqli_fetch_array($res);

                    //   ratting fetch code
                    $avgrat = 0;
                    $ret = mysqli_query($con, "SELECT post_id FROM postratting WHERE post_id='" . $row["pid"] . "'");
                    $count = mysqli_num_rows($ret);
                    $q = mysqli_query($con, "SELECT SUM(ratting) AS total FROM postratting WHERE post_id='" . $row["pid"] . "'");
                    $totarr = mysqli_fetch_array($q);
                    $total = $totarr['total'];
                    $avgrat = $total / $count;
                ?>

                    <div class="card mb-4">
                        <img class="card-img-top" style="padding: 10px; border-radius: 20px; height: 380px; width: auto" ; src="admin/postimages/<?php echo htmlentities($row['PostImage']); ?>" alt="<?php echo htmlentities($row['posttitle']); ?>">
                        <div class="card-body">
                            <hr>
                            <h2 class="card-title"><?php echo htmlentities($row['posttitle']); ?></h2>
                            <p><b>Category : </b> <a href="category.php?catid=<?php echo htmlentities($row['cid']) ?>"><?php echo htmlentities($row['category']); ?></a>
                                <span> <?php echo $arr[0]; ?> Views </span>
                                <span>
                                    <i class="fa fa-star" data-index="0"></i>
                                    <i class="fa fa-star" data-index="1"></i>
                                    <i class="fa fa-star" data-index="2"></i>
                                    <i class="fa fa-star" data-index="3"></i>
                                    <i class="fa fa-star" data-index="4"></i> <?php echo $avgrat; ?></span>
                            </p>
                            <p><b>Posted By : </b> <a href="category.php?catid=<?php echo htmlentities($row['cid']) ?>"><?php echo htmlentities($row['name']); ?></a>
                            </p>
                            <?php if (strlen($_SESSION['user']) == 0) { ?>

                                <form action="notlogin.php" method="POST" class="d-inline"> <input type="hidden" name="postid" value="<?php echo $row['pid']; ?>"> <button type=" submit" style="cursor: pointer" name="postlike"><i class="fa fa-thumbs-o-up"></i></button> &nbsp;
                                    <span><?php echo $row['post_like'] ?></span> &nbsp;
                                    <button type="submit" style="cursor: pointer" name="postdislikeid" value="View"><i class="fa fa-thumbs-o-down"></i></button>
                                </form>
                                &nbsp;<span><?php echo $row['post_dislike']; ?></span>&nbsp;&nbsp;

                            <?php } else { ?>
                                <i style="cursor: pointer; font-size: 25px;" <?php if (userlike($row['pid'])) { ?> class="fa fa-thumbs-up likebtn" <?php } else { ?> class="fa fa-thumbs-o-up likebtn" <?php } ?> data-id="<?php echo $row['pid'] ?>"></i>

                                <i style="cursor: pointer; font-size: 25px;" <?php if (disuserlike($row['pid'])) { ?> class="fa fa-thumbs-down dislikebtn" <?php } else { ?> class="fa fa-thumbs-o-down dislikebtn" <?php } ?> data-id="<?php echo $row['pid'] ?>"></i>
                                <span style="font-size: 20px; margin-right: 9px;" class="dislike"><?php echo getdislike($row['pid']) ?></span>
                            <?php } ?>

                            <a href="news-details.php?nid=<?php echo htmlentities($row['pid']) ?>" class="btn btn-primary">Read More &rarr;</a>
                        </div>
                        <div class="card-footer text-muted">
                            Posted on <?php echo htmlentities($row['postingdate']); ?>

                        </div>
                    </div>
                <?php } ?>

                <!-- Pagination -->

                <ul class="pagination justify-content-center mb-4">
                    <li class="page-item"><a href="?pageno=1" class="page-link">First</a></li>
                    <li class="<?php if ($pageno <= 1) {
                                    echo 'disabled';
                                } ?> page-item">
                        <a href="<?php if ($pageno <= 1) {
                                        echo '#';
                                    } else {
                                        echo "?pageno=" . ($pageno - 1);
                                    } ?>" class="page-link">Prev</a>
                    </li>
                    <li class="<?php if ($pageno >= $total_pages) {
                                    echo 'disabled';
                                } ?> page-item">
                        <a href="<?php if ($pageno >= $total_pages) {
                                        echo '#';
                                    } else {
                                        echo "?pageno=" . ($pageno + 1);
                                    } ?> " class="page-link">Next</a>
                    </li>
                    <li class="page-item"><a href="?pageno=<?php echo $total_pages; ?>" class="page-link">Last</a></li>
                </ul>

            </div>

            <!-- Sidebar Widgets Column -->
            <?php include('includes/sidebar.php'); ?>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->

    <!-- Footer -->
    <?php include('includes/footer.php'); ?>


    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="like.js"></script>
<script>
    setstar(3 - 1)

    function setstar(max) {
        for (i = 0; i <= max; i++)
            $('.fa-star:eq(' + i + ')').css('color', 'greenyellow');
    }
</script>

</html>