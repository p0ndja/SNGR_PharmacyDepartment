<?php require '../static/functions/connect.php';
if (isset($_GET['id']) && isLogin() && canUseThisCategory(getRole($_SESSION['id'], $conn),$_GET['category'],$conn)) {
    needLogin();
    $id = $_GET['id'];
    $q = "DELETE FROM `post` WHERE id = $id";
    $r = mysqli_query($conn, $q);
    if (!$r) die('Could not get data: '.mysqli_error($conn)); 
    $_SESSION['swal_success'] = "ลบโพสต์ข่าว ID : $id เรียบร้อยแล้ว!";
    back();
} else {
    back();
}
?>