
<?php
include_once './config.php';
include_once 'header.php';
if (isset($_POST['user_login'])) {
    $statement = $db->prepare("SELECT * FROM user WHERE email = ? AND password = ? AND status = '1'");
    $statement->execute(array($_POST['email'], $_POST['password']));
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    $num = $statement->rowCount();
    foreach($result as $row){
        $user_id = $row['interest'];
    }
    if ($num > 0) {
        session_start();
        $_SESSION['name'] = "user";
//        session_id($user_id);
        $_SESSION['user_id'] = $user_id;
        header('location: index.php');
    }
}
?>



<div class="well" style="min-height:720px ">
    <section id="contact" class="parallax-section">
        <div class="container">
            <div class="row" style="border: 5px solid rgba(255, 0, 0, 0.24);background-color: #3c292afc;margin-top:150px;">
                <div class="col-md-offset-1 col-md-10 col-sm-12 text-center">
                    <h1 class="heading"><b style="color: #ffffff">User Login</b></h1>
                    <hr>
                </div>
                <div class="col-md-offset-1 col-md-10 col-sm-12 wow fadeIn" data-wow-delay="0.9s">

                    <div class="row">

                        <!--                        <div class="col-sm-4">
                                                    <div class="col-md-12 col-sm-6">
                                                        <img src="developer_image/Moshiur H.jpg" alt="">
                                                    </div>
                                                </div>-->

                        <form method="post">
                            <div class="col-sm-8"style="margin-top:10px">
                                <div class="col-md-12 col-sm-12">
            <!--                        <input name="" type="text" class="form-control" id="name" placeholder="Md.Moshiur Rahman Khan">-->
                                    <h4 ><P><b style="color: #ffffff">Log In Here!</b></P></h4>
                                   
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <h4 ><P><b style="color: #ffffff">Email:</b></P></h4>
                                    <input name="email" rows="8" class="form-control" id="message" placeholder="Enter Your Email">
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <h4 ><P><b style="color: #ffffff">Password:</b></P></h4>
                                    <input name="password" rows="8" class="form-control" id="message" placeholder="Enter Your Password">
                                </div>
                                <div class="submit">
                                    <div class=" col-sm-4">

                                        <input style="float: right;margin-top: 10px;" name="user_login" type="submit" class="form-control btn btn-primary" value="LOGIN">
                                    </div>
                                    <div class=" col-sm-8">

                                        <p>Don't have an account ?</p><a href="user_signup.php">SIGN UP HERE</a>
                                    </div>
                                </div>
                            </div>
                        </form>

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