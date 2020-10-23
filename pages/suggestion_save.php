<?php
require '../static/functions/connect.php';

if (isset($_POST['message'])) {
    
    $name = $_POST['name'];
    $email = $_POST['email'];
    $text = $_POST['message'];

    $q = "INSERT INTO `suggestion` (name, email, text) VALUES ('$name', '$email', '$text')";
    $r = mysqli_query($conn, $q);

    if (!$r) die("Could not save suggestion");

    $_SESSION['swal_success'] = "บันทึกเรียบร้อยแล้ว";
    $_SESSION['swal_success_msg'] = "ข้อเรียนและเสนอแนะของคุณถูกบันทึกแล้วเรียบร้อย";
}
header("Location: ../home/");
?>