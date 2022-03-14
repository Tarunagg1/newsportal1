<?php
date_default_timezone_set('Asia/Kolkata');
$apiKey = "bd0da98abc85c1c3288e3ff31b55311c";
$cityId = "1273294";
$googleApiUrl = "http://api.openweathermap.org/data/2.5/weather?id=" . $cityId . "&lang=en&units=metric&APPID=" . $apiKey;

$ch = curl_init();
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_VERBOSE, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($ch);

curl_close($ch);
$data = json_decode($response);
?>
<div class="col-md-4">

          <!-- Search Widget -->
          <div class="card mb-4">
            <h5 class="card-header">Search</h5>
            <div class="card-body">
                   <form name="search" action="search.php" method="post">
              <div class="input-group">
        <input type="text" name="searchtitle" class="form-control" id="search" placeholder="Search for..." required autocomplete=off>
                <span class="input-group-btn">
                  <button class="btn btn-secondary" type="submit">Go!</button>
                </span>
              </form>
              </div>
              <div id="list" class="my-4"></div>
            </div>
          </div>

           <div class="card my-4">
            <h5 class="card-header">Whether</h5>
            <div class="card-body">
              <div class="row">
                <div class="col-lg-8">
               <h3><?php echo $data->name; ?> Weather</h3>
             <div class="time">
            <span id="time"></span>
            <div><?php echo ucwords($data->weather[0]->description); ?></div>
        </div>
        <div class="weather-forecast">
            <img src="http://openweathermap.org/img/w/<?php echo $data->weather[0]->icon; ?>.png"
                class="weather-icon" /> <?php echo $data->main->temp_max; ?>&deg;C<span
                class="min-temperature"><?php echo $data->main->temp_min; ?>&deg;C</span>
        </div>
        <div class="time">
            <div>Humidity: <?php echo $data->main->humidity; ?> %</div>
            <div>Wind: <?php echo $data->wind->speed; ?> km/h</div>
        </div>
                </div>
       
              </div>
            </div>
          </div>



          <!-- Categories Widget -->
          <div class="card my-4">
            <h5 class="card-header">Categories</h5>
            <div class="card-body">
              <div class="row">
                <div class="col-lg-6">
                  <ul class="list-unstyled mb-0">
<?php $query = mysqli_query($con,"select id,CategoryName from tblcategory");
while($row=mysqli_fetch_assoc($query))
{
?>
                    <li>
                      <a href="category.php?catid=<?php echo htmlentities($row['id'])?>"><?php echo htmlentities($row['CategoryName']);?></a>
                    </li>
<?php } ?>
                  </ul>
                </div>
       
              </div>
            </div>
          </div>

          <!-- Categories Widget -->
         
          <!-- Side Widget -->
          <div class="card my-4">
            <h5 class="card-header">Recent News</h5>
            <div class="card-body">
                      <ul class="mb-0">
<?php
$query=mysqli_query($con,"select tblposts.id as pid,tblposts.PostTitle as posttitle from tblposts left join tblcategory on tblcategory.id=tblposts.CategoryId left join  tblsubcategory on  tblsubcategory.SubCategoryId=tblposts.SubCategoryId limit 8");
while ($row=mysqli_fetch_array($query)) {

?>

  <li>
                      <a href="news-details.php?nid=<?php echo htmlentities($row['pid'])?>"><?php echo htmlentities($row['posttitle']);?></a>
                    </li>
            <?php } ?>
          </ul>
            </div>
          </div>

        </div>

 <!-- pop up list--> 
    <script src="vendor/jquery/jquery.min.js"></script>

<script>
function displaytime(){
  dt = new Date();
  document.getElementById('time').innerHTML = dt;
}  
setInterval(displaytime,1000);

    $(document).ready(function () {
                  $('#list').fadeOut();
        $('#search').keyup(function () {
            var query = $(this).val();
            if (query != 0) {
                $.ajax({
                    url: "popup.php",
                    method: "POST",
                    data: { query: query },
                    success: function (data) {
                        $('#list').fadeIn();
                        $('#list').html(data);
                    }
                });
            } else {
                $('#list').fadeOut();
                $('#list').html("");
            }
        });
        $(document).on('click', 'li', function (){
            $('#search').val($(this).text());
            $('#list').fadeOut();
        });
    });
</script>
