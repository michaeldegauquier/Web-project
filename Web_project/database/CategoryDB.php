<?php
$ROOT_PATH = ini_get("ROOT_PATH");

include_once($ROOT_PATH."/mnt/studentenhomes/michael.de.gauquier/public_html/WDA/Web_project/data/Category.php");

include_once 'DatabaseFactory.php';
//include_once '../data/Category.php'; Werkt niet

class CategoryDB {

    private static function getConnection(){
        return DatabaseFactory::getDatabase();
    }

    public static function getAllCategories(){

        $results = self::getConnection()->executeQuery("SELECT Id, Category FROM Category");
        $resultsArray = array();
        for($i = 0; $i < $results->num_rows; $i++ ){

            $row = $results->fetch_array();

            $category = self::convertRowToObject($row);

            $resultsArray[$i] = $category;
        }

        return $resultsArray;

    }

    public static function getCategoryByName($catg){

        $results = self::getConnection()->executeQuery("SELECT LOWER(Category) FROM Category WHERE Category = LOWER('?')", array($catg));

        if($results->num_rows > 0) {
            return true;
        }
        else {
            return false;
        }
    }

    public static function insertCategory($category){
        echo 'Start insert';
        return self::getConnection()->executeQuery("INSERT INTO Category(Category) VALUES ('?')", array($category->Category));
    }

    public static function convertRowToObject($row){
        return new Category(
            $row['Id'],
            $row['Category']);
    }
}


// Cyclonecode. PHP Include/Require Relative path from WebRoot Issues
// https://stackoverflow.com/questions/14504076/php-include-require-relative-path-from-webroot-issues
// Geraadpleegd op 23 december 2018.
?>
