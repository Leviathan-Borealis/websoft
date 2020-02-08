<?php
/**
 * A page controller
 */
require "../db-values/config.php";
require "../db-values/functions.php";
session_start();
$_SESSION['footer_type'] = "bottom_image_static";

// Get incoming values
$nameVar  = $_POST["name"] ?? null;
$descriptionVar   = $_POST["description"] ?? null;
$authorVar   = $_POST["author"] ?? null;
$create = $_POST["create"] ?? null;
//var_dump($_POST);

if ($create) {
    // Connect to the database
    $db = connectDatabase($dsn);

    // Prepare and execute the SQL statement
    $sql = "INSERT INTO websoft.test_table (id, name,description,Author) VALUES (?,?,?,?)";
    $stmt = $db->prepare($sql);
    $stmt->execute([null,$nameVar, $descriptionVar,$authorVar]);

    // Get the results as an array with column names as array keys
    $sql = "SELECT * FROM websoft.test_table";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $res = $stmt->fetchAll();
}



?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Create</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/search.css">
    <link rel="icon" href="favicon.ico">
</head>

<body>

<div class="wrapper">
    <?php require "../views/header.php";?>
<h1>Create an entry into the table</h1>

<form method="post">
    <fieldset>
        <legend>Create</legend>
        <p>
            <label>Name:
                <input type="text" name="name" placeholder="Enter name">
            </label>
        </p>
        <p>
            <label>Description:
                <input type="text" name="description" placeholder="Enter description">
            </label>
        </p>
        <p>
            <label>Author:
                <input type="text" name="author" placeholder="Enter author">
            </label>
        </p>
        <p>
            <input type="submit" name="create" value="Create">
        </p>
    </fieldset>
</form>

<?php if ($res ?? null) : ?>
    <table>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Description</th>
            <th>Author</th>
        </tr>

    <?php foreach ($res as $row) : ?>
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
