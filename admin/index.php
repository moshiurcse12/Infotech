<?php
ob_start();
session_start();
if($_SESSION['name']!='admin')
{
	header('location: login.php');
}
?>
<?php include("header.php"); ?>

<div style="font-weight:bold;color:#3d9ccd;font-size:28px;text-align:center;padding-top:50px;">
	Welcome To The I N F O T E C H
</div>
<?php include("footer.php"); ?>			