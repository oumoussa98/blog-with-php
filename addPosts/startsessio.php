<?php
session_start();
$userstr = ' (Guest)';
$user = 'guest' ;
if (isset($_SESSION['uname']))
{
  $user     = $_SESSION['uname'];
  $loggedin = TRUE;
  $userstr  = " ($user)";
  setcookie(session_name(), $user, '/');
}
else $loggedin = FALSE;
?>