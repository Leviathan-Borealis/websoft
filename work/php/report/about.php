<?php
/*
    session_start(); // this NEEDS TO BE AT THE TOP of the page before any output etc
    $_SESSION['ram_var'] = "about";
    //In sub php
    $_SESSION['ram_var'] ?>
*/
session_start(); // this NEEDS TO BE AT THE TOP of the page before any output etc
$_SESSION['footer_type'] = "bottom_image_dynamic";

?>
<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/html">

<head>
    <meta charset="utf-8">
    <title>About this site</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="favicon.ico">
</head>

<body>
    <div class="wrapper">

        <?php require "../views/header.php"?>

        <article>
            <h1>About</h1>
            <p>This website is part of the course <a class="button_links" href="https://www.hkr.se/en/course/DA377B">Software Development for the Web</a></p>
            <p>The intention is to use this site as a training ground for students to try out techniques as HTML,CSS or Javascript for creating
                navigable sites with some dynamic functionality</p>
            <p>Later in the course other techniques will be introduced and implemented. PHP, Node.JS and .Net are some examples.</p>
            <img class="in_feed_img" src="img/webdev.jpg">
            <br>
            <p>The <a class="button_links" href="https://github.com/Leviathan-Borealis/websoft">source code</a> for this
                site is a fork from the course repository</p>

            <p>If you want more information I recommend visiting the course repository
                <a class="button_links" href="https://github.com/Webbprogrammering/websoft">WebSoft</a>
                where further information can be obtained</p>
        </article>
    </div>

    <?php
        include "../views/footer.php";
    ?>

    <script type="text/javascript" src="js/main.js"></script>
    <script src="js/flysim.js"></script>
</body>
</html>
