<?php

    require_once "db_info.php";
    class DB
    {
        private $dbh;
        private $host;
        private $db_name;
        private $db_user;
        private $db_password;

        public function __construct(array $kwargs)
        {
                $this->host 		= $kwargs['host'];
                $this->db_name 		= $kwargs['db_name'];
                $this->db_user 		= $kwargs['db_user'];
                $this->db_password 	= $kwargs['db_password'];
    
                try
                {
                    $this->dbh = new PDO("mysql:host=$this->host;dbname=$this->db_name", $this->db_user, $this->db_password);
                    $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    return $this->dbh;
                }
                catch(PDOException $e)
                {
                    echo "Connection failed: " . $e->getMessage();
                }
        }

        public function connect()
        {
            return ($this->dbh);
        }
    }
?>
