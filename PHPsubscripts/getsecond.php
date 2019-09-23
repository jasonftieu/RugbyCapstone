<?php include("dbconnect.php")?>
<?php
    $sql="SELECT ID,STATUS FROM Time WHERE STATUS=1";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_row($result);
    $id = $row[0];
    mysqli_free_result($result);

    $sql="SELECT SECOND,ID FROM Time WHERE ID=$id";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_row($result);
    $second = $row[0];
    $conn->close();
    echo $second;
?>