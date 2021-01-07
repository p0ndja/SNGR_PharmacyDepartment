<?php 
    require '../static/functions/connect.php';
?>

<!DOCTYPE html>
<html lang="th" prefix="og:http://ogp.me/ns#">

<head>
    <?php require '../static/functions/head.php'; ?>
    <style>
        @media (min-width: 960px) {
            .card-columns {
                -webkit-column-count: 4;
                -moz-column-count: 4;
                column-count: 4;
            }
        }

        @media (max-width: 960px) {
            .card-columns {
                -webkit-column-count: 1;
                -moz-column-count: 1;
                column-count: 1;
            }
        }
    </style>
</head>
<nav class="navbar navbar-expand-lg navbar-dark navbar-normal fixed-top scrolling-navbar" id="nav" role="navigation">
    <?php require '../static/functions/navbar.php'; ?>
</nav>

<body>
    <div class="container" style="padding-top: 88px;">
        <div class="container mb-3" id="container">
            <div class="card-columns">
            <?php
                    $path = "../file/epub/";
                    $count = 0;
                    $files = glob($path . "*.{pdf}", GLOB_BRACE);
                    if ($files)
                        $count = count($files);
                    for ($i = 0; $i < $count; $i++) { ?>
                            <a onclick="javascript:void window.open('../epub/<?php echo str_replace($path, '', $files[$i]); ?>','1606564880393','width=800,height=600,toolbar=0,menubar=0,location=0,status=0,scrollbars=1,resizable=0,left=0,top=0');return false;">
                            <div class="card mt-2">
                                <img class="card-img-top" src="http://placehold.it/1080x1920">
                                <div class="card-body">
                                    <div class="card-text">
                                        <?php echo $files[$i]; ?>
                                    </div>
                                </div>
                            </div>
                            </a>
                    <?php }
            ?>
            </div>
        </div>
    </div>
    

    <?php require '../static/functions/popup.php'; ?>
    <?php require '../static/functions/footer.php'; ?>
</body>

</html>