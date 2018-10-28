<?php
    include_once ("db_setup/db_mod.php");
    session_start();

    class user extends db_mod
    {
        private  $pdo;

        public function __construct(array $kwargs)
        {
            parent::__construct($kwargs);
            $this->pdo = $this->connect();
        }

        public function sign_up()
        {
            try
            {
                if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['first_name']) && isset($_POST['last_name']))
                {
                    $this->username = $_POST['username'];
                    $this->email = strtolower($_POST['email']);
                    $this->password = $_POST['password'];
                    $this->first_name = $_POST['first_name'];
                    $this->last_name = $_POST['last_name'];
                    $sql = ('SELECT * FROM `users` WHERE email = "'.$this->email.'" OR username= "'.$this->username.'"');
                    $stmt = $this->pdo->prepare($sql);
                    $stmt->execute();
                    $record = $stmt->fetch();
                    if($record == NULL)
                    {
                        $sql = ('INSERT INTO `users` (`email`, `username`, `password`, `first_name`, `last_name`) VALUES
                        ("'.$this->email.'", "'.$this->username.'", "'.$this->password.'", "'.$this->first_name.'", "'.$this->last_name.'")');
                        $stmt = $this->pdo->prepare($sql);
                        $stmt->execute();
                        echo "User successfully added";
                        header("Location: localhost:8080/my camagru/camagru/front_end/login.php");
                    }
                    else
                    {
                        echo "User already exists <br>";
                        exit(-1);
                    }
                }
                else
                    header("Location: ../front_end/sign_up.php");

            }
            catch(PDOException $e)
            {
                $_SESSION['error'] = "ERROR: ".$e->getMessage();
            }
        }

        public function login()
        {
            if(isset($_POST['email']) && isset($_POST['password']))
            {
                $this->email = strtolower($_POST['email']);
                $this->password = $_POST['password'];
                $sql = ('SELECT * FROM `users` WHERE email = "'.$this->email.'" AND password= "'.$this->password.'"');
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute();
                $record = $stmt->fetch();
                if($record != NULL)
                {
                    $_SESSION['user_id'] = $record['user_id'];
                    $_SESSION['username'] = $record['username'];
                    $this->fetch_profile_pic();
                    echo $_SESSION['username']. " Successfully logged in";
                    header("Location: index.php");
                }
                else
                {
                    echo "Wrong username and password entered <br>";
                }
            }
        }

        public function logout()
        {
            if(isset($_SESSION['user_id']))
            {   
                
                session_destroy();
                unset($_SESSION['user_id']);
                "Successfully logged out!";
                header("Location: index.php");
            }
            else
                echo "User already logged out";
        }

        public function fetch_profile_pic()
        {
            $sql = 'SELECT `profile_img_url` FROM `users` WHERE user_id = "'.$_SESSION['user_id'].'"';
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            
            $record = $stmt->fetch();
            if($record != NULL)
            {
                $_SESSION['profile_pic_url'] = $record['profile_img_url'];
            }
        }

        public function upload_profile_pic()
        {
            var_dump($_FILES);
            if(isset($_FILES['file']['name'])){
                $name = $_FILES['file']['name'];     //the file's original name on the client's machine will be stored in this variable
                $extension = strtolower(substr($name,strpos($name,'.')+1));		//substr(text, position to start) strpos will start one position after the dot
                $size = $_FILES['file']['size']; //this will store the file size in the associative array
                $max_size = 100000;
                $type = $_FILES['file']['type']; //this will store the type of the file
                $tmp_name = $_FILES['file']['tmp_name']; //the temporary name of the file in which the uploaded file is stored in the server will be stored in the variable
                if (isset($name)){
                    if(!empty($name)){
                        if(($extension == 'jpg' || $extension == 'jpeg') && ($type == 'image/jpeg' || $type == 'image/jpg') && $size <= $max_size)
                        {
                            $location = 'images/';
                            if(move_uploaded_file($tmp_name, $location.$name)){ //move_uploaded_file(temporary name, location.filename)
                            echo "Successful";		
                            }
                            else{
                                echo 'There was an error';
                            }
                        }
                        else{
                            echo 'File must be jpg/jpeg and must be 2MB or less';
                        }
                    }
                    else{
                        echo "Please select file";
                    }
                }          
            }            
        }
    }
?>

