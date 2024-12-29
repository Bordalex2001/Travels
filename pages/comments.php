<h2>Write a comment</h2>
<hr>
<?php
global $link;
connect($link, DB_NAME);

echo '<form method="post">';
echo '<select name="hotelid" id="hotelid" class="col-sm-3 col-md-3 col-lg-3">';
echo '<option value="0">Select hotel...</option>';
$res=mysqli_query($link,'select * from hotels order by hotel');
while ($row=mysqli_fetch_array($res))
{
    echo '<option value="'.$row[0].'">'.$row[1].'</option>';
}
echo '</select>';
echo '<br><br>';
echo '<textarea name="comment" placeholder="Your comment" class="form-control" required></textarea>';
echo '<br>';
echo '<button type="submit" name="addcomment" class="btn btn-primary">Add comment</button>';
echo '</form>';

if (isset($_POST['addcomment'])) {
    $hotelid = $_POST['hotelid'];

    $comment = mysqli_escape_string($link, $_POST['comment']);

    $stmt = mysqli_prepare($link, 'INSERT INTO comments (comment, hotelid) VALUES (?, ?)');
    $stmt->bind_param('si', $comment, $hotelid);

    if ($stmt->execute()) {
        echo '<p style="color: green">New comment added!</p>';
    } else {
        echo '<p style="color: red">Error code: ' . $stmt->error . '</p>';
    }
    $stmt->close();
}
mysqli_close($link);
?>