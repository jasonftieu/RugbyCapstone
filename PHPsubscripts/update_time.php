<?php include("dbconnect.php")?>
<?php
    $id = $_REQUEST['id'];
    $minute = $_REQUEST['minute'];
    $second = $_REQUEST['second'];
    $sql = "UPDATE Time SET MINUTE=$minute WHERE ID=$id";
    mysqli_query($conn,$sql);
    $sql = "UPDATE Time SET SECOND=$second WHERE ID=$id";
    mysqli_query($conn,$sql);
    $conn->close();
?>