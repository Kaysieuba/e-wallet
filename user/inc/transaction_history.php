<?php $Alltransactions = $transaction->getAllTransactions($userdetails['id']); ?>
<div class="container">
  <h3>Transaction History</h3>
  <hr>
  <section class="transaction-history">
    <table width=100%>
      <thead>
        <th>Date</th>
        <th>Type</th>
        <th>Amount</th>
        <th class="text-center">Success</th>
        <th class="text-center">Details</th>
      </thead>
      <tbody>
      <?php if(empty($Alltransactions)): ?>
        <h3 class="text-center">You have not made any transactions</h3>
      </tbody>
      <?php else: ?>
        <?php foreach($Alltransactions as $Alltransaction): ?>
          <td><?php echo datetime_to_text($Alltransaction['date']) ?></td>
          <td>
            <?php
            if(($Alltransaction['transaction_type']) == 1){ echo "Deposit";}
            elseif(($Alltransaction['transaction_type']) == 2){ echo "Transfer";}
            else{echo "Service Payment";}
           ?>
          </td>
          <td><?php echo $Alltransaction['amount'] ?></td>
        <?php if(($Alltransaction['successful']) == 0): ?>
          <td class="text-center"><button class="btn btn-danger"><i class="fa fa-close"></i></button> </td>
        <?php else: ?>
          <td class="text-center"><button class="btn btn-success"><i class="fa fa-check"></i></button> </td>
        <?php endif; ?>
          <td class="text-center"> <a href="transaction.php?id=<?php echo $Alltransaction['id']; ?>"><button class="btn btn-info"><i class="fa fa-eye"></i></button></a> </td>
        </tbody>
      <?php endforeach; ?>
    <?php endif; ?>
    </table>
  </section>
</div>
