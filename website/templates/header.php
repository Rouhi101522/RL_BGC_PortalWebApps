<html>
<head>
    <title>
        <?php
        // Print the page title
        if (defined('TITLE')) {
            // Is the title defined
            print TITLE;
        } else {
            // Title is not defined
            print "All about the main title of the page...";
        }
        ?>
    </title>
    <link rel="stylesheet" href="css/styles_css.css">
</head>
<body>
<div class="header">
      <div class="row">
        <nav class="navbar navbar-dark fixed-top" style="background-color: #71bf43; height: 5em;">
          <div class="container-fluid">
            <a class="navbar-brand" href="#">
              <img src="assets\rl\Logo\Real LIFE Logo black.png" alt="Logo" style="width: 5cm; ">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

            <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel" style="background-color: #71bf43;">
              <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Menu</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
              </div>

              <!-- Navbar
              -->
              <div class="offcanvas-body" style="background-color: #71bf43;">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Log in</a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link" href="#">Home</a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link" href="#">Announcements</a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link" href="#">Frequently Asked Questions</a>
                  </li>
                  
                  <!--
                    This nav dropdown button is reserved for more features

                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Dropdown
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark">
                      <li><a class="dropdown-item" href="#">Action</a></li>
                      <li><a class="dropdown-item" href="#">Another action</a></li>
                      <li>
                        <hr class="dropdown-divider">
                      </li>
                      <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                  </li>
                  -->
                </ul>
                <form class="d-flex mt-3" role="search">
                  <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                  <button class="btn btn-success" type="submit">Search</button>
                </form>
              </div>
            </div>
          </div>
        </nav>  
      </div>
    </div>
    </table>
