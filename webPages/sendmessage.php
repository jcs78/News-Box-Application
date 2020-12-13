#!/usr/bin/php
<?php
   include_once 'connection.php';
 if(isset($_POST['send']))
 {
    $name= $_POST['name'];
    $msg= $_POST['msg'];
    $date= date('y-m-d j:i:s');

    $sql-insert = mysqli_query($con, "INSERT INTO message(name,message,cr_date) VALUES ('$name','$msg','$date')");
    if(sql_insert){
       echo"<script>alert('message send successfully');</script>";
    }
    else{
       echo mysqli_error($con);
       exit;
   }
    
}
?>

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
    <link rel="stylesheet" href="send-message.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
    <script src="home.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/js/all.min.js"></script>
  </head>
  <body>
    <!-- This is NavBar -->

<nav class="navbar">
  <div class="inner-width">
    <a href="#" class="logo"></a>
    <button class="menu-toggler">
      <span></span>
      <span></span>
      <span></span>
    </button>
    <!-- Where all the nav bar will list -->
    <div class="navbar-menu">
       <a href="index.php?action=showLandingPage">Landing</a>
       <a href="index.php?action=showHome">Home</a>
       <a href="index.php?action=showLogin">Login</a>
       <a href="index.php?action=showRegister">Register</a>
       <a href="index.php?action=showForum">Forum</a>
       <button class="dropbtn" style="margin-left:15px;border-style: none;">
             <i class="fas fa-envelope" ></i> <span class="badge badge-danger" id="count"><b><?php echo $count; ?></b></span>
              <i class="fa fa-caret-down" id="arrow"></i>
      </button>
      <div class="dropdown-content">
          <a href="#">Action</a>
          <a href="#">Message</a>
          <a href="#">Link 3</a>  
       </div>
    </div>
  </div>
</nav>
    
	  

    <!-- Home -->
    <div class="navbar-menu">
	  <a href="index.php?action=showLandingPage">Landing</a>
    <a href="index.php?action=showHome">Home</a>
	  <a href="index.php?action=showLogin">Login</a>
	  <a href="index.php?action=showRegister">Register</a>
    <a href="index.php?action=showForum">Forum</a>
    </div>

  <section id="home">
      <div class="inner-width">
        <div class="content">
          <h1></h1>
        </div>
      </div>
  </section>

   <!--Message-->
   <div class="contanier"  >
      <div class="row">
        <div class="col-sm-4"></div>
        <div class="col-sm-4">
          
             <form method="post">
               <div class="form-group" style="margin-top:20px;margin-bottom:20px;">
                  <label for="inputName" style="font-size:20px; margin-left: 30px;margin-top:20px;">Name</label><br/>
                  <input type="text" class="form-control" name="name" id="inputName" aria-describedby="nameUsing" placeholder="Enter Your Name"><br/>
      
               </div> 
               <div class="form-group">
                  <label for="inputName" style="font-size:20px; margin-left: 30px;margin-top:20px;">Enter Message</label><br/>
                  <textarea type="text" class="form-control" name="msg" id="inputMessage" aria-describedby="nameUsing" placeholder="Enter Your Message"></textarea>
      
               </div>  
               <button type="submit" name="send" class="btn btn-primary">SEND</button>
             </form>
          
        </div>
     </div>
   </div>
     
     
     
     
   </div>


    <!-- Footer--->

    <footer>
      <div class="inner-width">
        <div class="policy">
          <a class="bt" href="#">About Us</a>
          <a class="bt" href="https://news-box-application.glitch.me/login.html">Login</a>
          <a class="bt" href="https://news-box-application.glitch.me/register.html">Register</a>
        </div>

        <div class="copyright">&copy; | 2020, <a href="#">News Box </a></div>

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
