<?php
require_once 'startsessio.php';
require_once "functions.php" ;
require_once "login.php" ;
if (!$loggedin) die(header('Location:  addNewPosts.php')) ; 
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$error = $category = $postAuthor = $postTitle = $postText = $saveto = '' ;
// get inputs --------------------------------------
if (isset($_POST['postAuthor']) && isset($_POST['postTitle']) && isset($_POST['postText'])) {
    $postAuthor = sanitizeString($_POST['postAuthor']) ;
    $postAuthor = addslashes($postAuthor) ;
    $postTitle = sanitizeString($_POST['postTitle']) ;
    $postTitle = addslashes($postTitle) ;
    $category = sanitizeString($_POST['postCategory']) ;
  if ($category != "") {
    $category = sanitizeString($_POST['postCategory']) ;
    $query = "create table if not exists categories(
      category VARCHAR(32) NOT NULL
      );" ;
    $result = $conn->query($query) ;
    if (!$result)  die ($conn->error) ;
    $query1 = "SELECT * FROM categories WHERE category='$category'" ;
    $result1 = $conn->query($query1) ;
    if (!$result1)  die ($conn->error) ;
    if ($result1->num_rows) $category = sanitizeString($_POST['postCategory']) ;
    else {
      $query1 = "insert into categories values('$category');" ;
      $result1 = $conn->query($query1) ;
      if (!$result1)  die ($conn->error) ;
    }}
    else if(isset($_POST['category'])) $category = sanitizeString($_POST['category']) ;
    $postText = $_POST['postText'] ;
    $postText = addslashes($postText) ;
if (isset($_FILES['image']['name']))
    {
      $path = "images/$postTitle" ;
      mkdir($path) ;
      $saveto = "images/$postTitle/$postTitle.jpg";
      move_uploaded_file($_FILES['image']['tmp_name'], $saveto);
     }
     if ($postAuthor == '') $error = "<span class='error'>error: The Post Author field is empty </span> <br>" ;
     if ($postTitle == '') $error = $error."<span class='error'>error: The Post Title field is empty  </span> <br>" ;
     if ($category == '') $error = $error."<span class='error'>error: The category field is empty  </span> <br>" ;
     if ($postText == '') $error = $error."<span class='error'>error: The Post Text field is empty </span><br>" ;
     if ($saveto == '') $error = $error."<span class='error'>error: Please upload at least one image </span><br>" ;

    // create table for storing posts ----------
    if ($error == ''){
    $query = "create table if not exists posts(
        postAuthor VARCHAR(32) NOT NULL,
        postTitle TINYTEXT NOT NULL,
        category VARCHAR(32) NOT NULL,
        postText LONGTEXT NOT NULL,
        date Date
        );" ;
      $result = $conn->query($query) ;
      if (!$result)  die ($conn->error) ;
    $query = "insert into posts values('$postAuthor','$postTitle','$category','$postText',now());" ;
    $result = $conn->query($query) ;
    if (!$result)  die ($conn->error) ;   
  } }
  ?>

   <!DOCTYPE html>
   <html>
    <head>
        <title>add new post</title>
        <link rel="stylesheet" href="../style.css" type="text/css">
        <link rel="icon" type="image/png" href="../favicon.ico" >
    </head>
    <body>
    <div class="addPostDiv">
    <div class="errorDiv"><?php $error ?></div>
    <form method="POST" class="addPostForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype='multipart/form-data'>
    <label for="author">Post Author</label>
    <input type="text" id="author" name="postAuthor" placeholder="Your name.." >
    <label for="title">Post Title</label>
    <input type="text" id="title" name="postTitle" placeholder="Your post title.." >
    <label for="categories">Categories</label>
    <select id="categories" name="category" >
    <option value='' selected disabled>Select Category</option>
    <?php
$query = "SELECT * FROM categories;";
$result = $conn->query($query);
if ($result->num_rows) 
  {
 while($row = $result->fetch_assoc() ) {
   $category1 = $row["category"] ;
  echo '<option value='.$category1.'>'.$category1.'</option>' ;
  }}
  ?>
      </select>
    <input type="text" id="postCategory" name="postCategory" placeholder="add New category..">
    <p class="tips">
    ---------------------------------------- Tips -----------------------------------------------<br>
    The best way to write a post is by writing it in your html editor<br>
    then copy an paste it in here<br>
    ---------------------------------------------------------------------------------------------
   </p>
    <label for="postText">Post body</label>
    <textarea id="postText" name="postText" placeholder="start writing.." style="height:200px" ></textarea>
    Upload images <input type='file' name='image' multiple>
    <input type="submit" value="Add Post">
    <input form="form1" class="logoutButton" type="submit" value="Log Out">
    <p>!!! the image name will be <strong>Post Title.jpg</strong> by default </p>
    </form>
    <form method="POST" action="logout.php" id="form1">
    </form>
    <div>
    </body>
    </html>
