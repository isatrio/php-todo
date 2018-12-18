<?php
namespace Classes;

use PDO;

class Todo {

    protected $db;
    public $statusDB;

    public function __construct() {
        $this->connectDB();
    }

    public function connectDB() {
        $servername = "localhost";
        $username = "root";
        $password = "akulupa";

        try {
            $this->db = new PDO("mysql:host=$servername;dbname=todo", $username, $password);
            // set the PDO error mode to exception
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            $this->statusDB = "Connection failed: " . $e->getMessage();
        }

    }

    public function getAllTodos() {
        $res = $this->db->query("SELECT * FROM todo");
        return $res->fetchAll();
    }

    public function store($text) {
        $thisTime = date('Y/m/d h:i:s');
        try {
            $sql = "INSERT INTO todo (text, done, created_at)
                VALUES ('$text', 0, '$thisTime')";
                // use exec() because no results are returned
            $this->db->exec($sql);

            $this->statusDB = 'Success';
        } catch(PDOException $e) {
            $this->statusDB = $sql . "<br>" . $e->getMessage();
        }
    }
}
