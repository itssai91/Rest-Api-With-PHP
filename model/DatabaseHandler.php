<?php
class DatabaseHandler
{
    private $api_token = "B8@c90E2xcV_39VeRT9-c689o04Q9c"; //30 Digits

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

    function get_api_token()
    {
        return $this->api_token;
    }

    function get_data()
    {
        $query = "SELECT * FROM `$this->table_name` ";
        $result = $this->conn->query($query);
        return $result;
    }

    function add_data($name, $roll_no, $email_id)
    {
        if ($this->check_register($email_id)) {
            $query = "INSERT INTO `$this->table_name`(`$this->col_name`, `$this->col_roll`, `$this->col_email`) VALUES(?, ?, ?)";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param('sss', $name, $roll_no, $email_id);
            if ($stmt->execute()) {
                if ($stmt != null) {
                    $stmt->close();
                }
                $this->close();
                return true;
            }
        } else {
                return false;
        }
    }

    function update_data($name, $roll, $new_email, $old_email)
    {
        if (!$this->check_register($old_email)) {
            $query = "UPDATE `$this->table_name` SET `$this->col_name` = ?, `$this->col_roll` = ?, `$this->col_email` = ? WHERE `$this->col_email` = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param('ssss', $name, $roll, $new_email, $old_email);
            if ($stmt->execute()) {
                if ($stmt != null) {
                    $stmt->close();
                }
                $this->close();
                return true;
            } else {
                return false;
            }
        }
    }

    function delete_data($email)
    {
        if (!$this->check_register($email)) {
            $query = "DELETE FROM `$this->table_name` WHERE `$this->col_email` = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param('s', $email);
            if ($stmt->execute()) {
                if ($stmt != null) {
                    $stmt->close();
                }
                $this->close();
                return true;
            } else {
                return false;
            }
        }
    }

    function check_register($s_email)
    {
        $query = "SELECT * FROM `$this->table_name` WHERE `$this->col_email` = '$s_email'";
        $result = $this->conn->query($query);
        if ($result->num_rows > 0) {
            return false;
        } else {
            return true;
        }
    }

    function close()
    {
        if ($this->conn != null) {
            $this->conn->close();
        }
    }
}
