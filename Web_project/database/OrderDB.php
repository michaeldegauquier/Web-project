<?php
$ROOT_PATH = ini_get("ROOT_PATH");

include_once($ROOT_PATH."/mnt/studentenhomes/michael.de.gauquier/public_html/WDA/Web_project/data/Order.php");

include_once 'DatabaseFactory.php';
//include_once '../data/Order.php'; Werkt niet

class OrderDB {

    private static function getConnection(){
        return DatabaseFactory::getDatabase();
    }

    public static function getAllOrders(){

        $results = self::getConnection()->executeQuery("SELECT o.Id, o.UserEmail, p.Name, o.OrderDate, o.BillingAddressId, a1.StreetName, a1.HouseNumber, a1.City, a1.PostalCode, o.DeliveryAddressId, a2.StreetName as StreetName2, a2.HouseNumber as HouseNumber2, a2.City as City2, a2.PostalCode as PostalCode2, o.DeliveryMethod, o.PaymentMethod
                                                            FROM `Order` o JOIN Product p ON(o.ProductId = p.Id)
                                                            JOIN Address a1 ON(o.BillingAddressId = a1.Id)
                                                            JOIN Address a2 ON(o.DeliveryAddressId = a2.Id)");
        $resultsArray = array();
        for($i = 0; $i < $results->num_rows; $i++ ){
            //Retrieves the current selected row
            $row = $results->fetch_array();
            //Make an Order
            $order = self::convertRowToObject($row);
            //add order to result array
            $resultsArray[$i] = $order;
        }

        return $resultsArray;

    }

    public static function getAllOrdersByEmail($email){

        $results = self::getConnection()->executeQuery("SELECT o.Id, o.UserEmail, p.Name, o.OrderDate, o.BillingAddressId, a1.StreetName, a1.HouseNumber, a1.City, a1.PostalCode, o.DeliveryAddressId, a2.Streetname as StreetName2, a2.HouseNumber as HouseNumber2, a2.City as City2, a2.PostalCode as PostalCode2, o.DeliveryMethod, o.PaymentMethod
                                                            FROM `Order` o JOIN Product p ON(o.ProductId = p.Id)
                                                            JOIN Address a1 ON(o.BillingAddressId = a1.Id)
                                                            JOIN Address a2 ON(o.DeliveryAddressId = a2.Id) WHERE o.UserEmail = '?'", array($email));
        $resultsArray = array();
        for($i = 0; $i < $results->num_rows; $i++ ){
            //Retrieves the current selected row
            $row = $results->fetch_array();
            //Make an Order
            $order = self::convertRowToObject($row);
            //add order to result array
            $resultsArray[$i] = $order;
        }

        return $resultsArray;

    }

    public static function insertOrder($order){
        echo 'Start insert';
        return self::getConnection()->executeQuery("INSERT INTO `Order`(UserEmail, ProductId, BillingAddressId, DeliveryAddressId, DeliveryMethod, PaymentMethod) VALUES ('?','?','?','?','?','?')", array($order->UserEmail, $order->ProductName, $order->BillingAddressId, $order->DeliveryAddressId, $order->DeliveryMethod, $order->PaymentMethod));
    }

    public static function convertRowToObject($row){
        return new Order(
            $row['Id'],
            $row['UserEmail'],
            $row['Name'],
            $row['OrderDate'],
            //Billing address
            $row['BillingAddressId'],
            $row['StreetName'],
            $row['HouseNumber'],
            $row['City'],
            $row['PostalCode'],
            //Delivery address
            $row['DeliveryAddressId'],
            $row['StreetName2'],
            $row['HouseNumber2'],
            $row['City2'],
            $row['PostalCode2'],
            $row['DeliveryMethod'],
            $row['PaymentMethod']);
    }
}


// Cyclonecode. PHP Include/Require Relative path from WebRoot Issues
// https://stackoverflow.com/questions/14504076/php-include-require-relative-path-from-webroot-issues
// Geraadpleegd op 23 december 2018.
?>
