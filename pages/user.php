<?php 
    require '../static/functions/connect.php';
?>

<?php if (!isLogin()) header("Location: ../"); ?>

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
        <div class="card mb-3 card-body">
            <select class="mdb-select" searchable="กรุณาใส่ข้อมูล..." id="user_query" name="user_query">
                <option value="" disabled selected>กรุณาเลือก</option>
                <?php $cor = mysqli_query($conn, "SELECT * FROM `user`");
                        while($row = mysqli_fetch_array($cor, MYSQLI_ASSOC)) {?>
                <option value="<?php echo $row['id']; ?>"
                    data-icon="<?php echo getProfilePicture($row['id'], $conn); ?>" class="rounded-circle">
                    <?php echo getUserdata($row['id'], 'firstname', $conn) . ' ' . getUserdata($row['id'], 'lastname', $conn) . ' (' . $row['id'] . ')' ; ?>
                </option>
                <?php } ?>
            </select>
        </div>
        <?php 
            if (isset($_GET['id']) && isValidUserID($_GET['id'], $conn)) {
        $id = $_GET['id']; ?>
            <div class="card mb-3">
                <form method="post" action="../saveUser/<?php echo $id; ?>" enctype="multipart/form-data" id="userEditForm">
                    <input type="hidden" id="real_id" name="real_id" value="<?php echo $id; ?>">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-12 col-md-4 mb-3">
                                <img class="img-fluid w-100" src="<?php echo getProfilePicture($id, $conn); ?>" id="profile">
                                <input type="file" name="profile_upload" id="profile_upload"
                                        class="form-control-file validate mt-1 mb-1" accept="image/png, image/jpeg">
                                <h1 class="display-4 text-center">
                                    ID: <?php echo $id; ?>
                                </h1>
                                <a class="btn btn-success btn-block btn-lg" href="javascript:{}"
                                    onclick="document.getElementById('userEditForm').submit();">บันทึกข้อมูล <i
                                        class="fas fa-save"></i></a>
                            </div>
                            <div class="col-12 col-md-8">
                                <!-- Personal Zone -->
                                <h4 class="font-weight-bold">ข้อมูลส่วนตัว - Information <i
                                        class="fas fa-info-circle"></i></h4>
                                <hr>
                                <!-- ID -->
                                <div class="md-form input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text md-addon text-danger">Database User ID <sup
                                                class="text-danger">*แก้ไขเมื่อจำเป็นเท่านั้น</sup></span>
                                    </div>
                                    <input type="text" class="form-control mr-sm-3" id="id" name="id"
                                        placeholder="<?php echo $id; ?>" value="<?php echo $id; ?>" required>
                                </div>
                                <!-- ID -->
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
                                <!-- Username -->
                                <div class="md-form input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text md-addon">ผู้ใช้งาน</span>
                                    </div>
                                    <input type="text" class="form-control mr-sm-3" id="username" name="username"
                                        placeholder="<?php echo getUserdata($id, 'username', $conn); ?>"
                                        value="<?php echo getUserdata($id, 'username', $conn); ?>" required>
                                </div>
                                <!-- Username -->
                                <!-- Email -->
                                <div class="md-form input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text md-addon">อีเมล</span>
                                    </div>
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

                                <!-- Status Zone -->
                                <!-- role -->
                                <!-- Group of material radios - option 1 -->
                                <h4 class="mt-5 font-weight-bold">สถานะ - Role <i class="fas fa-user-tag"></i></h4>
                                <hr>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="admin" name="role"
                                        <?php if (getRole($id, $conn) == "admin") echo "checked"; ?> value="admin">
                                    <label class="form-check-label" for="admin">แอดมิน
                                        <a class="material-tooltip-main" data-html="true" data-toggle="tooltip"
                                            title="✔ เข้าถึงเมนูจัดการของแอดมิน<br>✔ เข้าถึงบัญชียา<br>✔ แก้ไขบัญชียา<br>✔ แก้ไขดาวน์โหลดแบบฟอร์ม<br>✔ แก้ไขโพสต์ทุกหมวดหมู่"><i
                                                class="fas fa-info-circle"></i></a>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="headManu" name="role"
                                        <?php if (getRole($id, $conn) == "headManu") echo "checked"; ?> value="headManu">
                                    <label class="form-check-label" for="headManu">งานผลิต
                                        <a class="material-tooltip-main" data-html="true" data-toggle="tooltip"
                                            title="❌ เข้าถึงเมนูจัดการของแอดมิน<br>✔ เข้าถึงบัญชียา<br>❌ แก้ไขบัญชียา<br>✔ แก้ไขดาวน์โหลดแบบฟอร์ม<br>✔ แก้ไขโพสต์หมวดงานผลิต"><i
                                                class="fas fa-info-circle"></i></a>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="headInv" name="role"
                                        <?php if (getRole($id, $conn) == "headInv") echo "checked"; ?> value="headInv">
                                    <label class="form-check-label" for="headInv">งานคลังเวชภัณฑ์
                                        <a class="material-tooltip-main" data-html="true" data-toggle="tooltip"
                                            title="❌ เข้าถึงเมนูจัดการของแอดมิน<br>✔ เข้าถึงบัญชียา<br>❌ แก้ไขบัญชียา<br>✔ แก้ไขดาวน์โหลดแบบฟอร์ม<br>✔ แก้ไขโพสต์หมวดงานคลัง ฯ"><i
                                                class="fas fa-info-circle"></i></a>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="headServ" name="role"
                                        <?php if (getRole($id, $conn) == "headServ") echo "checked"; ?> value="headServ">
                                    <label class="form-check-label" for="headServ">งานบริการจ่ายยา
                                        <a class="material-tooltip-main" data-html="true" data-toggle="tooltip"
                                            title="❌ เข้าถึงเมนูจัดการของแอดมิน<br>✔ เข้าถึงบัญชียา<br>❌ แก้ไขบัญชียา<br>✔ แก้ไขดาวน์โหลดแบบฟอร์ม<br>✔ แก้ไขโพสต์หมวดงานบริการ ฯ"><i
                                                class="fas fa-info-circle"></i></a>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="headDIC" name="role"
                                        <?php if (getRole($id, $conn) == "headDIC") echo "checked"; ?> value="headDIC">
                                    <label class="form-check-label" for="headDIC">งานเภสัชสนเทศทางยา
                                        <a class="material-tooltip-main" data-html="true" data-toggle="tooltip"
                                            title="❌ เข้าถึงเมนูจัดการของแอดมิน<br>✔ เข้าถึงบัญชียา<br>❌ แก้ไขบัญชียา<br>✔ แก้ไขดาวน์โหลดแบบฟอร์ม<br>✔ แก้ไขโพสต์หมวดเภสัชสนเทศ ฯ"><i
                                                class="fas fa-info-circle"></i></a>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="CoP" name="role"
                                        <?php if (getRole($id, $conn) == "CoP") echo "checked"; ?> value="CoP">
                                    <label class="form-check-label" for="headDIC">งานเภสัชสนเทศทางยา
                                        <a class="material-tooltip-main" data-html="true" data-toggle="tooltip"
                                            title="❌ เข้าถึงเมนูจัดการของแอดมิน<br>✔ เข้าถึงบัญชียา<br>❌ แก้ไขบัญชียา<br>✔ แก้ไขดาวน์โหลดแบบฟอร์ม<br>✔ แก้ไขโพสต์หมวดนักปฏิบัติ ฯ"><i
                                                class="fas fa-info-circle"></i></a>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="reporter" name="role"
                                        <?php if (getRole($id, $conn) == "reporter") echo "checked"; ?> value="reporter">
                                    <label class="form-check-label" for="reporter">งานเภสัชสนเทศทางยา
                                        <a class="material-tooltip-main" data-html="true" data-toggle="tooltip"
                                            title="❌ เข้าถึงเมนูจัดการของแอดมิน<br>✔ เข้าถึงบัญชียา<br>❌ แก้ไขบัญชียา<br>❌ แก้ไขดาวน์โหลดแบบฟอร์ม<br>✔ แก้ไขโพสต์หมวดประชาสัมพันธ์"><i
                                                class="fas fa-info-circle"></i></a>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="secretary" name="role"
                                        <?php if (getRole($id, $conn) == "secretary") echo "checked"; ?> value="secretary">
                                    <label class="form-check-label" for="secretary">เลขานุการ
                                        <a class="material-tooltip-main" data-html="true" data-toggle="tooltip"
                                            title="❌ เข้าถึงเมนูจัดการของแอดมิน<br>✔ เข้าถึงบัญชียา<br>❌ แก้ไขบัญชียา<br>❌ แก้ไขดาวน์โหลดแบบฟอร์ม<br>✔ แก้ไขโพสต์หมวดเกี่ยวกับ, ทั่วไป, งานวิจัยฯ, ประชาสัมพันธ์, คำสั่ง, ประกาศ, ระเบียบ, คู่มือ"><i
                                                class="fas fa-info-circle"></i></a>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="hospitalStaff" name="role"
                                        <?php if (getRole($id, $conn) == "hospitalStaff") echo "checked"; ?> value="hospitalStaff">
                                    <label class="form-check-label" for="hospitalStaff">บุคลากรภายใน
                                        <a class="material-tooltip-main" data-html="true" data-toggle="tooltip"
                                            title="❌ เข้าถึงเมนูจัดการของแอดมิน<br>✔ เข้าถึงบัญชียา<br>❌ แก้ไขบัญชียา<br>❌ แก้ไขดาวน์โหลดแบบฟอร์ม<br>❌ แก้ไขโพสต์"><i
                                                class="fas fa-info-circle"></i></a>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="guest" name="role"
                                        <?php if (getRole($id, $conn) == "guest") echo "checked"; ?> value="guest">
                                    <label class="form-check-label" for="guest">ผู้เยี่ยมชม
                                        <a class="material-tooltip-main" data-html="true" data-toggle="tooltip"
                                            title="❌ เข้าถึงเมนูจัดการของแอดมิน<br>❌ เข้าถึงบัญชียา<br>❌ แก้ไขบัญชียา<br>❌ แก้ไขดาวน์โหลดแบบฟอร์ม<br>❌ แก้ไขโพสต์"><i
                                                class="fas fa-info-circle"></i></a>
                                    </label>
                                </div>
                                <!-- role -->
                                <!-- Status Zone -->

                                <!-- Delete Zone -->
                                <h4 class="mt-5 font-weight-bold">ลบแอคเค้าท์ - Delete Account <i
                                        class="fas fa-trash-alt"></i>
                                </h4>
                                <hr>

                                <a class="btn btn-outline-danger btn-lg" href="javascript:{}"
                                    onclick='swal({title: "ลบผู้ใช้นี้หรือไม่ ?",text: "หลังจากที่ลบแล้ว ข่าวนี้จะไม่สามารถกู้คืนได้!",icon: "warning",buttons: true,dangerMode: true}).then((willDelete) => { if (willDelete) { window.location = "../admin/user_delete.php?id=<?php echo $id; ?>";}});''>ยืนยันการลบผู้ใช้นี้ <u><b>!! ไม่สามารถกู้คืนได้ !!</b></u></a>

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            <?php } ?>
    </div>
    

    <?php require '../static/functions/popup.php'; ?>
    <?php require '../static/functions/footer.php'; ?>
    <script>
        $("#user_query").on('change', function (e) {
            console.log("s");
            window.location = "../user/" + $("#user_query").val();
        });

        $('#user_query <?php if (isset($_GET['id']))echo "option[value=" . $_GET['id'] .']'; ?>').attr('selected', 'selected');

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
                document.getElementById("profile").src = e.target.result;
            };
            reader.readAsDataURL(this.files[0]);
        };
    </script>
</body>

</html>