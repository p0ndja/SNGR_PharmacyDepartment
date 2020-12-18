<?php declare(strict_types=1);
    function isLogin() {
        if (isset($_SESSION['id'])) return true;
        return false;
    }

    function isAdmin($id, $conn) {
        if (getRole($id, $conn) == "admin") return true;
        return false;
    }

    function isPermission($perm, $conn) {
        if (!isset($_SESSION['id'])) return false;
        $role = getUserdata($_SESSION['id'], 'role', $conn);
        if (canThisRoleDoThisPerm($role, $perm, $conn) || $role == 'admin') return true;
        return false;
    }

    function getRole($id, $conn) {
        return getUserdata($id, 'role', $conn);
    }

    function checkPermission($perm, $id, $conn) {
        if (!getUserdata($id, $perm, $conn) && !getUserdata($id, 'isAdmin', $conn)) return false;
        return true;
    }

    function addLog($conn, $userID, $action, $description) {
        return mysqli_query($conn, "INSERT INTO `log` (`user`,`action`,`data`) VALUES ('$userID', '$action', '$description')");
    }

    function getAnySQL($sql, $val, $key, $key_val, $conn) {
        if ($sql == null || $val == null || $key == null || $key_val == null || $conn == null) return false;
        return mysqli_fetch_array(mysqli_query($conn, "SELECT `$val` from `$sql` WHERE $key = '$key_val'"), MYSQLI_ASSOC)[$val];
    }

    function saveAnySQL($sql, $col, $val, $key, $key_val, $conn) {
        if ($sql == null || $col == null || $key == null || $key_val == null || $conn == null) return false;
        return mysqli_query($conn, "UPDATE `$sql` SET `$col` = $val WHERE `$key` = '$key_val'");
    }

    function getUserdata($id, $data, $conn) {
        return getAnySQL('user', $data, 'id', $id, $conn);
    }
    //getUserdata('604019', 'username', $conn);

    function saveUserdata($id, $data, $val, $conn) {
        if (saveAnySQL('user', $data, $val, 'id', $id, $conn)) return true;
        return false;
    }
    //saveUserdata('604019', 'username', 'PondJaTH', $conn);

    function getPostdata($id, $data, $conn) {
        return getAnySQL('post', $data, 'id', $id, $conn);
    }
    //getPostdata('1', 'article', $conn);

    function savePostdata($id, $data, $val, $conn) {
        if (saveAnySQL('post', $data, $val, 'id', $id, $conn)) return true;
        return false;
    }
    //saveUserdata('604019', 'username', 'PondJaTH', $conn);

    function canThisRoleDoThisPerm($role, $perm, $conn) {
        $r = getAnySQL('permission', $perm, 'role', $role, $conn);
        if (empty($r)) return null;
        return getAnySQL('permission', $perm, 'role', $role, $conn);
    }
    //canThisRoleDoThisPerm('admin', 'editAbout', $conn);

    function getProfilePicture($id, $conn) {
        $_array = getUserdata($id,'profilePic',$conn);
        if ($_array != null) return $_array;
        else return '../static/elements/user.png';
    }

    function isValidUserID($id, $conn) {
        $query = "SELECT * FROM `user` WHERE id = '$id'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) return true;
        return false;
    }

    function isValidForumID($id, $connForum) {
        $query = "SELECT * FROM `id_$id`";
        $result = mysqli_query($connForum, $query);
        if (mysqli_num_rows($result) > 0) return true;
        return false;
    }

    function isValidPostID($id, $conn) {
        $query = "SELECT * FROM `post` WHERE id = '$id'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) return true;
        return false;
    }

    function isVerify($id, $conn) {
        return getUserdata($id, 'isEmailVerify', $conn);
    }

    function watchVDO() {
        $vdo = array();
        $txtFile = "../static/elements/video.txt";
        if (file_exists($txtFile)) {
            $file = fopen("../static/elements/video.txt", "r");
            while(!feof($file)) {
                array_push($vdo, fgets($file));
                # do same stuff with the $vdo
            }
            fclose($file);
        } else {
            $file = fopen("../static/elements/video.txt","w");
            if (!fwrite($file,"https://www.youtube.com/embed/VXZM6imLsw4"))
                die("CAN'T WRITE FILE");
            fclose($file);
        }

        return array_filter($vdo);
    }

    function createHeader($text) {
        return '<div class="c_header"><div class="c_title">'.$text.'<div class="c_tail"></div><div class="c_tail2"></div></div></div>';
    }
