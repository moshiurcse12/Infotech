<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
        <title>I N F O T E C H </title>

        <!-- Materialize CSS  -->
        <link href="./css/materialize.css" type="text/css" rel="stylesheet">

        <!-- Custom Css -->
        <link href="./css/style.css" type="text/css" rel="stylesheet">

        <!-- Font Awesome Css -->
        <link href="./css/font-awesome.min.css" type="text/css" rel="stylesheet">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css" rel="stylesheet">

        <!-- Slider Css -->
        <link href="./css/pgwslider.css" type="text/css" rel="stylesheet">
        <link href="./css/bootstrap.min.css" type="text/css" rel="stylesheet">
        <link rel="stylesheet" id="camera-css" href="./css/camera.css" type="text/css" media="all">

        <style>
            ul li{
                display: inline;
            }
        </style>

    </head>
    <body>
        <?php include_once 'config.php'; ?>
        <!-- Header -->
        <header class="header-fix">
            <!-- Header Top Display In large and Tablet Device -->
            <div class="header-top hide-on-small-only">
                <div class="container">
                    <div class="row">
                        <div class="col l4 col m5 col s12">
                            <a href="#" data-activates="slide-out"style="margin-top:11px;" class="button-collapse show-on-large"><i class="fa fa-bars"></i></a>
                            <!-- Dropdown -->
                            <div class="header-dropdown"style="margin-top:10px; ">
                                <!-- Dropdown Trigger -->
                                <a class="dropdown-button btn" data-beloworigin="true" href="#" data-activates="dropdown">Today <i class="fa fa-angle-down"></i></a><ul id="dropdown" class="dropdown-content" style="position: absolute; top: 51px; left: 113.75px; opacity: 1; display: none;">
                                    <li><a href="javascript:void(0);">Today</a></li>
                                    <li><a href="javascript:void(0);">Yesterday</a></li>
                                    <li><a href="javascript:void(0);">1 Week</a></li>
                                    <li><a href="javascript:void(0);">1 Month</a></li>
                                </ul>
                                <!-- Dropdown Structure -->

                            </div>
                        </div>
                        <div class="col l4 col m3 col s12" style="color: #00FA9A;">
                            <!-- Logo -->
                            <div class="logo">
                                <h3><strong style="color: #ec8b17;margin-bottom:30px"><b>I    N    F    O    T    E    C    H</b></strong></h3>
                            </div>
                        </div>
                        <div class="col l4 col m4 col s12 pull-right">
                            <!-- Search Button -->
                            <form class="searchbox" method="get" action="search.php">
                                <input type="text" placeholder="Type and Press Enter" name="search" class="searchbox-input" required="">
                                <input type="submit" class="searchbox-submit">
                                <span class="searchbox-icon"><i class="fa fa-search"></i></span>
                            </form>
                            <!-- LogIn Link -->
                            <a href="user_login.php" class="right login">Login</a>
                            <a href="logout.php" class="right login">Logout</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Header top Display On Mobile -->
            <div class="header hide-on-med-and-up">
                <div class="top-header">
                    <div class="container">
                        <div class="row">
                            <div class="col l4 col m5 col s2">
                                <a href="#" data-activates="slide-out" class="button-collapse"><i class="fa fa-bars"></i></a>
                            </div>
                            <div class="col l4 col m4 col s5">    
                                <!-- Dropdown -->
                                <div class="header-dropdown">
                                    <!-- Dropdown Trigger -->
                                    <a class="dropdown-button btn" data-beloworigin="true" href="#" data-activates="dropdown-mobile">Today <i class="fa fa-angle-down"></i></a><ul id="dropdown-mobile" class="dropdown-content">
                                        <li><a href="javascript:void(0);">Today</a></li>
                                        <li><a href="javascript:void(0);">Yesterday</a></li>
                                        <li><a href="javascript:void(0);">1 Week</a></li>
                                        <li><a href="javascript:void(0);">1 Month</a></li>
                                    </ul>
                                    <!-- Dropdown Structure -->

                                </div>
                            </div>
                            <div class="col l4 col m4 col s3">
                                <!-- LogIn Link -->
                                <a href="#login.html" class="login">Login</a>
                            </div>
                            <div class="col l4 col m4 col s2">
                                <!-- Search Button -->
                                <form class="searchbox">
                                    <input type="text" placeholder="Type and Press Enter" name="search" class="searchbox-input" required="">
                                    <input type="submit" class="searchbox-submit">
                                    <span class="searchbox-icon"><i class="fa fa-search"></i></span>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bottom-header">
                    <div class="container">
                        <div class="row">
                            <div class="col l4 col m4 col s12">
                                <!-- Logo -->
                                <div class="logo">
                                    <a href="#index.html"><img src="./images/material-logo.png" alt="Logo"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <nav role="navigation" class="hide-on-small-only"> 
                <div class="nav-wrapper menu-category">
                    <ul>
                        <li>
                            <ul class="news-category-dropdown">
                                <li><a href="index.php">Home Page <i class="fa fa-angle-down"></i></a>

                                </li>
                            </ul>
                        </li>

                        <li>
                            <ul class="news-category-dropdown">
                                <li><a href="">Tips & Tricks<i class="fa fa-angle-down"></i></a>
                                    <ul>
                                        <?php
                                        $statement2 = $db->prepare("SELECT * FROM category where category_name = 'Tips & Tricks'");
                                        $statement2->execute();
                                        $category = $statement2->fetchAll(PDO::FETCH_ASSOC);
                                        foreach ($category as $cat) {
                                            $statement1 = $db->prepare("SELECT * FROM sub_category where cat_id = ?");
                                            $statement1->execute(array($cat['id']));
                                            $result_category = $statement1->fetchAll(PDO::FETCH_ASSOC);
                                            foreach ($result_category as $row_category) {
                                                ?>
                                                <li><a href="tips_tricks.php?id=<?php echo $row_category['id']; ?>"><?php echo $row_category['sub_cat_name'] ?></a></li>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </ul>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <ul class="news-category-dropdown">
                                <li><a href="">Tutorials<i class="fa fa-angle-down"></i></a>
                                    <ul>
                                        <?php
                                        $statement2 = $db->prepare("SELECT * FROM category where category_name = 'Tutorial'");
                                        $statement2->execute();
                                        $category = $statement2->fetchAll(PDO::FETCH_ASSOC);
                                        foreach ($category as $cat) {


                                            $statement1 = $db->prepare("SELECT * FROM sub_category where cat_id = ?");
                                            $statement1->execute(array($cat['id']));
                                            $result_category = $statement1->fetchAll(PDO::FETCH_ASSOC);
                                            foreach ($result_category as $row_category) {
                                                ?>
                                                <li><a href="tutorial.php?id=<?php echo $row_category['id']; ?>"><?php echo $row_category['sub_cat_name'] ?></a></li>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <ul class="news-category-dropdown">
                                <li><a href="">Report<i class="fa fa-angle-down"></i></a>
                                    <ul>
                                        <?php
                                        $statement2 = $db->prepare("SELECT * FROM category where category_name = 'Report'");
                                        $statement2->execute();
                                        $category = $statement2->fetchAll(PDO::FETCH_ASSOC);
                                        foreach ($category as $cat) {


                                            $statement1 = $db->prepare("SELECT * FROM sub_category where cat_id = ?");
                                            $statement1->execute(array($cat['id']));
                                            $result_category = $statement1->fetchAll(PDO::FETCH_ASSOC);
                                            foreach ($result_category as $row_category) {
                                                ?>
                                                <li><a href="report.php?id=<?php echo $row_category['id']; ?>"><?php echo $row_category['sub_cat_name'] ?></a></li>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </ul>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <ul class="news-category-dropdown">
                                <li><a href="">Operating System <i class="fa fa-angle-down"></i></a>
                                    <ul>
                                        <?php
                                        $statement2 = $db->prepare("SELECT * FROM category where category_name = 'Operating System'");
                                        $statement2->execute();
                                        $category = $statement2->fetchAll(PDO::FETCH_ASSOC);
                                        foreach ($category as $cat) {


                                            $statement1 = $db->prepare("SELECT * FROM sub_category where cat_id = ?");
                                            $statement1->execute(array($cat['id']));
                                            $result_category = $statement1->fetchAll(PDO::FETCH_ASSOC);
                                            foreach ($result_category as $row_category) {
                                                ?>
                                                <li><a href="operating_system.php?id=<?php echo $row_category['id']; ?>"><?php echo $row_category['sub_cat_name'] ?></a></li>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <ul class="news-category-dropdown">
                                <li><a href="">Product Review <i class="fa fa-angle-down"></i></a>
                                    <ul>
                                        <?php
                                        $statement2 = $db->prepare("SELECT * FROM category where category_name = 'Product Review'");
                                        $statement2->execute();
                                        $category = $statement2->fetchAll(PDO::FETCH_ASSOC);
                                        foreach ($category as $cat) {


                                            $statement1 = $db->prepare("SELECT * FROM sub_category where cat_id = ?");
                                            $statement1->execute(array($cat['id']));
                                            $result_category = $statement1->fetchAll(PDO::FETCH_ASSOC);
                                            foreach ($result_category as $row_category) {
                                                ?>
                                                <li><a href="product_review.php.?id=<?php echo $row_category['id']; ?>"><?php echo $row_category['sub_cat_name'] ?></a></li>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <ul class="news-category-dropdown">
                                <li><a href="">Frelancing<i class="fa fa-angle-down"></i></a>
                                    <ul>
                                        <?php
                                        $statement2 = $db->prepare("SELECT * FROM category where category_name = 'Frelancing'");
                                        $statement2->execute();
                                        $category = $statement2->fetchAll(PDO::FETCH_ASSOC);
                                        foreach ($category as $cat) {


                                            $statement1 = $db->prepare("SELECT * FROM sub_category where cat_id = ?");
                                            $statement1->execute(array($cat['id']));
                                            $result_category = $statement1->fetchAll(PDO::FETCH_ASSOC);
                                            foreach ($result_category as $row_category) {
                                                ?>
                                                <li><a href="frelancing.php?id=<?php echo $row_category['id']; ?>"><?php echo $row_category['sub_cat_name'] ?></a></li>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li><a href="about.php">About</a></li>
                    </ul>
                </div>
            </nav>
        </header> 
