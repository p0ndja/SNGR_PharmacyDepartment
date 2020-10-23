<?php require '../static/functions/connect.php'; ?>

<!DOCTYPE html>
<html lang="th">

<head>
    <?php require '../static/functions/head.php'; ?>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark navbar-normal fixed-top scrolling-navbar" id="nav"
        role="navigation">
        <?php require '../static/functions/navbar.php'; ?>
    </nav>
    <div class="container" id="container" style="padding-top: 88px">
        <h1><form method="POST" action="../static/functions/search.php">
            <div class="md-form form-lg">
                <i class="fas fa-search prefix"></i>
                <input value="<?php if (isset($_GET['search'])) echo $_GET['search']; ?>" type="text" id="search"
                    class="form-control form-control-lg" name="search" placeholder="Type something to search and enter!">
            </div>
        </form></h1>
        <hr>
        <?php if (isset($_GET['search'])) {
            $s = $_GET['search'];
            $q = "SELECT * FROM `post` WHERE title LIKE '%$s%' OR article LIKE '%$s%' OR tags LIKE '%$s%' OR attachment LIKE '%$s%'"; 
            $r = mysqli_query($conn, $q);

            echo '<h3>พบ <b>' . mysqli_num_rows($r) . '</b> ข้อมูลที่เกี่ยวข้องกับ "' . $s . '"<br></h3><ul>';

            while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
                echo '<li><a href="../post/' . $row['id'] . '">' . $row['title'] . '</a> โดย ' . getUserdata($row['writer'], 'firstname', $conn) . ' ' . getUserdata($row['writer'], 'lastname', $conn) . ' ('. getUserdata($row['writer'], 'username', $conn).')</li>';
            }

            echo '</ul>';
        }
        ?>
    </div>
<?php require '../static/functions/popup.php'; ?>
<?php require '../static/functions/footer.php'; ?>
</body>

</html>