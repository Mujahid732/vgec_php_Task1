
<?php

$servernaem = "localhost";
$username = "root";
$password = "";
$database = "vgecDB";

$conn = mysqli_connect($servernaem, $username, $password, $database);
if(!$conn){
    die("connection failed". mysqli_connect_error());
}

?>