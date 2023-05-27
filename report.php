<?php
session_start();
include('includes/dbconnection.php');


if(strlen($_SESSION['uid']==0)){
	header('location:logout.php');
}else{
  $eid = $_SESSION['uid'];

  $data = $_POST;
  $errors = array();

  if (isset($data['submit'])) {
    if ( $data['report_title'] && $data['report_content'] ) {
      $report = R::dispense('reports');
      $user = R::getAll('SELECT emp_code FROM employeedetail WHERE id = ?', [$eid]);

      $report->owner = $user[0]['emp_code'];
      $report->report_title = $data['report_title'];
      $report->report_content = $data['report_content'];
      $report->sent_date = date("Y-m-d H:i:s");
      
      $id = R::store($report);
      R::load('reports', $id);
      $errors['success'] = "Repord sent successfully";
    }else{
      $errors[] = "Fill all areas!";
    }
  }
}


?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Daily Repor</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>
<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
  <?php include_once('includes/sidebar.php')?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
         <?php include_once('includes/header.php')?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Report</h1>

          <!--Content-->
          <strong><?php echo date("d.m.Y")." report"?></strong>
          
          <form class="report" method="post">
            Title <input type="text" name="report_title"><br><br>
            Report <input type="textarea" name="report_content"><br><br>
            <input type="submit" name="submit" value="Send">
          </form>
          <?php
          if ( isset($data['submit']) && isset($errors['success']) ) {
            echo '<p style="font-size:16px; color:green" align="center">' . $errors['success'] . '</p>';
          }elseif(isset($data['submit'])){
            echo '<p style="font-size:16px; color:red" align="center">' . array_shift($errors) . '</p>';
          }

          ?>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
   <?php include_once('includes/footer.php');?>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  

  <!-- Bootstrap core JavaScript-->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../js/sb-admin-2.min.js"></script>
  
  <!-- Page level plugins -->
  <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="../js/demo/datatables-demo.js"></script>
</body>
</html>