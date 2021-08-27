<?php

class DatabaseHandler
{

    private $conn;
    private $table_name = "student";

    function __construct($conn)
    {
        $this->conn = $conn;
    }

    function get_data()
    {
        $query = "SELECT * FROM `$this->table_name` ";
        $result = $this->conn->query($query);
        return $result;
    }

    function close()
    {
        if ($this->conn != null) {
            $this->conn->close();
        }
    }
}
