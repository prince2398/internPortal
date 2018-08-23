<?php
require("core/init.php");
loggedInRedirect();




include("includes/overall/header.php");
?>

    <main role="main" class="container">
      <h1>Register</h1>
      <form action="register.php" class="lead" method="POST">
        <div class="form-group row">
          <label class="col-3">I am a </label>
          <div class="btn-group btn-group-toggle" data-toggle="buttons">
            <label class="btn btn-secondary active">
              <input type="radio" name="radio" value="student" checked>Student
            </label>
            <label class="btn btn-secondary">
              <input type="radio" name="radio" value="employer">Employee
            </label>
          </div>
        </div>
        <div class="form-group">
          <label>Name</label>
          <input type="text" class="form-control" name="name" placeholder="Enter your name">
        </div>
        <div class="form-group">
          <label>Email Id</label>
          <input type="email" class="form-control" name="email" placeholder="Enter your email">
        </div>
        <div class="form-group">
          <label>Password</label>
          <input type="password" class="form-control" name="password" placeholder="Enter Password">
        </div>
        <div class="form-group">
          <label>Confirm Password</label>
          <input type="password" class="form-control" name="confirm_password" placeholder="Re-Enter Password">
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-primary" formaction="register.php">Register</button>
        </div>
      </form>
    </main>

<?php include("includes/overall/footer.php"); ?>
