<?php
require("core/init.php");
protectPage();
protectForEmployer();
include("includes/overall/header.php");
?>

    <main role="main" class="container">
      <?php
        if (loggedIn()&& $_SESSION['type'] === 'employer') {
          $data = getEmployerData($_SESSION['userId'],'employerId','firstName','lastName','companyName');

      ?>
      <div class="display-4">
        <h1><?php echo $data['companyName']; ?></h1>
        <p class="lead">Managed by <?php echo $data['firstName'].' '.$data['lastName']; ?></p>
        <h3>Posted Internships</h3>
      </div>
        <?php
          $internIds = getPostedInternIds($data['employerId']);
          if (count($internIds) >0) {
            foreach ($internIds as $id) {
              $internData = getInternData($id,'internId','title','profile','applicationCount');
        ?>
      <div class="jumbotron row">
        <div class="col-10">
          <h3><?php echo $internData['title'];?></h3>
          <h5>Profile : <?php echo $internData['profile'];?></h5>
        </div>
        <div class="col-2">
          <a href="applicants.php?id=<?php echo $id;?>" class="btn btn-primary">
          <?php echo $internData['applicationCount'];?>
          </a>
        </div>
      </div>
      <?php
              }
            }else{
              ?>
            <p class="lead">You have not posted any internship</p>
            <?php
            }
          }

       ?>
    </main>

<?php include("includes/overall/footer.php"); ?>
