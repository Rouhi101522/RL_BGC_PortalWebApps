<?php 
DEFINE("TITLE", "ACCOUNT CREATION");
include_once("website/templates/header.php");
?>

<body>
<div class="signUpBody" style="padding-top: 6em;">
    <div class="container-fluid">
        <div class="row">
            <!-- Account creation form -->
            <div class="col-md-6 offset-md-3">
                <h2 class="text-center">Create an Account</h2>
                <form class="mt-4" action="submit_acct_cre.php" method="post">
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
                    <button type="submit" class="btn btn-primary">Create Account</button>
                </form>
            </div>
        </div>
    </div>
</div>


<?php 
include_once("website/templates/footer.php");
?>