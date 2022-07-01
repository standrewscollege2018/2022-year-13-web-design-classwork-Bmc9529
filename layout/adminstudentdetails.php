<?php
include 'dbconnect.php';

if (!isset($_GET["student"]) or $_GET["student"]==""){

     $studentstats_stmt = $dbconnect->prepare("SELECT student.*, yeargroup.yeargroupname, house.housename, tutor.tutorname FROM student JOIN yeargroup ON yeargroup.yeargroupID=student.yeargroupID JOIN house ON house.houseID=student.houseID JOIN tutor ON tutor.tutorID=student.tutorID ORDER BY student.pointcount DESC");
     $studentstats_stmt->execute();
     $studentstats_result = $studentstats_stmt->get_result();
     $studentstats_data = $studentstats_result->fetch_all(MYSQLI_ASSOC);
     if ($studentstats_result->num_rows > 0) {
       $ID = 0;
       foreach ($studentstats_data as $row)   {
       $studentID = $row['studentID'];
       $firstname = $row['firstname'];
       $lastname = $row['lastname'];
       $yeargroup = $row['yeargroupname'];
       $waka = $row['housename'];
       $wa_whanau = $row['tutorname'];
       $cardcount = $row['pointcount'];
       $ID = $ID+1;
       echo "<tr>";
         echo "<th scope='row'>$ID</th>";
         echo "<td>$firstname $lastname</td>";
         echo "<td>$yeargroup</td>";
         echo "<td>$waka</td>";
         echo "<td class='d-none d-sm-table-cell'>$wa_whanau</td>";
         echo "<td>$cardcount</td>";
       echo "</tr>";
     }
   }else {
     echo "Sorry this isn't working. No records found.";
   }



} else {
  $name = $_GET['student'];
  $name = mysqli_real_escape_string($dbconnect, $name);
  // turns the number of names inputed into an array eg firstname in pos 0 and last in pos 1 or vice a versa
  $names = explode(" ", $name);
  // $query = "SELECT st.studentID, st.firstname, st.lastname, y.yeargroupname FROM student AS st INNER JOIN yeargroup AS y ON st.yeargroupID = y.yeargroupID INNER JOIN tutor AS t ON st.tutorID = t.tutorID INNER JOIN house AS h ON st.houseID = h.houseID WHERE (firstname LIKE '%$names[0]%' OR lastname LIKE '%$names[0]%' OR housename LIKE '%$name%' OR tutorname LIKE '%$name%')";
  $query = "SELECT st.studentID, st.firstname, st.lastname, st.pointcount, h.housename, y.yeargroupname, t.tutorname FROM student AS st
            INNER JOIN yeargroup AS y ON st.yeargroupID = y.yeargroupID
            INNER JOIN tutor AS t ON st.tutorID = t.tutorID
            INNER JOIN house AS h ON st.houseID = h.houseID
            WHERE (st.firstname LIKE '%$names[0]%' OR st.lastname LIKE '%$names[0]%' OR h.housename LIKE '%$name%' OR t.tutorname LIKE '%$name%'
                  OR st.studentID IN (SELECT sc.studentID FROM studentclass AS sc INNER JOIN class AS c ON sc.classID=c.classID WHERE (c.class LIKE '%$name%')))";
  if (count($names) >1) {
    foreach ($names as $value) {
      // adds on the info for every name in the get array then appends that name down below
      // eg donald duck -> array([0]=>"donald",[1]=>"duck") then searches against those two
        $query = $query." AND (st.firstname LIKE '%$value%' OR st.lastname LIKE '%$value%' OR h.housename LIKE '%$name%' OR t.tutorname LIKE '%$name%'
                          OR st.studentID IN (SELECT sc.studentID FROM studentclass AS sc INNER JOIN class AS c ON sc.classID=c.classID WHERE (c.class LIKE '%$name%'))) ";
      }
  }
  $query = $query." ORDER BY st.pointcount DESC";
  // echo "$query";
  $session_stmt = $dbconnect->prepare("$query");
  $session_stmt->execute();
  $session_result = $session_stmt->get_result();
  if ($session_result->num_rows > 0) {
    $session_data = $session_result->fetch_all(MYSQLI_ASSOC);
    $ID = 0;
    foreach ($session_data as $row) {
      $studentID = $row['studentID'];
      $firstname = $row['firstname'];
      $lastname = $row['lastname'];
      $yeargroup = $row['yeargroupname'];
      $waka = $row['housename'];
      $wa_whanau = $row['tutorname'];
      $cardcount = $row['pointcount'];
      $ID = $ID+1;
      echo "<tr>";
        echo "<th scope='row'>$ID</th>";
        echo "<td>$firstname $lastname</td>";
        echo "<td>$yeargroup</td>";
        echo "<td>$waka</td>";
        echo "<td>$wa_whanau</td>";
        echo "<td>$cardcount</td>";
      echo "</tr>";
    }
  } else {
    echo "<tr>
            <th scope='row' class='pt-0 pb-0'></th>
            <td scope='col'>No student on Database</td>
            <td scope='col' class='text-center'></td>
          </tr>";
  }
}
