<?php

if (isset($_POST['search'])) {
    $search = $_POST['search'];
    header("Location: ../../search/$search");
} else {
    header("Location: ../../home/");
}
?>