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
    <div class="container" id="container" style="padding-top: 88px">
        <div class="card mb-3">
            <form method="post" action="../static/functions/auth/login.php" enctype="multipart/form-data">
                <!--Body-->
                <div class="card-body mb-1">
                    <h1 class="display-5 text-center">REGISTER <i class="far fa-edit"></i></h1>
                    <?php
                                if (isset($_SESSION['error'])) {
                                    echo '<div class="alert alert-danger" role="alert">'. $_SESSION['error'] .'</div>';
                                    $_SESSION['error'] = null;
                                }
                                ?>
                    <p class="text-danger mb-1"><b>ช่องที่มี * คือจำเป็นต้องกรอก</b></p>
                    <div class="md-form form-sm mb-1">
                        <i class="fas fa-id-badge prefix"></i>
                        <input type="text" name="register_username" id="register_username"
                            class="form-control form-control-sm validate" required>
                        <label for="register_username">ชื่อผู้ใช้งาน*</label>
                    </div>
                    <div class="md-form form-sm mb-1">
                        <i class="fas fa-key prefix"></i>
                        <input type="password" name="register_password" id="register_password"
                            class="form-control form-control-sm validate" required>
                        <label for="register_password">รหัสผ่าน*</label>
                    </div>
                    <div class="md-form form-sm mb-1">
                        <i class="fas fa-envelope prefix"></i>
                        <input type="email" name="register_email" id="register_email"
                            class="form-control form-control-sm validate" required>
                        <label for="register_email">อีเมล*</label>
                    </div>
                    <div class="md-form form-sm mb-1">
                        <i class="fas fa-user prefix"></i><input type="text" name="register_displayname" id="register_displayname" class="form-control form-control-sm validate">
                        <label for="register_displayname">ชื่อที่ใช้แสดง</label>
                    </div>
                </div>
                <!--Footer-->
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <div class="align-self-center">
                            เคยสมัครสมาชิกไปแล้วหรอ? <a href="../login/" class="text-smd">ล็อกอินที่นี่!</a>
                        </div>
                        <div>
                            <input class="btn btn-success" type="submit" name="register_submit" value="สมัคร !"></input>
                            <a class="btn btn-danger" href="../home/">ยกเลิก</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <?php require '../static/functions/popup.php'; ?>
    <div class="d-none">
    <?php require '../static/functions/footer.php'; ?>
    </div>
    <script>
        $('.datepicker').pickadate({
            format: 'yyyy-mm-dd',
            formatSubmit: 'yyyy-mm-dd 00:00:00',
            max: new Date()
        });
    </script>
</body>

</html>