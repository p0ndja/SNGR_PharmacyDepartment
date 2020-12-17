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
        <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> เกี่ยวกับ </a>
            <div class="dropdown-menu dropdown-pharm" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="../post/3">โครงสร้างหน่วยงาน</a>
                <a class="dropdown-item" href="../post/4">ผู้บริหาร</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="../post/5">คณะกรรมการเภสัชกรรม</a>
                <a class="dropdown-item" href="../post/6">คณะอนุกรรมการพิจารณายา</a>
                <a class="dropdown-item" href="../post/7">คณะอนุกรรมการพัฒนาระบบยา</a>
            </div>
        </li>
        <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> หน่วยงาน </a>
            <div class="dropdown-menu dropdown-pharm" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="../category/manufacture-1">งานผลิตยา</a>
                <a class="dropdown-item" href="../category/service-1">งานบริการจ่ายยา</a>
                <a class="dropdown-item" href="../category/DIC-1">งานเภสัชสนเทศทางยา</a>
                <a class="dropdown-item" href="../category/inventory-1">งานบริหารคลังยาและเวชภัณฑ์</a>
            </div>
        </li>
        <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> ข่าวสาร </a>
            <div class="dropdown-menu dropdown-pharm" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="../category/news-1">ข่าวประชาสัมพันธ์</a>
                <a class="dropdown-item" href="../category/order-1">คำสั่ง</a>
                <a class="dropdown-item" href="../category/announce-1">ประกาศ</a>
                <a class="dropdown-item" href="../category/guideline-1">ระเบียบ - แนวทางปฏิบัติ</a>
                <a class="dropdown-item" href="../category/manual-1">คู่มือการใช้ยา</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="../category/research-1">ผลงานวิจัยและ R2R</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="../category/CoPADR-1">ชุมชนนักปฏิบัติ ADR</a>
                <a class="dropdown-item" href="../category/CoPHAD-1">ชุมชนนักปฏิบัติ HAD</a>
                <a class="dropdown-item" href="../category/CoPME-1">ชุมชนนักปฏิบัติ ME</a>
                <a class="dropdown-item" href="../category/CoPRDU-1">ชุมชนนักปฏิบัติ RDU</a>
            </div>
        </li>
        <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> อื่น ๆ </a>
            <div class="dropdown-menu dropdown-pharm" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="../download/">ดาวน์โหลดแบบฟอร์ม</a>
                <a class="dropdown-item" href="../forum/">กระดานถาม - ตอบ</a>
            </div>
        </li>
    </ul>

    <ul class="nav navbar-nav nav-flex-icons ml-auto">
        <li class="nav-item">
            <form action="../static/functions/search.php" method="POST" class="form-inline">
                <div class="md-form my-0">
                    <input method="GET" class="form-control" type="text" placeholder="Search ID (Ex. 604019)"
                        aria-label="Search ID (Ex. 604019)" id="search" name="search"
                        value="<?php if (isset($_GET['search'])) echo $_GET['search']; ?>">
                </div>
            </form>
        </li>
        <?php if (isLogin()) { ?>
        <div class="d-lg-block d-none">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <img src="<?php echo getProfilePicture($_SESSION['id'], $conn); ?>" class="rounded-circle" width="20" alt="Profile">
                    <?php echo $_SESSION['name']; ?></a>
                <div class="dropdown-menu dropdown-menu-right dropdown-pharm" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="../profile/"> แก้ไขข้อมูลส่วนตัว <i class="fas fa-user"></i></a>
                    <?php if (isPermission("editHomepage", $conn)) { ?><a class="dropdown-item text-pharm" href="../admin/homepage"> แก้ไขหน้าหลัก</a><?php } ?>
                    <?php if (isPermission("viewSuggestion", $conn)) { ?><a class="dropdown-item text-pharm" href="../admin/suggestion"> ดูรายการร้องเรียน</a><?php } ?>
                    <?php if (isAdmin($_SESSION['id'], $conn)) { ?>
                    <a class="dropdown-item text-pharm" href="../user/"> จัดการบัญชีผู้ใช้งาน <i class="fas fa-user-tie"></i></a>
                    <a class="dropdown-item text-pharm" href="../log/"> ประวัติการแก้ไข <i class="fas fa-clock"></i></a>
                    <?php } ?>
                    <div class="dropdown-divider"></div>
                    <button class="dropdown-item text-danger" id="logoutBtn">ออกจากระบบ <i class="fas fa-sign-out-alt"></i></button>
                </div>
            </li>
        </div>
        <div class="d-block d-lg-none">
            <a class="btn btn-md btn-success btn-rounded font-weight-bold" data-toggle="modal" data-target="#futureCpanel"><?php echo $_SESSION['name']; ?></a>
        </div>
        <?php } else { ?>
            <a class="btn btn-md btn-rounded btn-success text-dark font-weight-bold d-block d-lg-none" href="../login/">Login</a>
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
                        <button class="btn btn-block bg-pharm" type="submit" name="login_submit">Login</button>
                        <div class="text-center"><a class="text-danger" href="../forgetpw/">ลืมรหัสผ่านหรอ?</a> <a href="../register/" class="text-pharm">หรือสมัครเข้าใช้งาน!</a></div>
                    </form>
                </div>
            </li>
        <?php } ?>
    </ul>
</div>