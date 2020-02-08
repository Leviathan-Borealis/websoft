<?php
/**
 * A page controller
 */
require "../db-values/config.php";
require "../db-values/functions.php";
session_start();
$_SESSION['footer_type'] = "bottom_image_static";

// Get incoming values
$idVar  = $_GET["id"] ?? null;
$nameVar    = $_POST["name"] ?? null;
$descriptionVar = $_POST["description"] ?? null;
$authorVar  = $_POST["author"] ?? null;
$save  = $_POST["save"] ?? null;
// var_dump($_GET);
// var_dump($_POST);

$db = connectDatabase($dsn);

$sql = "SELECT * FROM websoft.test_table";
$stmt = $db->prepare($sql);
$stmt->execute();
$res1 = $stmt->fetchAll();
//var_dump($res1);

if ($idVar) {
    $sql = "SELECT * FROM websoft.test_table WHERE id = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$idVar]);
    $res2 = $stmt->fetch();
    //var_dump($res2);
}

if ($save) {
    $sql = "UPDATE websoft.test_table SET name = ?, description = ?,Author = ? WHERE id = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$nameVar, $descriptionVar, $authorVar,$idVar]);
    //var_dump([$label, $type, $id]);

    header("Location: " . $_SERVER['PHP_SELF'] . "?item=$nameVar");
    exit;
}



?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Update</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/search.css">
    <link rel="icon" href="favicon.ico">
</head>

<body>

<div class="wrapper">
    <?php require "../views/header.php";?>
<h1>Update a row in the table</h1>

<form>
    <select name="id" onchange="this.form.submit()">
        <option value="-1">Select item</option>

        <?php foreach ($res1 as $row) : ?>
            <option value="<?= $row["id"] ?>"><?= "(" . $row["id"]. ") " . $row["name"] ?></option>
        <?php endforeach; ?>

    </select>
</form>


<?php if ($res2 ?? null) : ?>
<form method="post">
    <fieldset>
        <legend>Update</legend>
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
            <input type="submit" name="save" value="Save">
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