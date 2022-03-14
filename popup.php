<?php
include('includes/config.php');
if(isset($_POST['query'])){
    $st = $_POST['query'];
    $output = ' ';
    $query = "SELECT * FROM tblposts WHERE PostTitle like '%$st%' ";
    $res = mysqli_query($con,$query);

    $output = '<ol classs="list-unstyled">';

    if(mysqli_num_rows($res) > 0){
        while ($row = mysqli_fetch_array($res)) {
            $output .= '<li>'.$row['PostTitle'].'</li>';
        }
    }else{
        $output .= '<li> Ohh Snap!! No Result Found </li>';
    }
    $output .='</ol>';
    echo $output;
}
?>