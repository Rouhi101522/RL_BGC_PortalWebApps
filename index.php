<?php 
DEFINE("TITLE", "LOGIN");
?>
<!DOCTYPE HTML>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Log In</title>
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="bootstrap-5.3.3-dist\bootstrap-5.3.3-dist\css\bootstrap.min.css"> <!-- local Btsrp file -->
    
    <body>
    <nav class="navbar">
  <div class="container-fluid">
  <img class="navbar-brand" src="assets\rl\Logo\Real LIFE Logo ON black.png" alt="Logo">
    </div>
    </nav>
        <div class="main-content">
            <div class="left-panel">
                <h1><i>Hello aspiring RealLife Scholar</i></h1>
                <form action="login.php" method="post">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                    
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                    <br>
                    <button type="submit">Sign In</button>
                </form>
                <p>Don't have an account? <a href="acct_cre.php">Create one!</a></p>
            
            </div>
            <div class="right-panel">
                <img src="assets\rl\REALLIFE PORTAL GRAPHIC DESIGNS.jpeg" alt="Group Photo">
            </div>

        </div>
    </div>
</body>
</html>

<?PHP
ini_set('display_errors', 1);
error_reporting(E_ALL & ~E_NOTICE);



?>