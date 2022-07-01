<nav class="navbar navbar-expand-lg navbar-dark bg-red">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="text-center">
      <a class="navbar-brand me-1" href="teacher.php"><img src="images\Mariehaugif.png" alt="Mariehau logo" width="33" height="40"></a>
      <a href="teacher.php" class="navbar-brand align-middle h1 mb-0">Care Cards</a>
    </div>
    <div class="d-block d-lg-none dropstart">
      <a href="#" class="text-decoration-none" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi h1 text-light bi-person-circle"></i></a>
      <ul class="dropdown-menu text-small shadow">
        <li><span class="dropdown-item-text"><?php echo($_SESSION['user']['email']); ?></span></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="#">Settings</a></li>
        <li><a class="dropdown-item" href="#">Reset Password</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="logout.php">Sign out</a></li>
      </ul>
    </div>
    <div class="collapse navbar-collapse mt-2" id="navbarToggler">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <?php
            if ($category == "teacher") {
              echo "<a class='nav-link active' aria-current='page' href='$category.php'>Add Cards</a>";
            } else {
              echo "<a class='nav-link active' aria-current='page' href='$category.php'>Home</a>";
            }
           ?>

        </li>
        <li class="nav-item">
          <a class="nav-link active" href="teacher.php?page=leaderboard">Leaderboards</a>
        </li>
      </ul>
    </div>
    <div class="d-none d-lg-block dropstart">
      <a href="#" class="text-decoration-none" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi h1 text-light bi-person-circle"></i></a>
      <ul class="dropdown-menu text-small shadow">
        <li><span class="dropdown-item-text"><?php echo($_SESSION['user']['email']); ?></span></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="#">Settings</a></li>
        <li><a class="dropdown-item" href="#">Reset Password</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="logout.php">Sign out</a></li>
      </ul>
    </div>
  </div>
</nav>
