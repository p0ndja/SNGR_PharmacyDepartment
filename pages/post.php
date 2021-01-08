<?php 
    require '../static/functions/connect.php';
?>

<!DOCTYPE html>
<html lang="th" prefix="og:http://ogp.me/ns#">

<head>
    <?php require '../static/functions/head.php'; ?>
    <style>
        @media (min-width: 960px) {
            .card-columns {
                -webkit-column-count: 3;
                -moz-column-count: 3;
                column-count: 3;
            }
        }

        @media (max-width: 960px) {
            .card-columns {
                -webkit-column-count: 1;
                -moz-column-count: 1;
                column-count: 1;
            }
        }
    </style>
</head>
<nav class="navbar navbar-expand-lg navbar-dark navbar-normal fixed-top scrolling-navbar" id="nav" role="navigation">
    <?php require '../static/functions/navbar.php'; ?>
</nav>

<body>
    <?php

        $viewas = "guest";
        if (isset($_GET['id']) && !isValidPostID($_GET['id'], $conn)) back();

        if (isset($_GET['id']) && isValidPostID($_GET['id'], $conn) && getPostdata($_GET['id'], 'hotlink', $conn) != null)
            header("Location: " . getPostdata($_GET['id'], 'hotlink', $conn));

        if (!isset($_GET['id'])) {
            if (isset($_GET['category']) && isValidCategory($_GET['category'], $conn)) $category = $_GET['category'];
            else if (isset($_GET['viewas'])) $viewas = $_GET['viewas'];
            else header("Location: ../category/~-1");
        }

        $title = isset($category) ? $category : "viewas_$viewas";
    ?>

    <div class="container" id="container" style="padding-top: 88px">
        <?php if(!isset($_GET['id'])) {
            echo generateCategoryTitle($title); ?>
        <?php if (isLogin() && canThisRolePostAnything(getRole($_SESSION['id'], $conn), $conn)) { ?><a href="../post/create"
            class="btn btn-sm btn-info"><i class="fas fa-plus"></i> เขียนข่าวใหม่</a><?php } ?>
    <?php } ?>
    <?php 
            $news_per_page = 10;
            $cur_page = 1;
            if (isset($_GET['page'])) $cur_page = $_GET['page'];

            $start_id = ($cur_page - 1) * $news_per_page;

            $query = ""; $query_count = 0;
            if (isset($_GET['id'])) {
                $news_ID = $_GET['id'];
                $query = "SELECT * FROM `post` WHERE id = $news_ID";
                $query_count = "SELECT `id` FROM `post` WHERE id = $news_ID";
            } else if (isset($_GET['tags'])) { //Tags case
                $t = $_GET['tags'];
                if ($category == "~") {
                    $query = "SELECT * FROM `post` WHERE tags LIKE '%$t%' AND isHidden = 0 ORDER by isPinned DESC, time DESC limit {$start_id}, {$news_per_page}";
                    $query_count = "SELECT `id` FROM `post` WHERE tags LIKE '%$t%' AND isHidden = 0";
                } else {
                    $query = "SELECT * FROM `post` WHERE tags LIKE '%$t%' AND category = '$category' ORDER by isPinned DESC, time DESC limit {$start_id}, {$news_per_page}";
                    $query_count = "SELECT `id` FROM `post` WHERE tags LIKE '%$t%' AND category = '$category'";
                }
            } else if (isset($_GET['viewas'])) {
                $query = "SELECT * FROM `post` WHERE isHidden = 0 AND visible LIKE '%$viewas%' ORDER by isPinned DESC, time DESC limit {$start_id}, {$news_per_page}";
                $query_count = "SELECT `id` FROM `post` WHERE isHidden = 0 AND visible LIKE '%$viewas%'";
            } else { //Normal Case
                if ($category == "~") {
                    $query = "SELECT * FROM `post` WHERE isHidden = 0 ORDER by isPinned DESC, time DESC limit {$start_id}, {$news_per_page}";
                    $query_count = "SELECT `id` FROM `post` WHERE isHidden = 0";
                } else {
                    $query = "SELECT * FROM `post` WHERE isHidden = 0 AND category = '$category' ORDER by isPinned DESC, time DESC limit {$start_id}, {$news_per_page}";
                    $query_count = "SELECT `id` FROM `post` WHERE isHidden = 0 AND category = '$category'";
                }
            }

            $c = 0;
            $result = mysqli_query($conn, $query); ?>
    <?php if (!isset($_GET['id'])) { ?><div class="card-columns"><?php } else { ?><a onclick="window.history.back();" class="float-left"><i class="fas fa-arrow-left"></i> ย้อนกลับ</a><br><?php } ?>
        <?php while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) { $c++; ?>
        <?php if (getPostdata($row['id'], 'hotlink', $conn) == null) { ?>
        <div class="card hoverable mb-3 mt-1">
            <?php if (!empty($row['cover']) || !empty($row['thumbnail'])) { if (isset($_GET['id'])) $thumb = $row['cover']; else $thumb = !empty($row['thumbnail']) ? $row['thumbnail'] : $row['cover']; ?><img class="card-img-top" src="<?php echo $thumb; ?>"><?php } ?>
            <div class="card-body">
                <div class="card-text">
                    <h5 class="font-weight-bold"><?php echo generateCategoryBadge($row['category']); ?> <a
                            href="../post/<?php echo $row['id']; ?>" class="md"><?php echo $row['title']; ?></a>
                        <?php if (isLogin() && canUseThisCategory(getRole($_SESSION['id'], $conn), $row['category'], $conn)) { ?><small><a
                            href="../post/edit-<?php echo $row['id']; ?>"><i class="fas fa-edit text-success"></i></a>
                        <a
                            onclick='
                                    swal({title: "ลบข่าวหรือไม่ ?",text: "หลังจากที่ลบแล้ว ข่าวนี้จะไม่สามารถกู้คืนได้!",icon: "warning",buttons: true,dangerMode: true}).then((willDelete) => { if (willDelete) { window.location = "../pages/post_delete.php?id=<?php echo $row["id"]; ?>&category=<?php echo $row["category"]; ?>";}});'>
                            <i class="fas fa-trash-alt text-danger"></i></a></small><?php } ?>
                    </h5>
                    <?php if (!empty($row['tags'])) { ?><p class="card-text"><i class="fas fa-tag"></i> Tag: 
                    <?php foreach (explode(",", $row['tags']) as $s) { ?>
                        <u><a href="../category/<?php echo $row['category'] . "-1-" . $s; ?>" class="md"><?php echo $s; ?></a></u>
                        <?php } ?>
                    </p><?php }?>
                </div>

                <!-- Case post reader -->
                <?php if (isset($_GET['id'])) { ?>
                <?php if ($row['article'] != null) { ?>
                <hr>
                <p class="card-text"><?php echo $row['article']; ?></p>
                <?php } ?>
                <?php if ($row['attachment'] != null) { $n_attach = 0;?>
                <hr>
                <h5 class="font-weight-bold">ไฟล์แนบท้าย</h5>
                <?php foreach (explode(",", $row['attachment']) as $attach_split) { $n_attach++;?>
                <li><a href="<?php echo $attach_split; ?>"
                        target="_blank"><?php echo str_replace("../file/post/" . $_GET['id'] . "/" . "attachment/", "", $attach_split); ?></a>
                </li>
                <?php } ?>
                <?php if ($n_attach == 1 && strpos($row['attachment'], ".pdf")) { ?>
                <iframe
                    src="../vendor/pdf.js/web/viewer.html?file=<?php echo '../../../../' .  $row['attachment']; ?>"
                    width="100%" height="750"></iframe>
                <?php } ?>
                <?php } ?>
                <?php } ?>
                <i class="far fa-clock"></i>
                <small class="text-muted">
                <?php
                    $writer_id = $row['writer'];
                    $writer_name = getUserdata($writer_id, 'firstname', $conn) . ' ' . getUserdata($writer_id, 'lastname', $conn) . ' (' . getUserdata($writer_id, 'username', $conn) . ')';
                    echo fromThenToNow($row['time']) . ' โดย ' . '<a href="../profile/' . $writer_id . '" class="md">' . $writer_name . '</a>'; 
                ?>
                </small>
            </div>
        </div>
        <?php } else { // Case post is a hotlink ?>
        <a href="<?php echo $row['hotlink']; ?>" target="_blank">
            <div class="card hoverable mt-1">
                <?php if (!empty($row['cover']) || !empty($row['thumbnail'])) { $thumb = !empty($row['thumbnail']) ? $row['thumbnail'] : $row['cover'];?><img class="card-img-top"
                    src="<?php echo $thumb; ?>"><?php } ?>
                <?php if (isLogin() && canUseThisCategory(getRole($_SESSION['id'], $conn), $row['category'], $conn)) { ?><div class="card-body text-white p-2"><a
                        href="<?php echo $row['hotlink']; ?>" target="_blank" class="font-weight-bold md"><?php echo $row['title']; ?></a>
                    <a href="../post/edit-<?php echo $row['id']; ?>"><i class="fas fa-edit text-success"></i></a> <a
                        onclick='
                                    swal({title: "ลบข่าวหรือไม่ ?",text: "หลังจากที่ลบแล้ว ข่าวนี้จะไม่สามารถกู้คืนได้!",icon: "warning",buttons: true,dangerMode: true}).then((willDelete) => { if (willDelete) { window.location = "../pages/post_delete.php?id=<?php echo $row["id"]; ?>&category=<?php echo $row["category"]; ?>";}});'>
                        <i class="fas fa-trash-alt text-danger"></i></a></div><?php } ?>
            </div>
        </a>
        <?php } ?>
        <?php } ?>
    </div>
    <div class="mb-3"></div>
    <?php if (!isset($_GET['id'])) {
            if ($c > 0 && $c > $news_per_page) { ?>
    <hr>
    <?php
            $total = mysqli_num_rows(mysqli_query($conn, $query_count));
            $total_page = ceil($total / $news_per_page);?>
    <nav aria-label="Page navigation example">
        <ul class="pagination pagination-circle pg-amber justify-content-center">
            <li class="page-item">
                <a class="page-link"
                    href="../category/<?php echo $_GET['category'] . "-1"?><?php if (isset($_GET['tags'])) echo '-' . $_GET['tags']; ?>"
                    aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <?php for($i=1;$i<=$total_page;$i++){ ?>
            <li class="page-item <?php if ($_GET['page'] == $i) echo 'active';?>"><a class="page-link"
                    href="../category/<?php echo $_GET['category'] . "-" . $i;?><?php if (isset($_GET['tags'])) echo '-' . $_GET['tags']; ?>"><?php echo $i; ?></a>
            </li>
            <?php } ?>
            <li class="page-item">
                <a class="page-link"
                    href="../category/<?php echo $_GET['category'] . "-" . $total_page;?><?php if (isset($_GET['tags'])) echo '-' . $_GET['tags']; ?>"
                    aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
    <?php } else if ($c == 0) { ?>
    <h4 class="text-center"><i>ไม่พบข้อมูล</i></h4>
    <?php }
     } ?>
    </div>
    <?php require '../static/functions/popup.php'; ?>
    <?php require '../static/functions/footer.php'; ?>
</body>

</html>