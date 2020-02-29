<?php
$ROOT_PATH = ini_get("ROOT_PATH");

include_once($ROOT_PATH."/mnt/studentenhomes/michael.de.gauquier/public_html/WDA/Web_project/data/Address.php");

include_once 'DatabaseFactory.php';
//include_once '../data/Address.php'; Werkt niet

class AddressDB {

    private static function getConnection(){
        return DatabaseFactory::getDatabase();
    }

    public static function getAllAddressesByEmail($email){

        $results = self::getConnection()->executeQuery("SELECT * FROM Address WHERE UserEmail = '?'", array($email));
        $resultsArray = array();
        for($i = 0; $i < $results->num_rows; $i++ ){

            $row = $results->fetch_array();

            $address = self::convertRowToObject($row);

            $resultsArray[$i] = $address;
        }

        return $resultsArray;

    }

    // Gaat checken of er adressen zijn opgeslagen voor de klant
    public static function getAddressesByEmail($email){

        $results = self::getConnection()->executeQuery("SELECT * FROM Address WHERE UserEmail = '?'", array($email));

        if($results->num_rows > 0) {
            return true;
        }
        else {
            return false;
        }
    }

    // Alle adressen ophalen op email van de user
    public static function getAddressById($email){

        $results = self::getConnection()->executeQuery("SELECT * FROM Address WHERE UserEmail = '?'", array($email));
        $resultsArray = array();
        for($i = 0; $i < $results->num_rows; $i++ ){

            $row = $results->fetch_array();

            $address = self::convertRowToObject($row);

            $resultsArray[$i] = $address;
        }

        return $resultsArray;

    }

    public static function getAddressByAddressId($id){

        $results = self::getConnection()->executeQuery("SELECT * FROM Address WHERE Id = '?'", array($id));
        $resultsArray = array();
        for($i = 0; $i < $results->num_rows; $i++ ){

            $row = $results->fetch_array();

            $address = self::convertRowToObject($row);

            $resultsArray[$i] = $address;
        }

        return $resultsArray;

    }

    // Gaat checken of adres al bestaat op straatnaam en nummer en gebruiker
    public static function getAddressByInput($streetname, $housenumber, $email){

        $results = self::getConnection()->executeQuery("SELECT StreetName, HouseNumber FROM Address WHERE StreetName = '?' AND HouseNumber = '?' AND UserEmail = '?'", array($streetname, $housenumber, $email));

        if($results->num_rows > 0) {
            return true;
        }
        else {
            return false;
        }
    }

    public static function insertAddress($address){
        echo 'Start insert';
        return self::getConnection()->executeQuery("INSERT INTO Address(UserEmail, StreetName, HouseNumber, City, PostalCode) VALUES ('?','?','?','?','?')", array($address->UserEmail, $address->StreetName, $address->HouseNumber, $address->City, $address->PostalCode));
    }

    public static function convertRowToObject($row){
        return new Address(
            $row['Id'],
            $row['UserEmail'],
            $row['StreetName'],
            $row['HouseNumber'],
            $row['City'],
            $row['PostalCode']);
    }
}


// Cyclonecode. PHP Include/Require Relative path from WebRoot Issues
// https://stackoverflow.com/questions/14504076/php-include-require-relative-path-from-webroot-issues
// Geraadpleegd op 23 december 2018.
?>
