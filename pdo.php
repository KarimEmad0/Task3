<?php
$db_user = "root";
$db_pass = "";
$db_name = "csv";
$db = new PDO('mysql:host=localhost;port=3306;dbname=csv', $db_user, $db_pass);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 ?>
