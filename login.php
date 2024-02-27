<?php
include 'partials/dbconnect.php';
$login = false;
$showError = false;
if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $uid = $_POST["uid"];
  $password = $_POST["password"];
  $cptch1 = $_POST["captcha1"];
  $cptch2 = $_POST["captcha2"];

  if ($cptch1 == $cptch2) {
    //$sql = "SELECT * FROM users where username = '$uid' AND password = '$password'"; // feching username and password
    $sql = "SELECT * FROM users where username = '$uid'";
    
    $result = mysqli_query($conn, $sql); // executing query

    $num = mysqli_num_rows($result); // this function return number of records
    if ($num == 1) {
      //$row = mysqli_fetch_assoc($result);
      //password_verify($password, $row["password"])
      while($row = mysqli_fetch_assoc($result)){
        if(password_verify($password, $row["password"])){
          $login = true;
          session_start();
          //$rows = mysqli_fetch_assoc($result);

          $_SESSION["loggedin"] = true;
          $_SESSION["username"] = ucfirst($uid); // capitalized string
          header("location: todo.php");
        }else{
          $showError = " invalid credential !";
        }
      }
    } else {
      $showError = " invalid credential !";
    }
  }else{
    $showError = " Incorrect captcha !";
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
  <link rel="stylesheet" href="//cdn.datatables.net/2.0.0/css/dataTables.dataTables.min.css">
  <title>login</title>
  <style>
    * {
      user-select: none;
    }

    #liner {
      width: 100%;
      display: flex;
      justify-content: center;

    }

    #underLine {
      width: 50%;
      margin-left: 25%;
      margin-right: 25%;

    }

    input[id=captcha] {
      background-color: #3CBC8D;
      width: 50%;
      display: flex;
      judtify-content: center;
    }

    #captcha {
      pointer-events: none;
      letter-spacing: 12px;
      text-decoration: line-through;
      font-style: italic;
      font-size: 20px;
      border: 0;
      font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
      background: grayscale;

    }

    #span {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      font-size: 18px;
      color: grey;
      margin-right: 3px;


    }

    #regref {
      font-size: 22px;
      font-weight: bold;

    }
  </style>
</head>

<body>

  <?php require 'partials/nav.php' ?>
  <?php
  if ($login) {
    echo '
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>success!</strong> Your are logged  in
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
    <h1 class="d-flex justify-content-center heading">Login here </h1>
    <div class="liner">
      <hr id="underLine">
    </div>


    <div class="row d-flex justify-content-center p-4 h-50">

      <div class="col-sm-6">
        <form action="login.php" method="post">
          <div class="mb-3">
            <label for="uid" class="form-label">User id</label>
            <input name="uid" type="text" class="form-control" id="uid" aria-describedby="emailHelp">
          </div>

          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input name="password" type="password" class="form-control" id="password" aria-describedby="emailHelp">
          </div>
          <div class="mb-3">

            <input name="captcha1" type="text" class="form-control" id="captcha" aria-describedby="emailHelp"
              value="<?php echo substr(uniqid(), 5); ?>">
          </div>
          <div class="mb-3">
            <input name="captcha2" type="mycaptcha" placeholder="Enter captcha" class=" captcha form-control no-border"
              id="captchacode" aria-describedby="emailHelp">
          </div>

          <button type="submit" class="w-100 btn btn-primary">login</button>
        </form>
        <br>
        <a id="regref" href="<?php echo 'forgotPassword.php'; ?>">forgotPassword?</a>
        <br>
        <span id="span">don't have account</span><a id="regref" href="<?php echo 'signup.php'; ?>">register</a>
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