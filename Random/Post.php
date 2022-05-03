<?php
session_start();
include 'dbconnect.php';
 ?>

<?php
$student = $_SESSION['students'];
if (is_array($student)) {
  foreach ($student as $studentID) {
    echo "$studentID <br>";
  }
}
 ?>
<a href="Postto.php">back</a>
