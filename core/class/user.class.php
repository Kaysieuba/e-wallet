<?php
class User {
  // Properties
  private $database;
  public $id, $surname, $firstname, $email, $password, $balance, $usergroup, $created;

  // Methods
  public function __construct() {
    $this->database = new Connection();
    $this->database = $this->database->connect();
  }

  public function create() {
    $statement = $this->database->prepare("INSERT INTO user (surname, firstname, email, password) VALUES (?, ?, ?, ?)");
    // Bind parameters to the query
    $statement->bindParam(1, $this->surname);
    $statement->bindParam(2, $this->firstname);
    $statement->bindParam(3, $this->email);
    $statement->bindParam(4, $this->password);

    $result = $statement->execute();

    return $result ? true : false;
  }
  public function getUser($id) {
    $statement = $this->database->prepare('SELECT * FROM user WHERE id = :id ');
    $statement->execute(array('id' => $id ));

    $result = $statement->fetch();

    return $result ? $result : false;
  }
  public function getAllUsers() {
		$statement = $this->database->prepare('SELECT * FROM user ORDER BY created DESC');
		$statement->execute();
		$results = $statement->fetchALL(PDO::FETCH_ASSOC);

		return $results ? $results : false;
	}
  public function changePassword(){
    $statement = $this->database->prepare("UPDATE user SET password = ? WHERE id = ?");
    $statement->bindParam(1, $this->password);
    $statement->bindParam(2, $this->id);

    $result = $statement->execute();

    return $result ? $result : false;
  }
  public function updateBalance(){
    $statement = $this->database->prepare("UPDATE user SET balance = ? WHERE id = ?");
    $statement->bindParam(1, $this->balance);
    $statement->bindParam(2, $this->id);

    $result = $statement->execute();

    return $result ? $result : false;
  }
  public function login($email, $password) {
    $statement = $this->database->prepare("SELECT * FROM user WHERE email = :email AND password = :password");

    $statement->execute(array("email"=>$email, "password"=>$password));

    $result = $statement->fetch();

    // If row found, assign values to SESSION
    if ($result) {
      $_SESSION['us3rid'] = $result['id'];
      $_SESSION['us3rgr0up'] = $result['usergroup'];
      $_SESSION['profile'] = $result['profileid'];
      $_SESSION['emailaddress'] = $result['email'];
      $_SESSION['1s@dmin'] = ($result['usergroup'] == 108209) ? true : false;
    }

    return $result ? true : false;
  }

  public function logout() {
    if (isset($_SESSION['us3rid'])) {
      unset($_SESSION['us3rid']);
      session_destroy();
      return true;
    }
    return false;
  }
}
