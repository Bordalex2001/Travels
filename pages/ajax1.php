<?php
include_once("functions.php");
global $link;
connect($link, DB_NAME);
$countryid=$_GET['countryid'];
$sel='select * from cities where countryid='.$countryid.' order by city';
$res=mysqli_query($link, $sel);
echo '<option value="0">Select city...</option>';
while ($row=mysqli_fetch_array($res)) {
    echo '<option value="'.$row[0].'">'.$row[1].'</options>';
}
mysqli_free_result($res);