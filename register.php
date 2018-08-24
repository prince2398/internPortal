<?php
require("core/init.php");
loggedInRedirect();

if(isset($_POST['submit'])){
  $required_fields = array('firstName','lastName','email','password','confirm_password','companyName');
  foreach ($_POST as $key => $value) {
    if (empty($value) && (in_array($key, $required_fields))) {
      $errors[] = 'Fields marked with astrick(*) are required.';
      break;
    }
  }
  if (empty($errors)) {
    if($_POST['type'] === 'student' && studentExist($_POST['email'])){
      $errors[] = 'Student is already registered!';
    }
    if($_POST['type'] === 'employer' && employerExist($_POST['email'])){
      $errors[] = 'Employer is already registered!';
    }
    if (!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)) {
      $errors[] = 'A valid email id is required';
    }
    if (strlen($_POST['password']) < 8 || strlen($_POST['password'] > 32)) {
      $errors[] = 'Your password length must be between 8 to 32';
    }
    if($_POST['password'] !== $_POST['confirm_password']){
      $errors[] = 'Your Password do not match';
    }
  }
}

include("includes/overall/header.php");
?>

    <main role="main" class="container">
      <h1>Register</h1>
      <?php
        if(isset($_GET['success']) && empty($_GET['success'])) {
      ?>
          <p class="lead">You have been registered succesfully! Please click below to login.</p>
          <form class="form-inline">
             <button class="btn btn-success" type="submit" formaction="login.php">Login</button>
          </form>
      <?php
        }else{
          if(isset($_POST['submit']) && (empty($errors))) {
            if ($_POST['type'] === 'student') {
              $register_data = array(
                'firstName' => $_POST['firstName'],
                'lastName' => $_POST['lastName'],
                'email' => $_POST['email'],
                'password' => $_POST['password'],
                'institute' => $_POST['companyName'],
                'profile' => $_POST['profile']
              );
              if(registerStudent($register_data)){
                header('Location: register.php?success');
              }else{
                $errors[] = 'Error Registering '.$_POST['type'];
              }
            }
            if ($_POST['type'] === 'employer') {
              $register_data = array(
                'firstName' => $_POST['firstName'],
                'lastName' => $_POST['lastName'],
                'email' => $_POST['email'],
                'password' => $_POST['password'],
                'companyName' => $_POST['companyName']
              );
              if(registerEmployer($register_data)){
                header('Location: register.php?success');
              }
              }else{
                $errors[] = 'Error Registering '.$_POST['type'];
              }
            }
          if (!empty($errors)) {
            ?>
            <div class="list-group alert-danger">
            <?php if(!empty($errors)) echo outputErrors($errors);
            ?>
            </div>
      <?php
          }
      ?>
      <form action="register.php" class="lead" method="POST">
        <div class="form-group row">
          <label class="col-3">I am a </label>
          <div class="btn-group btn-group-toggle" data-toggle="buttons">
            <label class="btn btn-secondary
            <?php if(isset($_POST['type'])){
                        if ($_POST['type']==='student') {
                          echo 'active';
                        }
                    }else{
                      echo 'active';
                    }

                ?>">
              <input type="radio" name="type" value="student"
              <?php if(isset($_POST['type'])){
                        if ($_POST['type']==='student') {
                          echo 'checked';
                        }
                    }else{
                      echo 'checked';
                    }

                ?>
              >Student
            </label>
            <label class="btn btn-secondary
            <?php if(isset($_POST['type'])){
                        if ($_POST['type']==='employer') {
                          echo 'active';
                        }
                    }
                ?>">
              <input type="radio" name="type" value="employer"
                <?php if(isset($_POST['type'])){
                        if ($_POST['type']==='employer') {
                          echo 'checked';
                        }
                    }
                ?>
              >Employer
            </label>
          </div>
        </div>
        <div class="form-group">
          <label>First Name * </label>
          <input type="text" class="form-control" name="firstName" placeholder="Enter first name" maxlength = 64 value="<?php if (isset($_POST['firstName'])) echo $_POST['firstName']; ?>" required >
        </div>
        <div class="form-group">
          <label>Last Name * </label>
          <input type="text" class="form-control" name="lastName" placeholder="Enter last name" maxlength = 64 value="<?php if (isset($_POST['lastName'])) echo $_POST['lastName']; ?>" required >
        </div>
        <div class="form-group">
          <label>Email Id *</label>
          <input type="email" class="form-control" name="email" placeholder="Enter your email" maxlength = 64 value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" required>
        </div>
        <div class="form-group">
          <label>Password *</label>
          <input type="password" class="form-control" name="password" placeholder="Enter Password" maxlength = 32 minlength = 8 required>
        </div>
        <div class="form-group">
          <label>Confirm Password *</label>
          <input type="password" class="form-control" name="confirm_password" placeholder="Re-Enter Password" maxlength = 32 minlength = 8 required>
        </div>
        <div class="form-group">
          <label>Company Name or Institue Name * </label>
          <input type="text" class="form-control" name="companyName" placeholder="Enter company or institue name" maxlength = 128
          value="<?php if(isset($_POST['companyName'])) echo $_POST['companyName'];  ?>" required >
        </div>
        <div class="form-group">
          <label>Profile (if student) </label>
          <input type="text" class="form-control" name="profile" placeholder="Enter interest (eg. Web Developer, Programmer,etc)" maxlength = 128 value="<?php if (isset($_POST['profile'])) echo $_POST['profile']; ?>" >
        </div>
        <div class="form-group">
          <button type="submit" name="submit" class="btn btn-primary" >Register</button>
        </div>
      </form>
    </main>

<?php
}
include("includes/overall/footer.php");
?>
