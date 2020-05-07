<?php
class Connection {
  // Properties
  private $host = 'localhost';
  private $dbname = 'ewallet';
  private $username = 'root';
  private $password = '';

  // Methods
  public function connect() {
    try {
      $conn = new PDO("mysql:host=$this->host;port=3308;dbname=$this->dbname", $this->username, $this->password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $conn;
    }
    catch(PDOException $e) {
      return $e->getMessage();
    }
  }
}
?>
