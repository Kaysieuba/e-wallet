<?php require_once 'inc/header.php';
  $transaction_id = intval($_GET['id']);
  $transaction_details = $transaction->getTransaction($transaction_id);
  $bank_details = $bank->getBank($transaction_details['bank_id']);
?>

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h3 class="text-center"><strong>Transaction details</h3></strong>
      <ul class="list-group">
        <li class="list-group-item">
          <h4><strong>Transaction type: </strong><?php if($transaction_details['transaction_type'] == 1){echo 'Deposit';} else{echo 'Transfer';} ?></h4>
        </li>
        <li class="list-group-item">
          <h4><strong>Date: </strong><?php echo datetime_to_text($transaction_details['date']); ?></h4>
        </li>
        <li class="list-group-item">
          <h4><strong>Amount: </strong>N<?php echo $transaction_details['amount']; ?></h4>
        </li>
        <?php if($transaction_details['transaction_type'] == 2): ?>
          <li class="list-group-item">
            <h4><strong>Bank: </strong><?php echo $bank_details['name']; ?></h4>
          </li>
          <li class="list-group-item">
            <h4><strong>Account Number: </strong><?php echo $transaction_details['account_number']; ?></h4>
          </li>
        <?php else: ?>
        <?php endif; ?>
        <li class="list-group-item">
          <h4><strong>Status: </strong><?php echo $transaction_details['successful'] = 0 ? 'Unsuccessful' : 'Completed' ; ?></h4>
        </li>
      </ul>
    </div>
  </div>
</div>
