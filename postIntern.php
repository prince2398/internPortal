<?php
require("core/init.php");
protectPage();
protectForEmployer();
if(isset($_POST['submit'])){
  $required_fields = array('title','profile','description','requirements');
  foreach ($_POST as $key => $value) {
    if (empty($value) && in_array($key, $required_fields)) {
      $errors[] = 'All Fields are required';
      break;
    }
  }
  if(empty($errors)){
    if(isset($_POST['title']) && internExist($_POST['title'])) {
      $errors[] = "Internship Already Exist.";
    }
  }
}

include("includes/overall/header.php");
?>

    <main role="main" class="container">
      <h1>Post an Internship</h1>
      <br>
      <?php
        if (isset($_GET['id'])) {
          ?>
            <p class="lead">Internship posted successfully with id <?php
              echo $_GET['id'];?></p>
          <?php
        }else{
          if (isset($_POST['submit']) && empty($errors)) {
            $intern_data = array(
                              'title' => $_POST['title'],
                              'profile' => $_POST['profile'],
                              'description' => $_POST['description'],
                              'requirements' => $_POST['requirements'],
                              'employerId' => $_SESSION['userId'],
                              'deadline' => date('Y-m-d-H-i-s',time()+($_POST['deadline']*24*60*60))
                            );
            if($id = postIntern($intern_data)) {
              header('Location: postIntern.php?id='.$id);
            }else{
              $errors[] = 'Error Posting Internship! Please try again later.';
            }
          }
          if (!empty($errors)) {
            ?>
            <div class="list-group alert-danger"><span class="lead">Errors:</span>
            <?php if(!empty($errors)) echo outputErrors($errors); ?>
            </div>
      <?php
          }

      ?>
      <form action="postIntern.php" class="lead" method="POST">
        <div class="form-group">
          <label>Title of Internship</label>
          <input type="text" class="form-control" name="title" placeholder="Enter Title of Internship" value="<?php if(isset($_POST['title'])) echo $_POST['title']; ?>" required>
        </div>
        <div class="form-group">
          <label>Profile</label>
          <input type="text" class="form-control" name="profile" placeholder="Enter Profile" value="<?php if(isset($_POST['profile'])) echo $_POST['profile']; ?>" required>
        </div>
        <div class="form-group">
          <label>Description</label>
          <textarea type="text" class="form-control" name="description" placeholder="Enter description" required><?php if(isset($_POST['description'])) echo $_POST['description']; ?></textarea>
        </div>
        <div class="form-group">
          <label>Requirements</label>
          <textarea type="text" class="form-control" name="requirements" placeholder="Enter minimum requirements" required><?php if(isset($_POST['description'])) echo $_POST['description']; ?></textarea>
        </div>
        <div class="form-group">
          <label>Deadline</label>
          <input type="number" class="form-control" name="deadline" placeholder="Enter deadline (in days)" min="1" value="<?php if(isset($_POST['deadline'])) echo $_POST['deadline']; ?>" required>
        </div>
        <div class="form-group">
          <button type="submit" name="submit" class="btn btn-primary">Post</button>
        </div>
      </form>

    </main>

<?php
}
include("includes/overall/footer.php");
?>
