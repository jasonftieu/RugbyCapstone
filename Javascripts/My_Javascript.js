///////////////////////////////////////////////////////////////////////////
// This section is initilization
var homepoint = 0;
var awaypoint = 0;
var minute = 40;
var second = 0;
document.getElementById("score-home").innerHTML = homepoint;
document.getElementById("score-away").innerHTML = awaypoint;
document.getElementById("clock").innerHTML = ("0" + minute).slice(-2) + " : " + ("0" + second).slice(-2);
document.getElementById("1half").style.backgroundColor = "rgb(255,192,0)";
document.getElementById("play-button").style.display = "initial";
document.getElementById("pause-button").style.display = "none";
///////////////////////////////////////////////////////////////////////////
// This section covers the score
function add1home() {
    homepoint = homepoint + 1 ;
    document.getElementById("score-home").innerHTML = homepoint;
}

function minus1home() {
    homepoint = homepoint - 1 ;
    document.getElementById("score-home").innerHTML = homepoint;
}

function add2home() {
    homepoint = homepoint + 2 ;
    document.getElementById("score-home").innerHTML = homepoint;
}

function add3home() {
    homepoint = homepoint + 3 ;
    document.getElementById("score-home").innerHTML = homepoint;
}

function add5home() {
    homepoint = homepoint + 5 ;
    document.getElementById("score-home").innerHTML = homepoint;
}

function add1away() {
    awaypoint = awaypoint + 1 ;
    document.getElementById("score-away").innerHTML = awaypoint;
}

function minus1away() {
    awaypoint = awaypoint - 1 ;
    document.getElementById("score-away").innerHTML = awaypoint;
}

function add2away() {
    awaypoint = awaypoint + 2 ;
    document.getElementById("score-away").innerHTML = awaypoint;
}

function add3away() {
    awaypoint = awaypoint + 3 ;
    document.getElementById("score-away").innerHTML = awaypoint;
}

function add5away() {
    awaypoint = awaypoint + 5 ;
    document.getElementById("score-away").innerHTML = awaypoint;
}
///////////////////////////////////////////////////////////////////////////
// This section covers the code for the clock timer
var x;
function play() {
    clearInterval(x);
    run = 1;
    document.getElementById("play-button").style.display = "none";
    document.getElementById("pause-button").style.display = "initial";
    x = setInterval(CLKtimer,1000);
    function CLKtimer() {
        var minutes = minute;
        var seconds = second;
        if (second == 0){
            if (minute == 0){
                clearInterval(x);
            } else{
                second = 59;
                minute = minutes - 1;
            }
        } else {
        second = seconds - 1;
        }
        document.getElementById("clock").innerHTML = ("0" + minute).slice(-2) + " : " + ("0" + second).slice(-2);
    }
}

function pause(){
    clearInterval(x);
    run = 0;
    document.getElementById("play-button").style.display = "initial";
    document.getElementById("pause-button").style.display = "none";
}

function restart(){
    clearInterval(x);
    halftime(num);
    run = 0;
    document.getElementById("play-button").style.display = "initial";
    document.getElementById("pause-button").style.display = "none";
}
///////////////////////////////////////////////////////////////////////////
// This section covers the half-time options
var num = 1;
var run = 0;
function assign1(){
    num = 1;
    document.getElementById("1half").style.backgroundColor = "rgb(255,192,0)";
    document.getElementById("2half").style.backgroundColor = "rgb(208,206,206)";
    document.getElementById("OThalf").style.backgroundColor = "rgb(208,206,206)";
    if (run==0) {halftime(num,run);}
}

function assign2(){
    num = 2;
    document.getElementById("1half").style.backgroundColor = "rgb(208,206,206)";
    document.getElementById("2half").style.backgroundColor = "rgb(255,192,0)";
    document.getElementById("OThalf").style.backgroundColor = "rgb(208,206,206)";
    if (run==0) {halftime(num,run);}
}

function assign3(){
    num = 3;
    document.getElementById("1half").style.backgroundColor = "rgb(208,206,206)";
    document.getElementById("2half").style.backgroundColor = "rgb(208,206,206)";
    document.getElementById("OThalf").style.backgroundColor = "rgb(255,192,0)";
    if (run==0) {halftime(num,run);}
}

function halftime(number) {
    switch (number){
        case 1:
            minute = 40;
            second = 0;
            break;
        case 2:
            minute = 40;
            second = 0;
            break;
        case 3:
            minute = 10;
            second = 0;
            break;
    }
    document.getElementById("clock").innerHTML = ("0" + minute).slice(-2) + " : " + ("0" + second).slice(-2);
}
///////////////////////////////////////////////////////////////////////////
function renew() {
    clearInterval(x);
    homepoint = 0;
    awaypoint = 0;
    halftime(1);
    run = 0;
    document.getElementById("score-home").innerHTML = homepoint;
    document.getElementById("score-away").innerHTML = awaypoint;
    document.getElementById("1half").style.backgroundColor = "rgb(255,192,0)";
    document.getElementById("2half").style.backgroundColor = "rgb(208,206,206)";
    document.getElementById("OThalf").style.backgroundColor = "rgb(208,206,206)";
    document.getElementById("play-button").style.display = "initial";
    document.getElementById("pause-button").style.display = "none";
}