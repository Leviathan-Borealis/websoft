
function main() {


    let test;

    console.log(test);

}

function getDocumentTree() {
    let allNodes = document.getElementsByTagName("a");

    for (let i = 0;i < allNodes.length;i++){
        console.log(allNodes.item(i).innerHTML);
    }
}

function getDocTree() {
    let allNodes = document.getElementsByTagName("a");

    allNodes.forEach(function (element,number,localNodeList) {
        console.log(number);
    })
}