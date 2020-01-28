

(function () {
    'use strict';
    let jsonData = getData();
    displayData(jsonData);
}());

Date.prototype.yyyymmdd = function() {
    let mm = this.getMonth() + 1;
    let dd = this.getDate();

    return [this.getFullYear(),
        (mm > 9 ? '' : '0') + mm,
        (dd > 9 ? '' : '0') + dd
    ].join('');
};

function displayData(jsonData) {
    jsonData.then(value => {
        let newTable = document.createElement("table");
        newTable.id = "json_data";
        newTable.className = "root_table";
        document.getElementById("content").innerHTML = "";
        document.getElementById("content").appendChild(newTable);
        let rootNode = document.getElementById("json_data");

        //Populate table
        updateTableHTML(value,rootNode);
    })
}

function updateTableHTML(myArray,rootNode) {
    // Reset the table
    rootNode.innerHTML = "";

    //Switch for labels
    let doneOnce = false;

    for (let key in myArray){
        let newRow = document.createElement("tr");
        rootNode.appendChild(newRow);

        if (myArray[key] instanceof Array){
            //If array
            //Make new table and attach to node
            let innerTable = document.createElement("table");
            innerTable.id = key;
            rootNode.appendChild(innerTable);
            let innerNode = document.getElementById(key);
            //Recursive populate table
            updateTableHTML(myArray[key],innerNode);
            newRow.appendChild(innerNode);

        } else if (Object.keys(myArray[key]).length === 4) {

            if (!doneOnce){
                newRow.id = "column_labels";
                for (let objAttr in myArray[key]) {
                    let newCell = document.createElement("td");
                    newCell.textContent = objAttr;
                    newRow.appendChild(newCell);
                }
                newRow = document.createElement("tr");
                rootNode.appendChild(newRow);

                //Set switch
                doneOnce = true;
            }

            for (let objAttr in myArray[key]) {
                let newCell = document.createElement("td");
                newCell.textContent = myArray[key][objAttr];
                newRow.appendChild(newCell);
            }
        } else {

            let rootCell = document.createElement("td");
            rootCell.className = "root_key_value";

            let cellTable = document.createElement("table");
            cellTable.className = "table_key_value";
            rootCell.appendChild(cellTable);

            let cellRow = document.createElement("tr");
            cellTable.appendChild(cellRow);

            let newCell = document.createElement("td");
            newCell.className = "key_cell";
            newCell.textContent = key;
            cellRow.appendChild(newCell);

            newCell = document.createElement("td");
            newCell.className = "value_cell";

            if(!(isNaN(new Date(Date.parse(myArray[key]))))) {
                let aDate = new Date(Date.parse(myArray[key]));
                newCell.textContent = aDate.yyyymmdd();
            } else {
                newCell.textContent = "N/A";
            }
            cellRow.appendChild(newCell);

            newRow.appendChild(rootCell);
        }
    }
}


function getData() {
    let test = fetch("https://leviathan-borealis.github.io/websoft/work/s03/data/1081.json")
        .then((response) => {
            return response.json();
        })
        .then((myJson) => {
            console.log(myJson);
            return myJson;
        });

    console.log("Data was fetched");
    return test;
}
