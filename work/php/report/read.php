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
$delete_id = $_POST["DeleteItem"] ?? null;
$update_id = $_POST["UpdateItem"] ?? null;
$set_id = $_POST["SetItem"] ?? null;
$insertVar = $_POST["insert"] ?? null;
$test = null;



// Connect to the database
$db = connectDatabase($dsn);

if($insertVar && $nameIn && $descIn && $authorIn) {
    $sql = "INSERT INTO websoft.test_table (name, description, Author) VALUES (?, ?, ?)";
    $stmt = $db->prepare($sql);
    $stmt->execute([$nameIn, $descIn, $authorIn]);
}

if($set_id && $nameIn && $descIn && $authorIn) {
    $sql = "UPDATE websoft.test_table SET name = ?, description = ?,Author = ? WHERE id = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$nameIn, $descIn, $authorIn, $set_id]);
}
if ($delete_id) {
    $sql = "DELETE FROM websoft.test_table WHERE id = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$delete_id]);
}

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
        <table>
            <tr>
                <th colspan="2"></th>
                <th>Id</th>
                <th>Name</th>
                <th>Description</th>
                <th>Author</th>
            </tr>

            <?php foreach ($res as $row) : ?>
                <tr>
                    <td class="id_cell">
                        <form method="post">
                            <input type="hidden" name="UpdateItem" value="<?= $row["id"]?>">
                            <input type="submit" name="update" value="Update">
                        </form>
                    </td>
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
                <?php
            if ($update_id){
                if($update_id == $row["id"]){
                    $nameIn = $row["name"];
                    $descIn = $row["description"];
                    $authorIn = $row["Author"];
                    ?> <tr>
                        <td colspan="2" class="id_cell"></td>
                        <td colspan="4" id="create_cell">
                            <form method="post">
                                <input type="hidden" name="SetItem" value="<?= $row["id"]?>">
                                <input class="id_cell buttonCell" type="submit" name="set" value="Set">
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
                    <?php
                }
            }
            ?>
            <?php endforeach; ?>
            <?php
            $nameIn = null;
            $descIn = null;
            $authorIn = null;
            ?>
            <tr>
                <td colspan="2" class="id_cell"></td>
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