<?php
//session_start();
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
  $loggedin = true;
} else {
  $loggedin = false;
}

?>
<style>
  .pangolin-regular {
    font-family: "Pangolin", cursive;
    font-weight: 400;
    font-style: normal;
  }

  .heading {
    font-family: "Pangolin", cursive;
    font-style: normal;
    font-weight: 400;
    font-size: 50px;
    text-shadow: 1px 2px 3px green;
    color: grey;

  }

  .image img {
    width: 100%;
    height: 300px;
    background-position: center;
    object-fit: cover;
    opacity: 0.7;
    filter: grayscale(100%);

  }
</style>

<nav class="navbar  navbar-expand-sm navbar-dark bg-dark">
  <div class="container-fluid  mt-0">
    <a class="navbar-brand" href="#">iSecure</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?php echo 'home.php'; ?>">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">about</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo 'todo.php'; ?>">To Do</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact us</a>
        </li>
      </ul>
      <?php
        if(!$loggedin){
          //include 'partials/logsign.php';
          echo '
          <ul class="navbar-nav me-0 mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="login.php">login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="signup.php">sign up</a>
            </li>
          </ul>
          ';
        }else{
          //include 'partials/outlog.php';
          echo '
          <ul class="navbar-nav me-0 mb-2 mb-lg-0">
          <li class="nav-item">
              <a class="nav-link" href="">'.$_SESSION["username"].'</a>
            </li>
          <li class="nav-item">
              <a class="nav-link" href="logout.php">logout</a>
          </li>
      </ul>
          ';
        }
      ?>
    </div>
  </div>
</nav>