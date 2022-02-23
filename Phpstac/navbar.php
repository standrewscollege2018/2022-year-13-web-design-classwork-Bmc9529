<?php

$tutor_sql = "SELECT * FROM tutorgroup";
$tutor_qry = mysqli_query($dbconnect, $tutor_sql);
$tutor_aa = mysqli_fetch_assoc($tutor_qry);

 ?>
 <!-- where to change bg  -->
 <nav class="navbar navbar-expand-lg navbar-dark bg-blue">
   <div class="container-fluid">
     <a href="index.php"><img src="images/logo.png" alt="Stac Logo"></a>
     <!-- burger menu -->
     <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
       <span class="navbar-toggler-icon"></span>
     </button>
     <!-- means burger menu is display under a curtain size -->
     <div class="collapse navbar-collapse" id="navbarSupportedContent">
       <ul class="navbar-nav me-auto mb-2 mb-lg-0">
         <!-- all students -->
         <li class="nav-item rounded">
           <a class='nav-link active' href='index.php?page=allstudents'>All Students</a>
         </li>
         <!-- drop down stuff -->
         <li class="nav-item dropdown rounded">
           <!-- dropdown button -->
           <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Tutors</a>
           <!-- dropdown content -->
           <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown" data-mdb-toggle="animation" data-mdb-animation-reset="true" data-mdb-animation="slide-in-down">
             <?php
             do {
               // gets the tutor id and tutor code from db
               $tutorgroupID = $tutor_aa['tutorgroupID'];
               $tutorcode = $tutor_aa['tutorcode'];
               echo "<li><a class='dropdown-item' href='index.php?page=tutorgroup&tutorgroupID=$tutorgroupID&tutorcode=$tutorcode'>$tutorcode</a></li>";
              } while ($tutor_aa = mysqli_fetch_assoc($tutor_qry))
              ?>
           </ul>
         </li>
       </ul>
       <!-- modal -->
       <!-- as ul has me-auto it will cause any code after to go to the end of the page (right) -->
       <!-- Button trigger modal -->
       <button type="button" class="btn text-light me-3" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="bi bi-plus-square"></i> Add Tutor</button>
       <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-dialog-scrollable">
           <div class="modal-content">
             <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Add a Tutor</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
               <form action="entertutor.php" method="post">
               <div class="col bg-light-blue border rounded p-4">
                 <div class="mb-3">
                   <!-- Means when you click on text in label it brings you to tied item with the same id in the for="" -->
                   <label for="Nameinput" class="form-label">Input New Tutor Name:</label>
                   <!-- Id is same as labels for therefore the label links to the input -->
                   <!-- aria-describedby is for page readers -->
                   <!-- ID can be whatever, they dont seem to have give it styling -->
                   <input required type="text" name="Tutorname" class="form-control" id="Nameinput" aria-describedby="Nameinput" placeholder="Input Name">
                   <div id="Inputhelp" class="form-text">Enter the name of the tutor, eg John Smith.</div>
                 </div>
                 <div class="mb-3">
                   <!-- Means when you click on text in label it brings you to tied item with the same id in the for="" -->
                   <label for="Tutorinput" class="form-label">Input New Tutor Code:</label>
                   <!-- Id is same as labels for therefore the label links to the input -->
                   <!-- aria-describedby is for page readers -->
                   <!-- ID can be whatever, they dont seem to have give it styling -->
                   <input required type="text" name="Tutorcode" class="form-control" id="Tutorinput" aria-describedby="Tutorinput" placeholder="Input Tutor Code">
                   <div id="Inputhelp" class="form-text">Must be exactly 3 letters eg AAA.</div>
                 </div>
                 <button type="submit" class="btn btn-primary">Submit</button>
               </div>
               </form>
             </div>
             <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
               <!-- use data-bs-dismiss to close it -->
             </div>
           </div>
         </div>
       </div>
       <!-- end of modal -->
        <!-- search bar, links to searchresults page that then links back to index -->
        <!-- searchs results here sets page get array so it links to the php page -->
       <form class="d-flex flex-column" action="index.php?page=searchresults" method="post">
         <div class="col-12">
           <p class="text-light mb-0">Search for student:</p>
         </div>
         <div class="col-12">
           <div class="input-group">
             <input required class="form-control rounded" type="text" name="search" placeholder="Student name">
             <button type="submit" name="button" class="btn btn-outline-secondary text-light">Search</button>
           </div>
         </div>
       </form>
     </div>
   </div>
 </nav>