?>
<?php

    function getActionName($action) {

        switch($action) {
            case "USER_PROFILE_EDIT":
                return "แก้ไขข้อมูลผู้ใช้";

            case "USER_FORUM_POST":
                return "โพสต์ฟอรั่ม";
            case "USER_FORUM_EDIT":
                return "แก้ไขโพสต์ฟอรั่ม";
            case "USER_FORUM_DELETE":
                return "ลบโพสต์ฟอรั่ม";
            case "USER_FORUM_COMMENT_POST":
                return "โพสต์ความคิดเห็นในฟอรั่ม";
            case "USER_FORUM_COMMENT_DELETE":
                return "ลบโพสต์ความคิดเห็นในฟอรั่ม";
            
            case "USER_ARTICLE_POST":
                return "โพสต์ข่าว";
            case "USER_ARTICLE_EDIT":
                return "แก้ไขโพสต์ข่าว";
            case "USER_ARTICLE_DELETE":
                return "ลบโพสต์ข่าว";

            case "USER_FILE_FILE_CREATE":
                return "เพิ่มไฟล์";
            case "USER_FILE_FILE_DELETE":
                return "ลบไฟล์";
            case "USER_FILE_FOLDER_MKDIR":
                return "สร้างโฟลเดอร์";
            case "USER_FILE_FOLDER_RMDIR":
                return "ลบโฟลเดอร์";

            case "USER_REGISTER":
                return "สร้างบัญชีใหม่";
            case "USER_LOGIN":
                return "ลงชื่อเข้าใช้";
            
            default:
                return strtoupper($action);

        }

    }

    function getDisplayName($id, $conn) {
        return getUserdata($id, 'firstname', $conn) . ' ' . getUserdata($id, 'lastname', $conn);
    }

    function getClientIP() {
        if(!empty($_SERVER['HTTP_CLIENT_IP'])) return $_SERVER['HTTP_CLIENT_IP'];
        else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) return $_SERVER['HTTP_X_FORWARDED_FOR'];
        return $_SERVER['REMOTE_ADDR'];
    }

    function path_curTime() {
        date_default_timezone_set('Asia/Bangkok'); return date('Y/m/d', time());
    }

    function unformat_curTime() {
        date_default_timezone_set('Asia/Bangkok'); return date('YmdHis', time());
    }

    function curDate() {
        date_default_timezone_set('Asia/Bangkok'); return date('Y-m-d', time());
    }

    function curTime() {
        date_default_timezone_set('Asia/Bangkok'); return date('H:i:s', time());
    }

    function curFullTime() {
        date_default_timezone_set('Asia/Bangkok'); return date('Y-m-d H:i:s', time());
    }

    function sendFileToIMGHost($file) {
        $data = array(
            'img' => new CURLFile($file['tmp_name'],$file['type'], $file['name']),
        ); 
        
        //**Note :CURLFile class will work if you have PHP version >= 5**
        
         $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, 'https://img.p0nd.ga/upload.php');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_TIMEOUT, 86400); // 1 Day Timeout
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60000);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_REFERER, $_SERVER['HTTP_HOST']);
        
        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            $msg = FALSE;
        } else {
            $msg = $response;
        }
        
        curl_close($ch);
        return $msg;
    }

    function hasVisible($groupList, $group) {
        if (empty($groupList)) return false;
        return strpos($groupList, $group) !== false;
    }

    function isValidCategory($category) {
        $categoryList = ["about","manufacture","inventory","service","DIC","news","order","announce","guideline"
                        ,"manual","research","CoPADR","CoPHAD","CoPME","CoPRDU","general","news","order","announce","guideline","manual"];
        if ($category == "~") return true;
        foreach ($categoryList as $listCategory) {
            if ($listCategory == $category) return true;
        }
        return false;
    }

    function canThisRolePostAnything($role, $conn) {
        if ($role == "admin") return true;

        $categoryQuery = getAnySQL('permission', 'category', 'role', $role, $conn);
        if ($categoryQuery == null) return false;
        else return true;
    }

    function canUseThisCategory($role, $category, $conn) {
        if ($role == "admin") return true;

        $categoryQuery = getAnySQL('permission', 'category', 'role', $role, $conn);
        if ($categoryQuery == null) return false;

        if (strpos($categoryQuery, $category)) return true;
        else return false;
    }

    function generateCategoryBadge($category) {
        $style = "default"; $title = "undefined";
        if ($category == "news") {
            $style = "pharm"; $title = "ข่าว";
        } else if ($category == "order") {
            $style = "info"; $title = "คำสั่ง";
        } else if ($category == "announce") {
            $style = "danger"; $title = "ประกาศ";
        } else if ($category == "guideline") {
            $style = "primary"; $title = "ระเบียบ";
        } else if ($category == "manual") {
            $style = "dark"; $title = "คู่มือ";
        } else if ($category == "about") {
            $style = "light"; $title = "เกี่ยวกับ";
        } else if (strpos($category, "CoP") !== false) {
            $style = "info"; $title = "ชุมชนนักปฏิบัติ";
        } else if ($category == "manufacture") {
            $style = "success"; $title = "งานผลิตฯ";
        } else if ($category == "inventory") {
            $style = "secondary"; $title = "งานคลังฯ";
        } else if ($category == "service") {
            $style = "warning text-dark"; $title = "งานบริการฯ";
        } else if ($category == "DIC") {
            $style = "default"; $title = "DIC";
        }
        
        return "<span class='badge badge-$style'>$title</span>";
    }

    function generateForumTopic($topic) {
        $main = '<span class="badge %color% z-depth-0">%title%</span>';
        if ($topic == "general") $main = str_replace("%title%", "พูดคุยทั่วไป", str_replace("%color%", "badge-smd", $main));
        else if ($topic == "knowledge") $main = str_replace("%title%", "รอบรู้เรื่องเรียน", str_replace("%color%", "badge-info", $main));
        else if ($topic == "alumni") $main = str_replace("%title%", "ศิษย์เก่า", str_replace("%color%", "red darken-4", $main));
        else if ($topic == "marketplace") $main = str_replace("%title%", "ตลาดนัด SMD", str_replace("%color%", "badge-success", $main));
        else if ($topic == "bugreport") $main = str_replace("%title%", "แจ้งปัญหาการใช้งาน", str_replace("%color%", "purple", $main));
        else if ($topic == "suggestion") $main = str_replace("%title%", "เสนอแนะ", str_replace("%color%", "indigo", $main));
        else if ($topic == "updatelog") $main = str_replace("%title%", "อัพเดทเว็บไซต์", str_replace("%color%", "pink lighten-1", $main));
        return $main;
    }

    function convertJobToText($job) {
        if ($job == "contractor") return "รับจ้างทั่วไป / ลูกจ้าง";
        else if ($job == "civilservant") return "รับราชการ / พนักงานรัฐ";
        else if ($job == "business") return "ธุรกิจส่วนตัว";
        else if ($job == "other") return " - ";
        else if ($job == "doctor") return "แพทย์";
        else if ($job == "nurse") return "พยาบาล";
        else if ($job == "pharmacist") return "เภสัชกร";
        else if ($job == "staff") return "บุคลากรภายใน";
        else return "Undefined";
    }

    function convertRoleToText($role) {
        if ($role = "admin") return "แอดมิน";
        else if ($role = "headManu") return "งานผลิต";
        else if ($role = "headInv") return "งานคลังยาและเวชภัณฑ์";
        else if ($role = "headServ") return "งานบริการจ่ายยา";
        else if ($role = "headDIC") return "งานเภสัชสนเทศทางยา";
        else if ($role = "CoP") return "ชุมชนนักปฏิบัติ (CoP)";
        else if ($role = "reporter") return "ผู้รายงานข่าวประชาสัมพันธ์";
        else if ($role = "hospitalStaff") return "บุคลากรภายใน";
        else if ($role = "secretary") return "เลขานุการ";
        else return "ผู้เยี่ยมชม";
    }

    function generateCategoryTitle($category) {
        $path = "../static/elements/header/$category.png";
        if (file_exists($path)) {
            return "<div><img src='$path'/>";
        } else {
            if ($category == "~")
                return "<div class='display-4'>โพสต์ทั้งหมด</div>";
            else if ($category == "about")
                return "<div class='display-4'>เกี่ยวกับ</div>";
            else if ($category == "manufacture")
                return "<div class='display-4'>งานผลิต</div>";
            else if ($category == "inventory")
                return "<div class='display-4'>งานคลังยาและเวชภัณฑ์</div>";
            else if ($category == "service")
                return "<div class='display-4'>งานบริการจ่ายยา</div>";
            else if ($category == "DIC")
                return "<div class='display-4'>งานเภสัชสนเทศทางยา</div>";
            else if ($category == "general")
                return "<div class='display-4'>โพสต์ทั่วไป</div>";
            else if ($category == "news")
                return "<div class='display-4'>ข่าวประชาสัมพันธ์</div>";
            else if ($category == "order")
                return "<div class='display-4'>คำสั่ง</div>";
            else if ($category == "announce")
                return "<div class='display-4'>ประกาศ</div>";
            else if ($category == "guideline")
                return "<div class='display-4'>ระเบียบ - แนวทางปฏิบัติ</div>";
            else if ($category == "manual")
                return "<div class='display-4'>คู่มือการใช้ยา</div>";
            else if ($category == "research")
                return "<div class='display-4'>ผลงานวิจัยและ R2R</div>";
            else if ($category == "CoPADR")
                return "<div class='display-4'>ชุมชนนักปฏิบัติ ADR</div>";
            else if ($category == "CoPHAD")
                return "<div class='display-4'>ชุมชนนักปฏิบัติ HAD</div>";
            else if ($category == "CoPME")
                return "<div class='display-4'>ชุมชนนักปฏิบัติ ME</div>";
            else if ($category == "CoPRDU")
                return "<div class='display-4'>ชุมชนนักปฏิบัติ RDU</div>";
            else if ($category == "viewas_guest")
                return "<div class='display-4'>โพสต์สำหรับประชาชนทั่วไป</div>";
            else if ($category == "viewas_staff")
                return "<div class='display-4'>โพสต์สำหรับบุคลากรภายใน</div>";
            else if ($category == "viewas_dealer")
                return "<div class='display-4'>โพสต์สำหรับบริษัทยา</div>";
            
            
            else
                return "<div class='display-4'>" . strtoupper($category);
        }
    }

    function generateOpenGraphMeta($conn) {
        $current_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        
        if (strpos($current_url, "/post/")) {
            //Mean you're currently browsing in post page
            if (isset($_GET['id']) && isValidPostID($_GET['id'], $conn)) {
                $postID = $_GET['id'];
                $topic = getPostdata($postID, 'title', $conn);
                $img = getPostdata($postID, 'cover', $conn);
                
                if ($img == null) {
                    list($ogwidth, $ogheight, $ogtype, $ogattr) = getimagesize("../static/elements/logo/logo.png");
                    $img = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . "/static/elements/logo/logo.png";
                } else {
                    list($ogwidth, $ogheight, $ogtype, $ogattr) = getimagesize($img);
                    $img = str_replace("..", (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'], $img);
                }
                
                ?>
        <meta property="og:image" content="<?php echo $img; ?>" />
        <meta property="og:image:width" content="<?php echo $ogwidth; ?>" />
        <meta property="og:image:height" content="<?php echo $ogheight; ?>" />
        <meta property="og:title" content="<?php echo $topic;?>" />
        <title><?php echo $topic;?> | งานเภสัชกรรม โรงพยาบาลศรีนครินทร์</title>
        <meta property="og:description" content="คณะแพทยศาสตร์ มหาวิทยาลัยขอนแก่น 123 ถนน มิตรภาพ อำเภอเมืองขอนแก่น ขอนแก่น 40002" />
            <?php }
        } else { ?>
        <meta property="og:image" content="<?php echo (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST']; ?>/static/elements/logo/logo.png" />
        <?php list($ogwidth, $ogheight, $ogtype, $ogattr) = getimagesize("../static/elements/logo/logo.png"); ?>
        <meta property="og:image:width" content="<?php echo $ogwidth; ?>" />
        <meta property="og:image:height" content="<?php echo $ogheight; ?>" />
        <meta property="og:title" content="งานเภสัชกรรม โรงพยาบาลศรีนครินทร์" />
        <title>งานเภสัชกรรม โรงพยาบาลศรีนครินทร์</title>
        <meta property="og:description" content="คณะแพทยศาสตร์ มหาวิทยาลัยขอนแก่น 123 ถนน มิตรภาพ อำเภอเมืองขอนแก่น ขอนแก่น 40002" />
        <?php } ?>
        <meta name="twitter:card" content="summary"></meta>
        <link rel="image_src" href="<?php echo (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST']; ?>/static/elements/logo/logo.png" />
        <meta property="og:type" content="website" />
        <meta property="og:url" content="<?php echo $current_url; ?>" />
    <?php }

    function generateRandom($length = 16) {
        $characters = md5(time());
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }
?>

<?php
    function needLogin() {
    if (!isLogin()) {?>
<script>
    swal({
        title: "ACCESS DENIED",
        text: "You need to logged-in!",
        icon: "error"
    }).then(function () {
        <?php $_SESSION['error'] = "กรุณาเข้าสู่ระบบก่อนดำเนินการต่อ"; ?>
        window.location = "../login/";
    });
</script>
<?php die(); }} ?>

<?php
    function needPermission($perm, $conn) {
    if (!isset($_SESSION['id']) || !isLogin()) { needLogin(); die(); return false; }
    if (!isPermission($perm, $conn)) { ?>
<script>
    swal({
        title: "ACCESS DENIED",
        text: "You don't have enough permission!",
        icon: "warning"
    }).then(function () {
        window.location = "../home/";
    });
</script>
<?php die(); return false;}
        return true;
    }
?>
<?php
    function needRole($role, $conn) {
    if (!isset($_SESSION['id']) || !isLogin()) { needLogin(); die(); return false; }
    if (getRole($_SESSION['id'], $conn) != $role && !isAdmin($_SESSION['id'], $conn)) { ?>
<script>
    swal({
        title: "ACCESS DENIED",
        text: "You don't have enough permission!",
        icon: "warning"
    }).then(function () {
        window.location = "../home/";
    });
</script>
<?php die(); return false;}
        return true;
    }
?>
<?php function back() {
    if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    } else {
        home();
    }
    die();
    } ?>
<?php function home() {
    header("Location: ../home/");
} ?>
<?php function logout() { ?>
    <script>
        swal({
            title: "ออกจากระบบ ?",
            text: "คุณต้องการออกจากระบบหรือไม่?",
            icon: "warning",
            buttons: true,
            dangerMode: true}).then((willDelete) => {
                if (willDelete) {
                    window.location = "../logout/";
                }
            });
</script>
<?php } ?>

<?php function deletePost($id) { ?>
    <script>
        swal({
            title: "ลบข่าวหรือไม่ ?",
            text: "หลังจากที่ลบแล้ว ข่าวนี้จะไม่สามารถกู้คืนได้!",
            icon: "warning",
            buttons: true,
            dangerMode: true}).then((willDelete) => {
                if (willDelete) {
                    window.location = "../post/delete.php?id=<?php echo $id; ?>";
                }
            });
    </script>
<?php } ?>
<?php function warningSwal($title,$name) { ?>
    <script>
    swal({
        title: "<?php echo $title; ?>",
        text: "<?php echo $name; ?>",
        icon: "warning"
    });
    </script>
<?php } ?>
<?php function errorSwal($title,$name) { ?>
    <script>
    swal({
        title: "<?php echo $title; ?>",
        text: "<?php echo $name; ?>",
        icon: "error"
    });
    </script>
<?php } ?>
<?php function successSwal($title,$name) { ?>
    <script>
    swal({
        title: "<?php echo $title; ?>",
        text: "<?php echo $name; ?>",
        icon: "success"
    });
    </script>
<?php } ?>
<?php function debug($message) { echo $message; } ?>

<?php
    function startsWith($haystack, $needle) {
        return substr_compare($haystack, $needle, 0, strlen($needle)) === 0;
    }
    function endsWith($haystack, $needle) {
        return substr_compare($haystack, $needle, -strlen($needle)) === 0;
    }
?>
