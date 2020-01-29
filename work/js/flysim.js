let plane, button, paused, timer, interval, movePlane;

(function () {
    'use strict';

    plane = document.createElement('img');
    button = document.createElement("button");
    paused = false;
    timer = 5;

    flySim();

}());



function flySim() {
    let area = document.body,
        areaHeight = window.innerHeight,
        areaWidth = window.innerWidth,
        dirX = 1,
        dirY = 0;


    button.addEventListener("click", pauseAndHide);
    button.style.position ='absolute';
    button.className = "plane_button";
    button.textContent = "Show/Hide plane";
    button.style.zIndex = 10000;
    area.appendChild(button);

    /**
     * Set the attributes for the plane
     **/
    plane.src='/websoft/work/js/flygplan.png';
    plane.style.position ='absolute';
    plane.style.left = '0px';
    plane.style.top = '0px';
    plane.style.zIndex = 10000;
    plane.style.transform = "rotate(" + 0 + "deg)";
    plane.addEventListener('click', changeCardinal);

    function rotatePlaneTo(deg) {
        plane.style.transform = "rotate(" + deg + "deg)";
        plane.style.transition = "transform .8s ease-in-out";
    }

    function changeCardinal() {
        if(dirX === 0){
            dirX = (Math.random() < 0.5)?-1:1;
            dirY = 0;
            rotatePlaneTo((dirX > 0) ? 90 : 270);
        } else {
            dirY = (Math.random() < 0.5)?-1:1;
            dirX = 0;
            rotatePlaneTo((dirY < 0) ? 0 : 180);
        }
    }


    /**
     * A function for displaying the plane in random positions
     **/
    function spawnPlane() {
        let newX = Math.floor(Math.random() * (areaWidth - plane.width)),
            newY = Math.floor(Math.random() * (areaHeight - plane.height));

        plane.style.left = newX+'px';
        plane.style.top = newY+'px';
        plane.style.transform = "rotate(" + 90 + "deg)";
        area.appendChild(plane);

        interval = window.setInterval(movePlane, timer);
    }

    movePlane = function () {

        plane.style.left = Number.parseInt(plane.style.left.substr(0, plane.style.left.length - 2)) + dirX + "px";
        plane.style.top = Number.parseInt(plane.style.top.substr(0, plane.style.top.length - 2)) + dirY + "px";


        if (Number.parseInt(plane.style.left.substr(0, plane.style.left.length - 2)) <= 0) {
            if(dirX < 0) {
                rotatePlaneTo(90);
                dirX *= -1;
            }
        } else if (Number.parseInt(plane.style.left.substr(0, plane.style.left.length - 2)) + plane.width >= areaWidth) {
            if(dirX > 0) {
                rotatePlaneTo(270);
                dirX *= -1;
            }
        } else if (Number.parseInt(plane.style.top.substr(0, plane.style.top.length - 2)) <= 0) {
            if(dirY < 0) {
                rotatePlaneTo(180);
                dirY *= -1;
            }
        } else if (Number.parseInt(plane.style.top.substr(0, plane.style.top.length - 2)) + plane.height >= areaHeight) {
            if(dirY > 0) {
                rotatePlaneTo(0);
                dirY *= -1;
            }
        }
    };

    spawnPlane();
}

function pauseAndHide() {
    if(!paused) {
        window.clearInterval(interval);
        document.body.removeChild(plane);
        paused = true;
    } else {
        interval = window.setInterval(movePlane,timer);
        document.body.appendChild(plane);
        paused = false;
    }
}

