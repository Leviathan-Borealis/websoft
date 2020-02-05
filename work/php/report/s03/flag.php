<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>flag</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="css/flag.css">
    <link rel="icon" href="../favicon.ico">
</head>
<body>
<div class="wrapper">
    <?php require "../../views/header.php"?>
    <h1>Click links to view corresponding flag</h1>
    <section id="flag_section">
        <div>
            <iframe id="flag_frame" src="flag_scan.html"></iframe>
        </div>
    </section>
</div>
<footer>
    <img class=bottom_image_static src="../img/footer_slim.png">
</footer>

<script type="text/javascript" src="../js/main.js"></script>

<script src="../js/flysim.js"></script>
</body>
</html>