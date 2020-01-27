

(function () {
    'use strict';
    let jsonData = getData();
    displayData(jsonData);
}());

function displayData(jsonData) {
    jsonData.then(function (response) {
        let keys = Object.keys(response);
        console.log(keys);

        keys.forEach(function (item,index) {
            Object.keys(response[item]).forEach(function (item,index) {
                document.getElementById("content").innerHTML += index + ":" + item + "<br>";
            });
            //document.getElementById("content").innerHTML += index + ":" + item + "<br>";
        })
    });
}

function getData() {
    //fetch('https://api.scb.se/UF0109/v2/skolenhetsregister/sv/kommun/1081')
    let test = fetch('data/1081.json')
        .then((response) => {
            return response.json();
        })
        .then((myJson) => {
            console.log(myJson);
            return myJson;
        });

    console.log('Sandbox MEGA is ready!');
    return test;
}
