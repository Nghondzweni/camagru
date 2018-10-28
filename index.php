<?php
    include_once ("classes/users.class.php");
    ini_set('display_errors', 0);
    session_start();

    $crud = new user($db_args);
    if($_POST['submit'] === 'login')
        $crud->login();
    else if($_POST['submit'] === 'sign_up')
        $crud->sign_up();
    if($_POST['submit'] === 'upload')
    {
        $crud->upload_profile_pic();
        echo "done";
        exit(1);
    }
    if($_GET['logout'] === 'logout')
        $crud->logout(); 
?>
<!DOCTYPE html>
<html>
    <header>
      <title>Home</title>  
    </header>
    <body>
        <?php 
            if(isset($_SESSION['user_id']))
            {
                echo "Welcome To Camagru ".$_SESSION['username'].'<br>';
                echo '<img src= "'.$_SESSION['profile_pic_url'].'"<br>';
            }
            else
                header("Location: front_end/login.php");
            
            if(isset($_GET['submit']) && $_GET['submit'] === 'uploadBtn')
            {
                echo '<form action="index.php" method="POST" enctype="multipart/form-data">
                <input type="file" name="file">
                <button type="submit" name="submit" value = "upload">UPLOAD</button>
                </form>';
            } 
        ?>
        <br>
        <a href='index.php?submit=uploadBtn'>upload profile picture</a>
        <br>
        <a href='index.php?logout=logout'>logout</a>
    </body>
</html>