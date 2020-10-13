<?php
    
    $fileTotal = count($_FILES['attachment']['name']);
    if (is_uploaded_file($_FILES['attachment']['tmp_name'][0])) {
        $path = $_POST['path'];
        if (!file_exists("../file/form/$path/")) {
            mkdir("../file/form/$path/");
        }
        for ($i = 0; $i < $fileTotal; $i++) {
            if($_FILES['attachment']['tmp_name'][$i] != ""){
                $name_file = $_FILES['attachment']['name'][$i];
                $tmp_name = $_FILES['attachment']['tmp_name'][$i];
                $locate_img = "../file/form/$path/";
                move_uploaded_file($tmp_name,$locate_img.$name_file);
                rename($locate_img.$name_file, $locate_img.$name_file);
            }
        }
        header("Location: ../download/$path");
    }

?>