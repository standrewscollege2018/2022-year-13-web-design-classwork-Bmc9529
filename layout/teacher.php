<?php
session_start();
// includes DBConnect code so site can connect to database
include("dbconnect.php");
$category = "teacher";
$_SESSION['user']['permission'] = 3;
$_SESSION['user']['teacherID'] = 3;
$_SESSION['user']['email'] = "bmc9529@stacmail.net";
if (!isset($_SESSION['user']['permission']) OR $_SESSION['user']['permission'] == 1) {
  header('Location: index.php?error=permission');
} else {
  if (!isset($_SESSION['user']['teacherID'])) {
    header('Location: index.php?error=permission');
  }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Care Cards</title>
    <link rel="icon" type="image/x-icon" href="images\Mariehaugif.png">
    <!-- required for proper phone support -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS goes up here for bootrap -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="custom.css">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
  </head>
  <body class="d-flex flex-column min-vh-100">
    <!-- toast code -->
    <div aria-live="polite" aria-atomic="true" class="ui-front bg-dark position-relative">
      <div class="toast-container position-absolute p-3 top-0 start-50 translate-middle-x">
        <div class="toast" id="alertmsg">
          <div class="toast-header">
            <strong class="me-auto text-dark">Care Cards App</strong>
            <small class="text-muted">just now</small>
            <button type="button" class="btn-close text-dark" data-bs-dismiss="toast" aria-label="Close"></button>
          </div>
          <div class="toast-body bg-white rounded-bottom">
            Care cards succesfully added.
          </div>
        </div>
      </div>
    </div>

    <!-- error toast code -->
    <div aria-live="polite" aria-atomic="true" class="ui-front bg-dark position-relative">
      <div class="toast-container position-absolute p-3 top-0 start-50 translate-middle-x">
        <div class="toast" id="errormsg">
          <div class="toast-header bg-white">
            <strong class="me-auto text-danger">Alert</strong>
            <small class="text-muted">just now</small>
            <button type="button" class="btn-close text-dark" data-bs-dismiss="toast" aria-label="Close"></button>
          </div>
          <div class="toast-body bg-white rounded-bottom">
            Error: <?php echo($_GET['error']);?>
          </div>
        </div>
      </div>
    </div>
    <?php include 'navbar.php'; ?>
    <div class="container-fluid">
      <div class="row">
        <?php
        if (!isset($_GET['page'])) {
          include 'addcarecards.php';
        } elseif ($_GET['page'] == 'leaderboard') {
          $navpage = "leaderboard";
          include 'stats.php';
        }else {
          include 'addcarecards.php';
        }
         ?>
      </div>
    </div>
    <footer class="bg-red p-3 mt-auto text-center">
      <p class="col text-light mb-0">"Mairetia i te Mātauranga. Be fragrant with wisdom"</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <?php
      if (isset($_GET['insert'])) {
        if ($_GET['insert'] == "success") {
          ?>
          <script type="text/javascript">
          var alertmsg = document.getElementById('alertmsg')
          // this creates the toast according to the page
          var toast = new bootstrap.Toast(alertmsg)
          // this shows it
          toast.show()
          </script>
          <?php
        }
      }
      if (isset($_GET['error'])) {
        if ($_GET['error'] != "" and $_GET['error'] != " ") {
          ?>
          <script type="text/javascript">
          var errormsg = document.getElementById('errormsg')
          // this creates the toast according to the page
          var toast = new bootstrap.Toast(errormsg)
          // this shows it
          toast.show()
          </script>
          <?php
        }
      }
     ?>
  </body>
</html>
