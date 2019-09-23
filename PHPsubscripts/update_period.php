<?php include("dbconnect.php")?>
<?php
    $id = $_REQUEST['id'];
    $sql = "UPDATE Time SET STATUS=0";
    mysqli_query($conn,$sql);
    $sql = "UPDATE Time SET STATUS=1 WHERE id=$id";
    mysqli_query($conn,$sql);
    $conn->close();
?>