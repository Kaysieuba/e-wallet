<?php require_once 'inc/header.php'; ?>
<?php
  if(isset($_POST['transfer'])){
    $transaction->transaction_type = 2;
    $transaction->user_id = $_SESSION['us3rid'];
    $transaction->bank_id = $_POST['bank_id'];
    $transaction->account_number = trim($_POST['account_number']);
    $transaction->amount = trim($_POST['amount']);
    $transaction->successful = 1;

    if($_POST['amount'] > $userdetails['balance']){
      $errors [] = "You don't have sufficient balance.";
    }
    if(strlen($_POST['account_number']) < 10){
      $errors [] = "Account number invalid.";
    }

    if (empty($errors)) {
      if($transaction->create()){
        $user->balance = $userdetails['balance'] - ($_POST['amount']);
        $user->id = $_SESSION['us3rid'];
        $user->updateBalance();

        $session->message("Transfer completed.");
        redirectTo('transfer.php');
      }
    }
  }
?>

<?php require_once 'inc/sections.php'; ?>

<div class="container">
  <div class="row">
    <div class="col-md-offset-4 col-md-4 col-md-offset-4">
      <h3>Transfer to Bank account</h3>
      <?php success($message); error($errors); ?>
      <form action="transfer.php" method="post">
        <div class="form-group">
          <input type="text" name="amount" class="form-control" placeholder="Amount">
        </div>
        <div class="form-group">
          <select class="form-control" name="bank_id">
            <option value="">-- SELECT BANK --</option>
            <?php
              $allbanks = $bank->getBanks();
              foreach ($allbanks as $allbank) {
                echo "<option value=".$allbank['id'].">".$allbank['name']."</option>";
              }
             ?>
          </select>
        </div>
        <div class="form-group">
          <input type="text" name="account_number" class="form-control" maxlength="10" placeholder="Account number">
        </div>
        <div class="form-group">
          <button type="submit" name="transfer" class="btn btn-success">Transfer</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php include_once 'inc/transaction_history.php'; ?>
