<?php
session_start();

include 'dbconnect.php';
$delimiters = array("(", ")");

if (!isset($_GET["studentID"]) or $_GET["studentID"]==""){
  echo "<tr>
          <th scope='row' class='pt-0 pb-0'></th>
          <td scope='col'>No students searched</td>
          <td scope='col' class='text-center'>.</td>
        </tr>";
} elseif ($_GET["studentID"] == "clear") {
  unset($_SESSION["selectedstudents"]);
  echo "<tr>
          <th scope='row' class='pt-0 pb-0'></th>
          <td scope='col'>cleared students</td>
          <td scope='col' class='text-center'></td>
        </tr>";
}else {
  $newname = str_replace($delimiters, "", $_GET["studentID"]);
  $tempID = explode(" ", $newname);
  $studentID = $tempID[0];
  if (!isset($_SESSION['selectedstudents'])) {
    $_SESSION['selectedstudents'] = array();
    array_push($_SESSION['selectedstudents'], $studentID);
  } else {
    array_push($_SESSION['selectedstudents'], $studentID);
  }
  foreach ($_SESSION['selectedstudents'] as $student) {
    $sql = "SELECT st.studentID ,st.firstname, st.lastname, y.yeargroupname FROM student AS st INNER JOIN yeargroup AS y ON st.yeargroupID = y.yeargroupID WHERE studentID=$student";
    $qry = mysqli_query($dbconnect, $sql);
    if(mysqli_num_rows($qry)==0) {
      echo "<tr>
              <th scope='row' class='pt-0 pb-0'></th>
              <td scope='col'>No students in DB</td>
              <td scope='col' class='text-center'></td>
            </tr>";
    } else {
    $aa = mysqli_fetch_assoc($qry);
    $studentID = $aa['studentID'];
    $firstname = $aa['firstname'];
    $lastname = $aa['lastname'];
    $year = $aa['yeargroupname'];
    echo "<tr>
            <th scope='row' class='pt-0 pb-0'><input class='form-check-input display-7 m-0' type='checkbox' name='student[]' value='$studentID' id='checkbox'></th>
            <td scope='col' >$firstname $lastname</td>
            <td scope='col' class='text-center'>$year</td>
          </tr>";
    }
  }
}
