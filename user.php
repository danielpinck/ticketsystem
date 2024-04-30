<?php 

class User {
  private $username;
  private $password;
  private $privileges;
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

    $createuser = $this->db->execute_query($sql_createuser, [$this->username, $this->password]);
    
  }

  
  public function setPrivileges($privileges) {
    $this->privileges = $privileges;

  }

  public function getPrivileges($privileges) {

  }



  public function getUser() {
    $checklogin = "SELECT * FROM users WHERE name = ? AND password = ?";

    $result = $this->db->execute_query($checklogin, [$this->username, $this->password]);
  
    echo "Welcome, " . $this->username . ". Your password is: ". $this->password;
    
    if ($result->num_rows>0) {
      foreach ($result as $row) {

      echo "Welcome, " . $this->username . ". Your password is: ". $this->password . " Privileges: " . $row["privileges"];
    }
    $user = [$this->username, $this->password];
    var_dump($user);
    return $user;
    
  }
  }

}

?>
