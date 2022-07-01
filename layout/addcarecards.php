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
xmlhttp.open("GET","studentdetails.php?student="+studentID,true);
xmlhttp.send();
}
</script>
<script>
function showtext(other) {
  if (other == "null") {
    document.getElementById("textarea").innerHTML = "<div class='pt-3'><textarea required cols='50' rows='2' placeholder='Type New Commment Here...' name='newcomment' id='text_id' class='form-control' style='resize:vertical' ></textarea></p></div>";
  }
  else {
    document.getElementById("textarea").innerHTML = "";
  }
}
</script>

<div class="card mx-auto col-12 col-md-8 col-lg-6 col-xl-4 p-0">
  <div class="card-header bg-red text-light">
  <h5>Add Care Cards: </h5>
  </div>
  <div class="card-body">
    <div class="input-group input-group-lg mb-3">
      <input type="text" onkeyup="selectstudent(this.value)" autocomplete="off" name="searchinput" value="" class="form-control input-lg placeholder-white border-0 bg-input-red"  placeholder="Search All">
      <button class="btn btn-outline-none text-light bg-red" type="submit" id="button-addon1"><i class="bi bi-search"></i></button>
    </div>
    <form action="insertcard.php" method="post">
      <h4 class="mb-2">Selected Students:</h4>
      <input type="checkbox" class='form-check-input display-7 m-0' id="checkall">
      <label for="checkall" class="form-label display-8 mb-0">Select All</label>
      <div class="dropdown-divider bg-dark mb-0"></div> 
      <div class="mb-3 scroll">
        <table class="table table-striped table-hover align-middle">
          <!-- thead is always aligned bottom -->
          <thead class="sticky-top bg-white">
          <tr>
          <th scope="col" class="w-overide-0"></th>
          <th scope="col">Student Name:</th>
          <th scope="col" class="text-center">Year:</th>
          </tr>
          </thead>
          <!-- tbody is always aligned top -->
          <tbody id="studenttable">
          </tbody>
        </table>
      </div>
      <div class="dropdown-divider bg-dark mb-3"></div>
      <div class="mb-3">
        <?php
        $teacherID = $_SESSION['user']['teacherID'];
        $reason_stmt = $dbconnect->prepare("SELECT * FROM reason WHERE teacherID = '$teacherID' AND selectionvalue = '1'");
        $reason_stmt->execute();
        $reason_result = $reason_stmt->get_result();
        if ($reason_result->num_rows > 0) {
          echo "<select onchange='showtext(this.value)' class='btn btn-outline-none text-light bg-red btn-lg w-100 text-start' name='commentdropdown'>
                  <option selected>Select Comment<i class='bi bi-chevron-expand'</i></option>";
          $reason_data = $reason_result->fetch_all(MYSQLI_ASSOC);
          foreach ($reason_data as $row) {
            $reasonID = $row['reasonID'];
            $reason = $row['reason'];
            echo "<option value='$reasonID'>$reason</option>";
          }
          echo "<option value='null'>Other</option></select>";
        } else {
          echo "<textarea cols='50' rows='2' required placeholder='Type New Commment Here...' name='newcomment' id='text_id' class='form-control' style='resize:vertical'></textarea></p>";
        }  ?>
        <div id="textarea" class="col">
        </div>
      </div>
      <div class="dropdown-divider bg-dark"></div>
      <div class="row mb-3">
        <div class="col me-auto">
          <!-- Means when you click on text in label it brings you to tied item with the same id in the for="" -->
          <label for="numberinput" class="form-label display-8">Amount:</label>
        </div>
        <div class="col">
          <!-- Id is same as labels for therefore the label links to the input -->
          <!-- aria-describedby is for page readers -->
          <!-- ID can be whatever, they dont seem to have give it styling -->
          <input placeholder="Enter a number" name="pointamount" required value="1" min="1" max="3" type="number" id="Inputhelp"/>
        </div>
      </div>
  </div>
  <div class="card-footer text-end bg-secondary">
    <button type="submit" class="btn bg-red text-light">Add Care Cards</button>
    </form>
  </div>
</div>
<!-- none defined javascript functions down here -->
<script type="text/javascript">
$('#checkall').click(function(event) {
    if(this.checked) {
        // Iterate each checkbox
        $(':checkbox').each(function() {this.checked = true;});
    } else {
        $(':checkbox').each(function() {this.checked = false;});}});
</script>
<script src="files/bootstrap-input-spinner.js"></script>
<script>
    $("input[type='number']").inputSpinner()
</script>
