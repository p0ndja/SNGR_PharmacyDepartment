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
    <div class="container" style="padding-top: 88px;">
        <div class="container mb-3" id="container">
            <form method="post" enctype="multipart/form-data" action="../pages/suggestion_save.php" id="suggestForm" name="suggestForm" autocomplete="off">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="card-title">
                            <a onclick="window.history.back();" class="float-left"><i class="fas fa-arrow-left"></i> ย้อนกลับ</a><br>
                            <h1>ร้องเรียน - เสนอแนะ</h1>
                        </div>
                        <div class="card-text">
                            <div class="md-form input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text md-addon" id="addon-name">ชื่อ - สกุล</span>
                                </div>
                                <input type="text" class="form-control" id="name" name="name" placeholder=""
                                    aria-label="name" aria-describedby="addon-name" value="">
                            </div>
                            <div class="md-form input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text md-addon" id="addon-email">อีเมล</span>
                                </div>
                                <input type="email" class="form-control" id="email" name="email" placeholder=""
                                    aria-label="email" aria-describedby="addon-email" value="<?php if (isLogin()) echo getUserdata($_SESSION['id'], 'email', $conn); ?>">
                            </div>
                            <div class="container">
                                <!--Material textarea-->
                                <div class="md-form">
                                    <textarea id="message" name="message" class="md-textarea form-control" rows="5"></textarea>
                                    <label for="message">ข้อความ</label>
                                </div>
                            </div>
                            <h4><a id="submitDum" name="submitDum" class="float-right text-success" href="javascript:{}" onclick="document.getElementById('suggestForm').submit();">ส่ง <i class="fas fa-location-arrow"></i></a></h4>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <?php require '../static/functions/popup.php'; ?>
    <?php require '../static/functions/footer.php'; ?>
</body>

</html>