<?php
    require '../static/functions/connect.php';
    if (isPermission("editDLForm", $conn)) {
        $fileTotal = count($_FILES['attachment']['name']);
        if (is_uploaded_file($_FILES['attachment']['tmp_name'][0])) {
            $path = $_POST['path'];
            if (!file_exists("../file/form/$path/")) {
                mkdir("../file/form/$path/");
            }
            $name_file = "";
            for ($i = 0; $i < $fileTotal; $i++) {
                if($_FILES['attachment']['tmp_name'][$i] != ""){
                    $name_file = $_FILES['attachment']['name'][$i];
                    $tmp_name = $_FILES['attachment']['tmp_name'][$i];
                    $locate_img = "../file/form/$path/";
                    move_uploaded_file($tmp_name,$locate_img.$name_file);
                    rename($locate_img.$name_file, $locate_img.$name_file);
                    addLog($conn, $_SESSION['id'], "USER_FILE_FILE_CREATE", "FILE: $name_file\nPATH: $path");
                }
            }

            $_SESSION['swal_success'] = "อัพโหลดไฟล์สำเร็จ";
            if ($fileTotal == 1) {
                $_SESSION['swal_success_msg'] = "เพิ่มไฟล์ $name_file เรียบร้อยแล้ว!";
            } else {
                $_SESSION['swal_success_msg'] = "เพิ่ม $fileTotal ไฟล์เรียบร้อยแล้ว!";
            }
        }
    }

    header("Location: ../download/$path");

?>