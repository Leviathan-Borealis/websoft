

(function () {
    "use strict";

    console.log("All ready.");
}());

function main() {
    console.log("main");
}

function getDocumentTree() {
    let allNodes = document.getElementsByTagName("img");

    for (let i = 0;i < allNodes.length;i++){
        console.log(allNodes.item(i).innerHTML);
    }

    console.log("getDocumentTree");
}

function getDocTree() {
    let allNodes = document.getElementsByTagName("img");
    console.log(allNodes.length);

    for(let i = 0;i < allNodes.length;i++){
        console.log(allNodes.item(i).tagName);
    }
}