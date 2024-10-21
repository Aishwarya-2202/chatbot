<?php
session_start();
include 'connection.php';

if(isset($_POST['verify'])) {
    $entered_otp = $_POST['otp'];
    if($entered_otp == $_SESSION['otp']) {
        // Save the user data to the database
        $username = $_SESSION['username'];
        $email = $_SESSION['otp_email'];
        $password = $_SESSION['password'];
        $gender = $_SESSION['gender'];
        
        $query = "insert into login(name, email, password, gender) values('$username', '$email', '$password', '$gender')";
        $query_run = mysqli_query($connection, $query);
        if($query_run) {
            header("location:signin.php");
        } else {
            echo '<script type="text/javascript">alert("Data not saved")</script>';
        }
    } else {
        echo '<script type="text/javascript">alert("Invalid OTP")</script>';
    }
}
?>

<DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
    <link rel="stylesheet" href="loginstyle.css">
</head>
<body>
    <div class="container">
        <div class="regform">
            <form action="" method="post">
                <p class="logo"><b style="color: #ab4040;">Verify OTP</b></p>
                <div class="input">
                    <label class="textlabel" for="otp">Enter OTP</label><br>
                    <input type="text" id="otp" name="otp" required/>
                </div>
                <div class="btn">
                    <button type="submit" name="verify">Verify</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
