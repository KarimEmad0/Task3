<?php
session_start();
$servername = "localhost";
$username="root";

if($_POST['name']!="root"){
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
  $db = "CREATE DATABASE csv";
  $conn->exec($db);

  $conn = new PDO("mysql:host=$servername;dbname=csv", $username, $password);
  $table = "CREATE TABLE data (
 id INT  AUTO_INCREMENT PRIMARY KEY,
 client VARCHAR(255) NOT NULL,
 deal VARCHAR(30) NOT NULL,
 hour TIMESTAMP,
 accepted INT NOT NULL,
 refused INT NOT NULL
 )";
  $conn->exec($table);
  $_SESSION['created']="Database and Tables are created successfully";
  $_SESSION['db_check']=1;
  header("location:index.php");
} catch(PDOException $e) {
  echo $db . "<br>" . $e->getMessage();
  echo $table . "<br>" . $e->getMessage();

}
$conn = null;
?>
