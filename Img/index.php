<?php 
header("Refresh:3; url=/index.php"); 
echo "Do not try to index into this directory";
echo "<br>";echo "<br>";
echo "Redirecting back to login.";
exit; // <- don't forget this!
?>