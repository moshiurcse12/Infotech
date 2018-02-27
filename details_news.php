<?php
include_once './config.php';

if (isset($_POST['form-comment'])) {
    try {

        if (empty($_POST['commentator_name'])) {
            throw new Exception("Commentator Name can not be empty.");
        }

        if (empty($_POST['comment_message'])) {
            throw new Exception("Please Write Some Text In Comment Field");
        }

        $statement = $db->prepare("INSERT INTO comment (post_id,user_id,message) VALUES (?,?,?)");
        $statement->execute(array($_POST['post_id'], $_POST['commentator_name'], $_POST['comment_message']));

        $success_message = "Comment Uploaded successfully. Please Wait For Approve";
    } catch (Exception $e) {
        $error_message = $e->getMessage();
    }
}
?>

<?php
include_once 'header.php';
include_once 'config.php';

include_once 'function/functions.php';

if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];
}
?>

<!-- Main Wrapper -->
<div class="wrapper margin-top">
    <div class="container">
        <div class="row">
            <div class="col l9 col m12 col s12">
                <!-- News Slider -->
                <?php
                $statement_hit = $db->prepare("UPDATE post SET hit_count = hit_count + 1 WHERE id = ?");
                $statement_hit->execute(array($id));

                $statement = $db->prepare("SELECT * FROM post where id = ?");
                $statement->execute(array($id));
                $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                foreach ($result as $row) {
                    ?>
                    <div class="pgwSlider wide">
                        <div class="ps-current" style="height: 500px;">
                            <ul>
                                <li class="elt_1" style="opacity: 1; z-index: 2; display: list-item;">

                                    <?php if ((($row['image']) != null) || (($row['image']) != "")) { ?>
                                        <img src="./uploads/<?php echo $row['image']; ?>" class="responsive-img" alt="news Image">
                                    <?php } else { ?>
                                        <video width="100%" class="video-show" controls>
                                            <source src="./uploads/<?php echo $row['video']; ?>" type="video/mp4">

                                        </video>
                                    <?php } ?>
                                </li>

                                <li class="elt_2" style="opacity: 0; display: none; z-index: 1;"><a href="javascript:void(0);">
                                        <img src="./images/hor-news3.jpg" alt="<a href=" javascript:void(0);"=""></a>
                                </li><li class="elt_3" style="opacity: 0; display: none; z-index: 1;">
                                    <a href="javascript:void(0);"><img src="./images/hor-news4.jpg" alt="<a href=" javascript:void(0);"=""></a>
                                </li>
                            </ul>
                            <span class="ps-caption" style="">
                                <div class="news-time"><i class="fa fa-clock-o">

                                    </i><?= get_difference_with_current($row['post_date']); ?></div><h2> <a href="javascript:void(0);"></a> </h2><p></p></span></div>
                        <div class="wide ps-list">
                            <ul class="ps-list">
                                <li class="elt_3" style="cursor: pointer; width: 33.3333%; height: 180px; opacity: 0.6;">
                                    <!-- News Slider -->
                                </li>
                            </ul>
                        </div>
                    </div>
                    <p><?= get_difference_with_current($row['post_date']); ?></p>
                    <h3><?php echo $row['title']; ?></h3>
                    <h4><?php echo $row['description']; ?></h4>


                <?php } ?>


                <div class="row">
                    
                    <div class="col-md-11">


                        <?php
                        include_once './config.php';
                        $statement_comment = $db->prepare('SELECT * FROM comment WHERE post_id = ? AND active = 1');
                        $statement_comment->execute(array($id));
                        $comment_result = $statement_comment->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($comment_result as $comment_row) {
                            ?>
                            <div class="well">
                                <div class="row">
                                    <div class="col-md-2">
                                        <img src="images/avatar2.gif" class="img img-circle img-responsive" /> <br />
                                        <strong><?php echo $comment_row['user_id']; ?></strong> <br />

                                    </div>
                                    <div class="col-md-8">
                                        <p><?php echo $comment_row['message']; ?></p> 
                                    </div>
                                </div>

                            </div>
                        <?php } ?>
                    </div>
                </div>
                    <div style="margin-right:70px"> 
                        <center>
                            <legend style="background-color:#9A141D;padding-right:20px ">
                                <b style="color:#ffffff">All User's Comments </b>
                            </legend>
                        </center>
                    </div>

                <div class="row">
                    <div class="col-md-11">
                        <form method="post" style="border: 1px solid gray; padding: 20px; font-size: 20px;color: #402327;background-color: #9A141D">
                            <legend style="color:#f5e2e5; "><b>Add Your Comment</b></legend>
                            <div class="form-group">
                               
                                <label for="commentator_name" >Commenter Name :</label>
                                <input type="text" class="form-control" id="commentator_name" style="color: #f1efef;" name="commentator_name" placeholder="Commentator Name"/>
                            </div>

                            <input type="hidden" class="form-control" name="post_id" value="<?php echo $id; ?>"/>

                            <div class="form-group">
                                <label for="commentator_name">Write your comment :</label>
                                <textarea name="comment_message" class="form-control" cols="10" rows="10"></textarea>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="Comment" name="form-comment"/>
                            </div>
                        </form>
                    </div>

                </div>
            </div>

            <div class="col l3 col m12 col s12">
                <!-- Sidebar -->
                <div class="sidbar-box z-depth-1">
                    <div class="sidebar-title">Hot News</div>
                    <ul>
                        <?php
                        include_once './config.php';
                        $statement_hot = $db->prepare('SELECT * FROM post ORDER BY post_date DESC LIMIT 7');
                        $statement_hot->execute();
                        $hot_result = $statement_hot->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($hot_result as $hot_row) {
                            ?>
                            <li>
                                <a href="details_news.php?id=<?php echo $hot_row['id']; ?>"> <?php echo $hot_row['title']; ?></a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>

                <div class="sidbar-box z-depth-1" style="margin-top: 10px;">
                    <div class="sidebar-title">Popular News</div>
                    <ul>
                        <?php
                        $statement_popular = $db->prepare('SELECT * FROM post ORDER BY hit_count DESC LIMIT 7');
                        $statement_popular->execute();
                        $result_popular = $statement_popular->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($result_popular as $hot_popular) {
                            ?>
                            <li>
                                <a href="details_news.php?id=<?php echo $hot_popular['id']; ?>"> <?php echo $hot_popular['title']; ?></a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>

        </div>

    </div>
</div>


<?php
include_once 'footer.php';
?>