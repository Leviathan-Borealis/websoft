<?php
/**
 * A page controller
 */
require "config.php";
require "functions.php";

// Connect to the database
$db = connectDatabase($dsn);

// Prepare and execute the SQL statement
$stmt = $db->prepare("SELECT * FROM websoft.programming_lang");
$stmt->execute();

// Get the results as an array with column names as array keys
$res = $stmt->fetchAll();




?><h1>Connect to the database</h1>

<p>Show some content in a table.</p>

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

<?php foreach($res as $row) : ?>
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
