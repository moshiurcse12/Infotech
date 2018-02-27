<?php

if(isset($_POST['form_login'])) 
{
	
	try {
	
		
		if(empty($_POST['email'])) {
			throw new Exception('Email can not be empty');
		}
		
		if(empty($_POST['password'])) {
			throw new Exception('Password can not be empty');
		}
	
		
		$password = $_POST['password']; // admin
		$password = md5($password);
	
	
		include('../config.php');
		$num=0;
				
		$statement = $db->prepare("select * from admin where email=? and password=?");
		$statement->execute(array($_POST['email'],$password));		
		
		$num = $statement->rowCount();
		
		if($num>0) 
		{
			session_start();
			$_SESSION['name'] = "admin";
			header("location: index.php");
		}
		else
		{
			throw new Exception('Invalid Email and/or password');
		}
	
	
	
	}
	
	catch(Exception $e) {
		$error_message = $e->getMessage();
	}
	
}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login -Infotech</title>
	<link rel="stylesheet" href="../css/style-admin.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>

<!--<div id="wrapper-login">-->
	
<!--<div>
-->        

<div class="col-md-6 col-md-offset-3" style="margin-top: 130px;margin-right:150px;">
    
    <div class="panel" style="background-color: #004577;">
        
<form class="form-horizontal" role="form" method="post" style="padding: 50px;margin-left:20px;">
    <div style="text-align: center;color: #ffffff;"><h4> <b>Log in</b></h4></div>
    <?php
	if(isset($error_message))
	{
		echo "<div class='text-danger'>".$error_message."</div>";
	}
	?>
  <div class="form-group">
      <h4><label class="control-label col-sm-2 text-danger" for="email"style="color: #ffffff">Email:</label></h4>
    <div class="col-md-10">
        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
    </div>
  </div>
    
  <div class="form-group">
      <h4><label class="control-label col-sm-2 text-danger" for="pwd"style="color: #ffffff">Password:</label></h4>
    <div class="col-md-10"> 
        <input type="password" class="form-control" id="pwd" name="password" placeholder="Enter password">
    </div>
  </div>
    
  <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-primary" name="form_login" style="float: right;">Login</button>
    </div>
  </div>
</form>
    </div>
    </div>

</body>
</html>