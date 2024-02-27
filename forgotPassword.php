
<?php
include 'partials/dbconnect.php';
include('smtp/PHPMailerAutoload.php');
include('smtp/mailFuntion.php');

session_start();
$msg="";
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $semail = $_POST["email"];
    echo $semail;
    $otp = rand(000000,999999);
    $sql = "SELECT * FROM users WHERE email='$semail' ";
    $result = mysqli_query($conn, $sql);
    $rows = mysqli_fetch_assoc($result);
    $selected_email = $rows["email"];

    // echo "selected mail:".$selected_email."<br>";
    // echo "inserted mail:".$semail."<br>";

    if($selected_email == $semail){
        $username=$rows["username"];
        $to = $semail;
        $subject = "Verification code";
        $message = "Hi $username \n This is your otp for forgot passward : $otp ";
        if(smtp_mailer($to, $subject, $message)){
            $_SESSION["otp"]=$otp;
            $_SESSION["email"]= $rows["email"];
            // echo "selected mail:".$selected_email."<br>";
            // echo "inserted mail:".$semail."<br>";
            header("location: otp.php");
        }else{
            $msg= "otp sending failed";
        }
    }else{
        $msg="please ! Enter valid email id";
    }

    // if($result){
    //     if(mysqli_num_rows($result) == 1 ){
            

    //     }
    // }else{
    //     echo"fail";
    // }


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
            height: 100%;
            width: 100%;
            border-radius: 20%;
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
                    <img src="https://imgs.search.brave.com/35Qju4wk2bJNz4RVJHy3fewpmUrSl8e7A4qI3xmy5a0/rs:fit:860:0:0/g:ce/aHR0cHM6Ly9mcmVl/cG5naW1nLmNvbS90/aHVtYi9nbWFpbC83/NTgzNi10ZXh0LWJy/YW5kLWdtYWlsLXRy/aWFuZ2xlLWNvbW11/bmljYXRpb24tcG5n/LWZyZWUtcGhvdG8t/dGh1bWIucG5n"
                            alt="">
                    </div>
                    
                </div>
                <!-- <p><?php echo $msg ?></p> -->
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
                <form action="forgotPassword.php" method="post" >
                    <div class="mb-3">
                        <label for="InputEmail" class="form-label"><i class="fa-solid fa-envelope ms-3 me-2"></i>Email address</label>
                        <input name="email" placeholder="Enter your email" type="InputEmail" class="form-control" aria-describedby="emailHelp" required>
                    </div>
                    <button type="submit" class=" mb-3 btn btn-success w-100">send mail</button>
                </form>
            </div>
        </div>
    </div>










    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

</body>

</html>