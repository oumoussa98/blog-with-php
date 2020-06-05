<?php     
    require_once "addPosts/login.php" ;
   
?>
<!DOCTYPE html>
<html>
    <head>
      <?php 
       if(isset($_GET['subject'])) {
        $get=$_GET['subject'];
        $query = "SELECT * FROM posts WHERE postTitle='$get';";
        $result = $conn->query($query);
        if ($result->num_rows) 
        {
       while($row = $result->fetch_assoc() ) {
        $postTitle = $row["postTitle"] ;     }
       echo '<title>'.$postTitle.'</title>';
        }}
       else echo '<title>Home</title>' ; ?>
        <link rel="stylesheet" href="style.css" type="text/css">
        <link rel="stylesheet" href="fontawesome/css/all.css" >
        <link rel="icon" type="image/png" href="favicon.ico" >
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@1,300&display=swap" rel="stylesheet">      <!--  <script type="text/javascript" src="jquery-3.5.0.js">  </script> -->
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
<body>
<div class="firstDiv">
  <div class="topBar">
<!----------------- hyperlinks area ---------------------------------------->

<?php
 require "header.html" ;
 ?>
 <script>
  var element = document.getElementById("home");
  element.classList.add("selected");
</script>
  </div>
  <div class="page">
<!----------------- categories area ---------------------------------------->
<?php
    require "categories.php" ; 
?>
  <div class="articles">
  <div id="articleDiv" class="article">
<!----------------- arcicles area ---------------------------------------->
    <?php
    //  get the post fromthe table -------------
    $postText = array() ;
    $i = 0 ;
    if(isset($_GET['subject'])) {
      $get=$_GET['subject'];
      $query = "SELECT * FROM posts WHERE postTitle='$get';";
      $result = $conn->query($query);
      if ($result->num_rows) 
      {
     while($row = $result->fetch_assoc() ) {
      $postTextByGet = $row["postText"] ;
      $dateByGet = $row["date"] ;
        }
      }
      echo $dateByGet ;
      echo '<br>' ;
      echo $postTextByGet;
    }
    else {
    $query = "SELECT * FROM posts;";
    $result = $conn->query($query);
    if ($result->num_rows) 
    {
   while($row = $result->fetch_assoc() ) {
    $postText[$i] = $row["postText"] ;
    $date[$i] = $row["date"] ;
    $i++ ;         }
    }
    if ($result->num_rows) {
    echo $date[$i-1] ;
    echo '<br>' ;
    echo $postText[$i-1] ; }
  }
     ?>
  </div>
  </div>
<!----------------- arcicles by titles area ---------------------------------------->
      <div class="articlesByTitles">
        <div>
        <a class="latestPosts"><strong>Latest Posts:</strong></a>
        <a href="allPosts.php" class="seeAll"><strong>See All</strong></a><br>
      </div>
      <?php
//  get the posts from the database ------------------------------
    $query = "SELECT * FROM posts;";
    $result = $conn->query($query);
if ($result->num_rows > 0 ) 
  {
    $postTitle = array() ;
    $i = 0 ;
// get post title from the database ------------------
   while($row = $result->fetch_assoc() ) {
    $postTitle[$i] = $row["postTitle"] ;
    $postText[$i] = $row["postText"] ;
    $i++ ;    }
    $postsRowsNumber = count($postTitle) ;
    $i = 0 ;
// show articles by titles ------------------------------
if ($postsRowsNumber < 11 && $postsRowsNumber != 1 ) {
    do {
      $postTitleText = $postTitle[$postsRowsNumber-2] ;
      $myfile = 'addPosts/images/'.$postTitleText.'/'.$postTitleText.'.jpg' ;
      $postTextArray = $postText[$postsRowsNumber-2] ;
      if (file_exists($myfile))
      {
       echo <<<_END
       <div class="articlesBlocks">
       <div class="articleBlockHead">
       <a href="index.php?subject=$postTitleText" class="arcticlesBlocksButton" >
       $postTitleText</a> 
       </div>
       <div class="articleBlockImage">
       <a href="index.php?subject=$postTitleText"><img src="addPosts/images/$postTitleText/$postTitleText.jpg">
       </a></div></div>
       _END ;
      }
   else {
       echo <<<_END
       <div class="articlesBlocks">
       <div class="articleBlockP">
       <a href="index.php?subject=$postTitleText">$postTextArray
       </a></div></div>
       _END ;
     }
     $postsRowsNumber-- ;
     } while ($postsRowsNumber-1) ;
    }
// show articles by titles ------------------------------
if ($postsRowsNumber >= 11)
    do {
    $postTitleText = $postTitle[$postsRowsNumber-2] ;
    $myfile = 'addPosts/images/'.$postTitleText.'/'.$postTitleText.'.jpg' ;
    $postTextArray = $postText[$postsRowsNumber-2] ;
     if (file_exists($myfile))
     {
      echo <<<_END
      <div class="articlesBlocks">
      <div class="articleBlockHead">
      <a href="index.php?subject=$postTitleText" class="arcticlesBlocksButton" >
      $postTitleText</a> 
      </div>
      <div class="articleBlockImage">
      <a href="index.php?subject=$postTitleText"><img src="addPosts/images/$postTitleText/$postTitleText.jpg">
      </a></div></div>
      _END ;
     }
  else {
      echo <<<_END
      <div class="articlesBlocks">
      <div class="articleBlockP">
      <a href="index.php?subject=$postTitleText"><span> $postTextArray </span>
      </a></div></div>
      _END ;
    }
     $postsRowsNumber-- ;
     $i++ ;
   } while($i<9) ; 
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