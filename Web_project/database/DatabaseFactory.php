<?php

include_once 'Database.php';

class DatabaseFactory {

    //singleton
    private static $connection;

    public static function getDatabase(){

        if (self::$connection == null) {
            $url = "dt5.ehb.be";
            $user = "username_db";
            $passw = "pswd_db";
            $db = "db_name";
            self::$connection = new Database($url, $user, $passw, $db);
        }

        return self::$connection;
    }

}

?>
