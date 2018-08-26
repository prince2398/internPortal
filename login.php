<?php
require("core/init.php");
if(loggedIn()){
    header('Location: '.HOME);
}
if(isset($_POST['submit']) && !empty($_POST['submit'])){
    $submit = $_POST['submit'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    if (empty($username) || empty($password)) {
        $errors[] = "You need to enter both Username and Password.";
    }elseif($submit === 'student'){
        if (studentExist($username) === false) {
            $errors[] = 'Student with this email is not Registered. Click on Register to register';
        }elseif (strlen($password) >32) {
            $errors[] = "Password too long";
        }else{
            $login = loginAsStudent($username,$password);
            if($login === false){
                $errors[] = "Username/Password is incorrect.";
            }else{
                $_SESSION['userId'] = $login;
                $_SESSION['type'] = $submit;
                header('Location: '.HOME.'/studentProfile.php');
                exit();
            }
        }
    }elseif ($submit === 'employer') {
        if (employerExist($username) === false) {
            $errors[] = 'Employer with this email is not Registered. Click on Register to register';
        }elseif (strlen($password) >32) {
            $errors[] = "Password too long";
        }else{
            $login = loginAsEmployer($username,$password);
            if($login === false){
                $errors[] = "Username/Password is incorrect.";
            }else{
                $_SESSION['userId'] = $login;
                $_SESSION['type'] = $submit;
                header('Location: '.HOME.'/employerProfile.php');
                exit();
            }
        }
    }else{
        $errors[] = 'No data recieved';
    }
}

include("includes/overall/header.php");
?>
    <main role="main" class="container">

        <h1>Login</h1>
        <div class="list-group text-danger">
            <?php if(!empty($errors)) echo outputErrors($errors);
                ?>
        </div>
        <form action="login.php" class="lead" method="POST" autocomplete="off">
            <div class="form-group col-md-6">
                <label>Email</label><br>
                <input type="email" class="form-control" name="username" placeholder="Enter Email" <?php if(isset($username)) echo 'value="'.$username.'"';  ?> maxlength=128 required>
            </div>
            <div class="form-group col-md-6">
                <label>Password</label><br>
                <input type="password" class="form-control" name="password" maxlength = 32 minlength = 8 placeholder="Enter Password" required>
            </div>
             <div class="form-group">
                <button type="submit" name="submit" class="btn btn-primary col-md-3" value="student">Login as Student</button>
                <button type="submit" name="submit" class="btn btn-primary col-md-3" value="employer">Login as Employer</button>
            </div>
        </form>
    </main>

<?php include("includes/overall/footer.php"); ?>
