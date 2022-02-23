<?php
include 'dbconnect.php';
if(strlen($_POST['Tutorcode'])!= 3 or strlen($_POST['Tutorname'])<=1) {
  header("Location: index.php");
} else {
  $Tutorname = $_POST['Tutorname'];
  $Tutorcode = $_POST['Tutorcode'];
  $tutor_sql = "SELECT * FROM tutorgroup WHERE tutorcode='$Tutorcode' OR tutor='$Tutorname'";
  $tutor_qry = mysqli_query($dbconnect, $tutor_sql);
  if(mysqli_num_rows($tutor_qry)==0) {
    // Where you want followed by respective values
    $insert_sql = "INSERT INTO tutorgroup (tutor, tutorcode) VALUES ('$Tutorname', '$Tutorcode')";
    $insert_qry = mysqli_query($dbconnect, $insert_sql);
    header("Location: index.php");

  } else {
    $tutor_aa = mysqli_fetch_assoc($tutor_qry);
    echo "<h1 class='text-center display-4'>Tutor already exists</h1>";
    ?>
    <form action="index.php">
      <button type="submit" name="button" class="btn btn-outline-secondary text-light">Search</button>
    </form>
    <?php
  }

}


   ?>
