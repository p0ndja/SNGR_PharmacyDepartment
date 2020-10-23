<?php 
    require '../static/functions/connect.php';
?>

<?php if (!isLogin()) header("Location: ../"); ?>
<?php $id = $_SESSION['id']; ?>

<!DOCTYPE html>
<html lang="th" prefix="og:http://ogp.me/ns#">

<head>
    <?php require '../static/functions/head.php'; ?>
</head>
<nav class="navbar navbar-expand-lg navbar-dark navbar-normal fixed-top scrolling-navbar" id="nav" role="navigation">
    <?php require '../static/functions/navbar.php'; ?>
</nav>

<body>
    <div class="container" style="padding-top: 88px;">
        <div class="container mb-3" id="container">

            <div class="card mb-3">
                <form method="post" action="../saveProfile/" enctype="multipart/form-data" id="userEditForm">
                    <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-12 col-md-4 mb-3">
                                <img class="img-fluid w-100" src="<?php echo getProfilePicture($id, $conn); ?>" id="profile_preview">
                                <input type="file" name="profile_upload" id="profile_upload"
                                        class="form-control-file validate mt-1 mb-1" accept="image/png, image/jpeg">
                                <a class="btn btn-success btn-block btn-lg" href="javascript:{}"
                                    onclick="document.getElementById('userEditForm').submit();">บันทึกข้อมูล <i
                                        class="fas fa-save"></i></a>
                            </div>
                            <div class="col-12 col-md-8">
                                <!-- Personal Zone -->
                                <h4 class="font-weight-bold">ข้อมูลส่วนตัว - Information <i
                                        class="fas fa-info-circle"></i></h4>
                                <hr>
                                <!-- name -->
                                <div class="form-inline">
                                    <div class="md-form input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text md-addon">ชื่อ</span>
                                        </div>
                                        <input type="text" class="form-control mr-sm-3" id="firstname"
                                            name="firstname"
                                            placeholder="<?php echo getUserdata($id, 'firstname', $conn); ?>"
                                            value="<?php echo getUserdata($id, 'firstname', $conn); ?>">
                                    </div>
                                    <div class="md-form input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text md-addon">สกุล</span>
                                        </div>
                                        <input type="text" class="form-control mr-sm-3" id="lastname"
                                            name="lastname"
                                            placeholder="<?php echo getUserdata($id, 'lastname', $conn); ?>"
                                            value="<?php echo getUserdata($id, 'lastname', $conn); ?>">
                                    </div>
                                </div>
                                <!-- name -->
                                <div class="form-inline">
                                    <div class="form-row">
                                        <label for="job" class="col-form-label col-md-auto ">อาชีพ </label>
                                        <div class="align-items-center col-md-auto d-flex">
                                            <select class="form-control" id="job" name="job" required>
                                            <optgroup label="- สำหรับบุคคลทั่วไป -" id="general">
                                                <option value="contractor">รับจ้างทั่วไป/ลูกจ้าง</option>
                                                <option value="civilservant">รับราชการ/พนักงานรัฐ</option>
                                                <option value="business">ธุรกิจส่วนตัว</option>
                                                <option value="business">ธุรกิจส่วนตัว</option>
                                            </optgroup>
                                            <optgroup label="- สำหรับบุคลากรภายใน -" id="staff">
                                                <option value="doctor">แพทย์</option>
                                                <option value="nurse">พยาบาล</option>
                                                <option value="pharmacist">เภสัชกร</option>
                                                <option value="staff">บุคลากรภายใน (อื่น ๆ)</option>
                                            </optgroup>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <script>$('#job option[value=<?php echo getUserdata($id, 'job', $conn); ?>]').attr('selected', 'selected');</script>
                                <!-- Personal Zone -->

                                <!-- Security Zone -->
                                <h4 class="mt-5 font-weight-bold">ความปลอดภัย - Security <i class="fas fa-lock"></i>
                                </h4>
                                <hr>
                                <!-- Email -->
                                <div class="md-form input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text md-addon">อีเมล</span>
                                    </div>
                                    <input type="hidden" id="real_email" name="real_email" value="<?php echo getUserdata($id, 'email', $conn); ?>">
                                    <input type="text" class="form-control mr-sm-3" id="email" name="email"
                                        placeholder="<?php echo getUserdata($id, 'email', $conn); ?>"
                                        value="<?php echo getUserdata($id, 'email', $conn); ?>" required>
                                </div>
                                <!-- Email -->
                                <!-- Password -->
                                <div class="md-form input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text md-addon">รหัสผ่าน</span>
                                    </div>
                                    <input type="text" class="form-control mr-sm-3" id="password" name="password"
                                        placeholder="พิมพ์รหัสผ่านเพื่อตั้งรหัสผ่านใหม่... (การเว้นว่างจะถือว่าใช้รหัสผ่านเดิม)"
                                        value="">
                                </div>

                                <!-- Password -->
                                <!-- Security Zone -->
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <?php require '../static/functions/popup.php'; ?>
    <?php require '../static/functions/footer.php'; ?>
    <script>
        $("input[type=radio]").change(function () {
            if (this.id == "student") {
                $('#studentZone').css('display', 'block');
            } else {
                $('#studentZone').css('display', 'none');
            }
        });

        document.getElementById("profile_upload").onchange = function () {
            var reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById("profile_preview").src = e.target.result;
            };
            reader.readAsDataURL(this.files[0]);
        };
    </script>
</body>

</html>