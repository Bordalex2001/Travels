<ul class="nav nav-tabs nav-justified" role="tablist">
    <li class="nav-item" role="presentation" <?php echo ($page==1)? "class='active'":"" ?>>
        <a class="nav-link" role="tab" href="index.php?page=1">Tours</a></li>
    <li class="nav-item" role="presentation" <?php echo ($page==2)? "class='active'":"" ?>>
        <a class="nav-link" role="tab" href="index.php?page=2">Comments</a></li>
    <li class="nav-item" role="presentation" <?php echo ($page==3)? "class='active'":"hhh" ?>>
        <a class="nav-link" role="tab" href="index.php?page=3">Registration</a></li>
    <li class="nav-item" role="presentation" <?php echo ($page==4)? "class='active'":"" ?>>
        <a class="nav-link" role="tab" href="index.php?page=4">Admin Forms</a></li>
    <?php
    if(isset($_SESSION['radmin']))
    {
        if($page==6)
            $c='active';
        else
            $c='';
        echo '<li class="nav-item" role="presentation"> <a class="nav-link" role="tab" href="index.php?page=6">Private</a></li>';
    }
    ?>
</ul>