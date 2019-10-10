<?php 

 session_start();
 include_once("MODEL/user.php");
 if(!isset($_SESSION["user"])){
     header("location: login.php");
 }
?>
<?php include_once("header.php")?>

<?php include_once("nav.php")?>
<?php
    $user = unserialize($_SESSION["user"]) ;
    echo "Xin chao " . $user->fullName;
?>
<?php include_once("footer.php")?>