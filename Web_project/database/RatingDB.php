<?php
$ROOT_PATH = ini_get("ROOT_PATH");

include_once($ROOT_PATH."/mnt/studentenhomes/michael.de.gauquier/public_html/WDA/Web_project/data/Rating.php");

include_once 'DatabaseFactory.php';
//include_once '../data/Rating.php'; Werkt niet

class RatingDB {

    private static function getConnection(){
        return DatabaseFactory::getDatabase();
    }

    // Gaat kijken of er al een feedback gegeven is door die user
    public static function getRatingByEmail($email, $productId){
        $results = self::getConnection()->executeQuery("SELECT UserEmail, ProductId FROM Rating WHERE UserEmail = '?' AND ProductId = '?'", array($email, $productId));

        if($results->num_rows > 0) {
            return true;
        }
        else {
            return false;
        }
    }

    // Gemiddelde rating op product
    public static function getAVGRatingByProductId($productId){
        $results = self::getConnection()->executeQuery("SELECT ROUND(AVG(Rating),1) FROM Rating WHERE ProductId = '?'", array($productId));

        $resultsArray = array();
        for($i = 0; $i < $results->num_rows; $i++ ){

            $row = $results->fetch_array();

            $rating = self::convertRowToObject1($row);

            $resultsArray[$i] = $rating;
        }

        return $resultsArray;

    }

    // Feedback op product
    public static function getFeedbackByProductId($productId){
        $results = self::getConnection()->executeQuery("SELECT r.ProductId, r.UserEmail, ROUND(r.Rating,1), r.Feedback, r.Date, u.Firstname, u.Lastname FROM Rating r JOIN User u ON(r.UserEmail = u.Email) WHERE r.ProductId = '?' ORDER BY Date DESC LIMIT 5;", array($productId));

        $resultsArray = array();
        for($i = 0; $i < $results->num_rows; $i++ ){

            $row = $results->fetch_array();

            $rating = self::convertRowToObject2($row);

            $resultsArray[$i] = $rating;
        }

        return $resultsArray;

    }

    // Kijken of er al een rating is geplaatst op product door bezoeker
    public static function getRatingByUserEmail($email, $productId){
        $results = self::getConnection()->executeQuery("SELECT * FROM Rating WHERE UserEmail = '?' AND ProductId = '?'", array($email, $productId));

        if($results->num_rows > 0) {
            return true;
        }
        else {
            return false;
        }
    }

    // Kijken of er een rating is geplaatst op product
    public static function getRatingByProductId($productId){
        $results = self::getConnection()->executeQuery("SELECT Rating FROM Rating WHERE ProductId = '?'", array($productId));

        if($results->num_rows > 0) {
            return true;
        }
        else {
            return false;
        }
    }

    public static function insertRating($rating){
        echo 'Start insert';
        return self::getConnection()->executeQuery("INSERT INTO Rating(ProductId, UserEmail, Rating, Feedback) VALUES ('?','?','?','?')", array($rating->ProductId, $rating->UserEmail, $rating->Rating, $rating->Feedback));
    }

    public static function convertRowToObject1($row){
        return new Rating(
            $row['Id'] = 0,
            $row['ProductId'] = 0,
            $row['UserEmail'] = '',
            $row['ROUND(AVG(Rating),1)'],
            $row['Feedback'] = '',
            $row['Date'] = '',
            $row['Firstname'] = '',
            $row['Lastname'] = '');
    }

    public static function convertRowToObject2($row){
        return new Rating(
            $row['Id'] = 0,
            $row['ProductId'],
            $row['UserEmail'],
            $row['ROUND(r.Rating,1)'],
            $row['Feedback'],
            $row['Date'],
            $row['Firstname'],
            $row['Lastname']);
    }
}


// Cyclonecode. PHP Include/Require Relative path from WebRoot Issues
// https://stackoverflow.com/questions/14504076/php-include-require-relative-path-from-webroot-issues
// Geraadpleegd op 23 december 2018.
?>
