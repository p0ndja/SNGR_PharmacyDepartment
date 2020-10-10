<?php 
    require '../static/functions/connect.php';
?>

<!DOCTYPE html>
<html lang="th" prefix="og:http://ogp.me/ns#">

<head>
    <?php require '../static/functions/head.php'; ?>
</head>
<nav class="navbar navbar-expand-lg navbar-dark navbar-normal fixed-top scrolling-navbar" id="nav" role="navigation">
    <?php require '../static/functions/navbar.php'; ?>
</nav>

<body>
    <?php if (isLogin()) home(); ?>
    <div class="center container" id="container" style="padding-top: 88px">
        <form method="post" action="../pages/password_lookup.php" enctype="multipart/form-data">
            <div class="card">
                <!--Body-->
                <div class="card-body mb-1">
                    <h1 class="display-5 text-center">Forget Password <i class="fas fa-question"></i></h1>
                    <h6 class="text-center">ส่งคำร้องรีเซ็ตรหัสผ่าน (หากตัวยันยืนตัวตนไม่ขึ้น กรุณาดำเนินการหน้านี้ใหม่อีกครั้ง)</h6>
                    <div class="md-form form-sm mb-5">
                        <i class="fas fa-users prefix"></i>
                        <input type="email" name="reset" id="reset"
                            class="form-control form-control-sm validate" required placeholder="กรุณาใส่ E-Mail ใช้ในการสมัครเพื่อรีเซ็ตรหัสผ่าน">
                        <label for="reset">รีเซ็ตรหัสผ่าน</label>
                    </div>
                    <?php if (isset($_SESSION['error'])) {echo '<div class="alert alert-danger" role="alert">'. $_SESSION['error'] .'</div>'; $_SESSION['error'] = null;} ?>
                </div>
                <!--Footer-->
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <div class="align-self-center">
                            <a href="../login/" class="text-danger">เข้าสู่ระบบหรอ?</a> หรือ <a href="../register/">สมัครเข้าใช้งานที่นี่!</a>
                        </div>
                        <div>
                            <input class="btn btn-success" type="submit" name="resetPassword" value="ส่งคำร้องรีเซ็ตรหัสผ่าน"></input>
                            <a class="btn btn-danger" href="../home/">ยกเลิก</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    
    <?php require '../static/functions/popup.php'; ?>
    <div class="d-none">
    <?php require '../static/functions/footer.php'; ?>
    </div>
</body>

</html>