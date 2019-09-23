<?php 
header("Refresh:3; url=/index.php"); 
echo "Please login first. Do not try to access directly by a url.";
echo "<br>";echo "<br>";
echo "Redirecting back to login.";
exit; // <- don't forget this!
?>