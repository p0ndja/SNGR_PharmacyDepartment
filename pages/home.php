<?php 
    require '../static/functions/connect.php';
?>

<!DOCTYPE html>
<html lang="th" prefix="og:http://ogp.me/ns#">

<head>
    <?php require '../static/functions/head.php'; ?>
    <style>
        html,
        body,
        header,
        .view {
            height: 100% !important;
        }

        .carousel-item {
            height: 100vh;
            min-height: 350px;
            background: no-repeat center center scroll;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }

        @media (min-width: 960px) {
            .card-columns {
                -webkit-column-count: 3;
                -moz-column-count: 3;
                column-count: 3;
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

<body>
    <?php 
        $path = "../static/elements/carousel/";
        if (!file_exists($path))
            mkdir($path);
        
        $count = 0;
        $files = glob($path . "*.{jpg,png,gif}", GLOB_BRACE);
        if ($files)
            $count = count($files);
    ?>
    <?php if ($count > 0) { ?>
        <header>
        <div id="carousel" class="carousel slide carousel-fade" data-ride="carousel">
            <ol class="carousel-indicators">
                <?php 
                for ($i = 0; $i < $count; $i++) {
                    echo "<li data-target='#carousel' data-slide-to='$i'";
                    if ($i == 0) echo " class='active'></li>";
                    else echo "></li>";
                }
                ?>
            </ol>
            <div class="carousel-inner">
                    <?php for ($i = 0; $i < $count; $i++) { 
                        $picPath = $files[$i];
                        $picName = explode(".", str_replace("../static/elements/carousel/", "", $picPath));

                        $line = array();
                        $txtFile = "../static/elements/carousel/$picName[0].txt";
                        
                        if (file_exists($txtFile)) {
                            $file = fopen("../static/elements/carousel/$picName[0].txt", "r");
                            while(!feof($file)) {
                                array_push($line, fgets($file));
                                # do same stuff with the $line
                            }
                            fclose($file);
                        }
                    ?>
                        <div class="carousel-item <?php if ($i == 0) echo 'active'; ?>" style="background-image: url('<?php echo $picPath; ?>')" <?php if ($line != null) { echo "alt='$line[0]'"; }?>>
                            <!-- style="-webkit-mask-image: -webkit-gradient(linear, left 50%, left bottom, from(rgba(0,0,0,1)), to(rgba(0,0,0,0)))" -->
                            <?php if ($line != null) { ?>
                            <div class="carousel-caption d-none d-md-block animated fadeInDown">
                                <div class="carousel-caption-text">
                                    <h5><?php echo $line[0]; ?></h5>
                                    <p>
                                    <?php for($o = 1; $o < count($line); $o++) {
                                        echo $line[$o] . "<br>";
                                    } ?>
                                    </p>
                                </div>
                            </div>
                        <?php } ?>
                        </div>
                    <?php } ?>
                    
                </div>
                <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </header>
    <?php } ?>
    <nav class="navbar navbar-expand-lg navbar-dark navbar-normal <?php if ($count == 0) echo 'fixed-top scrolling-navbar'; ?>" id="nav" role="navigation">
        <?php require '../static/functions/navbar.php'; ?>
    </nav>
    <div class="container-fluid" <?php if ($count == 0) echo 'style="padding-top: 88px"'; ?>>
        <div class="container mb-3" id="container">
            <div class="row">
                <div class="col-6 col-md-3">
                    <a href="../category/manufacture-1">
                    <div class="card hoverable">
                        <div class="card-img-top"><img class="d-block img-fluid"
                                src="../static/elements/hotlink/manu.jpg" alt="First slide"></div>
                    </div>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="../category/service-1">
                    <div class="card hoverable">
                        <div class="card-img-top"><img class="d-block img-fluid"
                                src="../static/elements/hotlink/serv.jpg" alt="First slide"></div>
                    </div>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="../category/DIC-1">
                    <div class="card hoverable">
                        <div class="card-img-top"><img class="d-block img-fluid"
                                src="../static/elements/hotlink/dic.jpg" alt="First slide"></div>
                    </div>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="../category/inventory-1">
                    <div class="card hoverable">
                        <div class="card-img-top"><img class="d-block img-fluid"
                                src="../static/elements/hotlink/inv.jpg" alt="First slide"></div>
                    </div>
                    </a>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-9 col-12">
                    <!--- First -->
                    <div class="mb-3">
                        <h3 class="font-weight-bold">ข่าวประชาสัมพันธ์ - News</h3>
                        <div class="card-columns">
                            <?php
                                $query = "SELECT * FROM `post` WHERE isHidden = 0 AND category = 'news' ORDER by isPinned DESC, time DESC limit 5";
                                $result = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                            ?>
                                <a href="../post/<?php echo $row['id']; ?>" class="text-dark">
                                <div class="card mb-2 mt-1">
                                    <div class="card-img-top"><img class="d-block img-fluid"
                                            src="<?php echo $row['cover']; ?>" alt="Cover"></div>
                                    <div class="card-body card-text"><u><?php echo $row['title']; ?></u></div>
                                </div>
                                </a>
                            <?php } ?>
                        </div>
                        <a href="../category/news-1" class="btn btn-info"><i class="fas fa-arrow-circle-right"></i> อ่านเพิ่มเติม...</a>
                    </div>
                    <hr>
                    <h4 class="font-weight-bold">ชุมชนนักปฏิบัติ - Community of Practice</h4>
                    <div class="row">
                        <div class="col-6 col-md-3">
                            <a href="../category/CoPADR-1">
                            <div class="card">
                                <div class="card-img-top"><img class="d-block img-fluid"
                                        src="../static/elements/hotlink/adr.jpg" alt="ADR"></div>
                            </div>
                            </a>
                        </div>
                        <div class="col-6 col-md-3">
                            <a href="../category/CoPHAD-1">
                            <div class="card">
                                <div class="card-img-top"><img class="d-block img-fluid"
                                        src="../static/elements/hotlink/had.jpg" alt="HAD"></div>
                            </div>
                            </a>
                        </div>
                        <div class="col-6 col-md-3">
                            <a href="../category/CoPME-1">
                            <div class="card">
                                <div class="card-img-top"><img class="d-block img-fluid"
                                        src="../static/elements/hotlink/me.jpg" alt="ME"></div>
                            </div>
                            </a>
                        </div>
                        <div class="col-6 col-md-3">
                            <a href="../category/CoPRDU-1">
                            <div class="card">
                                <div class="card-img-top"><img class="d-block img-fluid"
                                        src="../static/elements/hotlink/rdu.jpg" alt="RDU"></div>
                            </div>
                            </a>
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-4">
                        <div class="col-6 col-md-6">
                            <a href="../category/research-1">
                            <div class="card mb-3">
                                <div class="card-img-top"><img class="d-block img-fluid"
                                        src="../static/elements/hotlink/researchr2r.jpg" alt="First slide"></div>
                            </div>
                            </a>
                        </div>
                        <div class="col-6 col-md-6">
                            <a href="../download/">
                            <div class="card mb-3">
                                <div class="card-img-top"><img class="d-block img-fluid"
                                        src="../static/elements/hotlink/dlform.jpg" alt="First slide"></div>
                            </div>
                            </a>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-12 col-md-6">
                            <div class="card mb-3">
                                <div class="card-img-top">
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <iframe class="embed-responsive-item"
                                            src="https://www.youtube.com/embed/VXZM6imLsw4" allowfullscreen></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="card mb-3">
                                <div class="card-img-top">
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <iframe class="embed-responsive-item"
                                            src="https://www.youtube.com/embed/_sB1OSMl59c" allowfullscreen></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="card mb-3">
                                <div class="card-img-top">
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <iframe class="embed-responsive-item"
                                            src="https://www.youtube.com/embed/El9wqKzL4RU" allowfullscreen></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="card mb-3">
                                <div class="card-img-top">
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <iframe class="embed-responsive-item"
                                            src="https://www.youtube.com/embed/GpVz9SOv8oQ" allowfullscreen></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="card mb-3 hoverable d-md-block d-none">
                        <div class="card-img-top"><img class="d-block img-fluid"
                                src="../static/elements/images/IMG_2503.jpg" alt="Ratchadaporn Soontornpas">
                            <div class="card-body">
                                <div class="card-text text-center">
                                    <h4 class="text-pharm font-weight-bold">รัชฎาพร สุนทรภาส</h4>หัวหน้าฝ่ายเภสัชกรรม<br>โรงพยาบาลศรีนครินทร์
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="https://kku.ac.th/" target="_blank">
                        <div class="card mb-2">
                            <div class="card-img-top"><img class="d-block img-fluid"
                                    src="../static/elements/hotlink/kku.png" alt="KKU"></div>
                        </div>
                    </a>
                    <a href="https://md.kku.ac.th/" target="_blank">
                        <div class="card mb-2">
                            <div class="card-img-top"><img class="d-block img-fluid"
                                    src="../static/elements/hotlink/md.png" alt="MD"></div>
                        </div>
                    </a>
                    <a href="https://www.cgd.go.th/" target="_blank">
                        <div class="card mb-2">
                            <div class="card-img-top"><img class="d-block img-fluid"
                                    src="../static/elements/hotlink/cgd.png" alt="CGD"></div>
                        </div>
                    </a>
                    <a href="https://moph.go.th/" target="_blank">
                        <div class="card mb-2">
                            <div class="card-img-top"><img class="d-block img-fluid"
                                    src="../static/elements/hotlink/moph.png" alt="MOPH"></div>
                        </div>
                    </a>
                    <a href="https://dmsic.moph.go.th/" target="_blank">
                        <div class="card mb-2">
                            <div class="card-img-top"><img class="d-block img-fluid"
                                    src="../static/elements/hotlink/dmsic.png" alt="DMSIC"></div>
                        </div>
                    </a>
                    <a href="http://ndi.fda.moph.go.th/" target="_blank">
                        <div class="card mb-2">
                            <div class="card-img-top"><img class="d-block img-fluid"
                                    src="../static/elements/hotlink/ndi.png" alt="NDI"></div>
                        </div>
                    </a>
                    <a href="http://sso.go.th" target="_blank">
                        <div class="card mb-2">
                            <div class="card-img-top"><img class="d-block img-fluid"
                                    src="../static/elements/hotlink/sso.png" alt="SSO"></div>
                        </div>
                    </a>
                    <a href="http://fda.moph.go.th" target="_blank">
                        <div class="card mb-2">
                            <div class="card-img-top"><img class="d-block img-fluid"
                                    src="../static/elements/hotlink/fda.png" alt="FDA"></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>


    <?php require '../static/functions/popup.php'; ?>
    <?php require '../static/functions/footer.php'; ?>
    <?php if ($count > 0) { ?>
    <script>
        $(window).bind('scroll', function () {
            var stick = false;
            if ($(window).scrollTop() > $(window).height()) {
                $('#nav').removeClass('navbar-top');
                $('#nav').addClass('fixed-top');
                $('#nav').addClass('scrolling-navbar');
                document.getElementById("container").style.paddingTop = "82px";

                stick = true;

            } else {
                $('#nav').removeClass('fixed-top');
                $('#nav').removeClass('scrolling-navbar');
                $('#nav').addClass('navbar-top');
                document.getElementById("container").style.paddingTop = "19px";

                stick = false;
            }
        });
    </script>
    <?php } ?>
</body>

</html>