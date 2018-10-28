<?php
    session_start();    
    
    class sessions extends db_mod
    {
        private $sessionExists = false;
        public $currentSession 	=   NULL;
        private $message;

        public function set($name, $value)
        {
            if (!isset($_SESSION[$name]))
                $_SESSION[$name] = $value;
        }

        public function get($name)
        {
            if (isset($_SESSION[$name]))
            {
                $message = "Session created";
                return $_SESSION[$name];
            }
            else
                $message = "Session non-existent";
        }

        public function update($name, $value)
        {
            if (!isset($_SESSION[$name]))
                $_SESSION[$name] = $value;
            else
                $_SESSION[$name] = $value;

        }
        
        public function distroy($name)
        {
            if (isset($_SESSION[$name]))
            {
                unset($_SESSION[$name]);
                $message = "Session distroyed!!";
            }
            else
                $message = "Session non-existent";
        }

    }

?>