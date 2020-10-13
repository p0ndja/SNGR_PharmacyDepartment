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
                -webkit-column-count: 2;
                -moz-column-count: 2;
                column-count: 2;
            }
        }
    </style>
</head>

<body>
    <header>
        <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
                <!-- Slide One - Set the background image for this slide in the line below -->
                <div class="carousel-item active"
                    style="background-image: url('https://eskipaper.com/images/landscape-wallpaper-hd-28.jpg')">
                    <div class="carousel-caption">
                        <h2 class="display-5">First Slide</h2>
                        <p class="lead">This is a description for the first slide.</p>
                    </div>
                </div>
                <!-- Slide Two - Set the background image for this slide in the line below -->
                <div class="carousel-item"
                    style="background-image: url('https://wallpaperset.com/w/full/b/7/0/349421.jpg')">
                    <div class="carousel-caption">
                        <h2 class="display-5">Second Slide</h2>
                        <p class="lead">This is a description for the second slide.</p>
                    </div>
                </div>
                <!-- Slide Three - Set the background image for this slide in the line below -->
                <div class="carousel-item" style="background-image: url('https://wallpaperaccess.com/full/112714.jpg')">
                    <div class="carousel-caption">
                        <h2 class="display-5">Third Slide</h2>
                        <p class="lead">This is a description for the third slide.</p>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </header>
    <nav class="navbar navbar-expand-lg navbar-dark navbar-normal" id="nav" role="navigation">
        <?php require '../static/functions/navbar.php'; ?>
    </nav>
    <div class="container-fluid">
        <div class="container mb-3" id="container">
            <div class="row">
                <div class="col-6 col-md-3">
                    <a href="../category/manufacture-1">
                    <div class="card hoverable mb-3">
                        <div class="card-img-top"><img class="d-block img-fluid"
                                src="../static/elements/hotlink/manu.jpg" alt="First slide"></div>
                    </div>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="../category/service-1">
                    <div class="card hoverable mb-3">
                        <div class="card-img-top"><img class="d-block img-fluid"
                                src="../static/elements/hotlink/serv.jpg" alt="First slide"></div>
                    </div>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="../category/DIC-1">
                    <div class="card hoverable mb-3">
                        <div class="card-img-top"><img class="d-block img-fluid"
                                src="../static/elements/hotlink/dic.jpg" alt="First slide"></div>
                    </div>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="../category/inventory-1">
                    <div class="card hoverable mb-3">
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
                    <div class="mb-5">
                        <h3 class="font-weight-bold">ข่าวประชาสัมพันธ์</h3>
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
                    <div class="row mb-4">
                        <div class="col-6 col-md-3">
                            <a href="../category/CoPADR-1">
                            <div class="card mb-3">
                                <div class="card-img-top"><img class="d-block img-fluid"
                                        src="../static/elements/hotlink/adr.jpg" alt="ADR"></div>
                            </div>
                            </a>
                        </div>
                        <div class="col-6 col-md-3">
                            <a href="../category/CoPHAD-1">
                            <div class="card mb-3">
                                <div class="card-img-top"><img class="d-block img-fluid"
                                        src="../static/elements/hotlink/had.jpg" alt="HAD"></div>
                            </div>
                            </a>
                        </div>
                        <div class="col-6 col-md-3">
                            <a href="../category/CoPME-1">
                            <div class="card mb-3">
                                <div class="card-img-top"><img class="d-block img-fluid"
                                        src="../static/elements/hotlink/me.jpg" alt="ME"></div>
                            </div>
                            </a>
                        </div>
                        <div class="col-6 col-md-3">
                            <a href="../category/CoPRDU-1">
                            <div class="card mb-3">
                                <div class="card-img-top"><img class="d-block img-fluid"
                                        src="../static/elements/hotlink/rdu.jpg" alt="RDU"></div>
                            </div>
                            </a>
                        </div>
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
</body>

</html>