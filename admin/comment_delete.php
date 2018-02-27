<?php
ob_start();
session_start();
if($_SESSION['name']!='admin')
{
	header('location: login.php');
}
include("../config.php");
?>

<?php

if(!isset($_REQUEST['id'])) {
	header("location: comment-approve.php");
}
else {
	$id = $_REQUEST['id'];
}
?>

<?php
$statement = $db->prepare("DELETE FROM comment WHERE id=?");
$statement->execute(array($id));

header("location: comment-approve.php");

?>