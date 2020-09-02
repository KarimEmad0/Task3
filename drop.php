<?php
session_start();
$servername = "localhost";
$username="root";
if($_POST['name']!=="root"){
  $_SESSION['fail']= "Error In name of Database Connection";
  header('location:index.php');
return;
}
if(!isset($_POST['submit'])){
  header('location:index.php');
return;
}
$password = "";
try {
  $conn = new PDO("mysql:host=$servername", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $db = "DROP DATABASE csv";
  $conn->exec($db);
  $_SESSION['drop']="Database Dropped correctly";
  unset($_SESSION['db_check']);
  header("location:index.php");
} catch(PDOException $e) {
  echo $db . "<br>" . $e->getMessage();
}
$conn = null;
?>
