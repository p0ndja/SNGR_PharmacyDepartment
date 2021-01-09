<?php
    include '../static/functions/connect.php';

    if (isLogin() && isPermission("editHomepage", $conn)) {

        $finaldir = ""; $name_file = (isset($_GET['name'])) ? $_GET['name'] : "";
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
            $picName = str_replace("." . $picNameAll[sizeof($picNameAll) - 1], "", $picFile);

            unlink($locate_img . $_GET['name']);
            unlink($locate_img . $picName . '.txt');
        }

        $title = $_POST['cTitle'];
        $description = $_POST['cDescription'];

        $picNameAll = explode(".", $name_file);
        $picName = str_replace("." . $picNameAll[sizeof($picNameAll) - 1], "", $picFile);


        $file = fopen("../static/elements/carousel/$picName.txt","w");
        if (!fwrite($file,"$title\n$description")) {
            $_SESSION['swal_error'] = "พบข้อผิดพลาด!";
            $_SESSION['swal_error_msg'] = "ไม่สามารถเขียน/อ่านไฟล์ได้";
        } else {
            $_SESSION['swal_success'] = "สำเร็จ!";
            fclose($file);
        }
    }
    header("Location: ../admin/homepage");
?>