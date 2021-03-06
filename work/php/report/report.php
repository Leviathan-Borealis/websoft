<?php
session_start();
$_SESSION['footer_type'] = "bottom_image_dynamic";
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Report from the course sections</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="favicon.ico">
</head>

<body>

<div class="wrapper">
    <?php require "../views/header.php"?>
<article>

<header>
    <h1>A report from the course development for the web</h1>
</header>

<section>
    <h2>S01</h2>
    <p>I have prior experience and feel experienced in GIT. I have been hosting a git-server since 2,5years and been
        the main code administrator
        during past projects. Of course I do not know everything but I have enough knowledge to find solutions to the
        more advanced problems when they arise.<br>
        GitHub: Yes, some experience. I also have som e experience using GitLab. Haven't used either of them that much
        due to I have been using my own git-server.<br>
        I have only limited experience of markdown. I get around and know the basics but I do not know it by heart<br>
        I have some previous experience with GitHub pages but only limited of the same reason as stated above<br>
        I do have some previous experience in creating websites. Both in pure HTML/Flash and in
        HTML/CSS/JS(React/TypeScript). As stated before, I have some knowledge but its
        just the basics.</p>
    <p>I would describe my previous experience in web development as overall limited. I get things done but it takes
        some time and research due to
        lack of experience and knowledge.
        Why haven't I developed that much for web? The dynamic typing in JS is confusing for me that normally use C/C++
        and Android/Java.
        And when working with UX/UI I often find myself lacking ideas for design.</p>
    <p>Today I learned about some new frameworks and techniques used for web-development. As I said before,
        its a jungle out there. And there is always something new...</p>
</section>

<section>
    <h2>S02</h2>
    <p>A short description of what makes a web page: HTML gives the page its structure, what goes where, where
        resources can be found etc.
        CSS fine-tunes how different elements of the page is visualised, interacts with other element and how they
        should respond to triggered events.
        Javascript provides dynamic to the page. Fetching of remote data, filtering data and calculations are some
        common implementations.</p>
    <p>I do have prior experience with HTML, JS and CSS but have lately used React.JS and Typescript to develop
        websites.
        On top of that I haven't really made any attempt to deep-dive into it. Web-development have always been an
        anxiety for me.
        I really do still experience confusion when it comes to web-development. It seems unstructured when compared to
        "normal"
        development.</p>
    <p>During this section I have been playing and debugging with CSS, both inline and in stylesheet. This work with
        CSS and JS has had the consequence
        that I have learned som new techniques to implement the desired effect on components.</p>
    <p>A short description of browser - HTTP - web server interaction:<br>
        A user request a web page via a browser. The browser connects to the web server via a HTTP GET. The web server
        looks
        for the resource specified in the GET from the browser. If found the web server responds to the browser with
        the requested data and the return code 200.
        Upon receiving the data (string of html) from web server the browser searches the received html for external
        resources referenced.
        The browser performs request for these resources and when all resources are locally(there are exceptions to
        this of course) the page will be showed fro the user</p>
</section>

