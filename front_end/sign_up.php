<?php session_start(); ?>
<!DOCTYPE html>
<html>

    <header>
      <title>SIGN UP</title>  
    </header>
    <body>
        <div class = 'sign_up'>
            <div class = 'title'></div>
            <div class = 'form_back'>
                <form method = "post" action = "../index.php">
                    <label>Email: </label><br>
                    <input type = "mail" name ="email" maxlength="100"><br>
                    <label>Username: </label><br>
                    <input type = "text" name = "username" maxlength="30"><br>
                    <label>Password: </label><br>
                    <input type = "password" name = "password" maxlength="30"><br>
                    <label>First Name: </label><br>
                    <input type = "text" name = "first_name" maxlength="30"><br>
                    <label>Last Name: </label><br>
                    <input type = "text" name = "last_name" maxlength="30"><br><br>
                    <input name="submit" type="submit" value="sign_up">
                </form>
            </div>
        </div>
    </body>
</html>