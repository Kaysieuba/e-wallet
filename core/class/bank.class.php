<?php
class Bank {
  // Properties
  private $database;
  public $id, $name, $code;

  // Methods
  public function __construct() {
    $this->database = new Connection();
    $this->database = $this->database->connect();
  }
  public function getBank($id) {
    $statement = $this->database->prepare('SELECT * FROM banks WHERE id = :id');
    $statement->execute(array('id'=>$id));

    $result = $statement->fetch();

    return $result ? $result : false;
  }
  public function getBanks() {
    $statement = $this->database->prepare('SELECT * FROM banks');
    $statement->execute();

    $results = $statement->fetchALL(PDO::FETCH_ASSOC);

    return $results ? $results : false;
  }
}
