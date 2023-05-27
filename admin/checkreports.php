<?php
// NOT FINISHED

session_start();
include('includes/dbconnection.php');

if($_SESSION['aid']==0){
  header('location:logout.php');
}else{
  // $eid = $_SESSION['uid'];
  $data = $_POST;

  $accepts = array();

// accepts
// 0 => btn name
// 1=> emp code


  if ( isset($data['submit']) ) {
    $accepts = $_SESSION['accepts'];
    foreach ($variable as $value) {
      if ( isset( $data[ $value['btn_name'] ] ) ) {
        $report = R::findOne( 'reports', "id = ?", [ $value['id_report'] ] );
        $report->accept = TRUE;
        $id = R::store($report);
        R::load('reports', $id);
      }else{
        continue;
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

  <title>Employees Details</title>

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
          <h1 class="h3 mb-4 text-gray-800">Report Details</h1>


<div class="table-responsive">
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

<tr>
  <th>id</th>
  <th>Report owner</th>
  <th>Report title</th>
  <th>Report content</th>
  <th>Sent date</th>
  <th>Action</th>
</tr>
<form class="form" method="POST">
<?php
$allReports = R::getAll('SELECT * FROM reports');

for ($i = 1; $i < count($allReports); $i++) { 
  $row = $allReports[$i];
  $accepts [] = array(
    'id_report' => $row['id'],
    'btn_name' => 'btn'.$row['id']
  );
  $_SESSION['accepts'] = $accepts;

  // value of owner key is EmpCode from table empdetails
  $owner = R::getAll('SELECT EmpFname,EmpLname FROM  employeedetail WHERE EmpCode = ?', [ $row['owner'] ] );
  
  if ( isset($owner[0]['EmpFname']) && isset($owner[0]['EmpLname']) ) {
    $owner_fullname = $owner[0]['EmpFname'] . " " . $owner[0]['EmpLname']; 
  }else{
    $owner_fullname = "NULL";
  }
  
?>
<tr>
  <td><?= $row['id'];?></td>
  <td><?= $owner_fullname;?></td>
  <td><?= $row['report_title'];?></td>
  <td><?= $row['report_content']?></td>
  <td><?= $row['sent_date']?></td>
  <td><a href="viewreport.php?editid=<?echo $row['id'];?>">View</a> | 
<?php
$item = R::findOne( 'reports', "id = ?", [ $row['id'] ] );

// accept buttons
if ( ! ($item->accept) ) {
  echo '<input type="submit" value="accept" name="btn' . $row['id'] . '">';
}else{
  echo '<span>Accepted</span>';
}  
?>
</td>
</tr>

<?php }?>
</form>
</table>

</div>
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