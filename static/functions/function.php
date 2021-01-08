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

    function lazy($path, $size = 0.025) {
        $dir = pathinfo($path, PATHINFO_DIRNAME);
        $nam = pathinfo($path, PATHINFO_FILENAME);
        $ext = pathinfo($path, PATHINFO_EXTENSION);

        list($wid, $ht) = getimagesize($path);

        $dul = "";
        if (file_exists("$dir/$nam.lazy.$ext")) {
            return "$dir/$nam.lazy.$ext";
        } else {
            return imageResize($wid*$size, "$dir/$nam.lazy", $path);
        }
    }

    function createThumbnail($path, $size = 0.125) {
        $dir = pathinfo($path, PATHINFO_DIRNAME);
        $nam = pathinfo($path, PATHINFO_FILENAME);
        $ext = pathinfo($path, PATHINFO_EXTENSION);

        list($wid, $ht) = getimagesize($path);

        $dul = "";
        if (file_exists("$dir/$nam.thumbnail.$ext")) {
            $i = 1;
            while(file_exists("$dir/$nam.thumbnail"."_$i.$ext")) {
                $i++;
            }
            $dul = "_$i";
        }

        return imageResize($wid*$size, "$dir/$nam.thumbnail$dul", $path);
    }

    function imageResize($newWidth, $targetFile, $originalFile) {

        $info = getimagesize($originalFile);
        $mime = $info['mime'];
    
        switch ($mime) {
                case 'image/jpeg':
                        $image_create_func = 'imagecreatefromjpeg';
                        $image_save_func = 'imagejpeg';
                        $new_image_ext = 'jpg';
                        break;
    
                case 'image/png':
                        $image_create_func = 'imagecreatefrompng';
                        $image_save_func = 'imagepng';
                        $new_image_ext = 'png';
                        break;
    
                case 'image/gif':
                        $image_create_func = 'imagecreatefromgif';
                        $image_save_func = 'imagegif';
                        $new_image_ext = 'gif';
                        break;
    
                default: 
                        throw new Exception('Unknown image type.');
        }
    
        $img = $image_create_func($originalFile);
        list($width, $height) = getimagesize($originalFile);
    
        $newHeight = (int) floor(($height / $width) * $newWidth);
        $newWidth = (int) floor($newWidth);
        $tmp = imagecreatetruecolor($newWidth, $newHeight);
        imagecopyresampled($tmp, $img, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
    
        if (file_exists($targetFile)) {
                unlink($targetFile);
        }
        if (!$image_save_func($tmp, "$targetFile.$new_image_ext")) return 0;
        return "$targetFile.$new_image_ext";
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
            return "<img src='$path'/>";
        } else {
            $text = strtoupper($category);
            if ($category == "~")
                $text = "โพสต์ทั้งหมด";
            else if ($category == "about")
                $text = "เกี่ยวกับ";
            else if ($category == "manufacture")
                $text = "งานผลิต";
            else if ($category == "inventory")
                $text = "งานคลังยาและเวชภัณฑ์";
            else if ($category == "service")
                $text = "งานบริการจ่ายยา";
            else if ($category == "DIC")
                $text = "งานเภสัชสนเทศทางยา";
            else if ($category == "general")
                $text = "โพสต์ทั่วไป";
            else if ($category == "news")
                $text = "ข่าวประชาสัมพันธ์";
            else if ($category == "order")
                $text = "คำสั่ง";
            else if ($category == "announce")
                $text = "ประกาศ";
            else if ($category == "guideline")
                $text = "ระเบียบ - แนวทางปฏิบัติ";
            else if ($category == "manual")
                $text = "คู่มือการใช้ยา";
            else if ($category == "research")
                $text = "ผลงานวิจัยและ R2R";
            else if ($category == "CoPADR")
                $text = "ชุมชนนักปฏิบัติ ADR";
            else if ($category == "CoPHAD")
                $text = "ชุมชนนักปฏิบัติ HAD";
            else if ($category == "CoPME")
                $text = "ชุมชนนักปฏิบัติ ME";
            else if ($category == "CoPRDU")
                $text = "ชุมชนนักปฏิบัติ RDU";
            else if ($category == "viewas_guest")
                $text = "โพสต์สำหรับประชาชนทั่วไป";
            else if ($category == "viewas_staff")
                $text = "โพสต์สำหรับบุคลากรภายใน";
            else if ($category == "viewas_dealer")
                $text = "โพสต์สำหรับบริษัทยา";

            return createHeader($text);
        }
    }

    function WTFTime($dateString) {
        if(strtotime($dateString) > time()) {
            return 1;
        # date is in the future
        }
        if(strtotime($dateString) < time()) {
            return -1;
        # date is in the past
        }
        if(strtotime($dateString) == time()) {
            return 0;
        # date is right now
        }
    }

    function dateDifference($date_1 , $date_2 = 'now' , $differenceFormat = '%a' )
    {
        $datetime1 = date_create($date_1);
        $datetime2 = date_create($date_2);
    
        $interval = date_diff($datetime1, $datetime2);
    
        return $interval->format($differenceFormat);
    
    }

    function fromThenToNow($date_1, $differenceFormat = '%a')
    {
        $datetime1 = date_create($date_1);
        date_default_timezone_set('Asia/Bangkok'); 
        $datetime2 = date_create('now');
    
        $interval = date_diff($datetime1, $datetime2);

        $time = WTFTime($date_1);
    
        $days = $interval->format($differenceFormat);
        $msg = "";
        if ($days == 0) {
            if ($hour = dateDifference($date_1, 'now', '%h'))
                $msg = "เมื่อ " . $hour . " ชั่วโมงที่แล้ว";
            else if ($min = dateDifference($date_1, 'now', '%i'))
                $msg = "เมื่อ " . $min . " นาทีที่แล้ว";
            else
                $msg = "เมื่อสักครู่";
        }
        else if ($time > 0) {
            if ($days > 365)
                $msg = "อีก " . floor($days/365) . " ปี";
            else if ($days > 30)
                $msg = "อีก " . floor($days/30) . " เดือน";
            else
                $msg = "อีก $days วัน";
        } else {
            if ($days > 365)
                $msg = "เมื่อ " . floor($days/365) . " ปีที่แล้ว";
            if ($days > 30)
                $msg = "เมื่อ " . floor($days/30) . " เดือนที่แล้ว";
            else
                $msg = "เมื่อ $days วันที่แล้ว";
        }
        return "<a title='$date_1 ICT'>$msg</a>";
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
<?php function requireMobile() { ?>
    <script>
        if ($(window).width() < 992) {
            swal({
                title: "ไม่สามารถเข้าถึงเนื้อหาได้",
                text: "หน้าเว็บนี้เหมาะสำหรับการใช้งานบนคอมพิวเตอร์เท่านั้น โปรดลองอีกครั้งบนคอมพิวเตอร์",
                icon: "warning",}).then(function () {
                    window.location = "../home/";   
            }); 
        }
    </script>
<?php } ?>

<?php
    function noMobile() {
        if ($_SESSION['isMobile']) {
     ?>
<script>
    swal({
        title: "ACCESS DENIED",
        text: "You don't have enough permission!",
        icon: "warning"
    }).then(function () {
        window.location = "../home/";
    });
</script>
<?php die(); return false; }
        return true;
    }
?>

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
