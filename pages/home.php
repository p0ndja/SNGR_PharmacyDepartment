<?php 
    require '../static/functions/connect.php';
?>

<!DOCTYPE html>
<html lang="th" prefix="og:http://ogp.me/ns#">

<head>
    <?php require '../static/functions/head.php'; ?>
    <style>
        header {
            height: 75vh !important;
        }

        .carousel-item {
            height: 75vh;
            background: no-repeat center center scroll;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
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
                    $picFile = str_replace("../static/elements/carousel/", "", $picPath);
                    $picNameAll = explode(".", $picFile);
                    $picName = str_replace("." . $picNameAll[sizeof($picNameAll) - 1], "", $picFile);

                    $line = array();
                    $txtFile = "../static/elements/carousel/$picName.txt";                        
                    if (file_exists($txtFile)) {
                        $file = fopen($txtFile, "r");
                        while(!feof($file)) {
                            array_push($line, fgets($file));
                        }
                        fclose($file);
                    }
                ?>
                <div class="carousel-item <?php if ($i == 0) echo 'active'; ?>" style="background-image: url('<?php echo $picPath; ?>')" <?php if ($line != null) { echo "alt='$line[0]'"; }?>>
                    <!-- style="-webkit-mask-image: -webkit-gradient(linear, left 50%, left bottom, from(rgba(0,0,0,1)), to(rgba(0,0,0,0)))" -->
                    <?php if ($line != null) { ?>
                    <div class="carousel-caption d-block animated fadeInDown">
                        <div class="carousel-caption-text">
                            <h5><?php echo $line[0]; ?>
                                <?php if (isPermission("editHomepage", $conn)) { ?>
                                <a href='../admin/homepage' class='text-danger'><i class='fas fa-pencil-alt'></i></a>
                                <a onclick='swal({title: "ลบรูปนี้หรือไม่",text: "หลังจากที่ลบแล้ว จะไม่สามารถกู้คืนได้!",icon: "warning",buttons: true,dangerMode: true}).then((willDelete) => { if (willDelete) { window.location = "../pages/admin_carousel_delete.php?target=<?php echo $picFile; ?>";}});'><i class="fas fa-trash-alt text-danger"></i></a>
                                <?php } ?>
                            </h5>
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
    <div class="container-bg">
        <nav class="navbar navbar-expand-lg navbar-dark navbar-normal <?php if ($count <= 0) echo 'fixed-top scrolling-navbar'; ?>"
            id="nav" role="navigation">
            <?php require '../static/functions/navbar.php'; ?>
        </nav>
        <div class=" container-fluid" id="container">
            <div class="container">
                <div <?php if ($count == 0) echo 'style="padding-top: 88px"'; ?> class="mt-3"></div>
                <div class="row">
                    <div class="col-6 col-md-3">
                        <a href="../category/manufacture-1">
                            <div class="card hoverable mb-3">
                                <div class="card-img-top"><img class="d-block img-fluid"
                                        src="../static/elements/hotlink/manu.jpg" class="lazy" data-src="<?php echo lazy("../static/elements/hotlink/manu.jpg"); ?>" alt="First slide"></div>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 col-md-3">
                        <a href="../category/service-1">
                            <div class="card hoverable mb-3">
                                <div class="card-img-top"><img class="d-block img-fluid"
                                        src="../static/elements/hotlink/serv.jpg" class="lazy" data-src="<?php echo lazy("../static/elements/hotlink/serv.jpg"); ?>" alt="First slide"></div>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 col-md-3">
                        <a href="../category/DIC-1">
                            <div class="card hoverable mb-3">
                                <div class="card-img-top"><img class="d-block img-fluid"
                                        src="../static/elements/hotlink/dic.jpg" class="lazy" data-src="<?php echo lazy("../static/elements/hotlink/dic.jpg"); ?>" alt="First slide"></div>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 col-md-3">
                        <a href="../category/inventory-1">
                            <div class="card hoverable mb-3">
                                <div class="card-img-top"><img class="d-block img-fluid"
                                        src="../static/elements/hotlink/inv.jpg" class="lazy" data-src="<?php echo lazy("../static/elements/hotlink/inv.jpg"); ?>" alt="First slide"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="container">
            <div class="row mt-3">
                <div class="col-md-9 col-12">
                    <!--- First -->
                    <div class="mb-3">
                        <?php echo createHeader("ข่าวประชาสัมพันธ์"); ?>               
                        <?php
                            $query = "SELECT `hotlink`,`title`,`cover`,`thumbnail`,`article`,`time`,`id`,`category` FROM `post` WHERE isHidden = 0 AND category = 'news' ORDER by isPinned DESC, time DESC limit 5";
                            $result = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                            /* $json_txt = file_get_contents("https://api.11th.studio/pharmmd/post?category=news&limit=5");
                            foreach (json_decode($json_txt, true) as $row) { */
                                $link = $row['hotlink'] ? $row['hotlink'] : "../post/" . $row['id'];
                        ?>
                        <a href="<?php echo $link; ?>" class="text-dark">
                            <div class="card mb-3 <?php if (getPostdata($row['id'], 'isPinned', $conn)) echo 'border border-success z-depth-1'; ?>">
                                <div class="row g-0">
                                    <?php if (!empty($row['cover']) || !empty($row['thumbnail'])) {
                                        $thumb = !empty($row['thumbnail']) ? $row['thumbnail'] : $row['cover']; ?>
                                    <div class="col-md-auto col-12">
                                        <img src="<?php echo $thumb; ?>" class="img-fluid" style="max-height: 200px;"/>
                                    </div>
                                    <?php } ?>
                                    <div class="col-md">
                                        <div class="card-body">
                                        <h5 class="font-weight-bold card-title"><a href="<?php echo $link; ?>" class="md"><?php echo $row['title']; ?></a> <?php if (isLogin() && canUseThisCategory(getRole($_SESSION['id'], $conn), $row['category'], $conn)) { ?><small><a
                            href="../post/edit-<?php echo $row['id']; ?>"><i class="fas fa-edit text-success"></i></a>
                        <a
                            onclick='
                                    swal({title: "ลบข่าวหรือไม่ ?",text: "หลังจากที่ลบแล้ว ข่าวนี้จะไม่สามารถกู้คืนได้!",icon: "warning",buttons: true,dangerMode: true}).then((willDelete) => { if (willDelete) { window.location = "../pages/post_delete.php?id=<?php echo $row["id"]; ?>&category=<?php echo $row["category"]; ?>";}});'>
                            <i class="fas fa-trash-alt text-danger"></i></small></a><?php } ?></h5>
                                            <p class="card-text">
                                                <?php echo mb_substr($row['article'],0,222,'UTF-8'); if (strlen($row['article']) > 222) echo "...<a href='$link'>อ่านเพิ่มเติม</a>"?>
                                            </p>
                                            <p class="card-text">
                                                <small class="text-muted">ประมาณ <?php echo fromThenToNow($row['time']); ?></small>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <?php } ?>
                        <a href="../category/news-1" class="btn btn-info"><i class="fas fa-arrow-circle-right"></i>
                            อ่านเพิ่มเติม...</a>
                    </div>
                    <div class="mb-1 mt-3"><?php echo createHeader("ชุมชนนักปฏิบัติ"); ?></div>
                    <div class="row">
                        <div class="col-6 col-md-3">
                            <a href="../category/CoPADR-1">
                                <div class="card mb-3">
                                    <div class="card-img-top"><img class="d-block img-fluid"
                                            src="../static/elements/hotlink/adr.jpg" class="lazy" data-src="<?php echo lazy("../static/elements/hotlink/adr.jpg"); ?>" alt="ADR"></div>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 col-md-3">
                            <a href="../category/CoPHAD-1">
                                <div class="card mb-3">
                                    <div class="card-img-top"><img class="d-block img-fluid"
                                            src="../static/elements/hotlink/had.jpg" class="lazy" data-src="<?php echo lazy("../static/elements/hotlink/had.jpg"); ?>" alt="HAD"></div>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 col-md-3">
                            <a href="../category/CoPME-1">
                                <div class="card mb-3">
                                    <div class="card-img-top"><img class="d-block img-fluid"
                                            src="../static/elements/hotlink/me.jpg" class="lazy" data-src="<?php echo lazy("../static/elements/hotlink/me.jpg"); ?>" alt="ME"></div>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 col-md-3">
                            <a href="../category/CoPRDU-1">
                                <div class="card mb-3">
                                    <div class="card-img-top"><img class="d-block img-fluid"
                                            src="../static/elements/hotlink/rdu.jpg" class="lazy" data-src="<?php echo lazy("../static/elements/hotlink/rdu.jpg"); ?>" alt="RDU"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12 col-md-12">
                            <a href="../news/">
                                <img class="img-fluid mb-3" src="../static/elements/hotlink/sngrnews.png" class="lazy" data-src="<?php echo lazy("../static/elements/hotlink/sngrnews.png"); ?>">
                            </a>
                        </div>
                        <div class="col-12 col-md-6">
                            <a href="../category/research-1">
                                <div class="card mb-1">
                                    <div class="card-img-top"><img class="d-block img-fluid"
                                            src="../static/elements/hotlink/researchr2r.jpg" class="lazy" data-src="<?php echo lazy("../static/elements/hotlink/researchr2r.jpg"); ?>"></div>
                                </div>
                            </a>
                        </div>
                        <div class="col-12 col-md-6">
                            <a href="../download/">
                                <div class="card mb-1">
                                    <div class="card-img-top"><img class="d-block img-fluid"
                                            src="../static/elements/hotlink/dlform.jpg" class="lazy" data-src="<?php echo lazy("../static/elements/hotlink/dlform.jpg"); ?>"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <?php foreach(watchVDO() as $v) { ?>
                        <div class="col-12 col-md-6">
                            <div class="card mb-3">
                                <div class="card-img-top">
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <iframe class="embed-responsive-item" src="<?php echo $v; ?>"
                                            allowfullscreen></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <?php if (isPermission("editHomepage", $conn)) { ?>
                        <div class="col-12 col-md-6">
                            <a href="../admin/homepage">แก้ไขรายการวิดีโอ</a>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="card mb-3 hoverable d-md-block d-none">
                        <div class="card-img-top"><img class="d-block img-fluid"
                                src="../static/elements/images/IMG_2503.jpg" alt="Ratchadaporn Soontornpas">
                            <div class="card-body">
                                <div class="card-text text-center">
                                    <h4 class="text-pharm font-weight-bold">รัชฎาพร สุนทรภาส</h4>
                                    หัวหน้าฝ่ายเภสัชกรรม<br>โรงพยาบาลศรีนครินทร์
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="https://kku.ac.th/" target="_blank">
                        <div class="card mb-2">
                            <div class="card-img-top"><img class="d-block img-fluid"
                                    src="../static/elements/hotlink/kku.png" class="lazy" data-src="<?php echo lazy("../static/elements/hotlink/kku.png"); ?>" alt="KKU"></div>
                        </div>
                    </a>
                    <a href="https://md.kku.ac.th/" target="_blank">
                        <div class="card mb-2">
                            <div class="card-img-top"><img class="d-block img-fluid"
                                    src="../static/elements/hotlink/md.png" class="lazy" data-src="<?php echo lazy("../static/elements/hotlink/md.png"); ?>" alt="MD"></div>
                        </div>
                    </a>
                    <a href="https://www.cgd.go.th/" target="_blank">
                        <div class="card mb-2">
                            <div class="card-img-top"><img class="d-block img-fluid"
                                    src="../static/elements/hotlink/cgd.png" class="lazy" data-src="<?php echo lazy("../static/elements/hotlink/cgd.png"); ?>" alt="CGD"></div>
                        </div>
                    </a>
                    <a href="https://moph.go.th/" target="_blank">
                        <div class="card mb-2">
                            <div class="card-img-top"><img class="d-block img-fluid"
                                    src="../static/elements/hotlink/moph.png" class="lazy" data-src="<?php echo lazy("../static/elements/hotlink/moph.png"); ?>" alt="MOPH"></div>
                        </div>
                    </a>
                    <a href="https://dmsic.moph.go.th/" target="_blank">
                        <div class="card mb-2">
                            <div class="card-img-top"><img class="d-block img-fluid"
                                    src="../static/elements/hotlink/dmsic.png" class="lazy" data-src="<?php echo lazy("../static/elements/hotlink/dmsic.png"); ?>" alt="DMSIC"></div>
                        </div>
                    </a>
                    <a href="http://ndi.fda.moph.go.th/" target="_blank">
                        <div class="card mb-2">
                            <div class="card-img-top"><img class="d-block img-fluid"
                                    src="../static/elements/hotlink/ndi.png" class="lazy" data-src="<?php echo lazy("../static/elements/hotlink/ndi.png"); ?>" alt="NDI"></div>
                        </div>
                    </a>
                    <a href="http://sso.go.th" target="_blank">
                        <div class="card mb-2">
                            <div class="card-img-top"><img class="d-block img-fluid"
                                    src="../static/elements/hotlink/sso.png" class="lazy" data-src="<?php echo lazy("../static/elements/hotlink/sso.png"); ?>" alt="SSO"></div>
                        </div>
                    </a>
                    <a href="http://fda.moph.go.th" target="_blank">
                        <div class="card mb-2">
                            <div class="card-img-top"><img class="d-block img-fluid"
                                    src="../static/elements/hotlink/fda.png" class="lazy" data-src="<?php echo lazy("../static/elements/hotlink/fda.png"); ?>" alt="FDA"></div>
                        </div>
                    </a>
                    <?php 
                        $page = file_get_contents('../static/functions/statscounter.html');
                        $page = str_replace("{wstotal}", $_SESSION['wstotal'], $page);
                        $page = str_replace("{wstoday}", $_SESSION['wstoday'], $page);
                        $page = str_replace("{wsmonth}", $_SESSION['wsmonth'], $page);
                        $page = str_replace("{wsyear}", $_SESSION['wsyear'], $page);
                        $page = str_replace("{wsip}", getClientIP(), $page);
                        echo $page; 
                    ?>
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
            if ($(window).scrollTop() > $("#carousel").height()) {
                $('#nav').removeClass('navbar-top');
                $('#nav').addClass('fixed-top');
                $('#nav').addClass('scrolling-navbar');
                document.getElementById("container").style.paddingTop = "50px";

                stick = true;

            } else {
                $('#nav').removeClass('fixed-top');
                $('#nav').removeClass('scrolling-navbar');
                $('#nav').addClass('navbar-top');
                document.getElementById("container").style.paddingTop = "0px";

                stick = false;
            }
        });
    </script>
    <?php } ?>
</body>

</html>