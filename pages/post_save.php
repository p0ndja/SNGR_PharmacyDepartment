<?php
require '../static/functions/connect.php';
$category = "~";

if (isset($_POST['post_submit']) || isset($_POST['post_update'])) {
    $id = $_SESSION['id'];
    $title = $_POST['title'];
    $article = $_POST['article'];
    $writer = $id;
    $time = curFullTime();
    $tags = $_POST['tags'];
    

    $finalG = "";
    $newGroup = $_POST['visible'];
    foreach ($newGroup as $g) {
        $finalG .= "|$g";
    }

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

    $category = $_POST['group'];

    if (isset($_POST['makeHotlink']) && $_POST['makeHotlink'] == true)
        $hotlink = $_POST['hotlinkField'];
    else
        $hotlink = null;

    if (isset($_POST['post_submit'])) {
        $query_final = "INSERT INTO `post` (title, writer, time, article, tags, hotlink, isHidden, isPinned, visible, category) VALUES ('$title', '$writer', '$time', '$article', '$tags', '$hotlink', '$hide', $pinned, '$finalG', '$category')";
        $result_final = mysqli_query($conn, $query_final);
        if (!$result_final) die('Could not post '.mysqli_error($conn));
        $news = mysqli_insert_id($conn);
    } else {
        $news = $_GET['news'];
        $query_final = "UPDATE `post` SET title = '$title', writer = '$writer', time = '$time', article = '$article', tags = '$tags', hotlink = '$hotlink', isHidden = '$hide', isPinned = $pinned, visible = '$finalG', category = '$category' WHERE id = '$news'";
        $result_final = mysqli_query($conn, $query_final);
        if (!$result_final) die('Could not post '.mysqli_error($conn));
    }

    if (!file_exists("../file/post/".$news."/")) {
        die(is_writable("../file/post/"));
        if (!mkdir("../file/post/".$news."/")) die("NOOOOOO");
        else die("YESSSSSS");
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
                if (!move_uploaded_file($tmp_name,$locate_img.$name_file)) die("Can't upload file");
                if (!rename($locate_img.$name_file, $locate_img.$name_file)) die("Can't move file");
                $finalFiledir = $locate_img.$name_file;
                if ($i == 0) $finalFilePath = "'". $finalFiledir;
                else $finalFilePath .= ',' . $finalFiledir;
            }
        }
        $finalFilePath .= "'";
        savePostdata($news, 'attachment', $finalFilePath, $conn); 
    }

    $action = (isset($_POST['post_submit'])) ? "USER_ARTICLE_POST" : "USER_ARTICLE_EDIT";
    addLog($conn, $_SESSION['id'], "$action", "POST_ID: $id\nTITLE: $title\nTAG: $tags\nCATEGORY: $category\nHIDE: $hide\nPIN: $pinned\nVISIBLE: $finalG\nCOVER: $finaldir\nATTACH: $finalFilePath\nARTICLE: $article");

}
header("Location: ../category/$category-1");
?>