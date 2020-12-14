<?php require '../static/functions/connect.php'; ?>

<!DOCTYPE html>
<html lang="th">

<head>
    <?php require '../static/functions/head.php'; ?>
</head>

<body>
    <div class="container" id="container">
        <div class="_df_book" webgl="true" backgroundcolor="transparent" source="<?php echo $_GET['file']?>" id="df_manual_book" height="1080" weight="1920"></div>
    </div>
    <div class="d-none">
<?php require '../static/functions/popup.php'; ?>
<?php require '../static/functions/footer.php'; ?>
</div>
</body>

</html>