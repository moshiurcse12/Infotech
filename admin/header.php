<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Admin Panel</title>
       
	<script type='text/javascript'>
	function confirmDelete()
	{
		return confirm("Do you sure want to delete this data?");
	}
	</script>
	<!-- Fancybox jQuery -->
	<script type="text/javascript" src="../fancybox/jquery-1.9.0.min.js"></script>
	<script type="text/javascript" src="../fancybox/jquery.fancybox.js"></script>
	<script type="text/javascript" src="../fancybox/main.js"></script>
	<link rel="stylesheet" type="text/css" href="../fancybox/jquery.fancybox.css" />
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
         <link rel="stylesheet" href="../css/style-admin.css">
	<!-- //Fancybox jQuery -->
	
	<!-- CKEditor Start -->
	<script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
	<!-- // CKEditor End -->
</head>
<body>


    <div id="wrapper" style="background-color: #1d2238">
            <div id="" style="background-color: #3d7784">
                <center><h1><b>Admin Panel</b></h1></center>
		</div>
		<div id="container">
			<div id="sidebar">
				<h2>Page Options</h2>
                               
				<ul class="none" >
                                    <li style="margin-bottom:10px;"><button class="btn btn-primary"style="width:150px;background-color: #1b2656"><a href="index.php" style="text-decoration: none;">Home</a></button></li>
					
					<li style="margin-top:10px"><button  class="btn btn-primary" style="width:150px;background-color: #1b2656;"><a href="change-password.php" style="text-decoration: none;">Change Password</a></button></li>
					<li style="margin-top:10px"><button  class="btn btn-primary" style="width:150px;background-color: #1b2656;"><a href="logout.php" style="text-decoration: none;">Logout</a></button></li>
				</ul>
                                     
<!--                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary" name="form_login" style="float: right;">Login</button>
                                </div>-->
				<h2>Blog Options</h2>
				<ul class="none" >
					<li style="margin-bottom:10px"><button class="btn btn-primary"style="width:150px;background-color: #1b2656;"><a href="post-add.php" style="text-decoration: none;">Add Post</a></button></li>
					<li style="margin-top:10px"><button  class="btn btn-primary" style="width:150px;background-color: #1b2656;"><a href="post-view.php" style="text-decoration: none;">View Post</a></button></li>
					<li style="margin-top:10px"><button  class="btn btn-primary" style="width:150px;background-color: #1b2656;"><a href="manage-category.php" style="text-decoration: none;">Manage Category</a></button></li>
                                        <li style="margin-top:10px"><button  class="btn btn-primary" style="width:150px;background-color: #1b2656;"><a href="manage-subcategory.php" style="text-decoration: none;">Manage SubCategory</a></button></li>
						
				</ul>
				<h2>Comment Section</h2>
				<ul class="none" >
                                    <li style="margin-bottom:10px"><button class="btn btn-primary"style="width:150px;background-color: #1b2656;"><a href="comment-approve.php" style="text-decoration: none;">View comments</a></button></li>
				</ul>
			</div>
			<div id="content">