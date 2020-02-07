<?php
/**
 * A page controller
 */
require "../db-values/config.php";
require "../db-values/functions.php";

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
    id = ?
    OR language LIKE ?
    OR intended_use LIKE ?
;
EOD;
    $stmt = $db->prepare($sql);
    $stmt->execute([$search, $like, $like]);

    // Get the results as an array with column names as array keys
    $res = $stmt->fetchAll();
}




?><h1>Search the database</h1>

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
            <th>id</th>
            <th>language</th>
            <th>intended_use</th>
            <th>imperative</th>
            <th>object-oriented</th>
            <th>functional</th>
            <th>procedural</th>
            <th>generic</th>
            <th>reflective</th>
            <th>event-drive</th>
            <th>other_paradigms</th>
            <th>standardized</th>
        </tr>

    <?php foreach ($res as $row) : ?>
        <tr>
            <td><?= $row["id"] ?></td>
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
