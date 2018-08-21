<?php include("includes/overall/header.php"); ?>

    <main role="main" class="container">

        <h1>Login</h1>
        <form action="login.php" class="lead" method="POST">
            <div class="form-group col-5">
                <label>Email/Username </label><br>
                <input type="email" class="form-control" name="email" placeholder="Enter Email">
            </div>
            <div class="form-group col-5">
                <label>Password</label><br>
                <input type="password" class="form-control" name="password" placeholder="Enter Password">
            </div>
             <div class="form-group">
                <button type="submit" class="btn btn-primary" formaction="loginasstudent.php">Login as Student</button>
                <button type="submit" class="btn btn-primary" formaction="loginasemployer.php">Login as Employer</button>
            </div>
        </form>
    </main>

<?php include("includes/overall/footer.php"); ?>
