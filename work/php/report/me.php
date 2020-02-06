<?php
session_start();
$_SESSION['footer_type'] = "bottom_image_dynamic";
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>About me</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="favicon.ico">
</head>

<body>

<!--
Comments are written as HTML style.
-->

    <div class="wrapper">
        <?php require "../views/header.php"?>

        <article>

            <h1>My report page in the course Development for the web</h1>

            <p><img class="in_feed_img" src="img/me.jpg" width="500" alt="Me on an image"></p>

            <p>My name is Fredrik Lemón Larsson. I am 39 years old, soon to turn 40.
                I am married to Linda and we have 3 kids.
                Idun is the oldest. She is 6. Our twins Atle and Eira are 4. We live east of Kristianstad and north of Bromölla in an area called Norreskog.

            Before I started study to become a software developer I worked as a Naval officer in the Royal Swedish navy.
                I served for 19 years during which I've piloted helicopters, operated large ships and handled small fast boats
            I have also experienced the joy of winning and the trauma of loosing under circumstances many do not experience. I believe this is both a blessing and a curse
            In general I have guided, taught and instructed 500 to 700 students per year and I have really come to like the teaching.
                I hope I can continue using this ability in my future.</p>

            <p>My hobbies are woodwork, coding and renovating things. But most of my spare time is spent with my children and family</p>

        </article>
    </div>

    <?php
        include "../views/footer.php";
    ?>

    <script type="text/javascript" src="js/main.js"></script>
    <script src="js/flysim.js"></script>

</body>
</html>
