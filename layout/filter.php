<?php
session_start();
include 'dbconnect.php';
$filteringkey = 1;
$ID = $_GET['id'];
// echo $ID;
$ID = explode(" ", $ID);
$filterID = $ID['0'];
$filtertable = $ID['1'];
$filtertableID = $filtertable;
$filtertableID .= "ID";

$_SESSION['filter'][$filtertable] = $filterID;
$qry = "SELECT student.*, yeargroup.yeargroupname, house.housename, tutor.tutorname FROM student JOIN yeargroup ON yeargroup.yeargroupID=student.yeargroupID JOIN house ON house.houseID=student.houseID JOIN tutor ON tutor.tutorID=student.tutorID WHERE 1=1";
if (isset($_SESSION['filter']['yeargroup'])) {
  $yeargroupID = $_SESSION['filter']['yeargroup'];
  $qry .= " AND yeargroup.yeargroupID = $yeargroupID";
}
if (isset($_SESSION['filter']['tutor'])) {
  $tutorID = $_SESSION['filter']['tutor'];
  $qry .= " AND tutor.tutorID = $tutorID";
}
if (isset($_SESSION['filter']['house'])) {
  $houseID = $_SESSION['filter']['house'];
  $qry .= " AND house.houseID = $houseID";
}
$qry .= " ORDER BY student.pointcount DESC";
?>

          <tbody>
            <?php
               $studentstats_stmt = $dbconnect->prepare("$qry");
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


              ?>
          </tbody>
