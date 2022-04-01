<?php

class Manager
{
    private $databaseName = "web_project";
    private $host = "localhost";
    private $username = "root";
    private $password = "root";
    // protected : 
    protected $db;


    //  Constructor 
    protected function __construct()
    {
        $this->db = $this->getDatabase();
    }
    private function getDatabase()
    {
        try {
            return new PDO('mysql:host=' . $this->host . ';dbname=' . $this->databaseName, $this->username, $this->password);
        } catch (PDOException $e) {
            echo $e->getmessage();
        }
    }
    protected function query($query, $values)
    {
        try {
            $res = $this->db->prepare($query);
            $res->execute($values);
        } catch (PDOException $e) {
            throw $e;
        }
        return $res;
    }
}
