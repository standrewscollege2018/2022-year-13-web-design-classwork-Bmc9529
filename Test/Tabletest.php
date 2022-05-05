<!DOCTYPE html>
<html lang="" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Table</title>
    <!-- CSS goes up here for bootrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

    <script type="text/javascript">
    // This function takes the studentID entered and gets their details
    // The studentDetails.php page is then updated
    function selectstudent(studentID) {

      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("student").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET","studentDetails.php?studentID="+studentID,true);
    xmlhttp.send();
    }

  </script>
  </head>
  <body>
    <button type="button" onclick="selectstudent(this.value)" value="1">Button 1</button>
    <button type="button" onclick="selectstudent(this.value)" value="2">Button 2</button>
    <div class="container-fluid">
      <div class="col-4">
        <!-- put table striped here -->
        <table class="table table-dark table-striped table-hover table-bordered">
          <!-- thead is always aligned bottom -->
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">First</th>
              <th scope="col">Last</th>
              <th scope="col">Handle</th>
              <th scope="col" class="align-top">Rand text</th>
            </tr>
          </thead>
          <!-- tbody is always aligned top -->
          <tbody >
            <tr id="student">
            </tr>
            <tr class="align-middle">
              <th scope="col">1</th>
              <!-- TD isnt bold th is -->
              <td scope="col">Elite</td>
              <td scope="col">Menzie</td>
              <td scope="col">@Elte</td>
              <td scope="col">This here is some placeholder text, intended to take up quite a bit of vertical space, to demonstrate how the vertical alignment works in the preceding cells.
    </td>
            </tr class="align-top">
            <!-- table active to make it lighter or darker -->
            <tr class="table-active">
              <th scope="col">2</th>
              <td scope="col">Jacob</td>
              <td scope="col">Can</td>
              <td scope="col">@JCAN-ECANT</td>
              <td scope="col">This here is some placeholder text, intended to take up quite a bit of vertical space, to demonstrate how the vertical alignment works in the preceding cells.
    </td>
            </tr>
            <tr class="align-bottom">
              <th scope="col">3</th>
              <td scope="col">Ben</td>
              <td scope="col"></td>
              <td scope="col">@yes</td>
              <td scope="col">This here is some placeholder text, intended to take up quite a bit of vertical space, to demonstrate how the vertical alignment works in the preceding cells.
    </td>
            </tr>
          </tbody>
        </table>
      </div>

    </div>

    <!-- javascript down here -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>
