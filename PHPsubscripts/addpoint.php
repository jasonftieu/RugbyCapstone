<?php include("dbconnect.php")?>
<?php
    $point = $_REQUEST['point'];
    $team = $_REQUEST['team'];
    $sql = "UPDATE Score SET POINT=$point WHERE TEAM='$team'";
    mysqli_query($conn,$sql);
    $sql="SELECT POINT,ID FROM Score WHERE Team='$team'";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_row($result);
    $Home_score = $row[0];
    $conn->close();
    echo $Home_score;
?>
