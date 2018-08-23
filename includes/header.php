<?php
?>
<header>
    <nav class="navbar navbar-expand-md navbar-dark  bg-dark fixed-top">
      <a class="navbar-brand" href="#">Internships</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href=<?php echo '"'.HOME.'"';?>>Home <span class="sr-only">(current)</span></a>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link" href="postIntern.php">Post an Internship</a>
          </li> -->
          <?php if (loggedIn()) { ?>
                  <li class="nav-item dropdown">
                    <?php if($_SESSION['type'] === 'student') { ?>
                            <a class="nav-link dropdown-toggle" href="studentProfile.php" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php
                              if($data = getStudentData($_SESSION['userId'],'firstName')){
                                echo $data[firstName];
                              }
                            ?></a>
                            <div class="dropdown-menu" aria-labelledby="dropdown01">
                                    <a class="dropdown-item" href="studentProfile.php">My Profile</a>
                            </div>
                    <?php }elseif($_SESSION['type'] === 'employer') { ?>
                              <a class="nav-link dropdown-toggle" href="employerProfile.php" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php
                                if($data = getEmployerData($_SESSION['userId'],'companyName')){
                                  echo $data['companyName'];
                                }
                              ?></a>
                              <div class="dropdown-menu" aria-labelledby="dropdown01">
                                      <a class="dropdown-item" href="employerProfile.php">My Profile</a>
                                        <a class="dropdown-item" href="postIntern.php">Post an Internship</a>
                                        <a class="dropdown-item" href="applicants.php">Applicants</a>
                              </div>
                    <?php } ?>
                  </li>
          <?php } ?>
        </ul>
        <?php if (!loggedIn()) {  ?>
                 <form class="form-inline my-2 my-lg-0">
                   <button class="btn btn-outline-success my-2 my-sm-0" type="submit" formaction="login.php">Login</button>
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit" formaction="register.php">Register</button>
                  </form>
        <?php }else{ ?>
                <form class="form-inline my-2 my-lg-0">
                  <button class="btn btn-outline-success my-2 my-sm-0" type="submit" formaction="logout.php">Logout</button>
                </form>
        <?php } ?>
      </div>
    </nav>
</header>
