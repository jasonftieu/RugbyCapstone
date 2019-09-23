<?php include("dbconnect.php")?>
<?php
    $sql="SELECT ID,STATUS FROM Time WHERE STATUS=1";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_row($result);
    $id = $row[0];
    $conn->close();
    echo $id;
?>