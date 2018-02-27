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
$sub_cat_id = $_REQUEST['id'];
/* ===================== Pagination Code Starts ================== */
$adjacents = 7;




$statement = $db->prepare("SELECT * FROM post where sub_cat_id = ? ORDER BY id DESC");
$statement->execute(array($sub_cat_id));
$total_pages = $statement->rowCount();


//$targetpage = $_SERVER['PHP_SELF'];   //your file name  (the name of this file)
$targetpage = $_SERVER['PHP_SELF'] . "?id=$sub_cat_id&";   //your file name  (the name of this file)

$limit = 5;                                 //how many items to show per page
$page = @$_GET['page'];
if ($page)
    $start = ($page - 1) * $limit;          //first item to display on this page
else
    $start = 0;


$statement = $db->prepare("SELECT * FROM post where sub_cat_id = ? ORDER BY id DESC LIMIT $start, $limit");
$statement->execute(array($sub_cat_id));
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



//                            $sub_cat_id = $_REQUEST['id'];
//                        $statement = $db->prepare("SELECT * FROM post where sub_cat_id = ? ORDER BY id DESC");
//                        $statement->execute(array($sub_cat_id));
//                        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    ?>
                        <div class="col l6 col m12 col s12">
                            <div class="z-depth-1">
                                <!-- Horizontal News Box -->
                                <div class="news horizontal">
                                    <div class="col l4 col m4 col s12 no-padding">
                                        <!-- News Image -->
                                        <div class="news-image">
                                            <img src="./uploads/<?php echo $row['image']; ?>" class="responsive-img" alt="news Image">
    <!--                                        <img src="../uploads/ alt="">-->
                                        </div>
                                    </div>
                                    <div class="col l8 col m8 col s12 no-padding">
                                        <!-- News  Description -->
                                        <div class="news-description">
                                            <div class="news-time">
                                                <i class="fa fa-clock-o"></i> <?= get_difference_with_current($row['post_date']); ?> 
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
                                                        <?php echo "Category-" . $row_category['category_name'] . "  ";
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

            <!--======================================Latest And Popular News====================================-->
            <div class="col l3 col m12 col s12">
                <!-- Sidebar -->
                <div class="sidbar-box z-depth-1">
                    <div class="sidebar-title">Hot News</div>
                    <ul>
                        <?php
                        include_once './config.php';
                        $statement_hot = $db->prepare('SELECT * FROM post WHERE sub_cat_id=? ORDER BY post_date DESC LIMIT 7');
                        $statement_hot->execute(array($sub_cat_id));
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
                        $statement_popular = $db->prepare('SELECT * FROM post WHERE sub_cat_id=? ORDER BY hit_count DESC LIMIT 7');
                        $statement_popular->execute(array($sub_cat_id));
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
<!--======================================Latest And Popular News====================================-->
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
