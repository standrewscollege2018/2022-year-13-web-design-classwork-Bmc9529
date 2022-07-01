<script>
  function showUser(str) {
    if (str == "") {
      document.getElementById("studenttable").innerHTML = "";
      return;
    } else {
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("studenttable").innerHTML = this.responseText;
        }
      };

      xmlhttp.open("GET", "filter.php?"+str,true);
      xmlhttp.send();

    }
  }
</script>
<script type="text/javascript">
// This function takes the studentID entered and gets their details
// The studentdetails.php page is then updated
function selectstudent(studentID) {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200) {
    document.getElementById("studenttable").innerHTML = this.responseText;
  }
};
xmlhttp.open("GET","adminstudentdetails.php?student="+studentID,true);
xmlhttp.send();
}
</script>
<?php

 if (isset($_POST['clear'])) {
   unset($_SESSION['filter']);
 }
 ?>

<div class="col-12 navbar-expand-lg navbar-light text-center pt-3">
  <button class="navbar-toggler btn border-none text-light bg-red p-2 ps-3 pe-3" type="button" data-bs-toggle="collapse" data-bs-target="#selectionToggler" aria-controls="selectionToggler" aria-expanded="false" aria-label="Toggle filter">
    Leaderboard Filters
  </button>
  <div class="collapse navbar-collapse" id="selectionToggler">
    <div class="row w-100 g-2 m-0">
      <div class="col-6 col-lg-2">
        <div>
          <select name="users" onchange="showUser(this.value)" class="form-select bg-red text-light">
            <option disabled selected>Yeargroup</option>
              <?php
              $yeargroup_stmt = $dbconnect->prepare("SELECT * FROM yeargroup");
              $yeargroup_stmt -> execute();
              $yeargroup_result = $yeargroup_stmt->get_result();
              $yeargroup_data = $yeargroup_result->fetch_all(MYSQLI_ASSOC);

              if ($yeargroup_result->num_rows > 0) {
                foreach ($yeargroup_data as $row) {
                  $yeargroupID = $row['yeargroupID'];
                  $yeargroup = $row['yeargroupname'];
                  echo "<option value='id=$yeargroupID yeargroup'>$yeargroup</option>";
                }
              }else {
                echo "<option value='0'>Error: No year group found</option>";
              }
              ?>
          </select>
        </div>
      </div>
      <!-- end of yeargroup dropdown -->
      <div class="col-6 col-lg-2">
        <div>
          <select name="users" onchange="showUser(this.value)" class="form-select bg-red text-light">
            <option disabled selected>Waka</option>
              <?php
              $waka_stmt = $dbconnect->prepare("SELECT * FROM house");
              $waka_stmt -> execute();
              $waka_result = $waka_stmt->get_result();
              $waka_data = $waka_result->fetch_all(MYSQLI_ASSOC);

              if ($waka_result->num_rows > 0) {
                foreach ($waka_data as $row) {
                  $wakaID = $row['houseID'];
                  $waka = $row['housename'];
                  echo "<option value='id=$wakaID house'>$waka</option>";
                }
              }else {
                echo "<option value='0'>Error: No year group found</option>";
              }
              ?>
          </select>
        </div>
      </div>
      <!-- end of waka dropdown -->
      <div class="col-6 col-lg-2">
        <div>
          <select name="users" onchange="showUser(this.value)" class="form-select bg-red text-light">
            <option disabled selected>Wa Whanau</option>
              <?php
              $tutor_stmt = $dbconnect->prepare("SELECT * FROM tutor");
              $tutor_stmt -> execute();
              $tutor_result = $tutor_stmt->get_result();
              $tutor_data = $tutor_result->fetch_all(MYSQLI_ASSOC);

              if ($tutor_result->num_rows > 0) {
                foreach ($tutor_data as $row) {
                  $tutorID = $row['tutorID'];
                  $tutor = $row['tutorname'];
                  echo "<option value='id=$tutorID tutor'>$tutor</option>";
                }
              }else {
                echo "<option value='0'>Error: No year group found</option>";
              }
              ?>
          </select>
        </div>
      </div>
      <!-- end of Wa whanau dropdown -->
      <div class="col-6 col-lg-2">
        <div>
          <div class="input-group mb-3">
            <input type="text" onkeyup="selectstudent(this.value)" autocomplete="off" name="searchinput" value="" class="form-control input-lg placeholder-white border-0 bg-input-red"  placeholder="Search All">
            <button class="btn btn-outline-none text-light bg-red" type="submit" id="button-addon1"><i class="bi bi-search"></i></button>
          </div>
        </div>
      </div>
      <!-- end of search -->
      <div class="col-12 col-lg-2 text-center">
        <?php
        echo "<form  action='$category.php?page=$navpage' method=post>
                <button type='submit' class='btn-secondary btn' name='clear'>Clear Filter</button>
              </form>";
         ?>
      </div>
      <!-- end of clear button -->
    </div>
    <!-- end of row ################ -->
  </div>
  <!-- end of collaspe ######## -->
  <!-- Start the table-->
  <table class="table table-striped table-hover align-middle">
  <!-- Start listing the column headers -->
    <thead>
      <tr>
      <!-- Column Names -->
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Yeargroup</th>
        <th scope="col">Waka</th>
        <th scope="col" class='d-none d-sm-table-cell'>Wa Whanau</th>
        <th scope="col">CARE Cards</th>
      </tr>
    <!-- End the column names -->
    </thead>
    <tbody id=studenttable>
      <?php
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
        ?>
    </tbody>
  </table>
  <!-- End the Table -->

</div>
