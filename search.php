<?php
include_once 'header.php';
include_once 'config.php';
include_once 'function/functions.php';
?>

<!-- Main Wrapper -->
<div class="wrapper margin-top">
    <div class="container">
        <div class="row">
            <div class="col l9 col m12 col s12">

                <!-- News Slider -->
                <div class="row">
                    <?php
                    $search = $_REQUEST['search'];
                    /* ===================== Pagination Code Starts ================== */
                    $adjacents = 7;
                    $statement = $db->prepare("SELECT * FROM post where title LIKE ? OR description LIKE ? ORDER BY id DESC");
                    $statement->execute(array("%$search%", "%$search%"));
                    $total_pages = $statement->rowCount();
                    $targetpage = $_SERVER['PHP_SELF'] . "?search=$search&";   //your file name  (the name of this file)

                    $limit = 10;                                 //how many items to show per page
                    $page = @$_GET['page'];
                    if ($page)
                        $start = ($page - 1) * $limit;          //first item to display on this page
                    else
                        $start = 0;


                    $statement = $db->prepare("SELECT * FROM post where title LIKE ? OR description LIKE ? ORDER BY id DESC LIMIT $start, $limit");
                    $statement->execute(array("%$search%", "%$search%"));

                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);


                    if ($page == 0)
                        $page = 1;                  //if no page var is given, default to 1.
                    $prev = $page - 1;                          //previous page is page - 1
                    $next = $page + 1;                          //next page is page + 1
                    $lastpage = ceil($total_pages / $limit);      //lastpage is = total pages / items per page, rounded up.
                    $lpm1 = $lastpage - 1;
                    $pagination = "";
                    if ($lastpage > 1) {
                        $pagination .= "<div class=\"pagination\">";
                        if ($page > 1)
                            $pagination.= "<a href=\"$targetpage?page=$prev\">&#171; previous</a>";
                        else
                            $pagination.= "<span class=\"disabled\">&#171; previous</span>";
                        if ($lastpage < 7 + ($adjacents * 2)) {   //not enough pages to bother breaking it up
                            for ($counter = 1; $counter <= $lastpage; $counter++) {
                                if ($counter == $page)
                                    $pagination.= "<span class=\"current\">$counter</span>";
                                else
                                    $pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";
                            }
                        }
                        elseif ($lastpage > 5 + ($adjacents * 2)) {    //enough pages to hide some
                            if ($page < 1 + ($adjacents * 2)) {
                                for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
                                    if ($counter == $page)
                                        $pagination.= "<span class=\"current\">$counter</span>";
                                    else
                                        $pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";
                                }
                                $pagination.= "...";
                                $pagination.= "<a href=\"$targetpage?page=$lpm1\">$lpm1</a>";
                                $pagination.= "<a href=\"$targetpage?page=$lastpage\">$lastpage</a>";
                            }
                            elseif ($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
                                $pagination.= "<a href=\"$targetpage?page=1\">1</a>";
                                $pagination.= "<a href=\"$targetpage?page=2\">2</a>";
                                $pagination.= "...";
                                for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                                    if ($counter == $page)
                                        $pagination.= "<span class=\"current\">$counter</span>";
                                    else
                                        $pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";
                                }
                                $pagination.= "...";
                                $pagination.= "<a href=\"$targetpage?page=$lpm1\">$lpm1</a>";
                                $pagination.= "<a href=\"$targetpage?page=$lastpage\">$lastpage</a>";
                            }
                            else {
                                $pagination.= "<a href=\"$targetpage?page=1\">1</a>";
                                $pagination.= "<a href=\"$targetpage?page=2\">2</a>";
                                $pagination.= "...";
                                for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
                                    if ($counter == $page)
                                        $pagination.= "<span class=\"current\">$counter</span>";
                                    else
                                        $pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";
                                }
                            }
                        }
                        if ($page < $counter - 1)
                            $pagination.= "<a href=\"$targetpage?page=$next\">next &#187;</a>";
                        else
                            $pagination.= "<span class=\"disabled\">next &#187;</span>";
                        $pagination.= "</div>\n";
                    }
                    /* ===================== Pagination Code Ends ================== */


//                        $statement = $db->prepare("SELECT * FROM post ORDER BY id DESC");
//                        $statement->execute();
//                        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($result as $row) {
                        ?>
                        <div class="col l6 col m12 col s12"style="margin-bottom: 15px;">
                            <div class="z-depth-1">
                                <!-- Horizontal News Box -->
                                <div class="news horizontal">
                                    <div class="col l4 col m4 col s12 no-padding">
                                        <!-- News Image -->
                                        <div class="news-image">
                                            <?php if ((($row['image']) != null) || (($row['image']) != "")) { ?>
                                                <img src="./uploads/<?php echo $row['image']; ?>" class="responsive-img" alt="news Image">
                                            <?php } else { ?>
                                                <video width="100%" class="video-show" controls>
                                                    <source src="./uploads/<?php echo $row['video']; ?>" type="video/mp4">

                                                </video>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="col l8 col m8 col s12 no-padding">
                                        <!-- News  Description -->
                                        <div class="news-description">
                                            <div class="news-time">
                                                <i class="fa fa-clock-o"></i> 
                                                <?= get_difference_with_current($row['post_date']); ?>
                                            </div>
                                            <div class="news-title"><a href="details_news.php?id=<?php echo $row['id'] ?>">
                                                    <?php echo $row['title']; ?>
                                                </a>
                                                <?php
                                                $statement1 = $db->prepare("SELECT category_name FROM category where id =? ");
                                                $statement1->execute(array($row['category_id']));
                                                $result_category = $statement1->fetchAll(PDO::FETCH_ASSOC);
                                                foreach ($result_category as $row_category) {
                                                    $statement1 = $db->prepare("SELECT sub_cat_name FROM sub_category where id = ?");
                                                    $statement1->execute(array($row['sub_cat_id']));
                                                    $result_sub_category = $statement1->fetchAll(PDO::FETCH_ASSOC);
                                                    foreach ($result_sub_category as $row_sub_category) {
                                                        ?>
                                                        <?php
                                                        echo "Category-" . $row_category['category_name'] . "  ";
                                                        echo "Sub Category-" . $row_sub_category['sub_cat_name'];
                                                    }
                                                }
                                                ?>
                                            </div>
                                            <div class="news-content"><p>
                                                    <?php ?>
                                                </p></div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Horizontal News Box -->

                            </div>
                        </div>
                        <?php
                    }
                    ?>
</div>
            </div>
</div> 
  </div>
</div>

<center>
    <div class="pagination text-center">        
        <?php
        echo $pagination;
        ?>
    </div>
</center>


<?php
include_once 'footer.php';
?>

