<?php
session_start();
include_once("website/config.php");


$applicant_ID = $_SESSION['auth_user'];

$stmt = $conn->prepare("SELECT * FROM `messages` WHERE `user_id`= ?  `receiver`='admin'");
$stmt->bindParam(":applicant_ID", $applicant_ID, PDO::PARAM_STR);
$stmt->execute();
$messages = $stmt->fetch(PDO::FETCH_ASSOC);



foreach ($messages as $message) {
    echo "<div class='message'>";
    echo "<strong>" . htmlspecialchars($message['sender']) . "</strong><br>";
    echo htmlspecialchars($message['message']) . "<br>";
    echo "<small>" . htmlspecialchars($message['created_at']) . "</small>";
    echo "</div><hr>";
}


?>
 