<?php
if ($result->num_rows > 0 ) 
{
  $postTitle = array() ;
  $i = 0 ;
// get post title from the database ------------------
 while($row = $result->fetch_assoc() ) {
  $postTitle[$i] = $row["postTitle"] ;
  $postText[$i] = $row["postText"] ;
  $postAuthor[$i] = $row["postAuthor"] ;
  $date[$i] = $row["date"] ;
  $i++ ;    }
  $postsRowsNumber = count($postTitle) ;
  $i = 0 ;
  // show articles by titles ------------------------------
 do {
    $postTitleText = $postTitle[$postsRowsNumber-1] ;
    $myfile = 'addPosts/images/'.$postTitleText.'/'.$postTitleText.'.jpg' ;
    $postTextArray = $postText[$postsRowsNumber-1] ;
    $postAuthorArray = $postAuthor[$postsRowsNumber-1] ;
    $dateArray = $date[$postsRowsNumber-1] ;
    if (file_exists($myfile))
  {
    echo <<<_END
    <div class="allPostsArticlesBlocks">
    <div class="articleBlockHead">
    <div class="articlesInfo">Published By: $postAuthorArray <br> date: $dateArray </div>
    <a href="index.php?subject=$postTitleText" class="allPostArcticlesBlocksButton" target="_blanck">
    $postTitleText</a> 
    </div>
    <div class="articleBlockImage">
    <a href="index.php?subject=$postTitleText" target="_blanck"><img src="addPosts/images/$postTitleText/$postTitleText.jpg">
    </a></div></div>
    _END ;
   }
else {
    echo <<<_END
    <div class="allPostsArticlesBlocks">
    <div class="articlesInfo">Published By: $postAuthorArray <br> date: $dateArray </div>
    <a href="index.php?subject=$postTitleText" target="_blanck">$postTextArray
    </a></div>
    _END ;
}
 $postsRowsNumber-- ;
 } while ($postsRowsNumber) ;
}
 ?>