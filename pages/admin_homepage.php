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
            <?php needPermission("editHomepage", $conn); ?>
            <div class="row">
            <div class="col-12 col-md-7">
            <h4 class="font-weight-bold">Edit Carousel</h4>
            <!--Carousel Wrapper-->
            <div id="carousel" class="carousel slide carousel-multi-item" data-interval="false">

                <!--Controls-->
                <div class="controls-top">
                    <a class="btn-floating green" href="#carousel" data-slide="prev"><i
                            class="fas fa-chevron-left"></i></a>
                    <a class="btn-floating green" href="#carousel" data-slide="next"><i
                            class="fas fa-chevron-right"></i></a>
                </div>
                <!--/.Controls-->

                <?php 
                    $path = "../static/elements/carousel/";
                    if (!file_exists($path))
                        mkdir($path);
                    
                    $count = 0;
                    $files = glob($path . "*.{jpg,png,gif}", GLOB_BRACE);
                    if ($files)
                        $count = count($files);
                ?>

                <!--Indicators-->
                <ol class="carousel-indicators">
                    <?php 
                    for ($i = 0; $i < $count; $i++) {
                        echo "<li class='green' data-target='#carousel' data-slide-to='$i'";
                        if ($i == 0) echo " class='active'></li>";
                        else echo "></li>";
                    }
                    echo "<li class='green' data-target='#carousel' data-slide-to='$count'></li>";
                    ?>
                </ol>
                <!--/.Indicators-->

                <!--Slides-->
                <div class="carousel-inner" role="listbox">
                    <?php for ($i = 0; $i < $count; $i++) {
                    
                        $picPath = $files[$i];
                        $picNameAll = explode(".", str_replace("../static/elements/carousel/", "", $picPath));
                        $picName = str_replace("." . $picNameAll[sizeof($picNameAll) - 1], "", $picFile);


                        $picFile = str_replace("../static/elements/carousel/", "", $picPath);

                        $line = array();
                        $txtFile = "../static/elements/carousel/$picName.txt";
                        
                        if (file_exists($txtFile)) {
                            $file = fopen("../static/elements/carousel/$picName.txt", "r");
                            while(!feof($file)) {
                                array_push($line, fgets($file));
                                # do same stuff with the $line
                            }
                            fclose($file);
                        }
                        ?>
                        <div class="carousel-item <?php if ($i == 0) echo "active"; ?>">
                            <div class="col-md-12" style="float:left">
                                <div class="card mb-3">
                                    <img class="card-img-top" src="<?php echo $picPath; ?>" alt="Card image cap" id="carousel_<?php echo $i; ?>" name="carousel_<?php echo $i; ?>">
                                    <div class="card-body">
                                        <form action="../pages/admin_carousel_save.php?name=<?php echo $picFile;?>" method="post" enctype="multipart/form-data" >
                                            <input type="file" name="carousel_file" id="carousel_file_<?php echo $i;?>" class="mb-3" accept="image/png, image/jpeg"></input>
                                            <script>
                                                document.getElementById("carousel_file_<?php echo $i;?>").onchange = function () {
                                                    var reader = new FileReader();
                                                    reader.onload = function (e) {
                                                        document.getElementById("carousel_<?php echo $i;?>").src = e.target.result;
                                                    };
                                                    reader.readAsDataURL(this.files[0]);
                                                };
                                            </script>
                                            <h4 class="card-title"><input type="text" placeholder="หัวข้อ" class="form-control mr-sm-3" value="<?php echo $line[0]; ?>" id="carouselTitle" name="cTitle"></input></h4>
                                            <p class="card-text">
                                                <?php
                                                $allLine = "";
                                                for($o = 1; $o < count($line); $o++) {
                                                    $allLine .= $line[$o];
                                                }
                                                ?>
                                                <textarea type="text" placeholder="คำอธิบาย" class="form-control mr-sm-3" id="carouselDescription" name="cDescription"><?php echo $allLine; ?></textarea>
                                            </p>
                                            <input type="submit" class="btn btn-success" value="update"></input>
                                            <a class="btn btn-danger" onclick='swal({title: "ลบรูปนี้หรือไม่",text: "หลังจากที่ลบแล้ว จะไม่สามารถกู้คืนได้!",icon: "warning",buttons: true,dangerMode: true}).then((willDelete) => { if (willDelete) { window.location = "../pages/admin_carousel_delete.php?target=<?php echo $picFile; ?>";}});'>DELETE</a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="carousel-item">
                        <div class="col-md-12" style="float:left">
                            <div class="card mb-3">
                                <img class="card-img-top" src="../static/elements/1920x1080.jpg" id="carousel-preview" name="carousel-preview">
                                <div class="card-body">
                                    <form action="../pages/admin_carousel_save.php" method="post" enctype="multipart/form-data" >
                                        <input type="file" class="mb-3" name="carousel_file" id="newCarousel" required></input>
                                        <script>
                                            document.getElementById("newCarousel").onchange = function () {
                                                var reader = new FileReader();
                                                reader.onload = function (e) {
                                                    document.getElementById("carousel-preview").src = e.target.result;
                                                };
                                                reader.readAsDataURL(this.files[0]);
                                            };
                                        </script>
                                        <h4 class="card-title"><input type="text" placeholder="หัวข้อ" class="form-control mr-sm-3" id="newcarouselTitle" name="cTitle"></input></h4>
                                            <p class="card-text">
                                                <?php
                                                $allLine = "";
                                                for($o = 1; $o < count($line); $o++) {
                                                    $allLine .= $line[$o];
                                                }
                                                ?>
                                                <textarea type="text" placeholder="คำอธิบาย" class="form-control mr-sm-3" id="newcarouselDescription" name="cDescription"></textarea>
                                            </p>
                                        <input type="submit" class="btn btn-success" value="create"></input>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/.Slides-->
            </div>
            <!--/.Carousel Wrapper-->
            </div>
            <div class="col-12 col-md-5">
                <h4 class="font-weight-bold">Edit Promoting Video</h4>
                <form action="../pages/admin_video_save.php" method="post" enctype="multipart/form-data">
                    <?php
                    $vdo = watchVDO();
                    foreach($vdo as $v) { ?> 
                        <input type="text" placeholder="ใส่ลิงก์ Embedded Video ของคุณที่นี่..." class="form-control mr-sm-3 mb-1" id="vdo" name="vdo[]" value="<?php echo $v; ?>"></input>
                    <?php } ?>
                    <input type="text" placeholder="ใส่ลิงก์ Embedded Video ของคุณที่นี่..." class="form-control mr-sm-3 mb-1" id="vdo" name="vdo[]"></input>
                    <div id="addOnVDOSection">
                    </div>
                    <button type="button" class="btn btn-success btn-floating" id="addButton" onclick="addVDOText();"><i class="fas fa-plus"></i></button>
                    <input type="submit" class="btn btn-success" value="Update!"></input>
                </form>
            </div>
            </div>
        </div>
    </div>

    <script>
        function addVDOText() {
            $("#addOnVDOSection").append('<input type="text" placeholder="ใส่ลิงก์ Embedded Video ของคุณที่นี่..." class="form-control mr-sm-3 mb-1" id="vdo" name="vdo[]"></input>');
        }
    </script>

    <?php require '../static/functions/popup.php'; ?>
    <?php require '../static/functions/footer.php'; ?>
</body>

</html>