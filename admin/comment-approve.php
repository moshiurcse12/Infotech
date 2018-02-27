<?php
ob_start();
session_start();
if ($_SESSION['name'] != 'admin') {
    header('location: login.php');
}
include("../config.php");
?>

<?php
if (isset($_REQUEST['id'])) {

    try {

        $statement = $db->prepare("UPDATE comment SET active=1 WHERE id=?");
        $statement->execute(array($_REQUEST['id']));

        $success_message = "Comment is approved. Thank you.";
    } catch (Exception $e) {
        $error_message = $e->getMessage();
    }
}
?>


<?php
//$statement = $db->prepare("SELECT * FROM tbl_footer WHERE id=1");
//$statement->execute();
//$result = $statement->fetchAll(PDO::FETCH_ASSOC);
//foreach($result as $row)
//{
//	$description = $row['description'];
//}
?>
<?php include("header.php"); ?>
<h2>All Un-approved Comments</h2>
<?php
if (isset($error_message)) {
    echo "<div class='error'>" . $error_message . "</div>";
}
if (isset($success_message)) {
    echo "<div class='success'>" . $success_message . "</div>";
}
?>
<table class="tbl2" width="100%">
    <tr>
        <th width="20%" style="text-align: center">Serial</th>
        <th width="20%" style="text-align: center">Name</th>
        <th width="20%" style="text-align: center">Message</th>
        <th width="20%" style="text-align: center">Post ID</th>
        <th width="20%" style="text-align: center">Action</th>
    </tr>

<?php
$i = 0;
$statement = $db->prepare("SELECT * FROM comment WHERE active=0 ORDER BY id DESC");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    $i++;
//        $statement_post = $db->prepare("SELECT * FROM post WHERE id= ?");
//	$statement_post->execute(arry($row['post_id']));
//	$result_post=  $statement->fetchAll(PDO::FETCH_ASSOC);
    ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $row['user_id']; ?></td>
            <td><?php echo $row['message']; ?></td>
            <td>
                <a class="fancybox" href="#inline<?php echo $i; ?>"><?php echo $row['post_id']; ?></a>

                <div id="inline<?php echo $i; ?>" style="width:700px;display: none;">
                    <h3 style="border-bottom:2px solid #808080;margin-bottom:10px;">View Post Details</h3>
                    <p>
    <?php
    $statement1 = $db->prepare("SELECT * FROM post WHERE id=?");
    $statement1->execute(array($row['post_id']));
    $result1 = $statement1->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result1 as $row1) {
        ?>


                        <table>
                            <tr>
                                <td><b>Title</b></td>
                            </tr>
                            <tr>
                                <td><?php echo $row1['title']; ?></td>
                            </tr>
                            <tr>
                                <td><b>Description</b></td>
                            </tr>
                            <tr>
                                <td><?php echo $row1['description']; ?></td>
                            </tr>
                            <tr>
                                <td><b>Featured Image</b></td>
                            </tr>
                            <tr>
                                <td><img src="../uploads/<?php echo $row1['post_image']; ?>" alt=""></td>
                            </tr>
                            <tr>
                                <td><b>Category</b></td>
                            </tr>
                            <tr>
                                <td>
        <?php
        $statement2 = $db->prepare("SELECT * FROM category WHERE id=?");
        $statement2->execute(array($row1['category_id']));
        $result2 = $statement2->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result2 as $row2) {
            echo $row2['category_name'];
        }
        ?>
                                </td>
                            </tr>
                            <tr>
                                <td><b>Tag</b></td>
                            </tr>
                            <tr>
                                <td>
                                    <?php
                                    $statement2 = $db->prepare("SELECT * FROM sub_category WHERE id=?");
                                    $statement2->execute(array($row1['sub_cat_id']));
                                    $result2 = $statement2->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($result2 as $row2) {
                                        echo $row2['sub_cat_name'];
                                    }
                                    ?>
                                </td>
                            </tr>

                        </table>



                                    <?php
                                }
                                ?>



                    </p>
                </div>




            </td>
            <td><a href="comment-approve.php?id=<?php echo $row['id']; ?>">Approve</a></td>	
        </tr>
    <?php
}
?>

</table>


<h2>All Approved Comments</h2>

<table class="tbl2" width="100%">
    <tr>
        <th width="10%" style="text-align: center">Serial</th>
        <th width="10%" style="text-align: center">Name</th>
        <th width="40%" style="text-align: center">Message</th>
        <th width="10%" style="text-align: center">Post ID</th>
        <th width="30%" style="text-align: center">Action</th>
    </tr>

<?php
$i = 0;
$statement = $db->prepare("SELECT * FROM comment WHERE active=1 ORDER BY id DESC");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    $i++;
    ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $row['user_id']; ?></td>
            <td><?php echo $row['message']; ?></td>
            <td>
                <a class="fancybox" href="#inline<?php echo $i; ?>"><?php echo $row['post_id']; ?></a>

                <div id="inline<?php echo $i; ?>" style="width:700px;display: none;">
                    <h3 style="border-bottom:2px solid #808080;margin-bottom:10px;">View Post Details</h3>
                    <p>
    <?php
    $statement1 = $db->prepare("SELECT * FROM post WHERE id=?");
    $statement1->execute(array($row['post_id']));
    $result1 = $statement1->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result1 as $row1) {
        ?>


                        <table>
                            <tr>
                                <td><b>Title</b></td>
                            </tr>
                            <tr>
                                <td><?php echo $row1['title']; ?></td>
                            </tr>
                            <tr>
                                <td><b>Description</b></td>
                            </tr>
                            <tr>
                                <td><?php echo $row1['description']; ?></td>
                            </tr>
                            <tr>
                                <td><b>Featured Image</b></td>
                            </tr>
                            <tr>
                                <td><img src="../uploads/<?php echo $row1['post_image']; ?>" alt=""></td>
                            </tr>
                            <tr>
                                <td><b>Category</b></td>
                            </tr>
                            <tr>
                                <td>
        <?php
        $statement2 = $db->prepare("SELECT * FROM category WHERE id=?");
        $statement2->execute(array($row1['category_id']));
        $result2 = $statement2->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result2 as $row2) {
            echo $row2['category_name'];
        }
        ?>
                                </td>
                            </tr>
                            <tr>
                                <td><b>Tag</b></td>
                            </tr>
                            <tr>
                                <td>
                                    <?php
                                    $statement2 = $db->prepare("SELECT * FROM sub_category WHERE id=?");
                                    $statement2->execute(array($row1['sub_cat_id']));
                                    $result2 = $statement2->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($result2 as $row2) {
                                        echo $row2['sub_cat_name'];
                                    }
                                    ?>
                                </td>
                            </tr>

                        </table>



                                    <?php
                                }
                                ?>



                    </p>
                </div>




            </td>
            <td><a href="comment_delete.php?id=<?php echo $row['id']; ?>">Delete</a></td>	
        </tr>
                    <?php
                }
                ?>

</table>


<?php include("footer.php"); ?>			