<?php
require_once "dbconnect.php";
$res = array();
if (isset($_GET['term'])) {
  $name = $_GET['term'];
  $names = explode(" ", $name);
  $query = "SELECT studentID, firstname, lastname FROM student WHERE (firstname LIKE '%$names[0]%' OR lastname LIKE '%$names[0]%')";
  if (count($names) >1) {
    foreach ($names as $value) {
        $query = $query." AND (firstname LIKE '%$value%' OR lastname LIKE '%$value%') ";
      }
  }
  $query = $query." Limit 5";
  $result = mysqli_query($dbconnect, $query);

  if (mysqli_num_rows($result) > 0) {
    while ($user = mysqli_fetch_array($result)) {
      $name = "(".$user['studentID'].") ".$user['firstname']." ".$user['lastname'];
      $studentID = $user['studentID'];
      array_push($res, $name);
    }
  } else {
    $res = array();
  }
  //return json res
  echo json_encode($res);
}
?>
