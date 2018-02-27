<?php
if (isset($_POST['user_login'])) {
//    $first_name = $_POST['first_name'];
//    $last_name = $_POST['last_name'];
//    $email = $_POST['email'];
//    $interest = $_POST['interest'];
//    $password = $_POST['password'];
//    $con_pass = $_POST['con_password'];
//
//    include_once './config.php';
//    $statement = $db->prepare("INSERT INTO user (first_name,last_name,email,password,interest) VALUES (?,?,?,?,?)");
//    $value = $statement->execute(array($first_name, $last_name, $email, $password, $interest));
//    
//    
//
//    if ($value) {
//        header('location: user_login.php');
//    } else {
//        $error_message = "Something went wrong";
//    }
}
?>

<?php
include_once 'header.php';
?>

<div class="well" style="min-height:720px ">
    <section id="contact" class="parallax-section">
        <div class="container">
            <div class="row" style="border: 5px solid rgba(255, 0, 0, 0.24);background-color: #3c292afc;margin-top:150px;">
                <div class="col-md-offset-1 col-md-10 col-sm-12 text-center">
                    <h1 class="heading"><b style="color: #ffffff">User Registration</b></h1>
                    <hr>
                </div>
                <div class="col-md-offset-1 col-md-10 col-sm-12 wow fadeIn" data-wow-delay="0.9s">

                    <div class="row form-group">

                        <!--                        <div class="col-sm-4">
                                                    <div class="col-md-12 col-sm-6">
                                                        <img src="developer_image/Moshiur H.jpg" alt="">
                                                    </div>
                                                </div>-->
                        <form class="form-group" action="test.php" method="post">
                            <div class="col-sm-8"style="margin-top:10px;margin-bottom:30px">
                                <div class="col-md-12 col-sm-12">
            <!--                        <input name="" type="text" class="form-control" id="name" placeholder="Md.Moshiur Rahman Khan">-->
                                    <h4 ><P><b style="color: #ffffff">Sign up Here!</b></P></h4>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <h4 ><P><b style="color: #ffffff">First Name:</b></P></h4>
                                    <input name="first_name" rows="8" class="form-control" id="message" placeholder="Enter Your First Name">
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <h4 ><P><b style="color: #ffffff">Last Name:</b></P></h4>
                                    <input name="last_name" rows="8" class="form-control" id="message" placeholder="Enter Your Last Name">
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <h4 ><P><b style="color: #ffffff">Email:</b></P></h4>
                                    <input name="email" rows="8" class="form-control" id="message" placeholder="Enter Your Email">
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <h4 ><P><b style="color: #ffffff">Password:</b></P></h4>
                                    <input name="password" rows="8" class="form-control" id="message" placeholder="Enter Your Password">
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <h4 ><P><b style="color: #ffffff">Confirm New Password:</b></P></h4>
                                    <input name="con_password" rows="8" class="form-control" id="message" placeholder="Confirm Your Password">
                                </div>
                                <div class="col-md-12 col-sm-12 form-group">
                                    <h4><b style="color: #ffffff">Interest:</b></h4>
                                    <select name="interest" class="form-control">
                                        <option>Select Category</option>
<?php
$statement_sub_cat = $db->prepare('SELECT * FROM sub_category');
$statement_sub_cat->execute();
$result_sub_cat = $statement_sub_cat->fetchAll(PDO::FETCH_ASSOC);
foreach ($result_sub_cat as $row_sub_cat) {
    ?>

                                            <option value="<?php echo $row_sub_cat['id']; ?>"><?php echo $row_sub_cat['sub_cat_name']; ?></option>

<?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-12 form-group">
                                    <div class=" col-sm-4">
                                        <input type="submit" style="margin-top: 10px;" name="user_login" type="submit" class="form-control btn btn-primary" value="Sign up">
                                    </div>

                                </div>
                        </form>

                    </div>

                </div>
                <div class="col-md-2 col-sm-1"></div>
            </div>
        </div>
</div>
</section>

</div>

<?php
include_once 'footer.php';
?>