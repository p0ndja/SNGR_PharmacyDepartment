<?php

    if (isset($_GET['path']) && isset($_GET['name'])) {
        unlink('../file/form/' . $_GET['path'] . '/' . $_GET['name']);
        header("Location: ../download/" . $_GET['path']);
    }

?>