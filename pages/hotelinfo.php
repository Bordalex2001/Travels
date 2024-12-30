<?php global $link; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hotel Info</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/info.css">
</head>
<body>
<?php
include_once ("functions.php");
if(isset($_GET['hotel'])) {
    $hotel = $_GET['hotel'];
    connect($link, DB_NAME);
    $sel = 'select * from hotels where id=' . $hotel;
    $res = mysqli_query($link, $sel);
    $row = mysqli_fetch_array($res);
    $hname = $row[1];
    $hstars = $row[4];
    $hcost = $row[5];
    $hinfo = $row[6];
    mysqli_free_result($res);

    echo '<div><a class="mx-1" href="../index.php?page=1">&leftarrow; Back to main</a><h2 class="text-uppercase text-center">' . $hname . '</h2></div>';
    echo '<div class="row"><div class="col-md-6 text-center">';

    connect($link, DB_NAME);
    $sel = 'select imagepath from images where hotelid=' . $hotel;
    $res = mysqli_query($link, $sel);

    echo '<span class="badge bg-info">Watch our pictures</span>';
    echo '<ul id="gallery" class="list-group">';
    while ($row = mysqli_fetch_array($res)) {
        echo ' <li class="list-group-item"><img src="../' . $row[0] . '" width="100%" height="100%"></li>';
    }
    mysqli_free_result($res);
    echo ' </ul>';
    for ($i = 0; $i < $hstars; $i++)
    {
        echo '<img src="../images/star.png" alt="star">';
    }
    echo '<h2 class="text-center">Cost&nbsp;<span class="badge bg-info">'
        .$hcost.' $</span>';
    echo '<a href="#" class="btn btn-success">Book This Hotel</a></h2>';
    echo '</div><div class="col-md-6"><p class="well">'.$hinfo.'</p></div>';
    echo '</div>';

    echo '<div class="row">';
    echo '<h2>Comments:</h2>';
    $sel = 'SELECT comment, сreatedat from comments WHERE hotelid='.$hotel.' ORDER BY сreatedat DESC';
    $res = mysqli_query($link, $sel);
    if(mysqli_num_rows($res) > 0)
    {
        while ($row = mysqli_fetch_array($res))
        {
            echo '<div class="comment">';
            echo '<p>' . $row[0] . '<small class="ms-5">' . $row[1] . '</small></p>';
            echo '</div>';
        }
    }
    else
    {
        echo '<p>There are no comments yet.</p>';
    }
    mysqli_free_result($res);
    echo '</div>';
}
?>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js">
</script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.js"></script>
</body>
</html>