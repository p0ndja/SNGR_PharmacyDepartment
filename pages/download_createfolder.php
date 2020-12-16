<?php 
    require '../static/functions/connect.php';

    if (isset($_GET['mkdir']) && isPermission("editDLForm", $conn)) {
        $mkdir = $_GET['mkdir'];
        mkdir("../file/form/$mkdir");
        addLog($conn, $_SESSION['id'], "USER_FILE_FOLDER_MKDIR", "PATH: $mkdir");
    }
    header("Location: ../download/");
?>