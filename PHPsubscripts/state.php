<?php include("dbconnect.php")?>
<?php
    $name = $_REQUEST['name'];
    $sql = "UPDATE Button SET STATUS=0";
    mysqli_query($conn,$sql);
    $sql = "UPDATE Button SET STATUS=1 WHERE NAME='$name'";
    mysqli_query($conn,$sql);
    $conn->close();
?>