/**
 * Route for lotto.
 */
"use strict";

var express = require("express");
var router  = express.Router();

router.get("/lotto", (req, res) => {
    let data = {};

    data.date = new Date();
    data.numbers = "";

    for (let i = 0;i < 7; i++) {
        data.numbers += Math.floor(Math.random() * 35) + (i === 6?"":", ");
    }
    res.render("lotto", data);
});

router.get("/lotto-json", (req, res) => {
    //Get query
    let queryString = req._parsedUrl.query;


    let submittedLottoNumbers = [];
    //Check if there was query data
    console.info(typeof queryString);
    if(queryString !== null && typeof queryString === "string") {
        if (queryString.length > 4 && queryString.includes(",")){
            queryString = queryString.substr(4);
            submittedLottoNumbers = queryString.split(',').map(Number);
            if(submittedLottoNumbers.length !== 7){
                console.info("Submitted numbers was of invalid format")
            }
        } else {
            console.info("No query was submitted");
        }
        //row=1,3,7,9,28,33,35

    }

    //Draw the winning numbers
    let drawnLottoNumbers = [];
    for (let i = 0;i < 7; i++) {
        drawnLottoNumbers[i] = Math.floor(Math.random() * 35);
    }
    if(submittedLottoNumbers.length === 0) {
        res.send(JSON.stringify({"drawn":JSON.stringify(drawnLottoNumbers)}));
    } else {
        let correctNumbersIndexes = [];
        submittedLottoNumbers.forEach((value, index, array) => {
            if (drawnLottoNumbers.includes(value)){
                correctNumbersIndexes.push(index);
            }
        });
        let returnObj = {"submitted":JSON.stringify(submittedLottoNumbers),"drawn":JSON.stringify(drawnLottoNumbers),"correctIndexes":correctNumbersIndexes};
        res.send(JSON.stringify(returnObj));
    }
});

function drawNumbers(queryString){

    let submittedLottoNumbers = [];
    //Check if there was query data
    console.info(typeof queryString);
    if(queryString !== null && typeof queryString === "string") {
        if (queryString.length > 4 && queryString.includes(",")){
            queryString = queryString.substr(4);
            submittedLottoNumbers = queryString.split(',').map(Number);
            if(submittedLottoNumbers.length !== 7){
                console.info("Submitted numbers was of invalid format")
            }
        } else {
            console.info("No query was submitted");
        }
        //row=1,3,7,9,28,33,35

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