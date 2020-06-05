<?php     
    require_once "addPosts/login.php" ; 
?>
<!DOCTYPE html>
<html>
    <head>
        <title>All Posts</title>
        <link rel="stylesheet" href="fontawesome/css/all.css" >
        <link rel="stylesheet" href="style.css" type="text/css">
        <link rel="icon" type="image/png" href="favicon.ico" />
      <!--  <script type="text/javascript" src="jquery-3.5.0.js">  </script> -->
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
<body>
<div class="firstDiv">
<div class="topBar">
<!----------------- hyperlinks area ---------------------------------------->
<?php
require "header.html" ;
?>
</div>
<div class="page">
<!----------------- categories area ---------------------------------------->
<?php
    require "categories.php" ;
?> 
<div class="AllPostDiv">
<!----------------- All Posts Blocks By Category Area ---------------------------------------->
<?php
if(isset($_GET['category'])) {
    $get = $_GET['category']; 
    $query = "SELECT * FROM posts WHERE category='$get';";
    $result = $conn->query($query);
    require "showArticles.php" ;
}
    ?>
</div>
</div>
<!----------------- nav bar area ---------------------------------------->
<?php
  require "footer.html" ;
?>
</div>

</body>

</html>