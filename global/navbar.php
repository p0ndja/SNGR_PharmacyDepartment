<nav class="navbar navbar-expand-lg navbar-dark navbar-normal green darken-2 mb-3">
<a class="navbar-brand" href="../home"><span class="badge badge-light"><img src="../assets/images/logo/medkku.min.png"
            width="32" alt="SMD"></span></a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
        <li class="nav-item">
            <a class="nav-link" href="../home">หน้าหลัก <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="./#" id="navbarDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> เกี่ยวกับ </a>
            <div class="dropdown-menu dropdown-dark" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#">โครงสร้างหน่วยงาน</a>
                <a class="dropdown-item" href="#">ผู้บริหาร</a>
                <a class="dropdown-item" href="#">รางวัลและผลงานที่ภาคภูมิใจ</a>
            </div>
        </li>
        <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                หน่วยงาน </a>
            <div class="dropdown-menu dropdown-dark" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#"> หน่วยบริการจ่ายยา </a>
                <a class="dropdown-item" href="#"> หน่วยผลิต </a>
                <a class="dropdown-item" href="#"> หน่วยคลังเวชภัณฑ์ </a>
            </div>
        </li>
        <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                ข้อมูล </a>
            <div class="dropdown-menu dropdown-dark" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#"> คำสั่ง </a>
                <a class="dropdown-item" href="#"> ประกาศ </a>
                <a class="dropdown-item" href="#"> ข่าวประชาสัมพันธ์ </a>
                <a class="dropdown-item" href="#"> ประกาศราคากลาง </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#"> คุณลักษณะเฉพาะของยา </a>
                <a class="dropdown-item" href="#"> ระเบียบและแนวทางปฏิบัติ</a>
                <a class="dropdown-item" href="#"> คู่มือการใช้ยา</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#"> รายการบัญชียา</a>
            </div>
        </li>
        <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> อื่น ๆ </a>
            <div class="dropdown-menu dropdown-dark" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#"> ดาวน์โหลดแบบฟอร์ม </a>
                <a class="dropdown-item" href="#"> กระดานถามตอบ </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#"> ติดต่อหน่วยงาน </a>
            </div>
        </li>
    </ul>

    <ul class="nav navbar-nav nav-flex-icons ml-auto">
    <div class="custom-control custom-switch">
  <input type="checkbox" class="custom-control-input" id="darkSwitch" />
  <label class="custom-control-label" for="darkSwitch">Dark Mode</label>
</div>
<form action="../pages/search.php" method="GET" class="form-inline">
            <div class="md-form my-0">
                <input method="GET" class="form-control" type="text" placeholder="Search ID (Ex. 604019)"
                    aria-label="Search ID (Ex. 604019)" id="search" name="search"
                    value="<?php if (isset($_GET['search'])) echo $_GET['search']; ?>">
            </div>
        </form>
        <?php if (isset($_SESSION['fn'])) { ?>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <img src="<?php echo $_SESSION['pi']; ?>" width="20" alt="Profile">
                <?php echo $_SESSION['fn'] . ' ' . $_SESSION['ln']; ?></a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="../profile"> ข้อมูลส่วนตัว <i class="fas fa-user"></i></a>
                <a class="dropdown-item" href="#"> ลงทะเบียนวิชาเลือก <i class="fas fa-tasks"></i></a>
                <a class="dropdown-item" href="#"> การเช็คชื่อ <i class="fas fa-calendar-check"></i></a>
                <a class="dropdown-item" href="#"> ผลการเรียน (SGS) <i class="fas fa-graduation-cap"></i></a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item text-secondary" href="../admin/"> ส่วนของแอดมิน <i
                        class="fas fa-user-tie"></i></a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item text-danger" href="../global/logout.php">ออกจากระบบ <i
                        class="fas fa-sign-out-alt"></i></a>
            </div>
        </li>
        <?php } else { ?>
        <a href="" class="btn btn-rounded peach-gradient text-dark font-weight-bold" data-toggle="modal"
            data-target="#login">Login</a>
        <?php } ?>
    </ul>
</div>
</nav>