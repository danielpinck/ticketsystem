<?php 

class User {
  private $username;
  private $password;
  private $rolle;
  private $db;

  public function __construct($db) {
    $this->db = $db;

  }

  public function setUsername($username) {
    $this->username = $username;
  }


  public function setPassword($password) {
    $this->password = $password;
  }

  public function setRolle($rolle) {
    $this->rolle = $rolle;

  }
  public function createUser() {
    $sql_createuser = "INSERT INTO users (username, password, rolle) VALUES (?, ?, ?)";
    $createuser = $this->db->execute_query($sql_createuser, [$this->username, password_hash($this->password, PASSWORD_DEFAULT), $this->rolle]);
    
  }

  public function getRolle() {
    $rolle_query = "SELECT 'rolle' FROM users WHERE 'username' = ?";

    $result = $this->db->execute_query($rolle_query, [$this->username]);
    return $result;

  }



  public function getUser() {
    // mysqli statement
    $checklogin = "SELECT * FROM users WHERE username = ? AND password = ?";
    // execute mysql statement
    $result = $this->db->execute_query($checklogin, [$this->username, $this->password]);

    // checks if the query was successfull
    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
    // adds info into an array
      $userInfo = array(
        "username"=> $row["username"],
        "user_id"=> $row["uid"],
        "rolle"=> $row["rolle"]
      );
      // set session values from sessionhandling class
      $sessionhandler = new SessionHandling();
      $sessionhandler->setSessionValue("username", $row['username']);
      $sessionhandler->setSessionValue("user_id", $row['uid']);
      $sessionhandler->setSessionValue("rolle", $row['rolle']);
      
      // returns the array with user info
      return $userInfo;

    } else {
      // returns flase when the query is empty meaning the login fails
      return false;
    }

  }

}

?>
