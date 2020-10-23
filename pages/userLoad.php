<?php 
    require '../static/functions/connect.php';
    if (!isset($_GET['id']) || !isValidUserID($_GET['id'], $conn) || !isAdmin($_SESSION['id'], $conn)) back();
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
            <?php
                $id = $_GET['id'];

            ?>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <img src="<?php echo getProfilePicture($id, $conn); ?>" class="img-fluid w-100">
                            <h1 class="display-4 text-center text-black"><?php echo "ID: $id"; ?></h1>
                            <center><a href="javascript:window.history.back();" class="btn btn-info"><i class="fas fa-arrow-circle-left"></i> Back</a></center>
                        </div>
                        <div class="col-12 col-md-8">
                            <h4 class="font-weight-bold">ข้อมูลส่วนตัว - Information <i class="fas fa-user"></i></h4><hr>
                            <p>
                                ชื่อ <b><?php echo getDisplayname($id, $conn); ?></b><br>
                                อีเมล <b><a href="mailto:<?php echo getUserdata($id, 'email', $conn); ?>"><?php echo getUserdata($id, 'email', $conn); ?></a></b><br>
                                สถานะ <b><?php echo convertJobToText(getUserdata($id, 'job', $conn)); ?> [<?php echo convertRoleToText(getUserdata($id, 'role', $conn)); ?>]</b>
                            </p>
                            <h4 class="font-weight-bold">ประวัติการโพสต์ - Post <i class="fas fa-calendar-alt"></i></h4><hr>
                            <p>
                                <table class="table table-sm table-responsive-md table-hover text-nowrap">
                                    <thead class="bg-pharm">
                                        <tr>
                                            <th scope="col" style="width: 15%">
                                                <center>รหัสโพสต์</center>
                                            </th>
                                            <th scope="col" style="width: 45%">
                                                หัวข้อ
                                            </th>
                                            <th scope="col" style="width: 30%">
                                                <center>วันที่</center>
                                            </th>
                                            <th scope="col" style="width: 10%">
                                                <center> </center>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $r = "SELECT * FROM `post` WHERE id = $id ORDER BY id DESC";
                                            $q = mysqli_query($conn, $r);
                                            $c = 0; 
                                            while ($p = mysqli_fetch_array($q, MYSQLI_ASSOC)) {
                                                $c += 1;
                                        ?>
                                        
                                        <tr>
                                            <td><center><?php echo 'ID: ' . $p['id']; ?></center></td>
                                            <td><?php echo getPostdata($p['id'], 'title', $conn); ?></td>
                                            <td><center><?php echo getPostdata($p['id'], 'time', $conn); ?></center></td>
                                            <td><center><a href="../post/<?php echo $p['id']; ?>"><text class="text-pharm"><i class="fas fa-link"></i></text></a></center></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    <?php require '../static/functions/popup.php'; ?>
    <?php require '../static/functions/footer.php'; ?>
</body>

</html>