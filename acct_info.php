<?PHP
DEFINE("TITLE", "PROFILE");
include_once("website/templates/header.php");
?>
<body>

<div class="acct_info">
<div class="container mt-5 center">
  <h2 class="mb-4">Applicant Information</h2>

  <form action="submit.php" method="post">
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

<style>
  .center {
    margin: auto;
    width: 50%;
    padding: 10px;
  }
</style>
