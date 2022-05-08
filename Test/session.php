<?php
$name = "(10) John Smith";
$delimiters = array("(", ")");
$newname = str_replace($delimiters, "", $name);
$studentID = explode(" ", $newname);
echo $studentID[0];
 ?>
