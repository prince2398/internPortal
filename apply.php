<?php
require("core/init.php");
include("includes/overall/header.php");
?>

    <main role="main" class="container">
      <?php
        if (!loggedIn()) {
      ?>
          <p class="lead">Please Login to Apply</p>
          <form class="form-inline">
             <button class="btn btn-success" type="submit" formaction="login.php">Login</button>
          </form>
      <?php
        }elseif($_SESSION['type'] !== 'student'){
      ?>
          <p class="lead">Sorry! Only Students can Apply.</p>
      <?php
        }else{
          if ($_SESSION['type'] === 'student') {
            if(isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id'])) {
              $internId = (int)$_GET['id'];
              if(!alreadyApplied($_SESSION['userId'],$internId)){
                  if(applyIntern($_SESSION['userId'],$internId)){
                    ?>
                      <br>
                      <p class="lead">Yay! Successfully applied for internship
                        '<?php
                          $name = getInternData($internId,'title');
                          echo $name['title'];
                         ?>'.
                      </p>
                    <?php
                  }else{
                ?>
               <p class="lead alert-danger" style="padding-left:2em;">Error Applying! Please try again later</p>
          <?php
                  }
              }else{ ?>
               <p class="lead alert-danger" style="padding-left:2em;">You Have Already Applied for this Internship</p>
          <?php
              }
            }else{ ?>
               <p class="lead alert-danger" style="padding-left:2em;">Id is not specified properly.</p>
          <?php

            }
          }
        }
      ?>
    </main>

<?php include("includes/overall/footer.php"); ?>
