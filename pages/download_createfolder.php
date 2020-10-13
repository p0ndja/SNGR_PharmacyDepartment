<?php 
    if (isset($_GET['mkdir'])) {
        $mkdir = $_GET['mkdir'];
        mkdir("../file/form/$mkdir");
        header("Location: ../download/");
    }
?>