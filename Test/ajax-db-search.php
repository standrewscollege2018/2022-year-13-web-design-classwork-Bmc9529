<?php
require_once "db.php";
$res = array();
if (isset($_GET['term'])) {
  $name = $_GET['term'];

  $query = "SELECT * FROM student WHERE firstname LIKE '%$name%' OR lastname LIKE '%$name%' LIMIT 5";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) > 0) {
    while ($user = mysqli_fetch_array($result)) {
      $name = $user['firstname']." ".$user['lastname'];
      array_push($res, $name);
      // $res = array($name);
    }
  } else {
    $res = array();
  }
  //return json res
  // $res = array("Ben M", "Joe Smith", "Alex Y");
  echo json_encode($res);
}
?>
