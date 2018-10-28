<?php
    include "db_info.php";
    
    try
    {
        $dbh = new PDO($dbsn, $db_user, $db_password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DROP DATABASE `camagru`";
        $dbh->exec($sql);
        echo "Table 'users successfully deleted.<br>";
    }
    catch(PDOException $e)
    {
        echo "Error Deleting Table 'users' : <br>".$e->getMessage()."<br>Aborting process<br>";
    }
?>