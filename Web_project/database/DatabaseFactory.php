<?php

include_once 'Database.php';

class DatabaseFactory {

    //singleton
    private static $connection;

    public static function getDatabase(){

        if (self::$connection == null) {
            $url = "dt5.ehb.be";
            $user = "1819WEBADV045";
            $passw = "kowu92";
            $db = "1819WEBADV045";
            self::$connection = new Database($url, $user, $passw, $db);
        }

        return self::$connection;
    }

}

?>