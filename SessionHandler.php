<?php

class SessionHandling {
  

  public function __construct() {
    if (session_status() != PHP_SESSION_ACTIVE) {
      session_start();
      
  }
  }

  public function setSessionValue($key, $value) {
    $_SESSION[$key] = $value;
  }

  public function getSessionValue($key) {
    return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
  }

  public function unsetSessionValue($key) {
    unset($_SESSION[$key]);
  }

  public function destroySession() {
    session_destroy();
  }

  public function setLoggedOutMessage($message) {
    $this->setSessionValue('logged_out_message', $message);
  }

  public function getLoggedOutMessage() {
    return $this->getSessionValue('logged_out_message');
  }

}

?>