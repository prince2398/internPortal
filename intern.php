<?php
require("core/init.php");

include("includes/overall/header.php");
?>
    <main role="main" class="container">
    <?php if(isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id'])){
        $id = (int)$_GET['id'];
        if($internData = getInternData($id,'internId','title','profile','employerId','description','requirements','time','deadline')){
           $company = getEmployerData($internData['employerId'],'companyName');
           $company = $company['companyName'];
    ?>
      <div class="jumbotron">
        <h1><?php echo $internData['title']; ?></h1>
        <p class="lead"><b>By <?php echo $company; ?></b></p>
        <p >Profile : <?php echo $internData['profile']; ?></p>
        <p >Description : <?php echo $internData['description']; ?></p>
        <p >Requirements : <?php echo $internData['requirements']; ?></p>
        <div class="row">
            <div class="col-6 text-left">
                <b>Posted On</b><br>
                <?php echo $internData['time']; ?>
            </div>
            <div class="col-6 text-right">
                <b>Deadline</b><br>
                <?php echo $internData['deadline']; ?>
            </div>
        </div>
        <br><br>
         <form action="apply.php?id=<?php echo $internData['internId']; ?>" method="POST" > 
            <button type="submit" class="btn btn-primary" <?php if (loggedin() && $_SESSION['type'] !== 'student') {
                echo 'disabled';
            }?> >Apply</button>
        </form>
      </div>

  <?php
        }else{ ?>
             <p class="lead alert-danger" style="padding-left:2em;">Intern Dont Exist</p>
        <?php

        }
    }else{ ?>
    <p class="lead alert-danger" style="padding-left:2em;">Id is not specified</p>
  <?php } ?>
    </main>

<?php include("includes/overall/footer.php"); ?>
