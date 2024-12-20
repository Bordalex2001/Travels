<?php
include_once __DIR__ . "/../config.php";
$link = mysqli_connect(
    DB_HOST,
    DB_USER,
    DB_PASS)
or die('connection error');

function connect($link, $dbname)
{
    mysqli_select_db($link, $dbname) or die('DB open error');
    mysqli_query($link,"set names 'utf8'");
}

function register($name,$pass,$email){
    global $link;
    $name=trim(htmlspecialchars($name));
    $pass=trim(htmlspecialchars($pass));
    $email=trim(htmlspecialchars($email));
    if ($name == "" || $pass == "" || $email == "") {
        echo "<h3><span style='color:red;'>
            Fill All Required Fields!
        </span></h3>";
        return false;
    }
    if ((strlen($name) < 3 || strlen($name) > 30) || (strlen($pass) < 3 || strlen($pass) > 30)) {
        echo "<h3><span style='color:red;'> Values Length Must Be Between 3 And 30!
        </span></h3>";
        return false;
    }
    $ins='insert into users (login, pass, email, roleid)
        values("'.$name.'","'.password_hash($pass, PASSWORD_DEFAULT).'","'.$email.'", 2)';
    connect($link, DB_NAME);
    mysqli_query($link, $ins);
    $err=mysqli_errno($link);
    if ($err){
        if($err==1062)
            echo "<h3><span style='color:red;'>
                This Login Is Already Taken!
            </span></h3>";
        else
            echo "<h3><span style='color:red;'>
            Error code:".$err."!</span></h3>";
        return false;
    }
    return true;
}
function login($name,$pass)
{
    global $link;
    $name=trim(htmlspecialchars($name));
    $pass=trim(htmlspecialchars($pass));
    if ($name == "" || $pass == "")
    {
        echo "<h3><span style='color:red;'> Fill All Required Fields! </span></h3>";
        return false;
    }
    if ((strlen($name) < 3 || strlen($name) > 30) ||
        (strlen($pass) < 3 || strlen($pass) > 30)) {
    echo "<h3><span style='color:red;'> 
                  Value Length Must Be Between 3 And 30!
                  </span></h3>";
    return false;
    }
    connect($link, DB_NAME);
    $sel='select * from users where login="'.$name.'"';
    $res=mysqli_query($link, $sel);
    if($row=mysqli_fetch_array($res)){

        if (password_verify($pass, $row['pass']))
        {
            $_SESSION['ruser']=$name;
            if($row['roleid']==1)
            {
                $_SESSION['radmin']=$name;
            }
            return true;
        }
        else
        {
            echo "<h3><span style='color:red;'>Incorrect Password!</span></h3>";
            return false;
        }
    }
    else
    {
        echo "<h3><span style='color:red;'> No Such User! </span></h3>";
        return false;
    }
}