<?php
require '../static/functions/connect.php';

if (isset($_POST['post_submit']) || isset($_POST['post_update'])) {
    $id = $_SESSION['id'];
    $title = $_POST['title'];
    $article = $_POST['article'];
    $writer = $id;
    $time = curFullTime();
    $tags = $_POST['tags'];

    $hide = 0;
    if (isset($_POST['isHidden'])) {
        $hide = $_POST['isHidden'];
        if ($hide == 'on') $hide = 1;
        else $hide = 0;
    }

    $pinned = 0;
    if (isset($_POST['isPinned'])) {
        $pinned = $_POST['isPinned'];
        if ($pinned == 'on') $pinned = 1;
        else $pinned = 0;
    }

    $type = $_POST['type'];

    if (isset($_POST['makeHotlink']) && $_POST['makeHotlink'] == true)
        $hotlink = $_POST['hotlinkField'];
    else
        $hotlink = null;

    if (isset($_POST['post_submit'])) {
        $query_final = "INSERT INTO `post` (title, writer, time, article, tags, hotlink, category, isHidden, isPinned) VALUES ('$title', '$writer', '$time', '$article', '$tags', '$hotlink', '$type', '$hide', $pinned)";
        $result_final = mysqli_query($conn, $query_final);
        if (!$result_final) die('Could not post '.mysqli_error($conn));
        $news = mysqli_insert_id($conn);
    } else {
        $news = $_GET['news'];
        $query_final = "UPDATE `post` SET title = '$title', writer = '$writer', time = '$time', article = '$article', tags = '$tags', hotlink = '$hotlink', isHidden = '$hide', category = '$type', isPinned = $pinned WHERE id = '$news'";
        $result_final = mysqli_query($conn, $query_final);
        if (!$result_final) die('Could not post '.mysqli_error($conn));
    }

    if (!file_exists("../file/post/".$news."/")) {
        mkdir("../file/post/".$news."/");
    }

    $finaldir = null;
    if (isset($_FILES['cover']) && $_FILES['cover']['name'] != "") {
        $name_file = $_FILES['cover']['name'];
        $tmp_name = $_FILES['cover']['tmp_name'];
        $locate_img ="../file/post/".$news."/"."thumbnail/";
        if (!file_exists($locate_img)) {
            mkdir($locate_img);
        }
        move_uploaded_file($tmp_name,$locate_img.$name_file);
        $finaldir = $locate_img.$name_file;
    } else if (isset($_SESSION['temp_cover']) && $_SESSION['temp_cover'] != null) {
        $finaldir = $_SESSION['temp_cover'];
        $_SESSION['temp_cover'] = null;
    }
    $query_final = "UPDATE `post` SET cover = '$finaldir' WHERE id = '$news'";
    $result_final = mysqli_query($conn, $query_final);
    if (!$result_final) die('Could not post cover '.mysqli_error($conn));

    $fileTotal = count($_FILES['attachment']['name']);
    $finalFilePath = null;
    if (is_uploaded_file($_FILES['attachment']['tmp_name'][0])) {
        if (!file_exists("../file/post/" . $news . "/". "attachment/")) {
            mkdir("../file/post/" . $news . "/". "attachment/");
        }
        for ($i = 0; $i < $fileTotal; $i++) {
            if($_FILES['attachment']['tmp_name'][$i] != ""){
                $name_file = $_FILES['attachment']['name'][$i];
                $tmp_name = $_FILES['attachment']['tmp_name'][$i];
                $locate_img ="../file/post/".$news.'/'.'attachment/';
                move_uploaded_file($tmp_name,$locate_img.$name_file);
                rename($locate_img.$name_file, $locate_img.$name_file);
                $finalFiledir = $locate_img.$name_file;
                if ($i == 0) $finalFilePath = "'". $finalFiledir;
                else $finalFilePath .= ',' . $finalFiledir;
            }
        }
        $finalFilePath .= "'";
        savePostdata($news, 'attachment', $finalFilePath, $conn); 
    }
}
header("Location: ../category/$type-1");
?>


<?php
    if (isset($_GET['post_submit'])) {
        $title = $_GET['title'];
        $cover = $_GET['cover']; //FILE
        
        $makeHotlink = $_GET['makeHotlink'];
        $hotlink = $_GET['hotlinkField'];
        $isHidden = $_GET['isHidden'];
        $isPinned = $_GET['pinned'];
        
    } else if (isset($_GET['post_update'])) {
        $id = -1;
        if (isset($_GET['id']))
            $id = $_GET['id'];
        else back();

    }


    $fileTotal = count($_FILES['attachment']['name']);
    $finalFilePath = null;
    if (is_uploaded_file($_FILES['attachment']['tmp_name'][0])) {
        if (!file_exists("../file/post/" . $news . "/". "attachment/")) {
            mkdir("../file/post/" . $news . "/". "attachment/");
        }
        for ($i = 0; $i < $fileTotal; $i++) {
            if($_FILES['attachment']['tmp_name'][$i] != ""){
                $name_file = $_FILES['attachment']['name'][$i];
                $tmp_name = $_FILES['attachment']['tmp_name'][$i];
                $locate_img ="../file/post/".$news.'/'.'attachment/';
                move_uploaded_file($tmp_name,$locate_img.$name_file);
                rename($locate_img.$name_file, $locate_img.$name_file);
                $finalFiledir = $locate_img.$name_file;
                if ($i == 0) $finalFilePath = "'". $finalFiledir;
                else $finalFilePath .= ',' . $finalFiledir;
            }
        }
        $finalFilePath .= "'";
        savePostdata($news, 'attachment', $finalFilePath, $conn); 
    }
?>