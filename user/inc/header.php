<?php require_once '../core/init.php'; ?>
<?php if(!loggedin()){
  redirectTo('../index.php');
}
$userdetails = $user->getUser($_SESSION['us3rid']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Stylesheets -->
    <link rel="stylesheet" href="css/custom.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- fonts -->
    <link rel="stylesheet" href="../css/font-awesome.min.css">

    <title>e-wallet - Save and transfer cash, the easy way.</title>

</head>

<body>
    <!-- Navigation -->
    <nav class="navbar" role="navigation">
        <div class="container">
          <div class="logo">
          <h1> <a href="index.php"> e-wallet</a></h1>
          </div>
          <div class="balance pull-right">
            <h3 style="display:inline-block;border-right:2px solid #000;">Balance: <strong>N<?php echo $userdetails['balance'];?>.00</strong> &nbsp;</h3>
            <strong>&nbsp;<a href="../logout.php" onclick="return confirm('Are you sure you want to logout?')">
              <i class="fa fa-power-off"style="color:red;font-size:20px;"></i> </a>
            </strong>
          </div>
        </div>
    </nav>
