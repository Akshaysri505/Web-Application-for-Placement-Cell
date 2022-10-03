<?php   
session_start();  
$_SESSION['user']="";
unset($_SESSION['h']);  
$_SESSION['user2']="";
$_SESSION['user1']="";
unset($_SESSION['user3']);
session_destroy();  
echo '<script>';
echo 'alert("you have successfully loged out");';
echo 'window.location="index.php";';
echo '</script>';
/*header("location:index.php");*/  
?>  