<!doctype html>
<html>
<head>
    <title>Fetch</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <div class="wrapper">
        <?php require "../../views/header.php"?>

        <select id="data_menu" onchange="repopulateWithNewData()">
            <option value="1080">Kommun 1080</option>
            <option value="1081">Kommun 1081</option>
            <option value="1082">Kommun 1082</option>
            <option value="1083">Kommun 1083</option>
        </select>

        <h1>Fetched data</h1>
        <div id="content">
            <p>Lets fetch and display some data. You need to run this web page using a web server, you can not use <code>file:///</code>.</p>
        </div>
    </div>
    <footer>
        <img class=bottom_image_dynamic src="../img/footer_slim.png">
    </footer>
    <script type="text/javascript" src="js/s03.js"></script>
    <script src="../js/flysim.js"></script>
</body>
</html>
