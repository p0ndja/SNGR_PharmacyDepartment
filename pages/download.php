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
            <div class="display-4">ดาวน์โหลดแบบฟอร์ม <?php if (isPermission('editDLForm', $conn) && !isset($_GET['path'])) { ?><button class="btn btn-sm btn-info" onclick="myFunction()">Create Folder</button><?php } ?></div>
            <hr>
            <h5>
            <script>
                function myFunction() {
                    var person = prompt("กรุณาระบุชื่อโฟลเดอร์ ห้ามใช้ \\ / : * ? \" < > |", "Harry Potter");
                    if (person != null && person != "") {
                        window.location = "../pages/download_createfolder.php?mkdir=" + person;
                    }
                }
            </script>
            <?php if (!isset($_GET['path'])) { ?>
            <?php $dirs = scandir('../file/form/'); $c = 0;
                for ($i = 2; $i < sizeof($dirs); $i++) {
                    $c++; ?>
                    <a href="./<?php echo $dirs[$i]?>"><i class="fas fa-folder"></i> <?php echo $dirs[$i]; ?> </a>  <?php if (isPermission('editDLForm', $conn)) { ?>
                    <a onclick='swal({title: "ลบโฟลเดอร์หรือไม่ ?",text: "หลังจากที่ลบแล้ว ไฟล์ทั้งหมดในโฟลเดอร์จะหายและไม่สามารถกู้คืนได้!",icon: "warning",buttons: true,dangerMode: true}).then((willDelete) => { if (willDelete) { window.location = "../pages/download_delete.php?method=dir&name=null&path=<?php echo $dirs[$i]; ?>";}});'>
                            <i class="fas fa-trash-alt text-danger"></i></a>
                    <?php } ?><br>
                <?php }
                if ($c == 0) echo "&nbsp;&nbsp;&nbsp;&nbsp; <sub><i>ไม่พบโฟลเดอร์ใด ๆ ในระบบ<br>หากคุณเป็นแอดมิน ลอง Create Folder ดูสิ!</i></sub>";

            ?>
            <?php } else if (isset($_GET['path'])) { $path = $_GET['path']; ?>
                <a href="../download/"><i class="fas fa-arrow-circle-left"></i> ย้อนกลับ</a><br>
                <a href="#"><i class="fas fa-folder-open"></i> <?php echo $path; ?></a><br>
                <?php
                $count = 0;
                if ($handle = opendir('../file/form/' . $path)) {
                    while (false !== ($entry = readdir($handle))) {
                        if ($entry != "." && $entry != "..") {
                            echo "<a href='../file/form/" . $path . '/' . $entry . "'>&nbsp;&nbsp;&nbsp;&nbsp; <i class='fas fa-file'></i> $entry</a>";
                            if (isPermission('editDLForm', $conn)) { ?>
                                <a onclick='swal({title: "ลบไฟล์ <?php echo $entry; ?> หรือไม่ ?",text: "หลังจากที่ลบแล้วจะไม่สามารถกู้คืนได้!",icon: "warning",buttons: true,dangerMode: true}).then((willDelete) => { if (willDelete) { window.location = "../pages/download_delete.php?method=file&name=<?php echo $entry; ?>&path=<?php echo $path; ?>";}});'><i class="fas fa-trash-alt text-danger"></i></a>
                            <?php }
                            echo "<br>"; 
                            $count++;
                        }
                    }
                    closedir($handle);
                }
                if ($count == 0) echo "&nbsp;&nbsp;&nbsp;&nbsp; <sub><i>โฟลเดอร์นี้ว่างเปล่า</i></sub>";
                ?>
            <?php } ?>
            <?php if (isPermission('editDLForm', $conn) && isset($_GET['path'])) { ?>
            <form id="formUploadFile" method="POST" action="../pages/download_upload.php" enctype="multipart/form-data" class="mt-1">
                <input type="hidden" name="path" id="path" value="<?php echo $_GET['path']; ?>">
                &nbsp;&nbsp;&nbsp;&nbsp; <input type="file" name="attachment[]" id="attachment" class="validate" multiple>
                <input type="submit" value="อัพโหลด!">
            </form>
            <?php } ?>
            </h5>
        </div>
    </div>

    <sc
    

    <?php require '../static/functions/popup.php'; ?>
    <?php require '../static/functions/footer.php'; ?>
</body>

</html>