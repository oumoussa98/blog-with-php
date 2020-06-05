<?php
require_once "functions.php" ;
require_once "login.php" ;
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
// get inputs --------------------------------------
if (isset($_POST['postAuthor'])) {
    $postAuthor = sanitizeString($_POST['postAuthor']) ;
    $postTitle = sanitizeString($_POST['postTitle']) ;
    $category = sanitizeString($_POST['postCategory']) ;
  if ($category != "") {
    $category = sanitizeString($_POST['postCategory']) ;
    $test="i'm in postCategory" ;
    $query = "create table if not exists categories(
      category VARCHAR(32) NOT NULL
      );" ;
    $result = $conn->query($query) ;
    if (!$result)  die ($conn->error) ;
    $query1 = "SELECT * FROM categories WHERE category='$category'" ;
    $result1 = $conn->query($query1) ;
    if (!$result1)  die ($conn->error) ;
    if ($result1->num_rows) $error = "This category already exist" ;
    else {
      $query1 = "insert into categories values('$category');" ;
      $result1 = $conn->query($query1) ;
      if (!$result1)  die ($conn->error) ;
    }}
    else
    $category = sanitizeString($_POST['category']) ;
    $postText = $_POST['postText'] ;
if (isset($_FILES['image']['name']))
    {
      $saveto = "images/$postTitle/$postTitle.jpg";
      move_uploaded_file($_FILES['image']['tmp_name'], $saveto);
     }
     $error = "" ;
     if  ($postAuthor == "") $error += "<p> The Post Author field is empty <br>" ;
     if  ($postTitle == "") $error += "<p> The Post Title field is empty <br>" ;
     if  ($category == "") $error = "<p> The category field is empty <br>" ;
     if  ($postText == "") $error = "<p> The Post Text field is empty <br>" ;
    // create table for storing posts ----------
    if ($error != "" ){
    $query = "create table if not exists posts(
        postAuthor VARCHAR(32) NOT NULL,
        postTitle VARCHAR(32) NOT NULL,
        category VARCHAR(32) NOT NULL,
        postText LONGTEXT NOT NULL,
        date datetime
        );" ;
      $result = $conn->query($query) ;
      if (!$result)  die ($conn->error) ;
    $query = "insert into posts values('$postAuthor','$postTitle','$category','$postText',now());" ;
    $result = $conn->query($query) ;
    if (!$result)  die ($conn->error) ;
      }
      else die(header('Location:  addNewPost.php')) ;
   }
   die(header('Location:  addNewPost.php')) ;

?>
