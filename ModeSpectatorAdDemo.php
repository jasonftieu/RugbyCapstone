<!-- Project: OU Rugby Score Board -->
<!-- Author: Minh Phi              -->
<!-- Credit to: W3schools.com      -->
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>OU Rugby Score Board</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSSscripts/My_CSS.css" type="text/css">
    <script type="text/javascript" src="Javascripts/jquery-3.3.1.js"></script>
</head>
<body class ="border" style="background-color:rgb(255, 242, 204); height:810px; border-style:none">
    <?php $conn=""; ?> <!--variable is global scope, used for all connection with server -->
    <?php include("PHPsubscripts/dbconnect.php")?> <!-- Connect to OURugby database--> 
    
    <div class="container">
        <a href="Ad/localPage.html" target="_blank">
            <img src="Ad/gifTest.gif" alt="testGif">
        </a>
    </div>
    <div class="container">
        <img class="logo" src="Img/logo.png" alt="Logo">
    </div>

    <div class="container">
        <img class="box" src="Img/Rectangle.png" alt="Box">
        <div class="home-name">HOME</div>
        <div class="away-name">AWAY</div>
        <div id="score-home" class="home-score"></div>
        <div id="score-away" class="away-score"></div>
    </div>

    <div class="container" style="margin:20px 0px">
        <p id="clock" class="clocktime"></p>
        <button id="1half" class="button half1">1st</button>
        <button id="2half" class="button half2">2nd</button>
        <button id="OThalf" class="button halfOT">OT</button>
    </div>
    
    <!-- Example of an advertisement -->
    <div class="container">
        <p>&nbsp; </p>
        <p>&nbsp; </p>
        <p>&nbsp; </p>
        <a id="linkAddress" href="Ad/localPage.html" target="_blank">
            <img id = "slideShowImg" src="Ad/Image 1.png" alt="Image" width=694px height=360px>
        </a>
    </div>

    <div class="container">
        <p>&nbsp; </p>
        <a href="Ad/localPage.html" target="_blank">
            <video controls loop width="500" height="240" autoplay>
                <source src="Ad/testVideo.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </a>
    </div>


    <script>
        var homepoint = 0;
        var awaypoint = 0;
        var minute = 0;
        var second = 0;
        var period = 0;
        var x;
        var slideCount = 0;
        x = setInterval(CLKtimer,100);
        function CLKtimer() {
            // Get Minute
            php_url = "PHPsubscripts/getminute.php";
            $.ajax({url:php_url,success:function(result){
                minute = result;
            }
            })
            // Get Second
            php_url = "PHPsubscripts/getsecond.php";
            $.ajax({url:php_url,success:function(result){
                second=result;
            }
            })
            // Display clock
            document.getElementById("clock").innerHTML = ("0" + minute).slice(-2) + " : " + ("0" + second).slice(-2);
            // Get and display Period
            php_url = "PHPsubscripts/getperiod.php";
            $.ajax({url:php_url,success:function(result){
                period=result;
            }
            })
            document.getElementById("1half").style.backgroundColor = "rgb(208,206,206";
            document.getElementById("2half").style.backgroundColor = "rgb(208,206,206)";
            document.getElementById("OThalf").style.backgroundColor = "rgb(208,206,206)";
            if(period==1){
                document.getElementById("1half").style.backgroundColor = "rgb(255,192,0)"; 
            }
            if(period==2){
                document.getElementById("2half").style.backgroundColor = "rgb(255,192,0)"; 
            }
            if(period==3){
                document.getElementById("OThalf").style.backgroundColor = "rgb(255,192,0)"; 
            }
            // Get Home Score
            php_url = "PHPsubscripts/getpoint.php?team=Home";
            $.ajax({url:php_url,success:function(result){
                homepoint=result;
            }
            })
            // Get Away Score
            php_url = "PHPsubscripts/getpoint.php?team=Away";
            $.ajax({url:php_url,success:function(result){
                awaypoint=result;
            }
            })
            // Display Scores
            document.getElementById("score-home").innerHTML = homepoint;
            document.getElementById("score-away").innerHTML = awaypoint;
            slideCount = slideCount + 1;
            if (slideCount == 30)
            {
                document.getElementById("slideShowImg").src="Ad/Image 1.png";
                document.getElementById("linkAddress").href="Ad/localPage.html";
            }

            if(slideCount == 60)
            {
                document.getElementById("slideShowImg").src="Ad/Image 2.png";
                document.getElementById("linkAddress").href="Ad/secondLocalPage.html";
            }

            if(slideCount == 90)
            {
                document.getElementById("slideShowImg").src="Ad/Image 3.png";
                document.getElementById("linkAddress").href="Ad/thirdLocalPage.html";
                slideCount = 0;
            }
        }
    </script>
</body>
</html>
