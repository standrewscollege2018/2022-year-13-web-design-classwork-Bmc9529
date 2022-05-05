<?php
require_once "dbconnect.php";
$res = array();
if (isset($_GET['term'])) {
  $name = $_GET['term'];

  $query = "SELECT * FROM student WHERE firstname LIKE '%$name%' OR lastname LIKE '%$name%' LIMIT 5";
  $result = mysqli_query($dbconnect, $query);

  if (mysqli_num_rows($result) > 0) {
    while ($user = mysqli_fetch_array($result)) {
      $name = $user['firstname']." ".$user['lastname'];
      $studentID = $user['studentID'];
      array_push($res, $name, $studentID);
    }
  } else {
    $res = array();
  }
  //return json res
  echo json_encode($res);
}
?>
