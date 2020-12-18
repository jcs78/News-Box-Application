<?php
	$forumPosts = $_SESSION['forumPosts'];

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width= device-width, initial-scale = 1.0" />
    <title>Forum</title>

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
    <link rel="stylesheet" href="forum.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
    <script src="homeScript.js"></script>
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

    <section id="forum">
        <div id="wrapper">
        <div id="menu" >
           <button class="btn" href="#" >Home</button>  
    </secion>
    <!--show all the created topic here-->
	<?php foreach($forumPosts as $forumPost):?>

         <section class="article">
                <div>
                        <form action="index.php" method="post">
                                <button type ="submit">
                                        <input type="hidden" name="action" value="showSingleForumPost">
                                        <input type="hidden" name="forumPostID" value="<?php echo $forumPost['postID']; ?>">
                                        <div>
                                                <span><?php echo $forumPost['postTitle'];?></span>
                                                <p><?php echo $forumPost['postContent'];?></p>
                                        </div>
                                </button>
                        </form
                </div>

               <div class="topTrends" item="top"></div>

        <?php endforeach;?>


          
          <button class="btn" href="#" >Create a topic</button> 
          	  <div id="content">
	                <div id="createTopic">
	                <h1>Create a Topic</h1><br><br>
	                Topic name: <input type="text" name="topic_name" /><br><br>
	                Topic description: <textarea name="topic_description"></textarea><br><br>
	                <input type="submit" value="submit" id="forumPostCreation" />
	               </div>
	            </div>
          
             
         
           <button class="logout" style="margin-left: 100px;" href="#">Log Out</button>
      </div>
      </div>
     <br>
     <br>
      

    
<script>
// Javascript is used here to show the opening and closing functionality of the tab
 var acc = document.getElementsByClassName("btn");
 var i;

// this for loop will check all the tabs with className "accordion" and provide them the same functionality
for (i = 0; i < acc.length; i++) {
      acc[i].addEventListener("click", function () {
        this.classList.toggle("active");
        var panel = this.nextElementSibling;
        if (panel.style.display === "block") {
          panel.style.display = "none";
        } else {
          panel.style.display = "block";
        }
      });
    }
</script>
 



    <!-- Footer-->

    <footer>
      <div class="inner-width" >
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

