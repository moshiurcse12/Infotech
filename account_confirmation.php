<?php

$token = $_REQUEST['status'];
include_once './config.php';
$statement = $db->prepare("SELECT * FROM user WHERE status = ?");
$statement->execute(array($token));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach($result as $row){
  $user = $row['id'];
  $status = $row['status'];
}

if($token == $status){
    $statement_update = $db->prepare("UPDATE user SET status = '1' WHERE id = ?");
    $statement_update->execute(array($user));
    
    header('location: user_login.php');
}
    
header('location: user_login.php')

?>
