<?php 

class DatabaseConnection {
    private $servername;
    private $username_sql;
    private $password_sql;
    private $dbname;
    private $conn;

    public function __construct($servername, $username_sql, $password_sql, $dbname) {
        $this->servername = $servername;
        $this->username_sql = $username_sql;
        $this->password_sql = $password_sql;
        $this->dbname = $dbname;

        $this->conn = new mysqli($this->servername, $this->username_sql, $this->password_sql, $this->dbname);

        if ($this->conn->connect_error) {
            die("Verbindung fehlgeschlagen: " . $this->conn->connect_error);
        }
    }

    public function getConnection() {
        return $this->conn;
    }

    public function closeConnection() {
        $this->conn->close();
    }

    public function fetchEnumValues($table, $column) {
        $query = "SELECT COLUMN_TYPE FROM information_schema.COLUMNS 
                  WHERE TABLE_NAME = ? AND COLUMN_NAME = ?";
        
        $result = $this->conn->execute_query($query, [$table, $column]);
        if ($result) {
            $row = $result->fetch_assoc();
            $enumString = $row['COLUMN_TYPE'];
            preg_match_all("/'([^']+)'/", $enumString, $matches);
            return $matches[1];
        } else {
            return false;
        }
    }
}

?>