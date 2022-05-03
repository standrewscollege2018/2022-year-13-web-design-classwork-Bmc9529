<?php
$student = $_POST['student'];
if (is_array($student)) {
  foreach ($student as $studentID) {
    echo "$studentID <br>";
  }
}

 ?>
