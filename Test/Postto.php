<?php
session_start();
include 'dbconnect.php';
 ?>
 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>postto</title>
     <!-- CSS goes up here for bootrap -->
     <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
     <link rel="stylesheet" href="custom.css">
     <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />
     <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

     <script type="text/javascript">
     // This function takes the studentID entered and gets their details
     // The studentDetails.php page is then updated
     function selectstudent(studentID) {

       var xmlhttp = new XMLHttpRequest();
       xmlhttp.onreadystatechange = function() {
       if (this.readyState == 4 && this.status == 200) {
         document.getElementById("studenttable").innerHTML = this.responseText;
       }
     };
     xmlhttp.open("GET","studentDetails.php?studentID="+studentID,true);
     xmlhttp.send();
     }
     </script>
     <script type="text/javascript">
       $(function() {$( "#term" ).autocomplete({source: 'autocomplete.php',});});
     </script>
      </script>
   </head>
   <body>
     <div class="container">
       <div class="row">
         <div class="col">
           <form class="input-group input-group-lg mt-3" action="Postto.php" method="post">
             <input class="form-control input-lg" type="text" id="term" placeholder="Search Here..." name="term" value="">
             <button class="btn btn-primary" type="submit">Submit</button>
           </form>
         </div>
       </div>
     </div>
     <?php
     if (isset($_POST['search'])) {
       $studentID = $_POST['search'];
       if ($studentID == -1) {
         session_unset();
       } else {
         if(isset($_SESSION['students'])){
           array_push($_SESSION['students'],$studentID);
         } else {
           $_SESSION['students']=[$studentID];
         }
       }
     }
      ?>

     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
   </body>
 </html>
