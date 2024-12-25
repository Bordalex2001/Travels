<h2>Select Tours</h2>
<hr>
<?php
global $link;
connect($link, DB_NAME);

echo '<div class="form-inline">';
echo '<select name="countryid" id="countryid" class="col-sm-3 col-md-3 col-lg-3" onchange="showCities(this.value)">';
echo '<option value="0">Select country...</option>';
$res=mysqli_query($link,'select * from countries order by country');
while ($row=mysqli_fetch_array($res))
{
    echo '<option value="'.$row[0].'">'.$row[1].'</option>';
}
echo '</select>';
echo '<br>';
//list of cities
echo '<select name="cityid" id="citylist" class="col-sm-3 col-md-3 col-lg-3" onchange="showHotels(this.value)"></select>';
echo '</div>';
//list of hotels
echo '<div id="hotels"></div>';
//javascript functions
?>

<script>
let ao = null;

function showCities(countryid)
{
    const cities = document.getElementById('citylist');
    if(countryid === "0")
    {
        cities.innerHTML = '';
    }
    if(window.XMLHttpRequest)
    {
        ao = new XMLHttpRequest();
    }
    else
    {
        ao = new ActiveXObject('Msxml2.XMLHTTP');
    }

    ao.onreadystatechange = function()
    {
        if(ao.readyState === 4 && ao.status === 200)
        {
            cities.innerHTML = ao.responseText;
        }
    }

    ao.open('GET', 'pages/ajax1.php?countryid=' + countryid, true);
    ao.send(null);
}

function showHotels(cityid)
{
    const hotels = document.getElementById('hotels');
    if(cityid === "0")
    {
        hotels.innerHTML = '';
    }
    if(window.XMLHttpRequest)
    {
        ao = new XMLHttpRequest();
    }
    else
    {
        ao = new ActiveXObject('Msxml2.XMLHTTP');
    }

    ao.onreadystatechange = function()
    {
        if(ao.readyState === 4 && ao.status === 200)
        {
            hotels.innerHTML = ao.responseText;
        }
    }

    ao.open('POST', 'pages/ajax2.php', true);
    ao.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    ao.send('cityid=' + cityid);
}
</script>