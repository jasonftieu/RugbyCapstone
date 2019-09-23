<?php include("dbconnect.php")?>
<?php
    $team = $_REQUEST['team'];
    $sql="SELECT POINT,ID FROM Score WHERE Team='$team'";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_row($result);
    $score = $row[0];
    $conn->close();
    echo $score;
?>