<?php
    require '../static/functions/connect.php';

    if (isset($_GET['path']) && isset($_GET['name']) && isPermission("editDLForm", $conn) && isset($_GET['method'])) {
        $path = $_GET['path'];
        if ($_GET['method'] == "file") {
            unlink('../file/form/' . $_GET['path'] . '/' . $_GET['name']);
            $file = $_GET['name'];
            $_SESSION['swal_success'] = "ลบไฟล์สำเร็จ";
            $_SESSION['swal_success_msg'] = "ลบไฟล์ $file เรียบร้อยแล้ว!";
            addLog($conn, $_SESSION['id'], "USER_FILE_FILE_DELETE", "FILE: $file\nPATH: $path");
            header("Location: ../download/" . $_GET['path']);
        } else if ($_GET['method'] == "dir") {
            if (rmdir('../file/form/' . $_GET['path'])) {
                $_SESSION['swal_success'] = "ลบโฟลเดอร์สำเร็จ";
                $_SESSION['swal_success_msg'] = "ลบโฟลเดอร์ $path เรียบร้อยแล้ว!";
                addLog($conn, $_SESSION['id'], "USER_FILE_FOLDER_RMDIR", "PATH: $path");
            } else {
                $_SESSION['swal_error'] = "พบข้อผิดพลาด";
                $_SESSION['swal_error_msg'] = "พบไฟล์ในโฟลเดอร์ โปรดลบไฟล์ในโฟลเดอร์ก่อนแล้วจึงลบโฟลเดอร์นี้";
            }
            header("Location: ../download/");   
        }
    }

?>