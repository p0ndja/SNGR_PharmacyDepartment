<?php
    ob_start();
    session_start();
    $dbhost = "pondhub.ga";
    $dbuser = "pondjaco";
    $dbpass = "11032545";
    $dbdatabase = "pondjaco_srinagarindhospital";
    $dbdatabaseForum = "pondjaco_srinagarindhospitalforum";
    $conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbdatabase); 
    $connForum = mysqli_connect($dbhost,$dbuser,$dbpass,$dbdatabaseForum); 
    
    mysqli_set_charset($conn, 'utf8');
    mysqli_set_charset($connForum, 'utf8');

    if(!$conn)  die('Could not connect: ' . mysqli_error($conn));
    
    $start_time = microtime(TRUE);
    
    require 'function.php';
    require 'webstats.php';

    @ini_set('upload_max_size','64M');
    @ini_set('post_max_size','64M');
    @ini_set('max_execution_time','300');
    
    date_default_timezone_set('Asia/Bangkok');

?>
