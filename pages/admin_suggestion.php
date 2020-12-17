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
    <?php needPermission("viewSuggestion", $conn); ?>
    <div class="container" style="padding-top: 88px;">
        <div class="container mb-3" id="container">
                
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Timestamp</th>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                    </tr>
                </thead>
                <tbody>
            <?php
            $start_id = 0;
            $item_per_page = 25;

            $q = "SELECT * FROM `suggestion` ORDER BY `date` DESC LIMIT {$start_id}, {$item_per_page}";
            $r = mysqli_query($conn, $q);

            while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) { ?>
                    <tr>
                        <th scope="row"><?php echo $row['id'];?></th>
                        <td><?php echo $row['date']; ?></td>
                        <td><?php echo $row['name']."<br>(<a href='mailto:".$row['email']."'>".$row['email']."</a>)"; ?></td>
                        <td><?php echo str_replace("\n", "<br>", $row['text']); ?></td>
                    </tr>
                <?php }
            ?>
                </tbody>
            </table>
        </div>
    </div>
    

    <?php require '../static/functions/popup.php'; ?>
    <?php require '../static/functions/footer.php'; ?>
</body>

</html>