<?php
    include '../static/functions/connect.php';

    if (isLogin() && isPermission("editHomepage", $conn)) {
        if (isset($_GET['target']) && file_exists('../static/elements/carousel/' . $_GET['target'])) {

            $picNameAll = explode(".", $_GET['target']);
            $picName = str_replace("." . $picNameAll[sizeof($picNameAll) - 1], "", $picFile);

            if (unlink('../static/elements/carousel/' . $_GET['target']) && unlink("../static/elements/carousel/$picName.txt")) {
                $_SESSION['swal_success'] = "ลบรูปภาพสำเร็จ!";
            } else {
                $_SESSION['swal_error'] = "พบข้อผิดพลาด!";
                $_SESSION['swal_error_msg'] = "ลบรูปภาพไม่สำเร็จ!";
            }
            
        }
    }
    header("Location: ../admin/homepage");
?>