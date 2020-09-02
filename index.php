<?php
session_start();
$data="";
if(isset($_SESSION["db_check"])){
  require_once "pdo.php";
if(isset($_POST['submit'])){
if($_FILES['csv_info']['name']){
$arrFileName = explode('.',$_FILES['csv_info']['name']);
if($arrFileName[1] == 'csv'){
$handle = fopen($_FILES['csv_info']['tmp_name'], "r");

while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
  if($data[0]=="client"){
    continue;
  }
  $stmt = $db->prepare("insert into data (client,deal,hour,accepted,refused) values(:client,:deal,:hour,:accepted,:refused)");
  $success = $stmt->execute(array(
    ":client"=>$data[0],
    ":deal"=>$data[1],
    ":hour"=>$data[2],
    ":accepted"=>$data[3],
    ":refused"=>$data[4]
  ));
}
fclose($handle);
header("Location: index.php");
}
}
}

  $stmt = $db->prepare("SELECT * FROM data");
  $stmt->execute();
  $data = $stmt->fetchALL(PDO::FETCH_ASSOC);
}
?>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="style.css">
<title>Upload CSV and Insert into Database Using PHP</title>
<head>
<body>
  <?php
    if (isset($_SESSION['fail'])) {
        echo('<p style="color: red;">' . htmlentities($_SESSION['fail']) . "</p>\n");
        unset($_SESSION['fail']);
    }
    ?>
  <form method='POST' action="create.php">
    User name <input type="text" name='name'/>
  <input type='submit' name='submit' value='Create Databse' />
  </form>
  <?php
    if (isset($_SESSION['created'])) {
        echo('<p style="color: green;">' . htmlentities($_SESSION['created']) . "</p>\n");
        unset($_SESSION['created']);
    }
    ?>
<form method='POST' enctype='multipart/form-data'>
Upload CSV FILE: <input type='file' name='csv_info' /> <input type='submit' name='submit' value='Upload File' />
</form>
<form method='POST' action="drop.php">
  User name <input type="text" name="name">
<input type='submit' name='submit' value='Drop Databse' />
</form>
<?php
  if (isset($_SESSION['drop'])) {
      echo('<p style="color: green;">' . htmlentities($_SESSION['drop']) . "</p>\n");
      unset($_SESSION['drop']);
  }
  ?>
<h2>Represent Data From Database</h2>

<table>
  <tr>
    <th>number</th>
    <th>Client</th>
    <th>Deal</th>
    <th>Hour</th>
    <th>Accepted</th>
    <th>Rejected</th>
  </tr>
  <?php $i=1; ?>
  <?php foreach ($data as $row): ?>

  <tr>
    <td><?php  echo $i++;?></td>
    <td><?php  echo $row['client'];?></td>
    <td><?php  echo $row['deal'];?></td>
    <td><?php  echo $row['hour'];?></td>
    <td><?php  echo $row['accepted'];?></td>
    <td><?php  echo $row['refused'];?></td>
  </tr>
    <?php endforeach; ?>
</table>
</body>
</html>
