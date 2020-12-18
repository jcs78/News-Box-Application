#!/usr/bin/php
<?php
   //include_once("connection.php");
	//include("abstractViews/header.php");
	//session_start();

	$articlesByPref = $_SESSION['articles'];
	//$articles = $articlesByPref['general'];
	//$article = $articles[0];
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
    <link rel="stylesheet" href="singleForumPost.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
    <script src="singleForumPost.js"></script>
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
        </div>
      </div>
  </section>

 
 <!--Display articles-->
 
<div class="forumTopic">
  <span>Forum topic<?php echo $forum['forumTopic'];?></span>
  

  <div class="forumInfo">
     <p>Forum contents here<?php echo $forum['forumInfo'];?></p>
    
  </div>
</div>

    
    <!--Comment-->
  <div class="commentForm">
    <h2>Discussion</h2>
    <textarea type="commentDisplay" name="display"> Show all the discussion here</textarea>
     
        <form>
             <textarea type="textarea" name="comments" required="required" placeholder="Enter your discussion here!" text-align="left" ></textarea>
            
             <br><input type="submit" id ="postCm" name="POST" value="COMMENT">
          
            </form>
      </div>
    <!-- Footer--->

    <footer>
      <div class="inner-width">
        <div class="policy">
          <a class="bt" href="#">About Us</a>
          <a class="bt" href="https://news-box-application.glitch.me/login.html">Login</a>
          <a class="bt" href="https://news-box-application.glitch.me/register.html">Register</a>
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

