<?php
include_once('functions.php');
global $link;
connect($link, DB_NAME);
$cityid=$_POST['cityid'];
$sel='select co.country, ci.city, ho.hotel, ho.cost, ho.stars, ho.id
    from hotels ho, cities ci, countries co
    where ho.cityid=ci.id
    and ho.countryid=co.id
    and ho.cityid='.$cityid;
$res=mysqli_query($link, $sel);
echo '<table class="table table-stripped"
id="table1"><thead><tr><th>Hotel</th><th>Country</th><th>City</th>
<th>Price</th><th>Stars</th><th>Details</th></thead><tbody>';
while ($row=mysqli_fetch_array($res)) {
    echo '<tr id="'.$row[1].'">';
    echo '<td>'.$row[2].'</td> <td>'.$row[0].'</td> <td>'.$row[1].'</td>
              <td>$'.$row[3].'</td><td>'.$row[4].'</td>
              <td <a href="pages/hotelinfo.php?hotel=
              '.$row[5].'" target="_blank">details</a></td>';
    echo '</tr>';
}
echo '</tbody></table>';
mysqli_free_result($res);