<?php require_once 'inc/header.php'; ?>
<?php
  if(loggedin()){
    redirectTo('user');
  }
  if(isset($_POST['loginForm'])){
    $user->email = trim($_POST['email']);
    $user->password = md5(trim($_POST['password']));

    if($user->login($user->email, $user->password)){
      redirectTo('user');
    }
    else{
      $errors [] = "Authentication failed.";
    }
  }
?>
    <!-- Page Content -->
    <div class="container">
        <div class="loginForm">
          <div class="col-md-6 col-md-offset-3">
            <?php error($errors); success($message); ?>
            <h3>Please log in to your e-wallet account.</h3>
            <form action="index.php" method="post">
              <div class="form-group">
                <input type="text" name="email" value="" class="form-control" placeholder="Username" required>
              </div>
              <div class="form-group">
                <input type="password" name="password" value="" class="form-control" placeholder="Password" required>
              </div>
              <div class="form-group">
                <button type="submit" name="loginForm" class="btn btn-success btn-block"> <i class="fa fa-lock"></i> Login</button>
              </div>
            </form>

            <em>Don't have an account? click <a href="register.php">here</a> to register </em>
          </div>
        </div>
    </div>
    <!-- /.Page Content  -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
