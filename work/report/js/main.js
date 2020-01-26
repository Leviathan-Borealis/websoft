/**
 * A function to wrap it all in.
 */
(function () {
    "use strict";
    if(document.title === "Report from the course sections") {
        displayMessage();
    }

    console.log("All ready.");
}());

function displayMessage(){
    let quote = "Non est ad astra mollis e terris via"
    window.status = quote;
    document.getElementById("quote_paragraph").innerHTML = "<b>" + quote + "</b>";
    console.log("Message showed");
}