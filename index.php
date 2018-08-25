<?php include("includes/overall/header.php"); ?>

    <main role="main" class="container">
      <h1 class="display-4">Internships<br><br></h1>
     <?php
        $internIds = allInternIds();
        if (count($internIds) >0){
          foreach ($internIds as $id){
            $data = getInternData($id,'title','employerId','profile','deadline','internId');
            $company = getEmployerData($data['employerId'],'companyName');
            $data['company'] = $company['companyName'];

     ?>
      <div class="jumbotron row">
        <div class="col-8">
          <h3><?php echo $data['title'];?></h3>
          <h5>by <?php echo $data['company'];?></h5>
          <h5>Profile: <?php echo $data['profile']; ?></h5>
        </div>
        <div class="col-2">
          <h6>Deadline</h6>
          <p><?php echo $data['deadline']; ?></p>
        </div>
        <form class="col-2" action="intern.php?id=<?php echo $data['internId'];?>" method="POST">
          <button type="submit" class="btn btn-primary form-group" <?php if (loggedin() && ($_SESSION['type']==='employer')) { echo 'disabled';}?>>Apply</button>
        </form>
      </div>
    <?php
          }
        }else{
          ?>
          <p class="lead">Sorry! No internships available.</p>
          <?php
        }

    ?>
    </main>

<?php include("includes/overall/footer.php"); ?>
