<?php
include('smtp/PHPMailerAutoload.php');
include('smtp/mailFuntion.php');

// $to = 'recipients@email-address.com';
// $subject = 'Hello from XAMPP!';
// $message = 'This is a test';
// $headers = "From: your@email-address.com\r\n";
// if (mail($to, $subject, $message, $headers)) {
//    echo "SUCCESS";
// } else {
//    echo "ERROR";
// }
$showSuccess=false;
$showError=false;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $to = $_POST["toemail"];
    $sub = $_POST["subject"];
    $msg = $_POST["message"];
    $m = smtp_mailer($to, $sub, $msg);
    if($m){
        $showSuccess = $m;
    }else{
        $showError = $m;
    }
}
//smtp_mailer('mdt17335@gmail.com', 'test', 'hello this is test mail for practice of php program');
// function smtp_mailer($to, $subject, $msg)
// {
//     $mail = new PHPMailer();
//     $mail->IsSMTP();
//     $mail->SMTPAuth = true;
//     $mail->SMTPSecure = 'tls';
//     $mail->Host = "smtp.gmail.com";
//     $mail->Port = 587;
//     $mail->IsHTML(true);
//     $mail->CharSet = 'UTF-8';
//     //$mail->SMTPDebug = 2; 
//     $mail->Username = "mujahidalam539@gmail.com";
//     $mail->Password = "byoi hqzi nbje qala";
//     $mail->SetFrom("mujahidalam539@gmail.com");
//     $mail->Subject = $subject;
//     $mail->Body = $msg;
//     $mail->AddAddress($to);
//     $mail->SMTPOptions = array(
//         'ssl' => array(
//             'verify_peer' => false,
//             'verify_peer_name' => false,
//             'allow_self_signed' => false
//         )
//     );
//     if (!$mail->Send()) {
//         echo $mail->ErrorInfo;
//     } else {
//         return 'Sent';
//     }
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>send mail</title>
</head>

<body>
    <?php require 'partials/nav.php' ?>

    <?php
        if($showSuccess){
            echo '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>success!</strong> '.$m.'
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            ';
        }
        if($showError){
            echo '
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Error !</strong> '.$m.' !
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            ';
        }

    ?>
    <div class="container">
        <div class="row p-4 d-flex justify-content-center">
            <h1 class="d-flex justify-content-center text-secondary" ><i class="fa-regular fa-envelope me-2"></i>mail sending</h1>
            <div class="col-sm-6">

                <form action="sendmail.php" method="post">
                    <div class="mb-3">
                        <label for="femal" class="form-label">from</label>
                        <input name="femail" type="text" class="form-control" id="femail" aria-describedby="emailHelp"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="temail" class="form-label">to</label>
                        <input name="toemail" type="text" class="form-control" id="toemail" aria-describedby="emailHelp"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="subject" class="form-label">subject</label>
                        <input name="subject" type="text" class="form-control" id="subject" aria-describedby="emailHelp"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">subject</label>
                        <textarea name="message" id="message" class="form-control" cols="30" rows="3"
                            required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">send</button>
                </form>
            </div>
        </div>
    </div>






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

</body>

</html>