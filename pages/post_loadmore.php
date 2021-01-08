<?php 
    require '../static/functions/connect.php';

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
    $result = mysqli_query($conn, $query); 
    $html = "";
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) { ?>
        <?php if (getPostdata($row['id'], 'hotlink', $conn) == null) { ?>
        <div class="card hoverable mb-3 mt-1">
            <?php if ($row['cover'] != null) { ?><img class="card-img-top" src="<?php echo $row['cover']; ?>"><?php } ?>
            <div class="card-body">
                <div class="card-text">
                    <h5 class="font-weight-bold"><?php echo generateCategoryBadge($row['category']); ?> <a
                            href="../post/<?php echo $row['id']; ?>"><?php echo $row['title']; ?></a>
                        <?php if (isLogin() && canUseThisCategory(getRole($_SESSION['id'], $conn), $row['category'], $conn)) { ?><a
                            href="../post/edit-<?php echo $row['id']; ?>"><i class="fas fa-edit text-success"></i></a>
                        <a
                            onclick='
                                    swal({title: "ลบข่าวหรือไม่ ?",text: "หลังจากที่ลบแล้ว ข่าวนี้จะไม่สามารถกู้คืนได้!",icon: "warning",buttons: true,dangerMode: true}).then((willDelete) => { if (willDelete) { window.location = "../pages/post_delete.php?id=<?php echo $row["id"]; ?>&category=<?php echo $row["category"]; ?>";}});'>
                            <i class="fas fa-trash-alt text-danger"></i></a><?php } ?>
                    </h5>
                    <?php if (!empty($row['tags'])) { ?><p class="card-text"><i class="fas fa-tag"></i> Alias: 
                    <?php foreach (explode(",", $row['tags']) as $s) { ?>
                        <u><a href="../category/<?php echo $row['category'] . "-1-" . $s; ?>"><?php echo $s; ?></a></u>
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
            </div>
            <div class="card-footer">
                <i class="far fa-clock"></i>
                <?php
                    $writer_id = $row['writer'];
                    $writer_name = getUserdata($writer_id, 'firstname', $conn) . ' ' . getUserdata($writer_id, 'lastname', $conn) . ' (' . getUserdata($writer_id, 'username', $conn) . ')';
                    echo $row['time'] . ' โดย ' . '<a href="../profile/' . $writer_id . '">' . $writer_name . '</a>'; 
                ?>
            </div>
        </div>
        <?php } else { // Case post is a hotlink ?>
        <a href="<?php echo $row['hotlink']; ?>" target="_blank">
            <div class="card hoverable mt-1">
                <?php if ($row['cover'] != null) { ?><img class="card-img-top"
                    src="<?php echo $row['cover']; ?>"><?php } ?>
                <?php if (isLogin() && canUseThisCategory(getRole($_SESSION['id'], $conn), $row['category'], $conn)) { ?><div class="card-body text-white p-2"><a
                        href="<?php echo $row['hotlink']; ?>" target="_blank"><?php echo $row['title']; ?></a>
                    <a href="../post/edit-<?php echo $row['id']; ?>"><i class="fas fa-edit text-success"></i></a> <a
                        onclick='
                                    swal({title: "ลบข่าวหรือไม่ ?",text: "หลังจากที่ลบแล้ว ข่าวนี้จะไม่สามารถกู้คืนได้!",icon: "warning",buttons: true,dangerMode: true}).then((willDelete) => { if (willDelete) { window.location = "../pages/post_delete.php?id=<?php echo $row["id"]; ?>&category=<?php echo $row["category"]; ?>";}});'>
                        <i class="fas fa-trash-alt text-danger"></i></a></div><?php } ?>
            </div>
        </a>
        <?php } ?>
    <?php } ?>
