/**
 * Route for lotto.
 */
"use strict";

var express = require("express");
var router  = express.Router();

router.get("/lotto", (req, res) => {

    let jsonResponse = JSON.parse(drawNumbers(req._parsedUrl.query));

    let data = {};
    if(jsonResponse.hasOwnProperty("submitted")){
        data.numbers = JSON.stringify(jsonResponse);
    } else {
        data.numbers = JSON.stringify(jsonResponse);
    }
    res.render("lotto", data);
});

router.get("/lotto-json", (req, res) => {
    res.send(JSON.parse(drawNumbers(req._parsedUrl.query)));
});

function drawNumbers(queryString){

    let submittedLottoNumbers = [];
    //Check if there was query data

    if(queryString !== null && typeof queryString === "string") {
        if (queryString.length > 4 && queryString.includes(",")){
            queryString = queryString.substr(4);
            submittedLottoNumbers = queryString.split(',').map(Number);
            if(submittedLottoNumbers.length !== 7){
                console.info(submittedLottoNumbers.length);
                console.info("Submitted numbers was of invalid format")
                submittedLottoNumbers = [];
            }
        } else {
            console.info("No query was submitted");
            submittedLottoNumbers = [];
        }
    }

    //Draw the winning numbers
    let drawnLottoNumbers = [];
    for (let i = 0;i < 7; i++) {
        drawnLottoNumbers[i] = Math.floor(Math.random() * 35);
    }
    if(submittedLottoNumbers.length === 0) {
        return JSON.stringify({"drawn":JSON.stringify(drawnLottoNumbers)});
    } else {
        let correctNumbersIndexes = [];
        submittedLottoNumbers.forEach((value, index, array) => {
            if (drawnLottoNumbers.includes(value)){
                correctNumbersIndexes.push(index);
            }
        });
        let returnObj = {"submitted":JSON.stringify(submittedLottoNumbers),"drawn":JSON.stringify(drawnLottoNumbers),"correctIndexes":correctNumbersIndexes};
        return JSON.stringify(returnObj);
    }
}
module.exports = router;