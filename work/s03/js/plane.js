
let area = document.body,
    areaHeight = window.innerHeight,
    areaWidth = window.innerWidth,
    plane = document.createElement('img'),
    dirX = 0,
    dirY = -1,
    timer = 100,
    posWhenTurnEnds = {
        posX: -1,
        posY: -1
    },
    newHeading = 0;

function turnPlane() {
    newHeading = leftOrRight();
    makeTurn();
}

function makeTurn() {
    if(newHeading > 0){
        //Turn to sb

        if(dirX > 0 && dirY === 0){
            posWhenTurnEnds = getPosWhenTurnEnds();
            plane.style.transform = "rotate(" + 45 + "deg)";
            dirY = 1;
        } else if (dirX < 0 && dirY === 0){
            dirY = -1;
        } else {
            //Performing turn
            if ((posWhenTurnEnds.posX ===
                Number.parseInt(plane.style.left.substr(0, plane.style.left.length - 2))) ||
                (posWhenTurnEnds.posY === Number.parseInt(plane.style.top.substr(0, plane.style.top.length - 2)))){
                newHeading = 0;
                plane.style.transform = "rotate(" + 45 + "deg)";
            }
        }
    } else {
        //Turn to the left

    }
}

function getPosWhenTurnEnds() {

}

function leftOrRight() {
    let directionToTurn = 0;
    if(dirX !== 0){
        //Moving horizontally

        if (Number.parseInt(plane.style.top.substr(0,plane.style.top.length - 2)) - plane.height <= 0) {
            //Plane should turn down
            directionToTurn = -1;
        } else {
            //Plane should turn up
            directionToTurn = 1;
        }

        if(dirX > 0){
            return directionToTurn * -1;
        }
        return directionToTurn;

    } else {
        //Moving vertical

        if(Number.parseInt(plane.style.left.substr(0,plane.style.left.length - 2)) === 0){
            //Turn to right part of screen
            directionToTurn = 1;
        } else {
            //Turn to left part of screen
            directionToTurn = -1;
        }

        if(dirY > 0){
            return directionToTurn * -1;
        }
        return directionToTurn;
    }
}