<a class="navbar-brand" href="../home/"><img src="../static/elements/logo/logo.png" width="32" alt="PharmMDKKU" align="center"></a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
        <li class="nav-item">
            <a class="nav-link" href="../home/">หน้าหลัก</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../event/">กิจกรรม</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">ตรวจสอบการลงทะเบียน</a>
        </li>
    </ul>

    <ul class="nav navbar-nav nav-flex-icons ml-auto">
        <?php if (isLogin()) { ?>
        <div class="d-lg-block d-none">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <?php echo $_SESSION['name']; ?></a>
            <div class="dropdown-menu dropdown-menu-right dropdown-mvsk" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#../profile/"> แก้ไขข้อมูลส่วนตัว <i class="fas fa-user-tie"></i></a>
                <div class="dropdown-divider"></div>
                <button class="dropdown-item text-danger" id="logoutBtn">ออกจากระบบ <i class="fas fa-sign-out-alt"></i></button>
            </div>
        </li>
                    </div>
                    <div class="d-block d-lg-none">
                    <a class="btn btn-md peach-gradient btn-rounded font-weight-bold" data-toggle="modal" data-target="#futureCpanel">
                <?php echo $_SESSION['name']; ?></a>
                    </div>
        <?php } else { ?>
            <a class="btn btn-md btn-rounded peach-gradient text-dark font-weight-bold d-block d-lg-none" href="../login/">Login</a>
            <li class="nav-item dropdown position-static d-none d-lg-block">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Login</a>
                <div class="dropdown-menu dropdown-menu-left dropdown-menu-md-right">
                    <form method="post" action="../static/functions/auth/login.php" enctype="multipart/form-data">
                        <div class="md-form form-sm mb-5">
                            <i class="fas fa-user prefix"></i>
                            <input type="text" name="login_username" id="login_username"
                                class="form-control form-control-sm validate" required style="color: black !important;">
                            <label for="login_username">Username</label>
                        </div>
                        <div class="md-form form-sm mb-4">
                            <i class="fas fa-lock prefix"></i>
                            <input type="password" name="login_password" id="login_password"
                                class="form-control form-control-sm validate" required style="color: black !important;">
                            <label for="login_password">Password</label>
                        </div>
                        <input type="hidden" name="method" value="loginNav">
                        <button class="btn btn-block bg-mvsk" type="submit" name="login_submit">Login</button>
                        <div class="text-center"><a class="text-danger" href="../forgetpw/">ลืมรหัสผ่านหรอ?</a> <a href="../register/" class="text-mvsk">หรือสมัครเข้าใช้งาน!</a></div>
                    </form>
                </div>
            </li>
        <?php } ?>
    </ul>
</div>