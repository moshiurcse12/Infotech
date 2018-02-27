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

if(isset($_POST['form1']))
{
	try {
		
		if(empty($_POST['category_name'])) {
			throw new Exception("Category Name can not be empty.");
		}
		
		$statement = $db->prepare("SELECT * FROM category WHERE category_name=?");
		$statement->execute(array($_POST['category_name']));
		$total = $statement->rowCount();
		
		if($total>0) {
			throw new Exception("Category Name already exists.");
		}
		
		$statement = $db->prepare("INSERT INTO category (category_name) VALUES (?)");
		$statement->execute(array($_POST['category_name']));
		
		$success_message = "Category name has been inserted successfully.";
		
	
	}
	
	catch(Exception $e) {
		$error_message = $e->getMessage();
	}
} 



if(isset($_POST['form2']))
{
	try {
		
		if(empty($_POST['category_name'])) {
			throw new Exception("Category Name can not be empty.");
		}
		
		$statement = $db->prepare("UPDATE category SET category_name=? WHERE id=?");
		$statement->execute(array($_POST['category_name'],$_POST['hdn']));
		
		$success_message1 = "Category Name has been updated successfully.";
		
	}
	catch(Exception $e) {
		$error_message1 = $e->getMessage();
	}
		
}

if(isset($_REQUEST['id'])) 
{
	$id = $_REQUEST['id'];
	
	$statement = $db->prepare("DELETE FROM category WHERE id=?");
	$statement->execute(array($id));
	
	$success_message2 = "Category Name has been deleted successfully.";
	
}

?>
<?php include("header.php"); ?>
<h2>Add New Category</h2>
<p>&nbsp;</p>
<?php
if(isset($error_message)) {echo "<div class='error'>".$error_message."</div>";}
if(isset($success_message)) {echo "<div class='success'>".$success_message."</div>";}
?>
<form action="" method="post">
<table class="tbl1">
<tr>
    <td style="color: #ffffff">Category Name</td>
</tr>
<tr>
	<td><input class="short" type="text" name="category_name"></td>
</tr>
<tr>
	<td><input type="submit" value="SAVE" name="form1"></td>
</tr>
</table>	
</form>


<h2>View  All Categories</h2>
<?php
if(isset($error_message1)) {echo "<div class='error'>".$error_message1."</div>";}
if(isset($success_message1)) {echo "<div class='success'>".$success_message1."</div>";}
if(isset($success_message2)) {echo "<div class='success'>".$success_message2."</div>";}
?>
<table class="tbl2" width="100%">
	<tr>
		<th width="20%" style="text-align: center">Serial</th>
                <th width="60%" style="text-align: center">Category Name</th>
		<th width="20%" style="text-align: center">Action</th>
	</tr>
	
	<?php
	$i=0;
	$statement = $db->prepare("SELECT * FROM category ORDER BY category_name ASC");
	$statement->execute();
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	foreach($result as $row)
	{
		$i++;
		?>
			
		<tr>
		<td><?php echo $i; ?></td>
		<td><?php echo $row['category_name']; ?></td>
		<td>
			<a class="fancybox" href="#inline<?php echo $i; ?>">Edit</a>
			<div id="inline<?php echo $i; ?>" style="width:400px;display: none;">
				<h3>Edit Data</h3>
				<p>
					<form action="" method="post">
					<input type="hidden" name="hdn" value="<?php echo $row['id']; ?>">
					<table>
						<tr>
							<td>Category Name</td>
						</tr>
						<tr>
							<td><input type="text" name="category_name" value="<?php echo $row['category_name']; ?>"></td>
						</tr>
						<tr>
							<td><input type="submit" value="UPDATE" name="form2"></td>
						</tr>
					</table>
					</form>
				</p>
			</div>
			&nbsp;|&nbsp;
			<a onclick='return confirmDelete();' href="manage-category.php?id=<?php echo $row['id']; ?>">Delete</a></td>
		</tr>
		
		<?php
	}
	?>
	
	
	
	
</table>


<?php include("footer.php"); ?>			