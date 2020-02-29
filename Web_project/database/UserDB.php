<?php
$ROOT_PATH = ini_get("ROOT_PATH");

include_once($ROOT_PATH."/mnt/studentenhomes/michael.de.gauquier/public_html/WDA/Web_project/data/User.php");

include_once 'DatabaseFactory.php';
//include_once '../data/User.php'; Werkt niet

class UserDB {

    private static function getConnection(){
        return DatabaseFactory::getDatabase();
    }

    // Kijken of het account bestaat
    public static function getUser($email, $password){

        $results = self::getConnection()->executeQuery("SELECT Email, Password FROM User WHERE Email = '?' AND Password = '?'", array($email, $password));

        if($results->num_rows > 0) {
            return true;
        }
        else {
            return false;
        }
    }

    // Kijken of email al bestaat
    public static function getUserByEmail($email){

        $results = self::getConnection()->executeQuery("SELECT Email FROM User WHERE Email = '?'", array($email));

        if($results->num_rows > 0) {
            return true;
        }
        else {
            return false;
        }
    }

    // Alle emails uit de DB nemen
    public static function getUserEmail(){

        $results = self::getConnection()->executeQuery("SELECT Email FROM User");

        $resultsArray = array();
        for($i = 0; $i < $results->num_rows; $i++ ){

            $row = $results->fetch_array();

            $user = self::convertRowToObject($row);

            $resultsArray[$i] = $user;
        }

        return $resultsArray;
    }

    // Als 'remember me' aangeklikt is, zet de cookie in de DB bij de juiste user
    public static function updateUserCookie($cookie, $email){
        echo 'Start update';
        return self::getConnection()->executeQuery("UPDATE User SET Cookie = '?' WHERE Email = '?'", array($cookie, $email));
    }

    // Als er een bepaalde cookie is, Neem dan de email uit de DB
    public static function getEmailByCookie($cookie){

        $results = self::getConnection()->executeQuery("SELECT Email FROM User WHERE Cookie = '?'", array($cookie));
        $resultsArray = array();
        for($i = 0; $i < $results->num_rows; $i++ ){

            $row = $results->fetch_array();

            $user = self::convertRowToObject($row);

            $resultsArray[$i] = $user;
        }

        return $resultsArray;

    }

    public static function insertUser($user){
        echo 'Start insert';
        return self::getConnection()->executeQuery("INSERT INTO User(Email, Password, Firstname, Lastname) VALUES ('?','?','?','?')", array($user->Email, $user->Password, $user->Firstname, $user->Lastname));
    }

    public static function convertRowToObject($row){
        return new User(
            $row['Id'] = 0,
            $row['Email'],
            $row['Password'] = '',
            $row['Firstname'] = '',
            $row['Lastname'] = '',
            $row['Cookie'] = '');
    }
}


// Cyclonecode. PHP Include/Require Relative path from WebRoot Issues
// https://stackoverflow.com/questions/14504076/php-include-require-relative-path-from-webroot-issues
// Geraadpleegd op 23 december 2018.
?>
