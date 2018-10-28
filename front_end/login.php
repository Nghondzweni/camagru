<?php session_start(); ?>
<!DOCTYPE html>
<html>

    <header>
      <title>Login</title>  
    </header>
    <body>
        <div class = 'login'>
            <div class = 'title'></div>
            <div class = 'form_back'>
                <form method = "post" action = "../index.php">
                    <label>Email: </label><br>
                    <input type = "mail" name ="email" maxlength="100"><br>
                    <label>Password: </label><br>
                    <input type = "password" name = "password" maxlength="30"><br>
                    <input name="submit" type="submit" value="login">
                </form>
            </div>
        </div>
    </body>
</html>