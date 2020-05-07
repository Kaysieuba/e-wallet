<?php require_once 'inc/header.php'; ?>
<?php
  if(loggedIn()){
    redirectTo('user');
  }
  $allusers = $user->getAllUsers();
  if(isset($_POST['register'])){

    $user->firstname = $_POST['firstname'];
    $user->surname = $_POST['surname'];
    $user->email = strtolower(trim($_POST['email']));
    $user->password = md5(trim($_POST['password']));
    $confirm = md5(trim($_POST['confirm']));

    if (!filter_var($user->email, FILTER_VALIDATE_EMAIL)) {
      $errors[] = "E-mail is invalid.";
    }
    foreach ($allusers as $alluser) {
      if(($user->email) == ($alluser['email'])){
        $errors [] = "An account with this email already exists.";
      }
    }
    if (strlen($user->password) == 1) {
      $errors[] = "Password must be at least 6 characters long.";
    }
    if (($user->password) !== $confirm) {
      $errors[] = "Passwords do not match.";
    }
    if (strlen($user->firstname) < 3) {
      $errors[] = "Initials not allowed for firstname.";
    }
    if (strlen($user->surname) < 3) {
      $errors[] = "Initials not allowed for surname.";
    }


    if(empty($errors)){
      If($user->create()){
        $session->message("Account created successfully.");
        redirectTo('index.php');
      }
    }
  }
 ?>
    <!-- Page Content -->
    <div class="container">
        <div class="register">
          <div class="col-md-6 col-md-offset-3">
            <?php error($errors); success($message); ?>
            <form action="register.php" method="post">
              <legend>Register your account</legend>
              <div class="form-group">
                <input type="text" name="firstname" value="" class="form-control" placeholder="Your Firstname" required>
              </div>
              <div class="form-group">
                <input type="text" name="surname" value="" class="form-control" placeholder="Your Surname" required>
              </div>
              <div class="form-group">
                <input type="email" name="email" value="" class="form-control" placeholder="Your E-mail" required>
              </div>
              <div class="form-group">
                <input type="password" name="password" value="" class="form-control" placeholder="Password" required>
              </div>
              <div class="form-group">
                <input type="password" name="confirm" value="" class="form-control" placeholder="Confirm Password" required>
              </div>
              <div class="form-group">
                <button type="submit" name="register" class="btn btn-success btn-block">Register</button>
              </div>
            </form>

            <em>Already registered? Login <a href="index.php">here</a></em>
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
