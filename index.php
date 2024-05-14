<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RealLife Application Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  </head>

  <body>
<?PHP 
DEFINE("TITLE","APPLICATION");
include_once("website/templates/header.php");
?>
    <div class="signInBody" style="padding-top: 6em;">
      <div class="container-fluid">
        <div class="row">
            <!-- Left side for signing -->
            <div class="col-md-9 ">
              <p>This is the right side (3/4).</p>

              <div class="login-form-container">
                <div class="login-form d-flex flex-column">
                  <form class="d-flex flex-column ng-valid ng-dirty ng-touched" novalidate="">
                    <!---->
                    <label class="sub-section-title-primary" for="username">Email Address</label>
                    <input formcontrolname="username" id="username" name="username" type="text">
                    <label class="sub-section-title-primary pt-20" for="password">Password</label>
                    <input formcontrolname="password" id="password" name="password" type="password">
                    <p class="ml-auto pt-10 sub-section-title-secondary" style="cursor: pointer;"><a href="applicant_info.html">Create an account</a></p>
                    <div class="pt-20 text-center"> 
                      <button class="button-sign-in btn btn-primary " type="submit" > Sign In</button>
                    </div>
                  </form>
                </div>
              </div>
          </div>
            <!-- Right side for bg -->
            <div class="col-md-3 ">
              <p>This is the left side (1/4).</p>
              <img src="assets\rl\testSamplePics.jpg" alt="Image" style="height: 30em; width: auto;">
          </div>
        </div>
    </div>


    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  
  </body>
</html>