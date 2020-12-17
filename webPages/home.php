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
    <link rel="stylesheet" href="home.css" />
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
   <!-- get the status of unread message from message table in the database --> 
   <?php
          //$sql_get = mysqli_query($con, "SELECT * FROM message WHERE status=0");
          //$count = mysqli_num_rows($sql_get);

    ?>
    <!-- Where all the nav bar will list -->
     <div class="navbar-menu">
           <a href="index.php?action=showLandingPage">Landing</a>
           <a href="index.php?action=showHome">Home</a>
           <a href="index.php?action=showLogin">Login</a>
           <a href="index.php?action=showRegister">Register</a>
           <a href="index.php?action=showForum">Forum</a>
       
           <button class="dropbtn" style="margin-left:15px;border-style: none;">
              <i class="fas fa-envelope" ></i> <span class="badge badge-danger" id="count"><b><?php //echo $count; ?></b></span>
              <i class="fa fa-caret-down" id="arrow"></i>
           </button>
         <div class="dropdown-content">
               <a href="#">Action</a>
               <a href="#">Message</a>
         </div>
    </div>
  </div>
</nav>

    <!-- Home -->

  <section id="home">
      <div class="inner-width">
        <div class="content">
          <h1></h1>
        </div>
      </div>
  </section>

  <!--References-->
<section id="edit">
    <div class="editRef">
      <form>

        <div class="checkBox">
           <br>
           <label style="color: lightskyblue; font-size: 30px;" >Edit Your References</label><br>
           <br><input type="checkbox" id="ref1" name="ref1" value="Bss">
           <label for="userRef1"> Business</label><br>
           <br><input type="checkbox" id="ref2" name="ref2" value="Ettm">
           <label for="userRef2"> Entertainment </label><br>
           <br><input type="checkbox" id="ref3" name="ref3" value="Hth">
           <label for="userRef3"> Health</label><br>
           <br><input type="checkbox" id="ref4" name="ref4" value="Sci">
           <label for="userRef4"> Science</label><br>
           <br><input type="checkbox" id="ref5" name="ref5" value="Sprt">
           <label for="userRef5"> Sports </label><br>
           <br><input type="checkbox" id="ref6" name="ref6" value="Tech">
           <label for="userRef6"> Technology</label><br><br>
        </div>
        
        <br /><input
          type="submit"
          id="loginSubmit"
          name=""
          value="EDIT"
          style="color: white;"
        />
      </form>
    </div>
  </section>
  
		 
 <!--Display articles-->
        <?php foreach($articles as $article):?>

         <section class="article">
		<div>
			<form action="index.php" method="post">
				<button type ="submit">
					<input type="hidden" name="action" value="showSingleArticle">
					<input type="hidden" name="articleID" value="<?php echo $article['articleID']; ?>">
					<div>
		                                <span><?php echo $article['articleTitle'];?></span>
		                                <p><?php echo $article['description'];?></p>
					</div>
				</button>
			</form
		</div>

		<!--
                <button id="rlt" class="result" item="general">
			<form action="index.php" method="post" >
				<input type="hidden" name="action" value="showSingleArticle">
                        	<span><?php echo $article['articleTitle'];?></span>
                        	<p><?php echo $article['description'];?></p>
				<input type="hidden"  name="articleID"
					value="<?php echo $article['articleID']; ?>"
				>
				<input type="submit" value="article">
			</form>
                </button>
		-->

                <div class="topTrends" item="top"></div>

        <?php endforeach;?>

<!--
      <div class="commentForm">

        <textarea type="commentDisplay" name="display"></textarea>
      
        <h2>Leave a comment</h2>
        <form>
             <textarea type="textarea" name="comments" required="required" placeholder="Enter your comment here!" text-align="left" ></textarea>
             
             
             <input type="submit" id ="postCm" name="POST" value="Comment">
          
            </form>
      </div>
-->
  </section>


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