<section>
    <h2>S03</h2>
    <!-- Do you have any previous experience of client side JavaScript?
            Can you compare and relate the JavaScript language to any other language you know?
            Describe how you worked with the coding exercise, what grade do you aim for and how did your code turn out to be?
            What is your TIL for this course section?
    -->
    <p>As said before I consider my skills in JS to be basic at best. When it comes to actual code JS is ok but when it
        comes to the finer details like how data is stored, referenced and handled I tend to use the c/c++/java
        approach and I think there's a better way in JS that I need to find and learn.
    </p>
    <p>In all these exercises and for the course in general I aim for grade 5. I do acknowledge that my
        skill/experience in design is poor but I hope that my technical skill will be enough to reach my goal.
        For this section of the course I have used my own web-server (Bitnami/Apache/Tomcat) for testing of the fetch
        function. Me and a class-mate have been using this server earlier for testing in a react-project that we have
        as a pet project. On this server I have implement a CORS-filter so we don't face that problem when testing
        scripts. After I verified the functionality of fetching data from a web-api I switched to get the data from
        GitHub instead. For convenience.
        <br>
        As for the js/css/html during this section I have really tried to challenge myself. To sit with the code and
        make it work. Not googleing away for solutions at the slightest problem but try and try and read and try until
        a working solution is produced. By me. I wanted to test if I could "crack" the javascript enigma I was soo
        afraid of. And I must say it worked.
        A note on my solution: When I was converting my js for the plane (moving object) to object I thought was
        supposed to create a class definition. It was fun and result was ok. My friend spoke to you 31st of jan of my
        solution and according to him you said it was fine. I do know how to work with javascript object-literals.
        I have appended an additional script for the plane using only an object-literal
        (work/s03/js/plane.js). Not as fancy as the first one I did thou...</p>
    <p>TIL: For the first time I feel a little bit more comfortable with JS. Working with object and class definition
        gave me some insight into some dom-features
        and some pitfalls. For ex. the windows.setInterval() runs a function at set interval. Problem is that function
        seem to be invoked on a temporary obj.
        Due to this I had to rewrite the code to get a handle on the object I wanted to handle. There's probably a more
        correct way of doing this but now it works. I will continue try different solutions. <br>
        As for CSS I feel more confused than ever. There seem to be no structure or standardizing structure regarding
        functions available. I feel it's just trial and error to get the desired design. Sometime using only css and
        sometime a combination of html and css. I do get the design I want thou. <br>
        During this section I have become much better at using the debugging tools available in my browser. To spot
        errors, refine code and to understand the Dom inner workings</p>
</section>

<section>
    <!-- Write your report by answering and reflecting on these questions. Write freely, between 15 to 30  sentences.
            Tell me about your previous experience on node/npm or any equal programming tools.
            How do you feel about working with JavaScript, Node and Express?
            Explain how you did take on the coding assignment, did you have a plan and did it work?
            What grade did you aim for and was it a difficult level?
            What is your TIL for this course section?
            Ensure you have pushed all your work to GitHub and attach a tag v4.0.0 or greater.
    -->
    <h2>S04</h2>
    <p>I have previously used NPM and Node. Mostly NPM because I have worked with React.JS which is handled by NPM.</p>
    <p>My aim when developing is to have a purpose when I use libraries and frameworks. I see advantages with
        express. It's easy to quickly produce a dynamic site. I am sure there is loads more advantages but as a novice
        I do not know about them yet. Having said this I will try to avoid these kind of
        supporting frameworks for now. Why? Because I want to learn the foundations well before taking shortcuts. I
        believe this will make me a more skilled developer in the end.</p>
    <p>During this course I have really come to accept and like the JS, a language that used to make me anxious. I am
        truly happy that I pressed on in the earlier tasks to push me to learn it. I do however like c/c++ more :-)<br>
        As for Node and Express I see their uses but I leave it at that for now</p>
    <p>My approach was to make grade 3, then 4 and last 5. When done I try to enhance and tidy the code and design.
        In all these assignments I aim for grade 5. I feel that it is challenging to aim at this grade. It takes time to
        solve the grade 4 and 5 tasks but I motivate myself with the knowledge that for every line of code I write I learn
        a little bit more. And that makes it worth all the long hours.</p>
    <p>My main take-aways from this course section is the routing,data-handling and processing in express. It was clean
        and pretty straight forward.</p>
</section>

<section>
    <h2>S05</h2>
    <p>Here is the text for this section.</p>
</section>

<section>
    <h2>S06</h2>
    <p>Here is the text for this section.</p>
</section>

<section>
    <h2>S07</h2>
    <p>Here is the text for this section.</p>
</section>

<section>
    <h2>S08</h2>
    <p>Here is the text for this section.</p>
</section>

<section>
    <h2>S09</h2>
    <p>Here is the text for this section.</p>
</section>

<section>
    <h2>S10</h2>
    <p>Here is the text for this section.</p>
</section>

<footer>
    <br>
    <p><b>"And this concludes this session"</b></p>
    <p id="quote_paragraph"></p>
</footer>

</article>

</div>

<?php
    include "../views/footer.php";
?>

<script type="text/javascript" src="js/main.js"></script>
<script type='text/javascript' src='js/bug-min.js'></script>
<script type='text/javascript'>
    // default fruit fly bug:
    //new BugController({});

    // default spiders:
    new SpiderController({'minBugs':4, 'maxBugs':10});
</script>
<script src="js/flysim.js"></script>
</body>

</html>
