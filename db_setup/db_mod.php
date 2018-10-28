<?php
    require_once "db_connect.php";
    require_once ("db_info.php");

    class db_mod extends DB
    {
        private $pdo;
        public $message;
        
        public function __construct(array $kwargs)
        {
            parent::__construct($kwargs); //initiate the parent class and get pdo ready
            $this->pdo = $this->connect(); //this connec() returns a pdo which will be used across program with functions that interact with the db
        }

        public function config($args)
        {
            $this->db_create_user_table();
            $this->db_create_following_table();
            $this->db_create_images_table();
            $this->db_create_comments_table();
            $this->db_create_likes_table();
        }

        public function db_create_user_table()
        {
            //CREATE TABLE USERS
            try
            {
                $sql = "CREATE TABLE `users`
                (
                    `user_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                    `email` VARCHAR (100) NOT NULL,
                    `username` VARCHAR (30) NOT NULL, 
                    `password` VARCHAR (255) NOT NULL,
                    `first_name` VARCHAR (30) NOT NULL,
                    `last_name` VARCHAR (30) NOT NULL,
                    `verified` BOOLEAN NOT NULL DEFAULT 0,
                    `profile_img_url` VARCHAR (255) DEFAULT 'images/default.png'
                )";
                $this->pdo->exec($sql);
                echo "Table 'users' successfully created.<br>";
            }
            catch(PDOException $e)
            {
                echo "Error Creating Table 'users' : <br>".$e->getMessage()."<br>Aborting process<br>";
            }
        }

        public function db_create_following_table()
        {
            //CREATE TABLE FOLLOWING
            try
            {
                $sql = "CREATE TABLE `following`
                (
                    `user_id` INT NOT NULL,
                    `following_id` INT NOT NULL
                )";
                $this->pdo->exec($sql);
                echo "Table 'following' successfully created.<br>";
            }
            catch(PDOException $e)
            {
                echo "Error Creating Table 'following' : <br>".$e->getMessage()."<br>Aborting process<br>";
            }
        }

        public function db_create_images_table()
        {
            //CREATE TABLE IMAGES
            try
            {
                $sql = "CREATE TABLE `images`
                (
                    `user_id` INT NOT NULL,
                    `image_id` INT NOT NULL,
                    `caption` VARCHAR (250) NOT NULL, 
                    `upload_date` DATETIME NOT NULL,
                    `image_url` VARCHAR (250) NOT NULL
                )";
                $this->pdo->exec($sql);
                echo "Table 'images' successfully created.<br>";
            }
            catch(PDOException $e)
            {
                echo "Error Creating Table 'images' : <br>".$e->getMessage()."<br>Aborting process<br>";
            }
        }

        public function db_create_comments_table()
        {
            //CREATE TABLE COMMENTS
            try
            {
                $sql = "CREATE TABLE `comments`
                (
                    `user_id` INT NOT NULL,
                    `image_id` INT NOT NULL,
                    `comment_user_id` INT NOT NULL,
                    `comment` VARCHAR (150) NOT NULL, 
                    `time` DATETIME NOT NULL
                )";
                $this->pdo->exec($sql);
                echo "Table 'comments' successfully created.<br>";
            }
            catch(PDOException $e)
            {
                echo "Error Creating Table 'comments' : <br>".$e->getMessage()."<br>Aborting process<br>";
            }
        }

        public function db_create_likes_table()
        {
            //CREATE TABLE LIKES
            try
            {
                $sql = "CREATE TABLE `likes`
                (
                    `user_id` INT NOT NULL,
                    `image_id` INT NOT NULL,
                    `user_who_liked_id` INT NOT NULL, 
                    `like time` DATETIME NOT NULL
                )";
                $this->pdo->exec($sql);
                echo "Table 'likes' successfully created.<br>";
            }
            catch(PDOException $e)
            {
                echo "Error Creating Table 'likes' : <br>".$e->getMessage()."<br>Aborting process<br>";
            }
        }
    }
    
    function db_create(array $kwargs)
    {
        //CREATE DATABASE
        try
        {
            $dbh = new PDO('mysql:host='. $kwargs['host'], $kwargs['db_user'], $kwargs['db_password']);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "CREATE DATABASE `".$kwargs['db_name']."`";
            $dbh->exec($sql);
            echo "Database successfully created <br>";
        }
        catch(PDOException $e)
        {
            echo "Error Creating Database '".$kwargs['db_name']."' : <br>".$e->getMessage()."\nAborting process\n";
            exit(-1);
        }            
    }
?>