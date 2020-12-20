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
    <?php requireMobile(); ?>
    <div class="container" style="padding-top: 88px;">
        <div class="container mb-3" id="container">
            <h1 class="font-weight-bold text-center">ใบเสนอยาเข้าเภสัชตำหรับโรงพยาบาล</h1>
            <?php echo createHeader("ส่วนที่ 1 กรอกโดยแพทย์ผู้ต้องการใช้ยา"); ?>
            <form action="upload_DIC_save.php" enctype="multipart/form-data" method="POST" class="md-form">
                ที่ <input type='text' id='order' name='order' required size="5">/<input type='text' id='order_year' name='order_year' required size="5"> ภาควิชา <input type='text' id='depart' name='depart' required size="10"> วันที่ <input type='text' id='date_day' name='date_day' required size="2"> เดือน <input type='text' id='date_month' name='date_month' required size="8"> พ.ศ. <input type='text' id='date_year' name='date_year' required size="2"><br>
                ชื่อ นพ./พญ. <input type='text' id='name' name='name' required><br>
                ชื่อยา <input type='text' id='drug' name='drug' required> ความแรง <input type='text' id='drug_strength' name='strength' required> ชนิดยาเตรียม <input type='text' id='drug_type' name='drug_type' required><br>
                เหตุผลที่ต้องการให้นำยาเข้ามาใช้ในโรงพยาบาล
                <textarea class="form-control" type='text' id='reason' name='reason' required rows="4"></textarea>
                ประสบการณ์ทางคลินิกจากการใช้ยานี้
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="experience" id="experience1" value="option1" checked>
                    <label class="form-check-label" for="experience1">มี</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="experience" id="experience2" value="option2">
                    <label class="form-check-label" for="experience2">ไม่มี</label>
                </div><br>
                <textarea class="form-control" type='text' id='experience_des' name='experience_des' required rows="4"></textarea>
                <h5 class="font-weight-bold mt-5">ข้อมูลเกี่ยวกับยาที่เสนอเข้า</h5>
                ส่วนประกอบของยา <i>(โปรดระบุตัวยาสำคัญ)</i>
                <textarea class="form-control" type='text' id='drug_ingredient' name='drug_ingredient' required rows="3"></textarea>
                ฤทธิ์ทางเภสัชวิทยา
                <textarea class="form-control" type='text' id='drug_effect' name='drug_effect' required rows="2"></textarea>
                ข้อบ่งใช้
                <textarea class="form-control" type='text' id='drug_drugofuse' name='drug_drugofuse' required rows="2"></textarea>
                ขนาดยา <input type='text' id='drug_dose' name='drug_dose' required> <br>
                ขนาดบรรจุ <input type='text' id='drug_size' name='size' required> <br>
                อาการข้างเคียงที่พบบ่อย <input type='text' id='drug_sideeffect' name='drug_sideeffect' required size="50"> <br>
                อาการไม่พึงประสงค์ที่รุนแรง <input type='text' id='drug_adversesideeffect' name='drug_adversesideeffect' required size="50"> <br>
                ราคายารวมภาษีมูลค่าเพิ่มต่อบรรจุ <input type='text' id='drug_price' name='drug_price' required placeholder="...กรณีมีส่วนลด/แถม-โปรดระบุ" size="30"> <br>
                บริษัทผู้แทนจำหน่าย <input type='text' id='drug_manu' name='drug_manu' required size="30"> เบอร์โทรติดต่อ <input type='text' id='drug_manu_contact' name='drug_manu_contact' required size="11"><br>
            </form>
        </div>
    </div>
    

    <?php require '../static/functions/popup.php'; ?>
    <?php require '../static/functions/footer.php'; ?>
</body>

</html>