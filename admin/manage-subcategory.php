<?php
ob_start();
session_start();
if ($_SESSION['name'] != 'admin') {
    header('location: login.php');
}
include("../config.php");
?>
<?php
if (isset($_POST['form1'])) {
    try {

        if (empty($_POST['sub_cat_name'])) {
            throw new Exception("Sub Category Name can not be empty.");
        }

        $statement = $db->prepare("SELECT * FROM sub_category WHERE sub_cat_name=?");
        $statement->execute(array($_POST['sub_cat_name']));
        $total = $statement->rowCount();

        if ($total > 0) {
            throw new Exception("Sub Category Name already exists.");
        }

        $statement = $db->prepare("INSERT INTO sub_category (sub_cat_name,cat_id) VALUES (?,?)");
        $statement->execute(array($_POST['sub_cat_name'], $_POST['cat_id']));

        $success_message = "Sub Category name has been inserted successfully.";
    } catch (Exception $e) {
        $error_message = $e->getMessage();
    }
}



if (isset($_POST['form2'])) {
    try {

        if (empty($_POST['sub_cat_name'])) {
            throw new Exception("Sub Category Name can not be empty.");
        }

        $statement = $db->prepare("UPDATE sub_category SET sub_cat_name=?, cat_id = ? WHERE id=?");
        $statement->execute(array($_POST['sub_cat_name'],$_POST['cat_id'], $_POST['hdn']));

        $success_message1 = "Sub Category Name has been updated successfully.";
    } catch (Exception $e) {
        $error_message1 = $e->getMessage();
    }
}

if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];

    $statement = $db->prepare("DELETE FROM sub_category WHERE id=?");
    $statement->execute(array($id));

    $success_message2 = "Sub Category Name has been deleted successfully.";
}
?>
<?php include("header.php"); ?>
<h2>Add New Sub Category</h2>
<p>&nbsp;</p>
<?php
if (isset($error_message)) {
    echo "<div class='error'>" . $error_message . "</div>";
}
if (isset($success_message)) {
    echo "<div class='success'>" . $success_message . "</div>";
}
?>
<form action="" method="post">
    <table class="tbl1">
        <tr><td style="color: #ffffff">Select a Category</td></tr>
        <tr>
            <td>
                <select name="cat_id">
                    <option value="">Select a Category</option>
                    <?php
                    $statement = $db->prepare("SELECT * FROM category ORDER BY category_name ASC");
                    $statement->execute();
                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($result as $row) {
                        ?>
                        <option value="<?php echo $row['id']; ?>"><?php echo $row['category_name']; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td style="color: #ffffff">Sub Category Name</td>
        </tr>
        <tr>
            <td><input class="short" type="text" name="sub_cat_name"></td>
        </tr>
        <tr>
            <td><input type="submit" value="SAVE" name="form1"></td>
        </tr>
    </table>	
</form>


<h2>View  All Sub Categories</h2>
<?php
if (isset($error_message1)) {
    echo "<div class='error'>" . $error_message1 . "</div>";
}
if (isset($success_message1)) {
    echo "<div class='success'>" . $success_message1 . "</div>";
}
if (isset($success_message2)) {
    echo "<div class='success'>" . $success_message2 . "</div>";
}
?>
<table class="tbl2" width="100%">
    <tr>
        <th width="20%" style="text-align: center">Serial</th>
        <th width="20%" style="text-align: center">SubCategory Name</th>
        <th width="20%" style="text-align: center">Action</th>
    </tr>

    <?php
    $i = 0;
    $statement = $db->prepare("SELECT * FROM sub_category ORDER BY sub_cat_name ASC");
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) {
        $i++;
        ?>

        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $row['sub_cat_name']; ?></td>
            <td>
                <a class="fancybox" href="#inline<?php echo $i; ?>">Edit</a>
                <div id="inline<?php echo $i; ?>" style="width:400px;display: none;">
                    <h3>Edit Data</h3>
                    <p>
                    <form action="" method="post">
                        <input type="hidden" name="hdn" value="<?php echo $row['id']; ?>">
                        <table>
                            <tr><td style="color: #ffffff">Select a Category</td></tr>
                            <tr>
                                <td>
                                    <select name="cat_id">
                                        <option value="">Select a Category</option>
                                        <?php
                                        $statement4 = $db->prepare("SELECT * FROM category ORDER BY category_name ASC");
                                        $statement4->execute();
                                        $result4 = $statement4->fetchAll(PDO::FETCH_ASSOC);
                                        foreach ($result4 as $row4) {
                                            if($row4['id']== $row['cat_id']){
                                            ?>
                                        <option value="<?php echo $row4['id']; ?>" selected><?php echo $row4['category_name']; ?></option>
                                            <?php 
                                            } 
                                            else{
                                                ?>    
                                        <option value="<?php echo $row4['id']; ?>"><?php echo $row4['category_name']; ?></option>
                                            <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                            <tr>
                                <td style="color: #ffffff">Sub Category Name</td>
                            </tr>
                            <tr>
                                <td><input type="text" name="sub_cat_name" value="<?php echo $row['sub_cat_name']; ?>"></td>
                            </tr>
                            <tr>
                                <td><input type="submit" value="UPDATE" name="form2"></td>
                            </tr>
                        </table>
                    </form>
                    </p>
                </div>
                &nbsp;|&nbsp;
                <a onclick='return confirmDelete();' href="manage-subcategory.php?id=<?php echo $row['id']; ?>">Delete</a></td>
        </tr>

        <?php
    }
    ?>




</table>


<?php include("footer.php"); ?>			