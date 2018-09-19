<?php include("includes/overall/header.php"); ?>

    <main role="main" class="container">
      <p class="lead">You are not authorised to view the page "<?php if (isset($_GET['file'])) echo $_GET['file']; ?>"</p>
    </main>

<?php include("includes/overall/footer.php"); ?>
