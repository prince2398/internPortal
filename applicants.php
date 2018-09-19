<?php
require("core/init.php");
protectPage();
protectForEmployer();

include("includes/overall/header.php");

?>
<main role="main" class="container">
<?php
if(isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id'])) {
  $internData = getInternData((int)$_GET['id'],'internId','title','profile','employerId','applicationCount');
  if ($_SESSION['type'] === 'employer' && $_SESSION['userId'] === $internData['employerId']) {
?>

      <h1>Applications for '<?php echo $internData['title'].'(id='.$internData['internId'].')' ?>'</h1>
      <br><br>
      <?php
        $studentIds = getStudentIds($internData['internId']);
        if(count($studentIds) >0){
          foreach ($studentIds as $id) {
            $studentData = getStudentData($id,'firstName','lastName','profile','institute','email');
      ?>
      <div class="jumbotron">
        <h3><?php echo $studentData['firstName'].' '.$studentData['lastName'];?></h3>
        <h5>Institue: <?php echo $studentData['institute'];?></h5>
        <h5>Profile: <?php echo $studentData['profile'];?></h5>
        <h5>Contact: <?php echo $studentData['email'];?></h5>
      </div>
<?php
          }
        }else{
          ?>
            <p class="lead alert-danger" style="padding-left:2em;">No Student Applied For This Internship</p>
        <?php
        }
  }else{
    ?>
      <p class="lead alert-danger" style="padding-left:2em;">You are not Authorised to view this</p>
  <?php
  }
}else{
  ?>
  <p class="lead alert-danger" style="padding-left:2em;">Id is not specified properly.</p>
  <?php
}
?>

    </main>

<?php include("includes/overall/footer.php"); ?>
