<?php

//its give the connection with database
Class Connection
{
    private static $username = 'root';
    private static $password = 'root';
    private static $dsn = 'mysql:host=localhost;dbname=mad_event';

    //create a connection property
    private static $dbcon;

    //private constructor
    private function __construct()
    {
        //to do
    }

    //create public function for get the db connection
    public static function getDb()
    {
        //create try catch for the web page so that its getting the data in the right path
        try {
            if (!isset(self::$dbcon)) {
                //use self to call the property
                self::$dbcon = new PDO(self::$dsn, self::$username, self::$password);
            }
        } catch (PDOException $e) {
            $msg = $e->getMessage();
            echo "error occurred";
        }
        return self::$dbcon;
    }
}