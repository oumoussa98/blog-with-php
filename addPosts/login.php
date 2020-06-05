
<?php // login.php
 $db_hostname = 'localhost';
 $db_database = 'db_blog';
 $db_username = 'root';
 $db_password = '';
 $port = 3306 ;
 $conn = new mysqli ($db_hostname,$db_username,$db_password,"",$port) ;
 $query = "CREATE DATABASE if not exists $db_database ;";
   $conn->query($query) ;
$conn = new mysqli ($db_hostname,$db_username,$db_password,$db_database,$port) ;
   $query = "create table if not exists posts(
    postAuthor VARCHAR(32) NOT NULL,
    postTitle TINYTEXT NOT NULL,
    category VARCHAR(32) NOT NULL,
    postText LONGTEXT NOT NULL,
    date DATE
    );" ;
  $result = $conn->query($query) ;
  if (!$result)  die ($conn->error) ;
  $query = "create table if not exists categories(
    category VARCHAR(32) NOT NULL
    );" ;
  $result = $conn->query($query) ;
  if (!$result)  die ($conn->error) ;
  $query = "create table if not exists users(
    firstname VARCHAR(32) NOT NULL,
    lastname VARCHAR(32) NOT NULL,
    gender VARCHAR(10) NOT NULL,
    username VARCHAR(32) NOT NULL UNIQUE ,
    password VARCHAR(32) NOT NULL
  );" ;
$result=$conn->query($query) ;
if (!$result)  die ($connexion->error) ;
?>