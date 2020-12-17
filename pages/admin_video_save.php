<?php
    include '../static/functions/connect.php';

    if (isLogin() && isPermission("editHomepage", $conn)) {

        $vdo = $_POST['vdo'];

        $AllVDO = "";
        foreach($vdo as $v) {
            /* Case Youtube */
            $v = str_replace("youtube.com/watch?v=", "youtube.com/embed/", $v);
            $v = str_replace("youtu.be/", "youtube.com/embed/", $v);
            $AllVDO .= "$v\n";
        }

        $file = fopen("../static/elements/video.txt","w");
        if (!fwrite($file,"$AllVDO"))
            die("CAN'T WRITE FILE");
        fclose($file);
    }

    header("Location: ../admin/homepage");
?>