<?php

class Database{

    protected $url;
    protected $user;
    protected $passw;
    protected $db;
    protected $connection = null;

    public function __construct($url,$user,$passw,$db){
        $this->url = $url;
        $this->user = $user;
        $this->passw = $passw;
        $this->db = $db;
    }

    public function __destruct() {
        if ($this->connection != null) {
            $this->closeConnection();
        }
    }

    protected function makeConnection(){
        //Make a connection
        $this->connection = new mysqli($this->url,$this->user,$this->passw,$this->db);
        if ($this->connection->connect_error) {
            echo "FAIL:" . $this->connection->connect_error;
        }
    }

    protected function closeConnection() {
        //Close the DB connection
        if ($this->connection != null) {
            $this->connection->close();
            $this->connection = null;
        }
    }

    protected function cleanParameters($p) {
        //prevent SQL injection
        $result = $this->connection->real_escape_string($p);
        return $result;
    }

    public function executeQuery($q, $params = null){

        //Is there a DB connection?
        $this->makeConnection();
        //Adjust query with params if available
        if ($params != null) {
            //Change ? to values from parameter Array
            $queryParts = preg_split("/\?/", $q);
            //If amount of ? is not equel to amount of values => error!
            if (count($queryParts) != count($params) + 1) {
                return false;
            }
            //Add first part
            $finalQuery = $queryParts[0];
            //loop over all parameters
            for ($i = 0; $i < count($params); $i++) {
                //add clean parameter to query
                $finalQuery = $finalQuery . $this->cleanParameters($params[$i]) . $queryParts[$i + 1];
            }
            $q = $finalQuery;
        }

        //execute query
        $results = $this->connection->query($q);

        return $results;
    }
}
?>