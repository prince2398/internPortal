<?php include("includes/overall/header.php"); ?>

    <main role="main" class="container">
      <h1>Post an Internship</h1>

      <form action="register.php" class="lead" method="POST">
        <div class="form-group row">

        </div>
        <div class="form-group">
          <label>Name of Internship</label>
          <input type="text" class="form-control" name="name" placeholder="Enter name of Internship">
        </div>
        <div class="form-group">
          <label>Profile</label>
          <input type="text" class="form-control" name="profile" placeholder="Enter Profile">
        </div>
        <div class="form-group">
          <label>Requirements</label>
          <textarea type="text" class="form-control" name="requirements" placeholder="Enter minimum requirements"></textarea>
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-primary" formaction="postIntern.php">Post</button>
        </div>
      </form>

    </main>

<?php include("includes/overall/footer.php"); ?>
