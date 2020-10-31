<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width= device-width, initial-scale = 1.0" />
    <title>News Box</title>
    <link
      rel="shortcut icon"
      href="https://cdn.glitch.com/5ee84088-d31b-4f20-89d8-592128411228%2Ffavicon-32x32%5B1%5D.png?v=1602708884887"
      type="image/x-icon"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/fontawesome.min.css"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.cs"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=David+Libre:wght@400;500;700&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css"
    />
    <link rel="stylesheet" href="login.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
    <script src="login.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/js/all.min.js"></script>
  </head>
  <body>
    <!-- This is NavBar -->

	<?php include('abstractViews/nav.php'); ?>

    <!-- Home -->
    <section id="home">
      <div class="inner-width">
        <div class="content">
          <h1></h1>
          <!--
          
          <div class="sm">
            <a href="#" class="fa fa-facebook"></a>
            <a href="#" class="fa fa-twitter"></a>
            <a href="#" class="fa fa-google"></a>
            <a href="#" class="fa fa-linkedin"></a>
            <a href="#" class="fa fa-youtube"></a>
          </div>
          
          -->

        </div>
      </div>
    </section>

    <section id="login"></section>
        <div class="loginForm" >
          <form action = "index.php" method="post">



	    <input type="hidden" name="action" value="validateLogin">


            <div class="inputBox">
              <br /><label style="color: lightskyblue;"> Username </label>
              <label style="color:red;">* </label>
              <input
                type="text"
                name="username"
		id="email"
                required="required"
                placeholder="Enter Your Name"
              />
            </div>
            <div class="inputBox">
              <br /><label style="color: lightskyblue;"> Password </label>
              <label style="color:red;">* &nbsp;</label>
              <input
                type="password"
                name="password"
		id="password"
                required="required"
                placeholder="Enter Your Password"
              />
            </div>
            <div class="links">
              <label>Don't have an account?</label>
              <a href="register.html" style="color: lightskyblue;"
                > Create an account</a
              >
            </div>
            <br /><input
              type="submit"
              id="loginSubmit"
              name=""
              value="LOG IN"
              style="color: white;"
            />
          </form>
        </div>
    </section>


    <!-- Footer--->

    <footer>
      <div class="inner-width">
        <div class="policy">
          <a class="bt" href="#">About Us</a>
          <a class="bt" href="#">Login</a>
          <a class="bt" href="#">Register</a>
        </div>

        <div class="copyright">
          &copy; | 2020, <a href="#">News Box </a>
        </div>

        <div class="sm">
          <a href="#"><i class="fab fa-facebook-f"></i></a>
          <a href="#"><i class="fab fa-twitter"></i></a>
          <a href="#"><i class="fab fa-instagram"></i></a>
        </div>
      </div>
    </footer>
    <!--Go Back Top-->
    <button class="goTop fas fa-arrow-up"></button>
  </body>
</html>

