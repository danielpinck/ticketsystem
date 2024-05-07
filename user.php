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

  public function createUser() {
    
    $sql_createuser = "INSERT INTO users (name, password) VALUES (?, ?)";

    $createuser = $this->db->execute_query($sql_createuser, [$this->username, password_hash($this->password, PASSWORD_DEFAULT)]);
    
  }

  
  public function setRolle($rolle) {
    $this->rolle = $rolle;

  }

  public function getRolle() {
    $rolle_query = "SELECT 'role' FROM users WHERE 'username' = ?";

    $result = $this->db->execute_query($rolle_query, [$this->username]);
    return $result;

  }



  public function getUser() {
    $checklogin = "SELECT * FROM users WHERE username = ? AND password = ?";

    $result = $this->db->execute_query($checklogin, [$this->username, $this->password]);
    // getRolle();
    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $sessionhandler = new SessionHandling();
      $sessionhandler->setSessionValue("username", $row['username']);
      $sessionhandler->setSessionValue("user_id", $row['uid']);
      $sessionhandler->setSessionValue("rolle", $row['privileges']);
      $session_username = $sessionhandler->getSessionValue("username");
      $session_rolle = $sessionhandler->getSessionValue("rolle");
      echo $session_username;
      echo $session_rolle;

    } else {
      var_dump($result);//"Anmeldung nicht erfolgreich.";
    }
    
    
    return $result;
  }

}

?>
