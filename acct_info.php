<?php
session_start();
include_once("website/config.php");

  if($_SESSION['authorized'] == false){
    header("location: index.php");
  }


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate and upload the profile image
    $uploadDir = 'uploads/';
    $uploadFile = $uploadDir . basename($_FILES['profileImage']['name']);
    $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));
    $allowedTypes = ['jpg', 'jpeg', 'png', 'pdf'];

    // Uploading 
    if (in_array($imageFileType, $allowedTypes)) {
        if (move_uploaded_file($_FILES['profileImage']['tmp_name'], $uploadFile)) {
            // Prepare PDO statement
            try {
              // PREPARE FOR SESSION SETTING
              //  $sql = "INSERT INTO person_inf (applicant_profile, name, address, sex, religion, contact_number, nationality, birthday, birthplace, marital_stat)
              //           VALUES (:profileImage, :name, :address, :sex, :religion, :contactNumber, :nationality, :birthday, :birthplace, :status)";
                
              //   $stmt = $conn->prepare($sql);
              //   $stmt->execute([
              //       ':applicant_ID' => $_POST['applicant_ID'],
              //       ':profileImage' => $uploadFile,
              //       ':name' => $_POST['name'],
              //       ':address' => $_POST['address'],
              //       ':sex' => $_POST['sex'],
              //       ':religion' => $_POST['religion'],
              //       ':contactNumber' => $_POST['contactNumber'],
              //       ':nationality' => $_POST['nationality'],
              //       ':birthday' => $_POST['birthday'],
              //       ':birthplace' => $_POST['birthplace'],
              //       ':status' => $_POST['marital_status'],

                
                $sql = "INSERT INTO person_inf (applicant_ID, applicant_profile, name, address, sex, religion, contact_number, nationality, birthdate, birthplace, marital_stat)
                        VALUES (:auth_user,:profileImage, :name, :address, :sex, :religion, :contactNumber, :nationality, :birthday, :birthplace, :status)";
                
                $stmt = $conn->prepare($sql);
                $stmt->execute([
                    ':auth_user'=>$_SESSION['auth_user'],
                    ':profileImage' => $uploadFile,
                    ':name' => $_POST['name'],
                    ':address' => $_POST['address'],
                    ':sex' => $_POST['sex'],
                    ':religion' => $_POST['religion'],
                    ':contactNumber' => $_POST['contactNumber'],
                    ':nationality' => $_POST['nationality'],
                    ':birthday' => $_POST['birthday'],
                    ':birthplace' => $_POST['birthplace'],
                    ':status' => $_POST['marital_status'],
                ]);
                echo "Data successfully submitted.";

                header("location:scho_info.php");
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        } else {
            echo "Error uploading file.";
        }
    } else {
        echo "Invalid file type.";
    }
}
?>

<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="assets/rl/Logo/favicon.ico">
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
<div class="acct_info" style="padding-top: 5px;">
<div class="container mt-5 center">
  <h2 class="mb-4">Applicant Information</h2>

  <form method="POST" enctype="multipart/form-data">
      <?php
      // Display the profile image or a placeholder
      $defaultIcon = 'assets/rl/Logo/profile-icon.png';
      $profileImagePath = isset($_FILES['profileImage']['name']) && !empty($_FILES['profileImage']['name']) ? 'uploads/' . basename($_FILES['profileImage']['name']) : $defaultIcon;
      ?>
      <div class="mb-3">
        <img id="profileImagePreview" src="<?php echo $profileImagePath; ?>" alt="Profile Image" class="img-thumbnail" style="width: 150px; height: 150px;">
      </div>

      <div class="mb-3">
        <label for="profileImage" class="form-label">Profile Image:</label>
        <input type="file" id="profileImage" name="profileImage" class="form-control" accept="image/*" required onchange="previewImage(event)">
      </div>

    <div class="mb-3">
      <label for="name" class="form-label">Name:</label>
      <input type="text" id="name" name="name" class="form-control" required>
    </div>

    <div class="mb-3">
      <label for="address" class="form-label">Address:</label>
      <textarea id="address" name="address" class="form-control" rows="4" required></textarea>
    </div>

    <div class="mb-3">
      <label for="sex" class="form-label">Sex:</label>
      <select id="sex" name="sex" class="form-select" required>
        <option value="">Select</option>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
      </select>
    </div>

    <div class="mb-3">
      <label for="religion" class="form-label">Religion:</label>
      <input type="text" id="religion" name="religion" class="form-control" required>
    </div>

    <div class="mb-3">
      <label for="contactNumber" class="form-label">Contact Number:</label>
      <input type="tel" id="contactNumber" name="contactNumber" class="form-control" required>
    </div>

    <div class="mb-3">
      <label for="nationality" class="form-label">Nationality:</label>
      <input type="text" id="nationality" name="nationality" class="form-control" required>
    </div>

    <div class="mb-3">
      <label for="birthday" class="form-label">Birthday:</label>
      <input type="date" id="birthday" name="birthday" class="form-control" required>
    </div>

    <div class="mb-3">
      <label for="birthplace" class="form-label">Birthplace:</label>
      <input type="text" id="birthplace" name="birthplace" class="form-control" required>
    </div>

    <div class="mb-3">
      <label for="marital_status" class="form-label">Status:</label>
      <select id="marital_status" name="marital_status" class="form-select" required>
        <option value="">Select</option>
        <option value="Single">Single</option>
        <option value="Married">Married</option>
        <option value="Legally Separated">Legally Separated</option>
      </select>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>
</div>

<?php
include_once("website/templates/footer.php");
?>

<script>
function previewImage(event) {
    var reader = new FileReader();
    reader.onload = function() {
        var output = document.getElementById('profileImagePreview');
        output.src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
}
</script>

</body>
</html>
