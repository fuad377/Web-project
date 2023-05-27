<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');


if (strlen($_SESSION['aid'] == 0)) {
  header('Location: logout.php');
  }else{
    if(isset($_POST['submit']))
    {
      $data = $_POST;

      $emp1name = $_POST['emp1name'];
      $emp1des = $_POST['emp1des'];
      $emp1ctc = $_POST['emp1ctc'];
      $emp1wd = $_POST['emp1workduration'];
      $emp2name = $_POST['emp2name'];
      $emp2des = $_POST['emp2des'];
      $emp2ctc = $_POST['emp2ctc'];
      $emp2wd = $_POST['emp2workduration'];
      $emp3name = $_POST['emp3name'];
      $emp3des = $_POST['emp3des'];
      $emp3ctc = $_POST['emp3ctc'];
      $emp3wd = $_POST['emp3workduration'];
      
      $query = mysqli_query($con, "insert into empexpireince ( EmpID,Employer1Name, Employer1Designation, Employer1CTC,  Employer1WorkDuration, Employer2Name,  Employer2Designation, Employer2CTC, Employer2WorkDuration, Employer3Name, Employer3Designation, Employer3CTC, Employer3WorkDuration) value('$eid','$emp1name', '$emp1des', '$emp1ctc', '$emp1wd', '$emp2name', '$emp2des', '$emp2ctc', '$emp2wd', '$emp3name', '$emp3des', '$emp3ctc', '$emp3wd' )");
    if ($query) {
      $msg = array(true, "Your Expirence data has been submitted succeesfully.");
    }else{
      $msg = array(false, "Something Went Wrong. Please try again.");
    }
    }
?>

<!DOCTYPE html>
<html lang="en">

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
          <h1 class="h3 mb-4 text-gray-800">Employees Details</h1>

  <?php
  if ($msg[0]) {
    echo '<p style="font-size:16px; color:green" align="center">' . $msg [1] . '</p>';
  }else{
    echo '<p style="font-size:16px; color:red" align="center">' . $msg [1] . '</p>';  
  }
  ?>

<div class="table-responsive">
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

<tr>
  <th>id</th>
  <th>Emp Code</th>
  <th>Emp First Name</th>
  <th>Emp Last Name</th>
  <th>Emp Email</th>
  <th>Salary</th>
  <th>Action</th>
  
</tr>

<?php
$allEmployees = R::getAll('SELECT * FROM employeedetail');

for ($i = 0; $i < count($allEmployees); $i++) { 
  $row = $allEmployees[$i];
?>

<tr>
  <td><?php   echo $row['id'] //cnt;?></td>
  <td><?php   echo $row['emp_code'];?></td>
   <td><?php  echo $row['emp_first_name'];?></td>
    <td><?php echo $row['emp_last_name'];?></td>
  <td><?php   echo $row['emp_email'];?></td>
  <td><?php   echo $row['emp_salary'];?></td>

  <td><a href="editempprofile.php?editid=<?php echo $row['id'];?>">Edit Profile Details</a> | 
   <a href="editempeducation.php?editid=<?php echo $row['id'];?>">Edit Education Details</a> |
    <!-- <a href="editempexp.php?editid=<?php //echo $row['id'];?>">Edit Experience Details</a> -->
  </td>
</tr>

<?php } ?>

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
<?php }  ?>
