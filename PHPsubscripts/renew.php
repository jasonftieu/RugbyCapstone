<?php include("dbconnect.php")?>
<?php
    $sql = "UPDATE Score SET POINT=0 WHERE TEAM='Home'";
    mysqli_query($conn,$sql);
    $sql = "UPDATE Score SET POINT=0 WHERE TEAM='Away'";
    mysqli_query($conn,$sql);

    $sql = "UPDATE Time SET MINUTE=40 WHERE id=1";
    mysqli_query($conn,$sql);
    $sql = "UPDATE Time SET MINUTE=40 WHERE id=2";
    mysqli_query($conn,$sql);
    $sql = "UPDATE Time SET MINUTE=10 WHERE id=3";
    mysqli_query($conn,$sql);

    $sql = "UPDATE Time SET SECOND=0 WHERE id=1";
    mysqli_query($conn,$sql);
    $sql = "UPDATE Time SET SECOND=0 WHERE id=2";
    mysqli_query($conn,$sql);
    $sql = "UPDATE Time SET SECOND=0 WHERE id=3";
    mysqli_query($conn,$sql);

    $sql = "UPDATE Time SET STATUS=1 WHERE id=1";
    mysqli_query($conn,$sql);
    $sql = "UPDATE Time SET STATUS=0 WHERE id=2";
    mysqli_query($conn,$sql);
    $sql = "UPDATE Time SET STATUS=0 WHERE id=3";
    mysqli_query($conn,$sql);

    $sql = "UPDATE Button SET STATUS=0";
    mysqli_query($conn,$sql);
    $sql = "UPDATE Button SET STATUS=1 WHERE NAME='New'";
    mysqli_query($conn,$sql);

    $conn->close();
?>