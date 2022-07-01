<?php
session_start();
// includes DBConnect code so site can connect to database
include("dbconnect.php");

$category = "student";

if (!isset($_SESSION['user']['studentID']) or $_SESSION['user']['studentID'] < 0 ) {
  header('Location: index.php?error=permission');
}
$studentID = $_SESSION['user']['studentID'];
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="icon" type="image/x-icon" href="images\Mariehaugif.png">
    <!-- required for proper phone support -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS goes up here for bootrap -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="custom.css">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css"/>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script>
    function opencard(cardarray) {
      // Gets the html for styling a modal
      var carecard = document.getElementById('carecard');
      // Inserts new data into modal
      document.getElementById('cardcontent').innerHTML="<div class='display-8'><p class='mb-1'>Student: <u>"+cardarray.firstname+" "+cardarray.lastname+"</u></p><p class='mb-1'>Teacher: <u>"+cardarray.title+" "+cardarray.teacher+"</u></p><p class='mb-1'>Comment:</p></div><div class='col bg-light p-1'><p class='display-8'>"+cardarray.comment+"</p></div><div class='col display-8 text-center'><p class='mb-0'>Amount: "+cardarray.pointamount+"</p></div>";
      // this creates the modal
      var cardmodal = new bootstrap.Modal(carecard);
      // this shows it
      cardmodal.show();
    }
  </script>
  </head>
  <body class="d-flex flex-column min-vh-100">
    <?php include 'navbar.php'; ?>
    <div class="container-fluid">
      <div class="row">
        <div class="col-12 col-md-6">
          <br>
          <!-- Displays care card amount to the student -->
          <div class="card mb-3 border-red">
            <div class="card-header bg-red text-white text-center">My Care Cards</div>
            <div class="card-body">
              <?php
                $point_stmt = $dbconnect->prepare("SELECT pointcount FROM student WHERE studentID = '$studentID' ");
                $point_stmt->execute();
                $point_result = $point_stmt->get_result();
                $point_data = $point_result->fetch_assoc();
                $pointcount = $point_data['pointcount'];
                echo "<h5 class='card-title text-center'>Amount: $pointcount</h5>";
               ?>
            </div>
          </div>

          <!-- displays the details about care cards given -->
          <div class="scroll-large">
            <table class="table table-striped table-hover align-middle">
              <thead class="sticky-top bg-white">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Teacher</th>
                  <th scope="col">Comment</th>
                  <th scope="col" class="text-center">Amount</th>
                </tr>
              </thead>
              <tbody>
                <?php
                // gets the information needed for modal and displaying details
                $card_stmt = $dbconnect->prepare("SELECT pt.amount, st.firstname, st.lastname, t.title, t.lastname AS teacher, r.reason FROM pointtable AS pt
                                                  INNER JOIN student AS st ON pt.studentID = st.studentID
                                                  INNER JOIN teacher AS t ON pt.teacherID = t.teacherID
                                                  INNER JOIN reason AS r ON pt.reasonID = r.reasonID
                                                  WHERE pt.studentID = '$studentID' ORDER BY pt.datetime DESC");
                $card_stmt->execute();
                $card_result = $card_stmt->get_result();
                if ($card_result->num_rows > 0) {
                  $card_data = $card_result->fetch_all(MYSQLI_ASSOC);
                  $ID=0;
                  foreach ($card_data as $row) {
                    $pointamount = $row['amount'];
                    $firstname = $row['firstname'];
                    $lastname = $row['lastname'];
                    $title = $row['title'];
                    $teacher = $row['teacher'];
                    $comment = $row['reason'];
                    $ID+=1;
                    // encodes all the relivant data to be sent to function so JS can understand
                    $cardarray = json_encode(array('pointamount' => $pointamount, 'firstname' => $firstname, 'lastname' => $lastname, 'title' => $title, 'teacher' => "$teacher", 'comment' => "$comment"));
                    echo "<tr class='cursor-pointer' onclick='opencard($cardarray)'>
                            <th scope='row'>$ID</th>
                            <td scope='col'>$title $teacher</td>
                            <td scope='col'>$comment</td>
                            <td scope='col' class='text-center'>$pointamount</td>
                          </tr>";
                  }
                } else {
                  echo "<tr>
                          <th scope='row' class='pt-0 pb-0'></th>
                          <td scope='col'>No Care Cards on Database</td>
                          <td scope='col' class='text-center'></td>
                        </tr>";
                }
                 ?>
              </tbody>
            </table>
          </div>
          <!-- hides itself for anything larger than md breakpoint -->
          <hr size="5" class="opacity-100 mt-5 d-md-none">
        </div>
        <div class="col-12 col-md-6">
          <div class="scroll-xlarge">
            <?php
            $navpage = "student";
            include 'stats.php'; ?>
          </div>
        </div>
      </div>
    </div>
    <div class="modal" id="carecard" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-red p-2 pe-4">
            <img src="images\Mariehaugif.png" alt="Mariehau logo" width="49.5" height="60">
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body p-0">
            <img src="images/carecardtop.png" class="img-fluid" alt="topcarecardimage">
            <div class="ps-3 pe-3" id="cardcontent">
              Sorry the relevant information didn't get sent through properly.<br>
              Please contact your admin.
            </div>
            <img src="images/carecardbottom.png" class="img-fluid" alt="bottomcarecardimage">
          </div>
          <div class="modal-footer bg-red">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <footer class="bg-red p-3 mt-auto text-center">
      <p class="col text-light mb-0">"Mairetia i te Mātauranga. Be fragrant with wisdom"</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>
