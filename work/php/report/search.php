<?php
session_start();
$_SESSION['footer_type'] = "bottom_image_dynamic";
$searchParam = $_POST["search_param"] ?? null;

if($searchParam != null){
    //Search database


}



?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Search</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="favicon.ico">
</head>

<body>

    <div class="wrapper">
        <?php require "../views/header.php";
        if($searchParam == null) {
            ?>
            <p>Search database</p>
            <form action="search.php" method="post">
                <input type="text" name="search_param">
                <input type="submit" value="Submit">
            </form>
        <?php
        } else {
        ?>
            <p>Submitted search params <?=$searchParam?></p>
        <?php
        }
        ?>
    </div>

    <?php
        include "../views/footer.php";
    ?>

    <script type="text/javascript" src="js/main.js"></script>
    <script src="js/flysim.js"></script>

</body>
</html>