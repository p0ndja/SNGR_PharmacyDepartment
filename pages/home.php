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
                    <div class="card hoverable">
                        <div class="card-img-top"><img class="d-block img-fluid"
                                src="https://placehold.it/800x800?text=Unit A" alt="First slide"></div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="card hoverable">
                        <div class="card-img-top"><img class="d-block img-fluid"
                                src="https://placehold.it/800x800?text=Unit B" alt="First slide"></div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="card hoverable">
                        <div class="card-img-top"><img class="d-block img-fluid"
                                src="https://placehold.it/800x800?text=Unit C" alt="First slide"></div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="card hoverable">
                        <div class="card-img-top"><img class="d-block img-fluid"
                                src="https://placehold.it/800x800?text=Unit D" alt="First slide"></div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-9 col-12">
                    <!--- First -->
                    <h3 class="font-weight-bold">ข่าวประชาสัมพันธ์</h3>
                    <div class="row mb-5">
                        <div class="col-4">
                            <div class="card mb-3">
                                <div class="card-img-top"><img class="d-block img-fluid"
                                        src="https://placehold.it/1600x900?text=Thumbnail" alt="First slide"></div>
                                <div class="card-body">
                                    <div class="card-text">Title</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card mb-3">
                                <div class="card-img-top"><img class="d-block img-fluid"
                                        src="https://placehold.it/1600x900?text=Thumbnail" alt="First slide"></div>
                                <div class="card-body">
                                    <div class="card-text">Title</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card mb-3">
                                <div class="card-img-top"><img class="d-block img-fluid"
                                        src="https://placehold.it/1600x900?text=Thumbnail" alt="First slide"></div>
                                <div class="card-body">
                                    <div class="card-text">Title</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card mb-3">
                                <div class="card-img-top"><img class="d-block img-fluid"
                                        src="https://placehold.it/1600x900?text=Thumbnail" alt="First slide"></div>
                                <div class="card-body">
                                    <div class="card-text">Title</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card mb-3">
                                <div class="card-img-top"><img class="d-block img-fluid"
                                        src="https://placehold.it/1600x900?text=Thumbnail" alt="First slide"></div>
                                <div class="card-body">
                                    <div class="card-text">Title</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card mb-3">
                                <div class="card-img-top"><img class="d-block img-fluid"
                                        src="https://placehold.it/1600x900?text=Thumbnail" alt="First slide"></div>
                                <div class="card-body">
                                    <div class="card-text">Title</div>
                                </div>
                            </div>
                        </div>
                        <div class="col d-flex flex-row-reverse"><a href="#" class="btn btn-info">Read More...</a></div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-6 col-md-3">
                            <div class="card mb-3">
                                <div class="card-img-top"><img class="d-block img-fluid"
                                        src="https://placehold.it/900x900?text=ADR" alt="First slide"></div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="card mb-3">
                                <div class="card-img-top"><img class="d-block img-fluid"
                                        src="https://placehold.it/900x900?text=HAD" alt="First slide"></div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="card mb-3">
                                <div class="card-img-top"><img class="d-block img-fluid"
                                        src="https://placehold.it/900x900?text=ME" alt="First slide"></div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="card mb-3">
                                <div class="card-img-top"><img class="d-block img-fluid"
                                        src="https://placehold.it/900x900?text=RDU" alt="First slide"></div>
                            </div>
                        </div>
                        <div class="col-6 col-md-6">
                            <div class="card mb-3">
                                <div class="card-img-top"><img class="d-block img-fluid"
                                        src="https://placehold.it/900x200?text=Reserch and R2R" alt="First slide"></div>
                            </div>
                        </div>
                        <div class="col-6 col-md-6">
                            <div class="card mb-3">
                                <div class="card-img-top"><img class="d-block img-fluid"
                                        src="https://placehold.it/900x200?text=Download Form" alt="First slide"></div>
                            </div>
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