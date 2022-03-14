<?php
  include('includes/config.php');
  $newsurl = "http://newsapi.org/v2/top-headlines?sources=google-news&apiKey=c89cb9cd405e4627a7199608a16c5089 "; 
  $response = file_get_contents($newsurl);
  $newsdata = json_decode($response);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home || News Update</title>
    <link rel="stylesheet" href="css/live.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>

<body>
    <?php include('includes/header.php')?>


    <!-- Page Content -->
    <div class="container" style="border: 3px solid black; border-radius: 2px; padding: 10px; margin-top: 100px;">
        <?php
      foreach($newsdata->articles as $news) { ?>

        <div class="row">
            <div class="col-md-6">
                <img style="height: 217px; width: 100%;  padding: 5px; border-radius: 1pc;"
                    src="<?php  echo $news->urlToImage ?>" alt="" srcset="">
            </div>

            <div class="col-md-6">
                <h2>Headline: <?php echo $news-> title; ?></h2>
            </div>
        </div>

        <hr style="color:black;" >
        <div class="card-body">
            <h5>Description: <?php  echo $news->description ?></h5>
            <p>content: <?php echo $news->content ?></p>
            <a href='<?php echo "$news->url" ?>' target="_blank" class="btn btn-primary">Read More &rarr;</a>
            </div>

        <div class="card-footer text-muted">
            <h6 style="float:right;">Author: <?php  echo $news->author ?> </h6>
            <h6>Publised Date: <?php echo $news->publishedAt  ?></h6>
        </div>
        <hr>
    <?php }  ?>
    </div>
    <br><br>
    <?php include('includes/footer.php');?>

</body>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
    integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
    integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
</script>

</html>