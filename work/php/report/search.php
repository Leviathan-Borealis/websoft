<?php
/**
 * A page controller
 */
require "../db-values/config.php";
require "../db-values/functions.php";
session_start();
$_SESSION['footer_type'] = "bottom_image_static";

// Get incoming values
$search = $_GET["search"] ?? null;
$like = "%$search%";
//var_dump($_GET);

if ($search) {
    // Connect to the database
    $db = connectDatabase($dsn);

    // Prepare and execute the SQL statement
  $sql = <<<EOD
SELECT
    *
FROM websoft.programming_lang
WHERE
    language = ?
    OR intended_use LIKE ?
;
EOD;

    $stmt = $db->prepare($sql);
    $stmt->execute([$search, $like]);

    // Get the results as an array with column names as array keys
    $res = $stmt->fetchAll();
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Search</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/search.css">
    <link rel="icon" href="favicon.ico">
</head>

<body>

    <div class="wrapper">
        <?php require "../views/header.php";?>
        <h2>Search the database</h2>

        <form>
            <p>
                <label>Search:
                    <input type="text" name="search" value="<?= $search ?>">
                </label>
            </p>
        </form>

        <?php if ($search) : ?>
            <table>
                <tr>
                    <th>Name</th>
                    <th>Intended use</th>
                    <th>Imperative</th>
                    <th>Object-oriented</th>
                    <th>Functional</th>
                    <th>Procedural</th>
                    <th>Generic</th>
                    <th>Reflective</th>
                    <th>Event-drive</th>
                    <th>Other paradigms</th>
                    <th>Standardized</th>
                </tr>

                <?php foreach ($res as $row) : ?>
                    <tr>
                        <td><?= $row["language"] ?></td>
                        <td><?= $row["intended_use"] ?></td>
                        <td><?= $row["imperative"] ?></td>
                        <td><?= $row["object-oriented"] ?></td>
                        <td><?= $row["functional"] ?></td>
                        <td><?= $row["procedural"] ?></td>
                        <td><?= $row["generic"] ?></td>
                        <td><?= $row["reflective"] ?></td>
                        <td><?= $row["event-driven"] ?></td>
                        <td><?= $row["other_paradigms"] ?></td>
                        <td><?= $row["standardized"] ?></td>
                    </tr>
                <?php endforeach; ?>

            </table>
        <?php endif; ?>
    </div>

    <?php
        if($search && $res != null) {
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