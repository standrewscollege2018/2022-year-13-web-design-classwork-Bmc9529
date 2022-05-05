<?php
require_once "dbconnect.php";
$res = array();
if (isset($_GET['term'])) {
  // $name = $_GET['term'];
  $name = "Donald Duck";
  $names = explode(" ", $name);
  $amount = count($names)-1;
  if (count($names) == 1) {
    $query = "SELECT studentID, firstname, lastname FROM student WHERE firstname LIKE '%$names[0]%' OR lastname LIKE '%$names[0]%' LIMIT 5";
  }elseif ((count($names) == 1) and ()) {
    // code...
  } else {
    $query = "SELECT studentID, firstname, lastname FROM student WHERE (firstname LIKE '%$names[$amount]%' OR lastname LIKE '%$names[$amount]%') AND (studentID IN (". implode(',', $filter) . ")) LIMIT 5";
  }
  $filter = array();
  $result = mysqli_query($dbconnect, $query);

  if (mysqli_num_rows($result) > 0) {
    while ($user = mysqli_fetch_array($result)) {
      $name = $user['firstname']." ".$user['lastname'];
      $studentID = $user['studentID'];
      array_push($res, $name, $studentID);
      array_push($filter, $studentID);
    }
  } else {
    $res = array();
  }
  //return json res
  print_r($res);
  // echo json_encode($res);
}
?>
