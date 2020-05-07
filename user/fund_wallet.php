<?php require_once 'inc/header.php';?>
<?php
if (isset($_POST['deposit'])) {
    if (($_POST['amount']) < 100) {
        $errors[] = "Amount cannot be less than N100.";
    } else {
        $amount = $_POST['amount'];
    }
}

?>

<?php require_once 'inc/sections.php';?>

<div class="container">
    <div class="row">
      <div class="col-md-offset-0 col-md-4 col-md-offset-8">
    <legend>Enter deposit amount:</legend>
    <?php error($errors); success($message);?>
    <form action="fund_wallet.php" method="post" class="deposit">
      <div class="form-group">
        <input type="text" name="amount" class="form-control" value="<?php echo stickyForm('amount'); ?>">
      </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <form>
                <button type="submit" name="deposit" class="btn btn-success btn-block">Deposit</button>
              </form>
            </div>
          </div>
          <?php if (isset($amount)): ?>
          <div class="col-md-6">
              <div class="form-group">
                <form>
                  <script src="https://js.paystack.co/v1/inline.js"></script>
                  <button type="button" name="paystack_button" class="btn btn-primary btn-block" id="paystack_button" onclick="payWithPaystack()">Pay Now</button>
                </form>
              </div>
          </div>
        <?php endif;?>
        </div>
      </div>
    </form>
  </div>
</div>
<!-- jQuery -->
    <script src="../js/jquery.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="../js/bootstrap.min.js"></script>
<script>

const orderObj = {
  email:'<?php echo $userdetails['email'] ?>',
  amount:<?php echo $amount ?>,
  user_id:'<?php echo $userdetails['id'] ?>'

}


  function payWithPaystack(){
    $('#paystack_button').prop('disabled', true);
    let previousText = $('#paystack_button').text();
    $('#paystack_button').text("Loading...");


    var handler = PaystackPop.setup({
      key: 'pk_test_efbd29b83483d9559bcc3cb8085aca4a0b5d5ec8',
      email: '<?php echo $userdetails['email'] ?>',
      amount: <?php echo ($amount * 100) ?>,
      currency: "NGN",

      callback: function(response){
         console.log(response);
         $('#paystack_button').prop('disabled', false).text(previousText);
          $.post("save_transaction.php", {
            reference:response.reference,
            amount:orderObj.amount,
            email:orderObj.email,
            user_id:orderObj.user_id
        },
        function(status){
                if(status == "success")
                    //successful transactionS
                    window.location.replace("fund_wallet.php");
                else
                    //transaction failed
                    alert(response);
            });

      },
      onClose: function(){
        $('#paystack_button').prop('disabled', false).text(previousText);

      }
    });
    handler.openIframe();
  }
</script>

<?php include_once 'inc/transaction_history.php';?>
