<!-- Project: OU Rugby Score Board -->
<!-- Author: Minh Phi              -->
<!-- Credit to: W3schools.com      -->

<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>OU Rugby Score Board</title>   
    <link rel="stylesheet" href="CSSscripts/My_CSS.css" type="text/css">
    <script type="text/javascript" src="Javascripts/jquery-3.3.1.js"></script>
</head>
<body class ="border" style="background-color:rgb(255, 242, 204);">
    <?php $conn=""; ?> <!--variable is global scope, used for all connection with server -->
    <?php include("PHPsubscripts/dbconnect.php")?> <!-- Connect to OURugby database-->
	<?php
            //Check that the user accessed by logging in.
            $url = '';
            $url != '/ModeOperator.php';

            if ($_SERVER['HTTP_REFERER'] == $url) {
                 header('Location: PHPsubscripts/accessWarning.php'); //redirect to some other page
                exit();
            }
            
            ////---Read the current database---////
            $sql="SELECT POINT,ID FROM Score WHERE Team='Home'";
            // ADD ID so the row array is more than 1 element to get the value
            // RASPBERRY PI Database is weird
            //Select desired row as a set even if the element inside is 1
            $result=mysqli_query($conn,$sql);
            //Fetch the row in the set even if the row number inside is 1
            $row=mysqli_fetch_row($result);
            //Get the actual column inside the row even if the column number inside is 1
            //The indexes inside the row are column indexes. Start with 0
            $Home_score = $row[0];
            // Free result set from memory
            mysqli_free_result($result);
            $sql="SELECT POINT,ID FROM Score WHERE Team='Away'";
            $result=mysqli_query($conn,$sql);
            $row=mysqli_fetch_row($result);
            $Away_score = $row[0];
            mysqli_free_result($result);
            //// Read the last Period, Minute, Second
            $sql="SELECT ID,MINUTE,SECOND,STATUS FROM Time";
            $result=mysqli_query($conn,$sql);
            while ($row=mysqli_fetch_row($result))
            {
                if ($row[3]==1){
                    $Period = $row[0];
                    $Minute = $row[1];
                    $Second = $row[2];
                    break;
                }
            }
            $sql = "UPDATE Button SET STATUS=0";
			mysqli_query($conn,$sql);
			$sql = "UPDATE Button SET STATUS=1 WHERE NAME='Pause'";
			mysqli_query($conn,$sql);
            //$conn->close(); //close connection to database
            mysqli_close($conn);
    ?>
    
    <div class="container">
        <img class="logo" src="Img/logo.png" alt="Logo">
        <button onclick="renew()" class="button new">NEW</button>
    </div>

    <div class="container">
        <img class="box" src="Img/Rectangle.png" alt="Box">
        <div class="home-name">HOME</div>
        <div class="away-name">AWAY</div>
        <div id="score-home" class="home-score"></div>
        <div id="score-away" class="away-score"></div>
    </div>

    <div class="container" style="margin:20px 0px">
        <button onclick="add1home()" class="button plus1-home">+1</button>
        <button onclick="minus1home()" class="button minus1-home">-1</button>
        <button onclick="add2home()" class="button plus2-home">+2</button>
        <button onclick="add3home()" class="button plus3-home">+3</button>
        <button onclick="add5home()" class="button plus5-home">+5</button>
        <button onclick="add1away()" class="button plus1-away">+1</button>
        <button onclick="minus1away()" class="button minus1-away">-1</button>
        <button onclick="add2away()" class="button plus2-away">+2</button>
        <button onclick="add3away()" class="button plus3-away">+3</button>
        <button onclick="add5away()" class="button plus5-away">+5</button>
        <p id="clock" class="clocktime"></p>
        <button id="play-button" onclick="play()" class="button play-pause">PLAY</button>
        <button id="pause-button" onclick="pause()" class="button play-pause">PAUSE</button>
        <button onclick="restart()" class="button restart">RESET TIME</button>
        <button id="1half" onclick="assign1()" class="button half1">1st</button>
        <button id="2half" onclick="assign2()" class="button half2">2nd</button>
        <button id="OThalf" onclick="assign3()" class="button halfOT">OT</button>
    </div>

    <div class="container" style="top: 225px; text-align: left;">
        <h4>
	    WARNING: Closing the Webpage will pause the scoreboard <br>
        Scores:<br>
        +5 = A Try <br>
        +3 = Drop Goal or Penalty Kick <br>
        +2 = Conversion Kick <br>
        Instructions:<br>
        1.Always hit "Restart" to reset the clock after selecting period<br>
        2.Hit "Restart" to enable Period Selection<br>
        Enter the time: <br>
        Minutes: <input type="text" id="minute" size="2" maxlength = "2"/>
        Seconds: <input type="text" id="seconds" size="2"maxlength = "2"/>
        <button id="change-time" onclick="changeTime()">Change time</button>
        </h4>
    </div>
    <script>
        ///////////////////////////////////////////////////////////////////////////
        // This section is initilization
        var homepoint = <?php echo $Home_score;?>; //assign PHP variable to JS variable
        var awaypoint = <?php echo $Away_score;?>;
        var minute = <?php echo $Minute;?>;
        var second = <?php echo $Second;?>;
        var period = <?php echo $Period;?>;
        document.getElementById("score-home").innerHTML = homepoint;
        document.getElementById("score-away").innerHTML = awaypoint;
        document.getElementById("clock").innerHTML = ("0" + minute).slice(-2) + " : " + ("0" + second).slice(-2);
        switch(period) {
            case 1:
                document.getElementById("1half").style.backgroundColor = "rgb(255,192,0)";
                break;
            case 2:
                document.getElementById("2half").style.backgroundColor = "rgb(255,192,0)";
                break;
            case 3:
                document.getElementById("OThalf").style.backgroundColor = "rgb(255,192,0)";
                break;
        }
        document.getElementById("play-button").style.display = "initial";
        document.getElementById("pause-button").style.display = "none";
        ///////////////////////////////////////////////////////////////////////////
        // This section covers the score
        function add1home() {
            homepoint += 1;
            if (homepoint > 99)
            {
                homepoint = 99;
            }
            php_url = "PHPsubscripts/addpoint.php?point="+homepoint+"&team=Home";
            $.ajax({url:php_url,success:function(pt)
            {
                document.getElementById("score-home").innerHTML = pt;
            }
            })
        }
        function minus1home() {
            homepoint -= 1 ;
            if (homepoint < 0)
            {
                homepoint = 0;
            }
            php_url = "PHPsubscripts/addpoint.php?point="+homepoint+"&team=Home";
            $.ajax({url:php_url,success:function(pt)
            {
                document.getElementById("score-home").innerHTML = pt;
            }
            })
        }
        function add2home() {
            homepoint += 2 ;
            if (homepoint > 99)
            {
                homepoint = 99;
            }
            php_url = "PHPsubscripts/addpoint.php?point="+homepoint+"&team=Home";
            $.ajax({url:php_url,success:function(pt)
            {
                document.getElementById("score-home").innerHTML = pt;
            }
            })
        }
        function add3home() {
            homepoint += 3 ;
            if (homepoint > 99)
            {
                homepoint = 99;
            }
            php_url = "PHPsubscripts/addpoint.php?point="+homepoint+"&team=Home";
            $.ajax({url:php_url,success:function(pt)
            {
                document.getElementById("score-home").innerHTML = pt;
            }
            })
        }
        function add5home() {
            homepoint += 5 ;
            if (homepoint > 99)
            {
                homepoint = 99;
            }
            php_url = "PHPsubscripts/addpoint.php?point="+homepoint+"&team=Home";
            $.ajax({url:php_url,success:function(pt)
            {
                document.getElementById("score-home").innerHTML = pt;
            }
            })
        }
        function add1away() {
            awaypoint += 1 ;
            if (awaypoint > 99)
            {
                awaypoint = 99;
            }
            php_url = "PHPsubscripts/addpoint.php?point="+awaypoint+"&team=Away";
            $.ajax({url:php_url,success:function(pt)
            {
                document.getElementById("score-away").innerHTML = pt;
            }
            })
        }
        function minus1away() {
            awaypoint -= 1 ;
            if (awaypoint < 0)
            {
                awaypoint = 0;
            }
            php_url = "PHPsubscripts/addpoint.php?point="+awaypoint+"&team=Away";
            $.ajax({url:php_url,success:function(pt)
            {
                document.getElementById("score-away").innerHTML = pt;
            }
            })
        }
        function add2away() {
            awaypoint += 2 ;
            if (awaypoint > 99)
            {
                awaypoint = 99;
            }
            php_url = "PHPsubscripts/addpoint.php?point="+awaypoint+"&team=Away";
            $.ajax({url:php_url,success:function(pt)
            {
                document.getElementById("score-away").innerHTML = pt;
            }
            })
        }
        function add3away() {
            awaypoint += 3 ;
            if (awaypoint > 99)
            {
                awaypoint = 99;
            }
            php_url = "PHPsubscripts/addpoint.php?point="+awaypoint+"&team=Away";
            $.ajax({url:php_url,success:function(pt)
            {
                document.getElementById("score-away").innerHTML = pt;
            }
            })
        }
        function add5away() {
            awaypoint += 5 ;
            if (awaypoint > 99)
            {
                awaypoint = 99;
            }
            php_url = "PHPsubscripts/addpoint.php?point="+awaypoint+"&team=Away";
            $.ajax({url:php_url,success:function(pt)
            {
                document.getElementById("score-away").innerHTML = pt;
            }
            })
        }
        ///////////////////////////////////////////////////////////////////////////
        // This section covers the code for the clock timer
        var x;
        function play() {
            clearInterval(x);
            run = 1;
            php_url = "PHPsubscripts/state.php?name=Play";
            $.ajax({url:php_url,success:function(result) {/*void function*/} })
            document.getElementById("play-button").style.display = "none";
            document.getElementById("pause-button").style.display = "initial";
            document.getElementById("1half").style.display = "none";
            document.getElementById("2half").style.display = "none";
            document.getElementById("OThalf").style.display = "none";
            if(period==1){
                document.getElementById("1half").style.display = "initial";
                document.getElementById("1half").style.backgroundColor = "rgb(255,192,0)"; 
            }
            if(period==2){
                document.getElementById("2half").style.display = "initial";
                document.getElementById("2half").style.backgroundColor = "rgb(255,192,0)"; 
            }
            if(period==3){
                document.getElementById("OThalf").style.display = "initial";
                document.getElementById("OThalf").style.backgroundColor = "rgb(255,192,0)"; 
            }
            x = setInterval(CLKtimer,1000);
            function CLKtimer() {
                var minutes = minute;
                var seconds = second;
                if (second == 0){
                    if (minute == 0){
                        clearInterval(x);
                        pause();
                        document.getElementById("1half").style.display = "initial";
                        document.getElementById("2half").style.display = "initial";
                        document.getElementById("OThalf").style.display = "initial";
                    } else{
                        second = 59;
                        minute -= 1;
                        php_url = "PHPsubscripts/update_time.php?minute="+minute+"&second="+second+"&id="+period;
                        $.ajax({url:php_url,success:function(result) {/*void function*/} })
                    }
                } else {
                second -= 1;
                php_url = "PHPsubscripts/update_time.php?minute="+minute+"&second="+second+"&id="+period;
                $.ajax({url:php_url,success:function(result) {/*void function*/} })
                }
                document.getElementById("clock").innerHTML = ("0" + minute).slice(-2) + " : " + ("0" + second).slice(-2);
            }
        }
        function pause(){
            clearInterval(x);
            run = 0;
            php_url = "PHPsubscripts/state.php?name=Pause";
            $.ajax({url:php_url,success:function(result) {/*void function*/} })
            document.getElementById("play-button").style.display = "initial";
            document.getElementById("pause-button").style.display = "none";
        }
        function restart(){
            clearInterval(x);
            document.getElementById("1half").style.display = "initial";
            document.getElementById("2half").style.display = "initial";
            document.getElementById("OThalf").style.display = "initial";
            halftime(period);
            run = 0;
            php_url = "PHPsubscripts/state.php?name=Reset";
            $.ajax({url:php_url,success:function(result) {/*void function*/} })
            php_url = "PHPsubscripts/update_time.php?minute="+minute+"&second="+second+"&id="+period;
            $.ajax({url:php_url,success:function(result) {/*void function*/} })
            document.getElementById("play-button").style.display = "initial";
            document.getElementById("pause-button").style.display = "none";
        }
        ///////////////////////////////////////////////////////////////////////////
        // This section covers the half-time options
        var run = 0;
        function assign1(){
            period = 1;
            document.getElementById("1half").style.backgroundColor = "rgb(255,192,0)";
            document.getElementById("2half").style.backgroundColor = "rgb(208,206,206)";
            document.getElementById("OThalf").style.backgroundColor = "rgb(208,206,206)";
            if (run==0) {
                php_url = "PHPsubscripts/update_period.php?id="+period;
                $.ajax({url:php_url,async:false,success:function(result) {/*void function*/} })
                location.reload(true);
            }
        }
        function assign2(){
            period = 2;
            document.getElementById("1half").style.backgroundColor = "rgb(208,206,206)";
            document.getElementById("2half").style.backgroundColor = "rgb(255,192,0)";
            document.getElementById("OThalf").style.backgroundColor = "rgb(208,206,206)";
            if (run==0) {
                php_url = "PHPsubscripts/update_period.php?id="+period;
                $.ajax({url:php_url,async:false,success:function(result) {/*void function*/} })
                location.reload(true);
            }
        }
        function assign3(){
            period = 3;
            document.getElementById("1half").style.backgroundColor = "rgb(208,206,206)";
            document.getElementById("2half").style.backgroundColor = "rgb(208,206,206)";
            document.getElementById("OThalf").style.backgroundColor = "rgb(255,192,0)";
            if (run==0) {
                php_url = "PHPsubscripts/update_period.php?id="+period;
                $.ajax({url:php_url,async:false,success:function(result) {/*void function*/} })
                location.reload(true);
            }
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
            php_url = "PHPsubscripts/renew.php";
            $.ajax({url:php_url,success:function(result) //Dummy variable result just to get the function to work
            {
                //This following part is normal javascripts
                clearInterval(x);
                homepoint = 0;
                awaypoint = 0;
                period = 1;
                halftime(period);
                run = 0;
                document.getElementById("score-home").innerHTML = homepoint;
                document.getElementById("score-away").innerHTML = awaypoint;
                document.getElementById("1half").style.display = "initial";
                document.getElementById("2half").style.display = "initial";
                document.getElementById("OThalf").style.display = "initial";
                document.getElementById("1half").style.backgroundColor = "rgb(255,192,0)";
                document.getElementById("2half").style.backgroundColor = "rgb(208,206,206)";
                document.getElementById("OThalf").style.backgroundColor = "rgb(208,206,206)";
                document.getElementById("play-button").style.display = "initial";
                document.getElementById("pause-button").style.display = "none";
            }
            })
        }

        function changeTime()
        {
            if (isNaN(document.getElementById("minute").value) || document.getElementById("minute").value < 0 || document.getElementById("minute").value > 60)
            {
                window.alert("Invalid value for minutes. Minutes must be a whole number from 0 to 60.");
            }

            else if (isNaN(document.getElementById("seconds").value) || document.getElementById("seconds").value < 0 || document.getElementById("seconds").value >= 60)
            {
                window.alert("Invalid value for seconds. Seconds must be a whole number from 0 to 59.");
            }
            else
            {
                minute = document.getElementById("minute").value;
                second = document.getElementById("seconds").value;
                
                if (!minute.match(/\S/) && second.match(/\S/))
                {
                    minute = 0;
                }

                else if (!second.match(/\S/) && minute.match(/\S/))
                {
                    second = 0;
                }

                php_url = "PHPsubscripts/update_time.php?minute="+minute+"&second="+second+"&id="+period;
                $.ajax({url:php_url,async:false,success:function(result) {/*void function*/} })
                location.reload(true);
            }
        }
    </script>
</body>
</html>
