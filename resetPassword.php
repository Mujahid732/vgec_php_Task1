
<?php
include 'partials/dbconnect.php';
include('smtp/PHPMailerAutoload.php');
include('smtp/mailFuntion.php');
session_start();
$msg ="";
$email = $_SESSION["email"];
echo "This is user email".$email;
if ($_SERVER['REQUEST_METHOD']=="POST") {
    $newPassword = $_POST["pass"];
    $cnewPassword= $_POST["cpass"];
    $email = $_SESSION["email"];
    
    if($newPassword==$cnewPassword){
        $hashed_password = password_hash($newPassword, PASSWORD_DEFAULT);
        $sql = "
        update users set password = '$hashed_password' where email = '$email'";
        $result = mysqli_query($conn, $sql);
        if($result){
            session_unset();
            session_destroy();
            header("location: home.php");
            

        }else{
            $msg = "some technical issue is there";
        }

    }else{
        $msg = "Your password does not match";
    }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        
    <!--font awsome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .heading{
            width: 100%;
            height: 250px;
            display: flex;
            justify-content: center;
        }
        .heading .image{
            width: 350px;
            height: 200px;
        }
        .heading .image img{
            height: 90%;
            width: 70%;
            margin-top: 5%;
            margin-bottom: 5%;
            margin-left: 15%;
            margin-right: 15%;
            border-radius: 20%;
            color: green;
            box-shadow: 5px 4px 1px green;
        }
        .round{
            border-radius: 35px;
        }
        label{
            font-family: Arial, Helvetica, sans-serif;
            color: #333;
            font-size: 1.2rem;

        }
        #InputEmail1{
            height: 50px;
            border-color: green;
            font-size: 1.5rem;

        }
    </style>
</head>

<body>

    <div class="container  ">
        <div class="row p-4 d-flex justify-content-center">
            <div class="col-5 round  shadow-lg  p-4">
                <div class="heading">
                    <div class="image">
                    <img src="https://imgs.search.brave.com/PJtKgx53U2KoJszuNYcpjbnThz8iU1Iwg12oS3TWKPg/rs:fit:860:0:0/g:ce/aHR0cHM6Ly93d3cu/cG5nYWxsLmNvbS93/cC1jb250ZW50L3Vw/bG9hZHMvMTAvTG9j/ay1TaWxob3VldHRl/LVBORy1JbWFnZXMu/cG5n"
                            alt="">
                    </div>
                </div>
                <?php 
                    if($msg){
                        echo'
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>'.$msg.'!</strong> 
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        ';
                    }

                ?>
                <form action="resetPassword.php" method="post">
                    <div class="mb-3">
                        <label for="pass" class="form-label"><i class="fa-solid fa-key ms-2 me-2"></i>New password</label>
                        <input name="pass" placeholder="Enter new password" id="pass" type="text" class="form-control" aria-describedby="emailHelp" required>
                    </div>
                    <div class="mb-3">
                        <label for="cpass" class="form-label"><i class="fa-solid fa-key ms-2 me-2"></i></i>Confirm password</label>
                        <input name="cpass" placeholder="Enter confirm password" id="cpass" type="text" class="form-control" aria-describedby="emailHelp" required>
                    </div>
                    <button type="submit" class=" mb-3 btn btn-success w-100">submit</button>
                </form>
            </div>
        </div>
    </div>










    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

</body>

</html>