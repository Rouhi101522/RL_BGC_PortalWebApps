
<?php
session_start();
DEFINE("TITLE", "ACCOUNT CREATION");


ini_set('display_errors', 1);
error_reporting(E_ALL & ~E_NOTICE);

require 'website/PHPMailer/PHPMailer.php';
require 'website/PHPMailer/SMTP.php';
require 'website/PHPMailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passcheck = $_POST['confirm_password'];

    $verification_code = rand(100000,999999);
    $is_applicant = '1';

    if ($password != $passcheck) {
        $_SESSION['status'] = "Passwords do not match. Please try again.";
        header("Location: acct_cre.php");
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['status'] = "Invalid email format. Please try again.";
        header("Location: acct_cre.php");
        exit();
    }

    if (strlen($password) < 8) {
        $_SESSION['status'] = "Password must be at least 8 characters long.";
        header("Location: acct_cre.php");
        exit();
    }

    //ADD password validations

    $passwordHashed = md5($password);

    // Database connection
    include_once("website/config.php");

    $stmt = $conn->prepare("SELECT * FROM acc_inf WHERE user = ?");
    $stmt->execute([$email]);

    if ($stmt->rowCount() > 0) {
        $_SESSION['status'] = "Email already exists. Please use a different email.";
        header("Location: acct_cre.php");
        exit();
    }

    $stmt = $conn->prepare("INSERT INTO acc_inf (user, pass, ver_code) VALUES (?, ?, ?)");
    if ($stmt->execute([$email, $passwordHashed, $verification_code])) {
        // Send verification email
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com'; // Set the SMTP server to send through
            $mail->SMTPAuth   = true;
            $mail->Username   = ' reallifebgcapplicationportal@gmail.com'; // Your Gmail address
            $mail->Password   = 'zvcc ltje unzj awpb'; // Your Gmail app-specific password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;
            

            //Recipients
            $mail->setFrom('reallifebgcapplicationportal@gmail.com');
            $mail->addAddress($email);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Account Verification';
            $mail->Body    = 'Please click on the link to verify your account. <br> <a href="http://localhost/RL_BGC_PortalWebApps/index.php?verification='.$verification_code."applicant=". $is_applicant.'" target="_blank">VERIFY EMAIL</a>';

            $mail->send();
            $_SESSION['status'] = 'Registration successful! Please check your email to verify your account.';
            header("Location: acct_cre.php");
            
        } catch (Exception $e) {
            $_SESSION['status'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            header("Location: acct_cre.php");
        }
    } else {
        $_SESSION['status'] = 'Registration failed! Please try again.';
        header("Location: acct_cre.php");
    }
    exit();
}
?>

<?PHP
include_once("website/templates/header.php");
?>

<div class="signUpBody" style="padding-top: 6em; height: 92vh;">
    <div class="container">
        <div class="row">
            <!-- Account creation form -->
            <div class="col-md-6 offset-md-3">
                <h2 class="text-center">Create an Account</h2>
                <form class="mt-4" method="POST" action="">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                    </div>
                    <div class="message">
                        <?php 
                        if(isset($_SESSION['status'])){
                            ?>
                            <div class="alert alert-danger d-flex align-items-center" role="alert">
                                <div>
                                    <?= $_SESSION['status'] ?>
                                </div>
                            </div>
                            <?php
                            unset($_SESSION['status']);
                        }
                        ?>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Create Account</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php 
include_once("website/templates/footer.php");
?>