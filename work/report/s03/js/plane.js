/**
 * Script flying a plane over screen. Not utilizing class definition
 * see script /work/js/flysim.js
 */

let button, aPlane;

function automaticPlaneFlight() {
    'use strict';
    button = document.createElement("button");

    aPlane = {
        paused: false,
        timer: 5,
        interval: {},
        directionX: 1,
        directionY: 0,
        planeElement: document.createElement('img'),
        setUpPlane: function () {
            aPlane.planeElement.src = '/websoft/work/js/flygplan.png';
            aPlane.planeElement.style.position ='absolute';
            aPlane.planeElement.style.left = '0px';
            aPlane.planeElement.style.top = '0px';
            aPlane.planeElement.style.zIndex = '10000';
            aPlane.planeElement.style.transform = "rotate(" + 0 + "deg)";
            aPlane.planeElement.addEventListener('click', this.turnPlane);
        },
        rotatePlane: function (deg) {
            aPlane.planeElement.style.transform = "rotate(" + deg + "deg)";
            aPlane.planeElement.style.transition = "transform .8s ease-in-out";
        },
        turnPlane: function () {
            if(aPlane.directionX === 0){
                aPlane.directionX = (Math.random() < 0.5)?-1:1;
                aPlane.directionY = 0;
                aPlane.rotatePlane((aPlane.directionX > 0) ? 90 : 270);
            } else {
                aPlane.directionY = (Math.random() < 0.5)?-1:1;
                aPlane.directionX = 0;
                aPlane.rotatePlane((aPlane.directionY < 0) ? 0 : 180);
            }
        },
        showPlane: function () {
            aPlane.planeElement.style.left = (Math.floor(Math.random() * (window.innerWidth - this.planeElement.width))) + 'px';
            aPlane.planeElement.style.top = (Math.floor(Math.random() * (window.innerHeight - this.planeElement.height))) + 'px';
            aPlane.planeElement.style.transform = "rotate(" + 90 + "deg)";
            document.body.appendChild(this.planeElement);
            aPlane.interval = window.setInterval(aPlane.movePlaneObj, aPlane.timer);
        },
        freezeAndHidePlane: function () {
            if(!aPlane.paused) {
                window.clearInterval(aPlane.interval);
                document.body.removeChild(aPlane.planeElement);
                aPlane.paused = true;
            } else {
                aPlane.interval = window.setInterval(aPlane.movePlaneObj,aPlane.timer);
                document.body.appendChild(aPlane.planeElement);
                aPlane.paused = false;
            }
        },
        movePlaneObj: function () {
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
            } else if (Number.parseInt(aPlane.planeElement.style.top.substr(0, aPlane.planeElement.style.top.length - 2)) <= 0) {
                if(aPlane.directionY < 0) {
                    aPlane.rotatePlane(180);
                    aPlane.directionY *= -1;
                }
            } else if (Number.parseInt(aPlane.planeElement.style.top.substr(0, aPlane.planeElement.style.top.length - 2)) + aPlane.planeElement.height >= window.innerHeight) {
                if(aPlane.directionY > 0) {
                    aPlane.rotatePlane(0);
                    aPlane.directionY *= -1;
                }
            }
        }
    };



    button.addEventListener("click", pauseAndHide);
    button.style.position ='absolute';
    button.className = "plane_button";
    button.textContent = "Show/Hide plane";
    button.style.zIndex = "10000";
    document.body.appendChild(button);

    aPlane.setUpPlane();
    aPlane.showPlane();
}

function pauseAndHide() {
    aPlane.freezeAndHidePlane();
}

