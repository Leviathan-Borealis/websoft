let button, aPlane;

class PlaneObj {
    paused = false;
    timer = 5;
    interval = {};
    directionX = 1;
    directionY = 0;
    planeElement = {};
    screenTop = 0;
    screenBottom = 0;

    constructor() {
        this.planeElement = document.createElement('img');
        this.planeElement.src='/websoft/work/js/flygplan.png';
        this.planeElement.style.position ='absolute';
        this.planeElement.style.left = '0px';
        this.planeElement.style.top = '0px';
        this.planeElement.style.zIndex = '10000';
        this.planeElement.style.transform = "rotate(" + 0 + "deg)";
        this.planeElement.addEventListener('click', this.turnPlane);
        this.screenTop = window.pageYOffset;
        this.screenBottom = window.innerHeight + window.pageYOffset;
        window.onscroll = function() {getViewportTopBottom()};

        function getViewportTopBottom() {
            aPlane.screenTop = window.pageYOffset;
            aPlane.screenBottom = window.innerHeight + window.pageYOffset;
        }
    }

    rotatePlane (deg) {
        this.planeElement.style.transform = "rotate(" + deg + "deg)";
        this.planeElement.style.transition = "transform .8s ease-in-out";
    }

    turnPlane () {
        if(aPlane.directionX === 0){
            aPlane.directionX = (Math.random() < 0.5)?-1:1;
            aPlane.directionY = 0;
            aPlane.rotatePlane((aPlane.directionX > 0) ? 90 : 270);
        } else {
            aPlane.directionY = (Math.random() < 0.5)?-1:1;
            aPlane.directionX = 0;
            aPlane.rotatePlane((aPlane.directionY < 0) ? 0 : 180);
        }
    }

    showPlane () {
        this.planeElement.style.left = (Math.floor(Math.random() * (window.innerWidth - this.planeElement.width))) + 'px';
        this.planeElement.style.top = (Math.floor(Math.random() * (window.innerHeight - this.planeElement.height))) + 'px';
        this.planeElement.style.transform = "rotate(" + 90 + "deg)";
        document.body.appendChild(this.planeElement);
        this.interval = window.setInterval(this.movePlaneObj, this.timer);
    }

    freezeAndHidePlane () {
        if(!this.paused) {
            window.clearInterval(this.interval);
            document.body.removeChild(this.planeElement);
            this.paused = true;
        } else {
            this.interval = window.setInterval(this.movePlaneObj,this.timer);
            document.body.appendChild(this.planeElement);
            this.paused = false;
        }
    }

    movePlaneObj () {
        aPlane.planeElement.style.left = Number.parseInt(aPlane.planeElement.style.left.substr(0, aPlane.planeElement.style.left.length - 2)) + aPlane.directionX + "px";
        aPlane.planeElement.style.top = Number.parseInt(aPlane.planeElement.style.top.substr(0, aPlane.planeElement.style.top.length - 2)) + aPlane.directionY + "px";

        if (Number.parseInt(aPlane.planeElement.style.left.substr(0, aPlane.planeElement.style.left.length - 2)) <= 0) {
            if(aPlane.directionX < 0) {
                aPlane.rotatePlane(90);
                aPlane.directionX *= -1;
            }
        } else if (Number.parseInt(aPlane.planeElement.style.left.substr(0, aPlane.planeElement.style.left.length - 2)) + aPlane.planeElement.width >= window.innerWidth) {
            if(aPlane.directionX > 0) {
                aPlane.rotatePlane(270);
                aPlane.directionX *= -1;
            }
        } else if (Number.parseInt(aPlane.planeElement.style.top.substr(0, aPlane.planeElement.style.top.length - 2)) <= aPlane.screenTop) {
            if(aPlane.directionY < 0) {
                aPlane.rotatePlane(180);
                aPlane.directionY = 1;
            } else if (aPlane.directionX !== 0){
                aPlane.directionX = 0;
                aPlane.rotatePlane(180);
                aPlane.directionY = 1;
            }
        } else if (Number.parseInt(aPlane.planeElement.style.top.substr(0, aPlane.planeElement.style.top.length - 2)) + aPlane.planeElement.height >= aPlane.screenBottom) {
            if(aPlane.directionY > 0) {
                aPlane.rotatePlane(0);
                aPlane.directionY = -1;
            } else if (aPlane.directionX !== 0){
                aPlane.directionX = 0;
                aPlane.rotatePlane(0);
                aPlane.directionY = -1;
            }
        }
    }
}

(function () {
    'use strict';
    button = document.createElement("button");
    flySim();
}());

function flySim() {
    aPlane = new PlaneObj();
    button.addEventListener("click", pauseAndHide);
    button.style.position ='absolute';
    button.className = "plane_button";
    button.textContent = "Show/Hide plane";
    button.style.zIndex = "10000";
    document.body.appendChild(button);
    aPlane.showPlane();
}

function pauseAndHide() {
    aPlane.freezeAndHidePlane();
}

