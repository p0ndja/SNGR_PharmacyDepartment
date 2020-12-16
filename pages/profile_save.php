<?php 
    require '../static/functions/connect.php';
    
    function generateRandomS($length = 16) {
        $characters = md5(time());
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }

    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $query = "SELECT * FROM `user` WHERE id = '$id'";
        $result = mysqli_query($conn, $query);
        if (! $result) die('Could not get data: ' . mysqli_error($conn));

        $pass = mysqli_fetch_array($result, MYSQLI_ASSOC)['password'];

        $fname = $_POST['firstname'];
        $lname = $_POST['lastname'];
        $email = $_POST['email'];
        $real_email = $_POST['real_email'];
        
        $job = $_POST['job'];
        
        $re = mysqli_query($conn, "UPDATE `user` set  firstname = '$fname', lastname = '$lname', email = '$email', job = '$job' WHERE id = '$id'");
        if (! $re) die('Could not update text: ' . mysqli_error($conn));

        if (isset($_POST['password']) && !empty($_POST['password'])) {
            $pass = md5($_POST['password']);
            $re = mysqli_query($conn, "UPDATE `user` set password = '$pass' WHERE id = '$id'");
            if (! $re) die('Could not update text: ' . mysqli_error($conn));
        }
        
        if(isset($_FILES['profile_upload']) && $_FILES['profile_upload']['name'] != ""){
            if ($_FILES['profile_upload']['name']) {
                if (!$_FILES['profile_upload']['error']) {
                    $name = "profile_" . generateRandomS(8);
                    $ext = explode('.', $_FILES['profile_upload']['name']);
                    $filename = $name . '.' . $ext[1];
        
                    if (!file_exists('../file/profile/'. $id .'/')) {
                        mkdir('../file/profile/'. $id .'/');
                    }
        
                    $destination = '../file/profile/'. $id .'/' . $filename; //change this directory
                    $location = $_FILES["profile_upload"]["tmp_name"];
                    move_uploaded_file($location, $destination);
                    $finalFile = '../file/profile/'. $id .'/' . $filename;//change this URL
                    $r = mysqli_query($conn, "UPDATE `user` SET profilePic = '$finalFile' WHERE id = '$id'");
                    if (! $r) die("Could not set profile: " . mysqli_error($conn));
                }
            }
        }
        $_SESSION['name'] = getUserdata($_SESSION['id'], 'firstname', $conn) . ' ' . getUserdata($_SESSION['id'], 'lastname', $conn);
        $_SESSION['shortname'] = getUserdata($_SESSION['id'], 'firstname', $conn);

        addLog($conn, $id, 'USER_PROFILE_EDIT', "ID: $id\nUSER: $username\nFIRSTNAME: $fname\nLASTNAME: $lname\nEMAIL: $email\nROLE: $role\nJOB: $job\n PROFILE: $finalFile\n")

        $name = $_SESSION['name'];        
        if ($real_email != $email) {
            header("Location: ../static/functions/verify/mail.php?key=$pass&email=$email&name=$name&method=changeEmail");
        } else {
            $_SESSION['swal_success'] = "ปรับปรุงข้อมูลสำเร็จ";
            header("Location: ../profile/");
        }
    }
?>