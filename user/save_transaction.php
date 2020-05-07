<?php
require_once '../core/init.php';
$userdetails = $user->getUser($_SESSION['us3rid']);

$transaction->amount = $_POST['amount'];
$transaction->bank_id = NULL;
$transaction->account_number = NULL;
$transaction->user_id = $_POST['user_id'];
$transaction->transaction_type = "1";
$transaction->successful = "1";

if($transaction->create()){
  $user->id = $userdetails ['id'];
  $user->balance = $userdetails ['balance'] + $_POST['amount'];

  $status = $user->updateBalance();
  $session->message("Deposit successful");
}

echo ($status) ? 'success' : '';
