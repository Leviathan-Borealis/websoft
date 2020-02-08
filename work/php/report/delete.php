<?php
/**
 * A page controller
 */
require "../db-values/config.php";
require "../db-values/functions.php";
session_start();
$_SESSION['footer_type'] = "bottom_image_static";

// Get incoming values
$item  = $_GET["item"] ?? null;
$id    = $_POST["id"] ?? null;
$nameVar = $_POST["name"] ?? null;
$descriptionVar  = $_POST["description"] ?? null;
$delete  = $_POST["delete"] ?? null;
// var_dump($_GET);
// var_dump($_POST);

$db = connectDatabase($dsn);

$sql = "SELECT * FROM websoft.test_table";
$stmt = $db->prepare($sql);
$stmt->execute();
$res1 = $stmt->fetchAll();
//var_dump($res1);

if ($item) {
    $sql = "SELECT * FROM websoft.test_table WHERE id = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$item]);
    $res2 = $stmt->fetch();
    //var_dump($res2);
}

if ($delete) {
    $sql = "DELETE FROM websoft.test_table WHERE id = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$id]);

    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}



?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Delete</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/search.css">
    <link rel="icon" href="favicon.ico">
</head>

<body>

<div class="wrapper">
    <?php require "../views/header.php";?>
<h1>Delete a row from the table</h1>

<form>
    <label>
        <select name="item" onchange="this.form.submit()">
            <option value="-1">Select item</option>

            <?php foreach ($res1 as $row) : ?>
                <option value="<?= $row["id"] ?>"><?= "(" . $row["id"]. ") " . $row["name"] ?></option>
            <?php endforeach; ?>

        </select>
    </label>
</form>


<?php if ($res2 ?? null) : ?>
<form method="post">
    <fieldset>
        <legend>Delete</legend>
        <p>
            <label>Id: 
                <input type="text" readonly="readonly" name="id" value="<?= $res2["id"] ?>">
            </label>
        </p>
        <p>
            <label>Name:
                <input type="text" name="name" value="<?= $res2["name"] ?>">
            </label>
        </p>
        <p>
            <label>Description:
                <input type="text" name="description" value="<?= $res2["description"] ?>">
            </label>
        </p>
        <p>
            <label>Author:
                <input type="text" name="author" value="<?= $res2["Author"] ?>">
            </label>
        </p>
        <p>
            <input type="submit" name="delete" value="Delete">
        </p>
    </fieldset>
</form>
<?php endif; ?>


<?php if ($res1 ?? null) : ?>
    <table>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Description</th>
            <th>Author</th>
        </tr>

    <?php foreach ($res1 as $row) : ?>
        <tr>
            <td><?= $row["id"] ?></td>
            <td><?= $row["name"] ?></td>
            <td><?= $row["description"] ?></td>
            <td><?= $row["Author"] ?></td>
        </tr>
    <?php endforeach; ?>

    </table>
<?php endif; ?>
</div>

<?php
if($res1 ?? null) {
    if (sizeof($res1) > 7) {
        $_SESSION['footer_type'] = "bottom_image_dynamic";
    }
}
include "../views/footer.php";
?>

<script type="text/javascript" src="js/main.js"></script>
<script src="js/flysim.js"></script>

</body>
</html>