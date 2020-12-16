<?php
    include '../static/functions/connect.php';

    if (isLogin() && isPermission("editHomepage", $conn)) {

        $finaldir = ""; $name_file = "";
        if (isset($_FILES['carousel_file']) && $_FILES['carousel_file']['name'] != "") {
            $name_file = $_FILES['carousel_file']['name'];
            $tmp_name = $_FILES['carousel_file']['tmp_name'];
            $locate_img ="../static/elements/carousel/";
            if (!file_exists($locate_img)) {
                mkdir($locate_img);
            }
            move_uploaded_file($tmp_name,$locate_img.$name_file);
            $finaldir = $locate_img.$name_file;
        }



        if (isset($_GET['name']) && ($_GET['name'] != $name_file)) { //New Image File
            $picNameAll = explode(".", str_replace("../static/elements/carousel/", "", $_GET['name']));
            $picName = "";
            for ($o = 0; $o < sizeof($picNameAll) - 1; $o++) {
                $picName .= $picNameAll[$o];
            }
            unlink($locate_img . $_GET['name']);
            unlink($locate_img . $picName . '.txt');
        }

        $title = $_POST['cTitle'];
        $description = $_POST['cDescription'];

        $picNameAll = explode(".", $name_file);
        $picName = "";
        for ($o = 0; $o < sizeof($picNameAll) - 1; $o++) {
            $picName .= $picNameAll[$o];
        }

        $file = fopen("../static/elements/carousel/$picName.txt","w");
        if (!fwrite($file,"$title\n$description"))
            die("CAN'T WRITE FILE");
        fclose($file);
    }
    header("Location: ../admin/carousel");
?>