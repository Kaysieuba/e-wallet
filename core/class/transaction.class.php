<?php
class Transaction {
  // Properties
  private $database;
  public $id, $date, $transaction_type, $amount, $user_id, $successful, $bank_id, $account_number;

  // Methods
  public function __construct() {
    $this->database = new Connection();
    $this->database = $this->database->connect();
  }

  public function create() {
    $statement = $this->database->prepare("INSERT INTO transactions (transaction_type, amount, user_id, bank_id, account_number, successful) VALUES (?, ?, ?, ?, ?, ?)");
    // Bind parameters to the query
    $statement->bindParam(1, $this->transaction_type);
    $statement->bindParam(2, $this->amount);
    $statement->bindParam(3, $this->user_id);
    $statement->bindParam(4, $this->bank_id);
    $statement->bindParam(5, $this->account_number);
    $statement->bindParam(6, $this->successful);

    $result = $statement->execute();

    return $result ? true : false;
  }

  public function getAllTransactions($id) {
		$statement = $this->database->prepare('SELECT * FROM transactions WHERE user_id = :id ORDER BY date DESC ');
		$statement->execute(array("id"=>$id));
		$results = $statement->fetchALL(PDO::FETCH_ASSOC);

		return $results ? $results : false;
	}
  public function getTransaction($id) {
		$statement = $this->database->prepare('SELECT * FROM transactions WHERE id = :id');
		$statement->execute(array("id"=>$id));
		$result = $statement->fetch(PDO::FETCH_ASSOC);

		return $result ? $result : false;
	}
}
