<?php
session_start();
ini_set('display_errors', 0);
error_reporting(E_ALL & ~E_NOTICE);
include_once("website/config.php");
include_once("website/templates/header.php");

if($_SESSION['authorized'] == false){
    header("location: index.php");
}

$userID = $_SESSION['auth_user'];
$stmt = $conn->prepare("SELECT * FROM person_inf WHERE applicant_ID = ?");
$stmt->execute([$userID]);
$userInfo = $stmt->fetch(PDO::FETCH_ASSOC);
$value = isset($userInfo['birthday']) ? date('Y-m-d', strtotime($userInfo['birthday'])) : '';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST['submit_profile'])) {
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
                    $sql = "UPDATE person_inf SET applicant_profile=:profileImage, last_name=:last_name, first_name=:first_name, middle_name=:middle_name, house_num=:house_num, street=:street, brgy=:barangay, city=:city, sex=:sex, religion=:religion, contact_number=:contactNumber, nationality=:nationality, birthdate=:birthday, birthplace=:birthplace, marital_stat=:status WHERE applicant_ID=:auth_user";
                    
                    $stmt = $conn->prepare($sql);
                    $stmt->execute([
                        ':profileImage' => $uploadFile,
                        ':last_name' => $_POST['lname'],
                        ':first_name' => $_POST['fname'],
                        ':middle_name' => $_POST['midname'],
                        ':house_num' => $_POST['house_num'],
                        ':street' => $_POST['street'],
                        ':barangay' => $_POST['brgy'],
                        ':city' => $_POST['city'],
                        ':sex' => $_POST['sex'],
                        ':religion' => $_POST['religion'],
                        ':contactNumber' => $_POST['contactNumber'],
                        ':nationality' => $_POST['nationality'],
                        ':birthday' => $_POST['birthday'],
                        ':birthplace' => $_POST['birthplace'],
                        ':status' => $_POST['marital_status'],
                        ':auth_user'=>$_SESSION['auth_user']
                    ]);

                    // Update the status of profile set 
                    $sql= "UPDATE acc_inf SET is_profile_set = ? WHERE applicant_ID=?";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute([1,$_SESSION['auth_user']]);

                    echo "Data successfully updated.";

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
    } elseif (isset($_POST['submit_school'])) {
        // Set parameters and execute
        $schoolName = $_POST['school_name'];
        $schoolType = $_POST['scho_type'];
        $tuition = $_POST['tuition'];
        $course = $_POST['course'];
        $currentYearLevel = $_POST['curYear'];

        $applicant_ID = $_SESSION['auth_user'];

        // Prepare and bind
        $stmt = $conn->prepare("UPDATE acad_inf SET school_name=?, school_type=?, tuition_fee=?, course=?, cur_year=? WHERE applicant_ID=?");
        $stmt->execute([$schoolName, $schoolType, $tuition, $course, $currentYearLevel, $applicant_ID]);

        if ($stmt->execute()) {
            echo "Data successfully updated.";
            header("location: home.php");
        } else {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>

<div class="acct_info" style="padding-top: 100px;">
<div class="container mt-5 center">
  <h2 class="mb-4">Applicant Information</h2>

  <form method="POST" enctype="multipart/form-data">
      <?php
      // Display the profile image or a placeholder
      $defaultIcon = 'assets/rl/Logo/profile-icon.png';
      $profileImagePath = isset($_FILES['profileImage']['name']) && !empty($_FILES['profileImage']['name']) ? 'uploads/' . basename($_FILES['profileImage']['name']) : $defaultIcon;
      ?>
      <div class="mb-3">
      <img id="profileImagePreview" src="<?php echo isset($userInfo['applicant_profile']) ? $userInfo['applicant_profile'] : 'assets/rl/Logo/profile-icon.png'; ?>" alt="Profile Image" class="img-thumbnail" style="width: 150px; height: 150px;">
      </div>

      <div class="mb-3">
        <label for="profileImage" class="form-label">Profile Image:</label>
        <input type="file" id="profileImage" name="profileImage" class="form-control" accept="image/*" required onchange="previewImage(event)">
      </div>

      <div class="mb-3">
        <label for="name" class="form-label">Name:</label>
        <div class="row">
          <div class="col-md-4">
          <input type="text" id="lname" name="lname" class="form-control" value="<?php echo isset($userInfo['last_name']) ? $userInfo['last_name'] : ''; ?>" disabled>
          </div>
          <div class="col-md-4">
          <input type="text" id="fname" name="fname" class="form-control" value="<?php echo isset($userInfo['first_name']) ? $userInfo['first_name'] : ''; ?>" disabled>
          </div>
          <div class="col-md-4">
          <input type="text" id="midname" name="midname" class="form-control" value="<?php echo isset($userInfo['middle_name']) ? $userInfo['middle_name'] : ''; ?>" disabled>
          </div>
        </div>
      </div>


    <div class="mb-3">
      <label for="address" class="form-label">Address:</label>
      <div class="row">
          <div class="col-md-3">
          <input type="text" id="house_num" name="house_num" class="form-control" value="<?php echo isset($userInfo['house_num']) ? $userInfo['house_num'] : ''; ?>" required>
          </div>
          <div class="col-md-3">
          <input type="text" id="street" name="street" class="form-control" value="<?php echo isset($userInfo['street']) ? $userInfo['street'] : ''; ?>" required>
          </div>
          <div class="col-md-3">
          <input type="text" id="brgy" name="brgy" class="form-control" value="<?php echo isset($userInfo['brgy']) ? $userInfo['brgy'] : ''; ?>" required>
          </div>
          <div class="col-md-3">
          <input type="text" id="city" name="city" class="form-control" value="<?php echo isset($userInfo['city']) ? $userInfo['city'] : ''; ?>" required>
          </div>
        </div>
    </div>

    <div class="mb-3">
    <label for="sex" class="form-label">Sex:</label>
    <input type="text" id="sex" name="sex" class="form-control" value="<?php echo isset($userInfo['sex']) ? $userInfo['sex'] : ''; ?>" disabled>
</div>

    <div class="mb-3">
      <label for="religion" class="form-label">Religion:</label>
      <input type="text" id="religion" name="religion" class="form-control" value="<?php echo isset($userInfo['religion']) ? $userInfo['religion'] : ''; ?>" disabled>
    </div>

    <div class="mb-3">
      <label for="contactNumber" class="form-label">Contact Number:</label>
      <input type="text" id="contactNumber" name="contactNumber" class="form-control" value="<?php echo isset($userInfo['contact_number']) ? $userInfo['contact_number'] : ''; ?>" required>
    </div>

    <div class="mb-3">
      <label for="nationality" class="form-label">Nationality:</label>
      <input type="text" id="nationality" name="nationality" class="form-control" value="<?php echo isset($userInfo['nationality']) ? $userInfo['nationality'] : ''; ?>" disabled>
    </div>

    <div class="mb-3">
    <label for="birthday" class="form-label">Birthday:</label>
    <input type="date" id="birthday" name="birthday" class="form-control"  value="<?php echo isset($userInfo['birthdate']) ? $userInfo['birthdate'] : ''; ?>" disabled>
    </div>

    <div class="mb-3">
      <label for="birthplace" class="form-label">Birthplace:</label>
      <input type="text" id="birthplace" name="birthplace" class="form-control" value="<?php echo isset($userInfo['birthplace']) ? $userInfo['birthplace'] : ''; ?>"  disabled>
      
    </div>

    <div class="mb-3">
    <label for="marital_status" class="form-label">Status:</label>
    <select id="marital_status" name="marital_status" class="form-select" disabled>
        <option value="">Select</option>
        <option value="Single" <?php if(isset($userInfo['marital_status']) && $userInfo['marital_status'] == 'Single') echo 'selected'; ?>>Single</option>
        <option value="Married" <?php if(isset($userInfo['marital_status']) && $userInfo['marital_status'] == 'Married') echo 'selected'; ?>>Married</option>
        <option value="Legally Separated" <?php if(isset($userInfo['marital_status']) && $userInfo['marital_status'] == 'Legally Separated') echo 'selected'; ?>>Legally Separated</option>
    </select>
</div>

    <button type="submit" name="submit_profile" class="btn btn-primary">Submit</button>
  </form>
</div>
</div>


  <h2 class="mb-4 mt-5 center">School Information</h2>

  <div class="scho_info" style="padding-top: 1px;">
  <div class="container mt-5 center">
    <form method="POST">
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
      <button type="submit" name="submit_school" class="btn btn-primary">Submit</button>
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

