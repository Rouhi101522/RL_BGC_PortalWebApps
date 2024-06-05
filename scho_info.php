<?php
session_start();
include_once("website/config.php");

if($_SESSION['authorized'] == false){
    header("location: index.php");
  }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

// Set parameters and execute
$schoolName = $_POST['school_name'];
$schoolType = $_POST['scho_type'];
$tuition = $_POST['tuition'];
$course = $_POST['course'];
$currentYearLevel = $_POST['curYear'];

$applicant_ID = $_SESSION['auth_user'];

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO acad_inf (applicant_ID,school_name, school_type, tuition_fee, course, cur_year) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->execute([$applicant_ID, $schoolName, $schoolType, $tuition, $course, $currentYearLevel]);

if ($stmt->execute()) {
    echo "New record created successfully";
    header("location: home.php");
} else {
    echo "Error: " . $e->getMessage();
}
}

?>

<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="assets\rl\Logo\favicon.ico">
    <title>Account Creation</title>
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="bootstrap-5.3.3-dist/bootstrap-5.3.3-dist/css/bootstrap.min.css"> <!-- local Bootstrap file -->
</head>
<body>
<nav class="navbar ">
  <div class="container-fluid">
    <img class="navbar-brand" src="assets/rl/Logo/Real LIFE Logo ON black.png" alt="Logo">
  </div>
</nav>
<div class="scho_info" style="padding-top: 1px;">
<div class="container mt-5 center">
  <h2 class="mb-4">School Information</h2>

  <form method="POST" enctype="multipart/form-data">
    <div class="mb-3">
      <label for="name" class="form-label">School Name:</label>
      <input type="text" id="school_name" name="school_name" placeholder="(eg. University of Makati)" class="form-control" required>
    </div>

    <div class="mb-3">
      <label for="scho_type" class="form-label">School Type:</label>
      <select id="scho_type" name="scho_type" class="form-select" required>
        <option value="">Select</option>
        <option value="Private">Private</option>
        <option value="Public">Public</option>
      </select>
    </div>

    <div class="mb-3">
      <label for="Tuition" class="form-label">Tuition Fee:</label>
      <input type="tuition" id="tuition" name="tuition" placeholder="(eg. 10,000.00)" class="form-control" required>
    </div>

    <div class="mb-3">
      <label for="course" class="form-label">Course:</label>
      <input type="course" id="course" name="course" placeholder="(eg. Diploma In Application Development)"class="form-control" required>
    </div>

    <div class="mb-3">
      <label for="curYear" class="form-label">Current Year Level:</label>
      <select id="curYear" name="curYear" class="form-select" required>
        <option value="">Select</option>
        <option value="7th Junior High School">7th Junior High School</option>  
        <option value="8th Junior High School">8th Junior High School</option>
        <option value="9th Junior High School">9th Junior High School</option>
        <option value="10th Junior High School">10th Junior High School</option>
        <option value="11th Senior High School">11th Senior High School</option>
        <option value="12th Senior High School">12th Senior High School</option>
        <option value="1st College">1st College</option>
        <option value="2nd College">2nd College</option>
        <option value="3rd College">3rd College</option>
        <option value="4th College">4th College</option>
      </select>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>
</div>

<?PHP
include_once("website/templates/footer.php");
?>
