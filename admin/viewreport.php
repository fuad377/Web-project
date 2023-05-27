<?php
session_start();
include('includes/dbconnection.php');


if(strlen($_SESSION['aid']==0)){
	header('location:logout.php');
}else{
  $report_id = $_GET['editid'];
  $data = $_POST;
  $report =R::findOne( 'reports', "id = ?", [ $report_id ] );

  if ( isset($data['accept']) ) {
    $report->accept = TRUE;
    $id = R::store($report);
    R::load( 'accept', $id );
  }elseif( isset($data['decline']) ) {
    $report->accept = FALSE;
    $id = R::store($report);
    R::load( 'accept', $id );
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
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin-2.min.css" rel="stylesheet">

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
          <?php
          $report = R::getAll( 'SELECT report_title,report_content,owner FROM reports WHERE id = ?', [ $report_id ] );
          $owner = R::getAll( 'SELECT EmpFname,EmpLname FROM employeedetail WHERE EmpCode = ? ', [ $report[0]['owner'] ] );
            if ( isset($owner[0]['EmpFname']) && isset($owner[0]['EmpLname']) ) {
              $owner_fullname = $owner[0]['EmpFname'] . " " . $owner[0]['EmpLname']; 
            }else{
              $owner_fullname = "NULL";
            }
          ?>
            Sent <input type="text" name="report_owner" readonly value="<?=$owner_fullname;?>"> <br><br>
            Title <input type="text" name="report_title" readonly value="<?=$report[0]['report_title'];?>"><br><br>
            Report <input type="textarea" name="report_content" readonly value="<?=$report[0]['report_content'];?>"><br><br>
            Sent Date <input type="text" name="report_sent_date" readonly value="<?=$report[0]['report_content'];?>"><br><br>
            <input type="submit" name="accept" value="accept">
            <input type="submit" name="decline" value="decline">
          </form>
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

<?php }?>