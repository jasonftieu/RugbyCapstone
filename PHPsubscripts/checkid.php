<?php 
$conn="";
include("dbconnect.php");

$name = $_POST["name"]; 
$pass = $_POST["password"];
if (($name=="") or ($pass=="")){
    header("Location:/ModeSpectator.php"); 
    exit; // <- don't forget this!
}

$sql="SELECT ID,LOGIN,PASSPHRASE FROM Operator";
$result=mysqli_query($conn,$sql);
while ($row=mysqli_fetch_row($result))
{
    if ($row[1]==$name){
        if ($row[2]==$pass){
            header("Location:/ModeOperator.php"); 
            exit; // <- don't forget this!
        } else {
            header("Refresh:3; url=/index.php"); 
            echo "ERROR: WRONG ID or PASSWORD. Try Again";
            echo "<br>";echo "<br>";
            echo "Redirecting back to login";
            exit; // <- don't forget this!
        }
    }
}
header("Refresh:3; url=/index.php"); 
echo "ERROR: WRONG ID or PASSWORD. Try Again";
echo "<br>";echo "<br>";
echo "Redirecting back to login";
exit; // <- don't forget this!
?>
