#!/usr/bin/php
<?php
        //include_once("connection.php");
	//include("abstractViews/header.php");
	//session_start();

	$articlesByPref = $_SESSION['articles'];

	foreach($articlesByPref as $singleArticle){
		if($singleArticle['articleID'] == $_SESSION['currentArticleID']){
			$article = $singleArticle;
		}
	}

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
    <link rel="stylesheet" href="singleArticle.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
    <script src="singleArticle.js"></script>
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
 
<div class="articleTitle">
  <a href="<?php echo $article['url'];?>"> <span><?php echo $article['articleTitle'];?></span></a>
  
  <br><img 
      src="<?php echo $article['urlToImage'];?>" >
  <div class="description">
     <p><?php echo $article['description'];?></p>
    
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

