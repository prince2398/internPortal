<?php
require("core/init.php");
protectPage();
protectForStudent();
include("includes/overall/header.php");
?>

    <main role="main" class="container">
      <?php
        if (loggedIn()&& $_SESSION['type'] === 'student') {
          $data = getStudentData($_SESSION['userId'],'studentId','firstName','lastName','profile','appliedCount');

      ?>
      <div class="display-4">
        <h1 ><?php echo $data['firstName'],' ',$data['lastName']; ?></h1>
        <p class="lead"><?php echo $data['profile']; ?></p>
      </div>
      <br><br>
      <h2>Internships applied for</h2>
      <br>
      <?php

          $internIds = getAppliedInternIds($data['studentId']);
          if(count($internIds) > 0){
            foreach ($internIds as $id) {
              $data = getInternData($id,'title','profile','employerId');
              $company = getEmployerData($data['employerId'],'companyName');
              $data['company'] = $company['companyName'];
      ?>
      <div class="jumbotron row">
        <div class="col-10">
          <h3><?php echo $data['title'];?></h3>
          <h5>by <?php echo $data['company'];?></h5>
          <h5>Profile: <?php echo $data['profile']; ?></h5>
        </div>
        <div class="col-2">
          <br>
          <a href="intern.php?id=<?php echo $id;?>" class="btn btn-primary"> Learn more...
          </a>
        </div>
      </div>
    <?php
            }
          }else{
            ?>
            <p class="lead">You have not applied for any internship</p>
            <?php
          }
    }else{
      ?>
          <p class="lead">You must Login first to see Profile</p>
          <form class="form-inline">
             <button class="btn btn-success" type="submit" formaction="login.php">Login</button>
          </form>
      <?php
    }
    ?>

    </main>

<?php include("includes/overall/footer.php"); ?>
