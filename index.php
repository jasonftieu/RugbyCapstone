<!-- Project: OU Rugby Score Board -->
<!-- Author: Minh Phi              -->
<!-- Credit to: W3schools.com      -->
<html>  
<head>
    <meta charset="UTF-8">
    <title>Welcome to University of Oklahoma</title>
    <link rel="stylesheet" href="CSSscripts/My_CSS.css" type="text/css">
</head>

<body class ="border" style="background-color:rgb(255, 242, 204); height:275px;">
<div class="container">
        <img class="logo" src="Img/logo.png" alt="Logo">
</div>
<div style="text-align:center;">
For Operator: Login using OU 4x4 ID<br>
For Spectator: Leave the field blank and hit Submit<br><br>
</div>
<form action="/PHPsubscripts/checkid.php" method="post" style="text-align:center;">
OU ID(4x4)&nbsp;&nbsp;&nbsp; : &nbsp; <input type="text" name="name"><br><br>
PASSWORD &nbsp; : &nbsp; <input type="password" name="password"><br><br>
<input type="submit" value="LOG IN">
</form>

</body>
</html
