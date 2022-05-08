<?php
// includes DBConnect code so site can connect to database
include("dbconnect.php");
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Yes</title>
    <!-- CSS goes up here for bootrap -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="custom.css">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

    <script type="text/javascript">
    var input = document.getElementById("term");
    input.addEventListener("keypress", function(event) {
      if (event.key === "Enter") {
        event.preventDefault();
        var search = document.getElementById("term");
        selectstudent(this.search);
      }
    });
    // This function takes the studentID entered and gets their details
    // The studentdetails.php page is then updated
    function selectstudent(studentID) {

      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("studenttable").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET","studentdetails.php?studentID="+studentID,true);
    xmlhttp.send();
    }
    </script>
    <script type="text/javascript">
      $(function() {$( "#term" ).autocomplete({source: 'autocomplete.php',});});
    </script>
  </head>
  <body>

      <div class="input-group input-group-lg mb-3">
        <input type="text" id="term" name="searchinput" value="" class="form-control input-lg placeholder-white border-0 bg-input-red"  placeholder="Search All" aria-label="Example text with button addon" aria-describedby="button-addon1">
        <button class="btn btn-outline-none text-light bg-red" type="submit" id="button-addon1"><i class="bi bi-search"></i></button>
      </div>

    <table class="table table-striped table-hover align-middle">
      <!-- thead is always aligned bottom -->
      <thead>
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

    <!-- javascript down here -->
    <script src="bootstrap-input-spinner.js"></script>
    <script>
        $("input[type='number']").inputSpinner()
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>
