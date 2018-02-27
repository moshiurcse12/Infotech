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
	header("location: post-view.php");
}
else {
	$id = $_REQUEST['id'];
}
?>


<?php

if(isset($_POST['form1'])) {


	try {
	
		if(empty($_POST['title'])) {
			throw new Exception("Title can not be empty.");
		}
		
		if(empty($_POST['description'])) {
			throw new Exception("Description can not be empty.");
		}		
		
		if(empty($_POST['cat_id'])) {
			throw new Exception("Category Name can not be empty.");
		}
                
                if(empty($_POST['sub_cat_id'])) {
			throw new Exception("Category Name can not be empty.");
		}
		
                $title = $_POST['title'];
                $description = $_POST['description'];
                $cat_id = $_POST['cat_id'];
                $sub_cat_id = $_POST['sub_cat_id'];
                
		$statement = $db->prepare("SHOW TABLE STATUS LIKE 'post'");
		$statement->execute();
		$result = $statement->fetchAll();
		foreach($result as $row)
			$new_id = $row[10];
			
//		$file = $_FILES["file"];
//                print_r($file);
		$up_filename=$_FILES["file"]["name"];
		$file_basename = substr($up_filename, 0, strripos($up_filename, '.')); // strip extention
		$file_ext = substr($up_filename, strripos($up_filename, '.')); // strip name
		$f1 = $new_id . $file_ext;
                

//        $allowedExts = array("jpg", "jpeg", "gif", "png", "mp3", "mp4", "wma");
//        $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
//
//        if ((($_FILES["file"]["type"] == "video/mp4") || ($_FILES["file"]["type"] == "audio/mp3") || ($_FILES["file"]["type"] == "audio/wma") || ($_FILES["file"]["type"] == "image/pjpeg") || ($_FILES["file"]["type"] == "image/gif") || ($_FILES["file"]["type"] == "image/jpeg")) && ($_FILES["file"]["size"] < 20000) && in_array($extension, $allowedExts)) {
//            if ($_FILES["file"]["error"] > 0) {
//                echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
//            } else {
//                echo "Upload: " . $_FILES["file"]["name"] . "<br />";
//                echo "Type: " . $_FILES["file"]["type"] . "<br />";
//                echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
//                echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";
//
//                if (file_exists("upload/" . $_FILES["file"]["name"])) {
//                    echo $_FILES["file"]["name"] . " already exists. ";
//                } else {
//                    move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" . $_FILES["file"]["name"]);
//                    echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
//                }
//            }
//        } else {
//            echo "Invalid file";
//        }

        if (($file_ext != '.png') && ($file_ext != '.jpg') && ($file_ext != '.jpeg') && ($file_ext != '.gif') && ($file_ext != '.mp4') && ($file_ext != '.MP4'))
            throw new Exception("Only jpg, jpeg, png, gif and mp4 format images are allowed to upload.");
        else {
            if (($file_ext == '.png') || ($file_ext == '.jpg') || ($file_ext == '.jpeg') || ($file_ext == '.gif')) {
                move_uploaded_file($_FILES["file"]["tmp_name"], "../uploads/".$f1);
                
                $statement = $db->prepare("INSERT INTO post (title,description,image,category_id,sub_cat_id) VALUES (?,?,?,?,?)");
                $statement->execute(array($title, $description, $f1, $cat_id, $sub_cat_id));


                $success_message .= "Image Post is inserted successfully.";
            } 
            else if($file_ext == '.mp4' || $file_ext == '.MP4'){

              if(move_uploaded_file($_FILES["file"]["tmp_name"], "../uploads/".$f1))
                {
                    $success_message = 'Video has published...';
                }  else {
                    throw new Exception("There is a problem in the video");
                }
//		$post_date = date('Y-m-d');
//		$post_timestamp = strtotime(date('Y-m-d'));
//		$year = substr($post_date,0,4);
//		$month = substr($post_date,5,2);

                $statement = $db->prepare("INSERT INTO post (title,description,video,category_id,sub_cat_id) VALUES (?,?,?,?,?)");
                $statement->execute(array($title, $description, $f1, $cat_id, $sub_cat_id));


                $success_message = "Video Post is inserted successfully.";
            }
        }
    }
	
	
        catch(Exception $e) {
		$error_message = $e->getMessage();
	}


}

?>



<?php
$statement = $db->prepare("SELECT * FROM post WHERE id=?");
$statement->execute(array($id));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach($result as $row)
{
	$title = $row['title'];
	$description = $row['description'];
	$image = $row['image'];
	$category_id = $row['category_id'];
	$sub_cat_id = $row['sub_cat_id'];
}
?>


<?php include("header.php"); ?>
<h2>Edit Post</h2>

<?php
if(isset($error_message)) {echo "<div class='error'>".$error_message."</div>";}
if(isset($success_message)) {echo "<div class='success'>".$success_message."</div>";}
?>


<form action="post-edit.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
<!--<input type="hidden" name="id" value="<?php echo $id; ?>">-->
<table class="tbl1">
    <tr><td style="color: #ffffff">Title</td></tr>
<tr><td><input class="long" type="text" name="title" value="<?php echo $title; ?>"></td></tr>
<tr><td style="color: #ffffff">Description</td></tr>
<tr>
<td>
<textarea name="description" cols="30" rows="10"><?php echo $description; ?></textarea>
<script type="text/javascript">
	if ( typeof CKEDITOR == 'undefined' )
	{
		document.write(
			'<strong><span style="color: #ff0000">Error</span>: CKEditor not found</strong>.' +
			'This sample assumes that CKEditor (not included with CKFinder) is installed in' +
			'the "/ckeditor/" path. If you have it installed in a different place, just edit' +
			'this file, changing the wrong paths in the &lt;head&gt; (line 5) and the "BasePath"' +
			'value (line 32).' ) ;
	}
	else
	{
		var editor = CKEDITOR.replace( 'description' );
		//editor.setData( '<p>Just click the <b>Image</b> or <b>Link</b> button, and then <b>&quot;Browse Server&quot;</b>.</p>' );
	}

</script>
</td>
</tr>

<tr><td style="color: #ffffff">Upload:</td></tr>
<input name="MAX_FILE_SIZE" value="10000000000000000000"  type="hidden"/>
<tr><td><input type="file" name="file"></td></tr>

<tr><td style="color: #ffffff">Select a Category</td></tr>
<tr>
<td>
<select name="cat_id">
<option value="">Select a Category</option>
<?php
$statement = $db->prepare("SELECT * FROM category ORDER BY category_name ASC");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach($result as $row)
{
	?>
	<option value="<?php echo $row['id']; ?>"><?php echo $row['category_name']; ?></option>
	<?php
}
?>
</select>
</td>
</tr>
<tr><td style="color: #ffffff">Select Subcategory</td></tr>
<tr>
<td>
<select name="sub_cat_id">
<option value="">Select Sub Category</option>
<?php
$statement = $db->prepare("SELECT * FROM sub_category ORDER BY sub_cat_name ASC");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach($result as $row)
{
	?>
	<option value="<?php echo $row['id']; ?>"><?php echo $row['sub_cat_name']; ?></option>
	<?php
}
?>
</select>
</td>
</tr>
<tr><td><input type="submit" value="UPDATE" name="form1"></td></tr>
</table>	
</form>
<?php include("footer.php"); ?>			