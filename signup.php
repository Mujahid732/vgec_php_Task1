<?php
include 'partials/dbconnect.php';

$showAlert = false;
$showError = false;
if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $fname = $_POST["fname"];
  $lname = $_POST["lname"];
  $email = $_POST["email"];
  $username= $_POST["uid"];
  $branch = $_POST["branch"];
  $gender = $_POST["gender"];
  $password = $_POST["password"];
  $cpassword = $_POST["cpassword"];


  $exists = false;


  // checking record is already exist or not
  $existsql = "SELECT * FROM users WHERE email='$email'";
  $result = mysqli_query($conn, $existsql);
  $numexists = mysqli_num_rows($result);
  if ($numexists > 0) {
    //$exists = true;
    $showError = "This email is already exist";
  } else {
    //comparing password and insert data 
    if ($password == $cpassword) {
      //hashing the password for security purpose
      $hash = password_hash($password, PASSWORD_DEFAULT);
      $sql = "INSERT INTO `users` (`first name`, `last name`, `email`,`username`, `branch`, `gender`, `password`)
      VALUES ('$fname', '$lname', '$email','$username', '$branch', '$gender', '$hash');
      ";
      $result = mysqli_query($conn, $sql);
      if ($result) {
        $showAlert = true;
      } else {
        $showError = "password do not match !";

      }
    }
  }

}



?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <title>sign up</title>
</head>

<body>

  <?php require 'partials/nav.php' ?>
  <?php
  if ($showAlert) {
    echo '
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>success!</strong> Your are registered successfully ! now you can login
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    ';
  }
  if ($showError) {
    echo '
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Error!</strong>' . $showError . '
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    ';
  }




  ?>

  <div class="container p-4">
    <h1 class="d-flex justify-content-center heading">Register to our website </h1>
    <hr id="underLine">
    <div class=" d-flex justify-content-center row p-4 h-50">


      <div class="col-8">
        <form action="signup.php" method="post">
          <div class="mb-3">
            <label for="name" class="form-label" >First name</label>
            <input name="fname" type="text" class="form-control" id="name" aria-describedby="emailHelp" required>
          </div>
          <div class="mb-3">
            <label for="lname" class="form-label">Last name</label>
            <input name="lname" type="text" class="form-control" id="lname" aria-describedby="emailHelp" required>
          </div>
          <div class="mb-3">
            <label for="uname" class="form-label">User name</label>
            <input name="uid" type="text" class="form-control" id="uname" aria-describedby="emailHelp" required>
          </div>
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
          </div>
          <div class="mb-3">
            <label for="branch" class="form-label">Branch</label>
            <select name="branch" class="form-select" id="branch" aria-label="Default select example" >
              <option value="Information Technology">Information Technology</option>
              <option value="Computer Engineering">Computer Engineering</option>
              <option value="Civil Engineering">Civil Engineering</option>
              <option value="Mechanical Engineering">Mechanical Engineering</option>
              <option value="Electronic Engineering">Electronic Engineering</option>
            </select>

          </div>
          <div class="mb-3">
            <label for="gender" class="form-label">gender</label>
            <select name="gender" class="form-select" id="gender" aria-label="Default select example">
              <option value="Male">Male</option>
              <option value="Female">Female</option>
              <option value="Other">Other</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input name="password" type="text" class="form-control" id="password" aria-describedby="emailHelp" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">confirm Password</label>
            <input name="cpassword" type="text" class="form-control" id="password" aria-describedby="emailHelp" required>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>






    </div>

  </div>



  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>