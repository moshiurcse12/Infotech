<?php
include_once './config.php';
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