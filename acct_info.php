<?PHP
session_start();
DEFINE("TITLE", "PROFILE");

include_once("website/templates/header.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate and upload the profile image
    $uploadDir = 'uploads/';
    $uploadFile = $uploadDir . basename($_FILES['profileImage']['name']);
    $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));
    $allowedTypes = ['jpg', 'jpeg', 'png', 'pdf'];

    if (in_array($imageFileType, $allowedTypes)) {
        if (move_uploaded_file($_FILES['profileImage']['tmp_name'], $uploadFile)) {
            // Prepare PDO statement
            try {
                $pdo = new PDO($dsn, $username, $password, $options);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql = "INSERT INTO applicants (profileImage, name, address, sex, religion, contactNumber, nationality, birthday, birthplace, status)
                        VALUES (:profileImage, :name, :address, :sex, :religion, :contactNumber, :nationality, :birthday, :birthplace, :status)";
                
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    ':profileImage' => $uploadFile,
                    ':name' => $_POST['name'],
                    ':address' => $_POST['address'],
                    ':sex' => $_POST['sex'],
                    ':religion' => $_POST['religion'],
                    ':contactNumber' => $_POST['contactNumber'],
                    ':nationality' => $_POST['nationality'],
                    ':birthday' => $_POST['birthday'],
                    ':birthplace' => $_POST['birthplace'],
                    ':status' => $_POST['status']
                ]);

                echo "Data successfully submitted.";
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

<div class="acct_info" style="padding-top: 5%;">
<div class="container mt-5 center">
  <h2 class="mb-4">Applicant Information</h2>

  <form action="submit.php" method="post" enctype="multipart/form-data">
      <div class="mb-3">
        <label for="profileImage" class="form-label">Profile Image:</label>
        <input type="file" id="profileImage" name="profileImage" class="form-control" accept="image/*" required>
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
      <label for="status" class="form-label">Status:</label>
      <input type="text" id="status" name="status" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>
</div>

<?PHP
include_once("website/templates/footer.php");
?>
