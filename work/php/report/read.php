<?php
/**
 * A page controller
 */
require "../db-values/config.php";
require "../db-values/functions.php";
session_start();
$_SESSION['footer_type'] = "bottom_image_static";

$nameIn = $_POST["nameIn"] ?? null;
$descIn = $_POST["descIn"] ?? null;
$authorIn = $_POST["authorIn"] ?? null;
$testing = $_POST["DeleteItem"] ?? null;





// Connect to the database
$db = connectDatabase($dsn);

// Prepare and execute the SQL statement
$sql = <<<EOD
    SELECT
    *
    FROM websoft.test_table
    ;
EOD;

$stmt = $db->prepare($sql);
$stmt->execute();

// Get the results as an array with column names as array keys
$res = $stmt->fetchAll();

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Read</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/read.css">
    <link rel="icon" href="favicon.ico">
</head>

<body>

<div class="wrapper">
    <?php require "../views/header.php";?>
    <h2>Work the database</h2>
    <p><?="Just testing: " . $nameIn . " " . $descIn . " " . $authorIn . " " . $testing?></p>
        <table>
            <tr>
                <th></th>
                <th>Id</th>
                <th>Name</th>
                <th>Description</th>
                <th>Author</th>
            </tr>

            <?php foreach ($res as $row) : ?>
                <tr>
                    <td class="id_cell">
                        <form method="post">
                            <input type="hidden" name="DeleteItem" value="<?= $row["id"]?>">
                            <input type="submit" name="delete" value="Delete">
                        </form>
                    </td>
                    <td class="id_cell"><?= $row["id"] ?></td>
                    <td><?= $row["name"] ?></td>
                    <td><?= $row["description"] ?></td>
                    <td><?= $row["Author"] ?></td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td class="id_cell"></td>
                <td colspan="4" id="create_cell">
                    <form method="post">
                        <input class="id_cell buttonCell" type="submit" name="insert" value="Insert">
                        <label class="create_label">
                            <input class="create_input" type="text" name="nameIn" value="<?= $nameIn?>">
                        </label>
                        <label class="create_label">
                            <input class="create_input" type="text" name="descIn" value="<?= $descIn?>">
                        </label>
                        <label class="create_label">
                            <input class="create_input" type="text" name="authorIn" value="<?= $authorIn?>">
                        </label>
                    </form>
                </td>
            </tr>
        </table>

</div>

<?php
if($res ?? null) {
    if (sizeof($res) > 7) {
        $_SESSION['footer_type'] = "bottom_image_dynamic";
    }
}
include "../views/footer.php";
?>

<script type="text/javascript" src="js/main.js"></script>
<script src="js/flysim.js"></script>

</body>
</html>