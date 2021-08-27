<?php

class DatabaseHandler
{

    private $conn;
    private $table_name = "student";

    private $col_id    = "_id";
    private $col_name  = "name";
    private $col_roll  = "roll_no";
    private $col_email = "email_id";

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

    function add_data($name, $roll_no, $email_id)
    {
        $query = "INSERT INTO `$this->table_name`(`$this->col_name`, `$this->col_roll`, `$this->col_email`) VALUES('$name', '$roll_no', '$email_id')";
        $this->conn->query($query);
        return true;
    }

    function close()
    {
        if ($this->conn != null) {
            $this->conn->close();
        }
    }
}
