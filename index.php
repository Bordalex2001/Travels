<?php
session_start();
include_once ("pages/functions.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Travel Agency</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="css/style1.css" rel="stylesheet">
</head>

<body>
<div class="container">
    <div class="row">
        <header class="col-sm-12 col-md-12 col-lg-12">
            <?php include_once("pages/login.php");?>
        </header>
    </div>
    <div class="row">
        <nav class="col-sm-12 col-md-12 col-lg-12">
            <?php
            include_once('pages/menu.php');
            ?>
        </nav>
    </div>
    <div class="row">
        <section class="col-sm-12 col-md-12 col-lg-12">
            <?php
            if(isset($_GET['page']))
            {
                $page=$_GET['page'];
                if($page==1) include_once("pages/tours.php");
                if($page==2) include_once("pages/comments.php");
                if($page==3) include_once("pages/registration.php");
                if($page==4) include_once("pages/admin.php");
                if($page==6 && isset($_SESSION['radmin']))
                    include_once("pages/private.php");
            }
            ?>
        </section>
    </div><br>
    <div class="row">
        <footer>Step Academy &copy;</footer>
    </div>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js">
</script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.js"></script>
</body>
</html>