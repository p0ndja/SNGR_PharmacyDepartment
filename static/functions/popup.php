<!-- Announcement Modal -->
<!--
<div class="modal animated jackInTheBox fadeOut" id="announcementPopup" name="announcementPopup" tabindex="-1"
    role="dialog" aria-labelledby="announcementTitle" aria-hidden="true">
    <div class="modal-dialog modal-notify modal-warning modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="annoucementTitle">ข่าวประชาสัมพันธ์</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="https://repository-images.githubusercontent.com/216790969/da52a000-7792-11ea-997b-7503371435f0"
                    class="img-fluid w-100 d-flex justify-content-center mb-3 z-depth-2">
                <div class="modal-text">
                    <p class="text-center">ทางผู้พัฒนาขอความร่วมมือจากผู้เข้าชมเว็บไซต์ทุก ๆ ท่าน
                        ร่วมตอบแบบสอบถามความพึงพอใจในการใช้งานเว็บไซต์ <a
                            href="https://smd.pondja.com">smd.pondja.com</a> / <a
                            href="https://smd.p0nd.ga">smd.p0nd.ga</a></p>
                    <a href="https://forms.gle/HfxaWmjVGKjARUR18" target="_blank" class="text-center text-pharm">
                        <h1 class="animated infinite pulse">ตอบแบบสอบถาม</h1>
                    </a>
                </div>
            </div>
            <div class="modal-footer">
                <a class="btn btn-md btn-warning" data-dismiss="modal">ปิดหน้าต่าง</a>
            </div>
        </div>
    </div>
</div>
-->
<!-- Mobile Cpanel Modal -->
<?php if (isLogin()) { ?>
<div class="modal fade right" id="futureCpanel" tabindex="-1" role="dialog" aria-labelledby="cpanelTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-full-width modal-right modal-sm" role="document">
        <div class="modal-content-full-width modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cpanelTitle">สวัสดี!
                    <?php echo $_SESSION['name'] . ' (' . $_SESSION['username'] . ')'; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <a class="dropdown-item" href="../profile/"> แก้ไขข้อมูลส่วนตัว <i class="fas fa-user-tie"></i></a>
                <?php if (isAdmin($_SESSION['id'], $conn)) { ?>
                <hr>
                <a class="dropdown-item text-secondary" href="../user/"> User Management <i
                        class="fas fa-user-tie"></i></a>
                <?php } ?>
                <hr>
                <a class="dropdown-item text-danger" href="../logout/">ออกจากระบบ <i
                        class="fas fa-sign-out-alt"></i></a>
            </div>
        </div>
    </div>
</div>
<?php } ?>
<!-- Mobile Cpanel Modal -->
<?php 
    if (isset($_SESSION['swal_error']) && isset($_SESSION['swal_error_msg'])) { 
        errorSwal($_SESSION['swal_error'],$_SESSION['swal_error_msg']);
        $_SESSION['swal_error'] = null;
        $_SESSION['swal_error_msg'] = null;
    }
?>
<?php 
    if (isset($_SESSION['swal_warning']) && isset($_SESSION['swal_warning_msg'])) { 
        warningSwal($_SESSION['swal_warning'],$_SESSION['swal_warning_msg']);
        $_SESSION['swal_warning'] = null;
        $_SESSION['swal_warning_msg'] = null;
    }
?>
<?php 
    if (isset($_SESSION['swal_success'])) { 
        successSwal($_SESSION['swal_success'],$_SESSION['swal_success_msg']);
        $_SESSION['swal_success'] = null;
        $_SESSION['swal_success_msg'] = null;
    }
?>
<script>
    $("#logoutBtn").click(function () {
        swal({
            title: "ออกจากระบบ ?",
            text: "คุณต้องการออกจากระบบหรือไม่?",
            icon: "warning",
            buttons: true,
            dangerMode: true
        }).then((willDelete) => {
            if (willDelete) {
                window.location = "../logout/";
            }
        });
    });
</script>