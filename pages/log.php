<?php 
    require '../static/functions/connect.php';
?>

<!DOCTYPE html>
<html lang="th" prefix="og:http://ogp.me/ns#">

<head>
    <?php require '../static/functions/head.php'; ?>
</head>
<nav class="navbar navbar-expand-lg navbar-dark navbar-normal fixed-top scrolling-navbar" id="nav" role="navigation">
    <?php require '../static/functions/navbar.php'; ?>
</nav>

<body>
    <div class="container" style="padding-top: 88px;">
        <div class="container mb-3" id="container">
        <?php
            needRole("admin", $conn);
            $start_id = 0;
            $item_per_page = 10;

            $q = "SELECT * FROM `log` ORDER BY `time` DESC, LIMIT {$start_id}, {$item_per_page}";
            $r = mysqli_query($conn, $q);

            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            
            }
        ?>
        </div>
    </div>
    

    <?php require '../static/functions/popup.php'; ?>
    <?php require '../static/functions/footer.php'; ?>
</body>

</html>