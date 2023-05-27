<?php
session_start();
error_reporting(E_ALL);
include('includes/dbconnection.php');

function check_password($pass)
{
  $errors = array();
  if(strlen($pass) < 8) {
    $errors[] = "The password's length should be more than 8 symbols!";
  }elseif(!(is_numeric($pass)))
  {
    $errors[] = "The password must consist of at least one digit";
  }
  return $errors;
}

$data = $_POST;
$adminid = $_SESSION['aid'];

if ($_SESSION['aid'] == 0){
  header('Location: logout.php');
} else{
    if(isset($data['submit']))
    {
      $errors = array();
      $user = R::findOne('tbladmin', "id = ?", [$adminid]);

      if ($data['current_password'] == $user->password)
      {
        if ($data['new_password'] == $data["new_password_confirm"])
        {
          $password_errors = check_password($data['new_password']);
          if ( empty( $password_errors ) ) {
            $user->password = $data['new_password'];
            $id = R::store($user);
            R::load('tbladmin', $id);            
          }else{
            $errors[] = array_shift($password_errors);
          }      
        }else{
          $errors[] = "Passwords doesn't match!";
        }
      }else{
        $errors[] = "Wrong current password!";
      }
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

  <title>Change Password</title>

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
  <?php include_once('includes/sidebar.php');?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
         <?php include_once('includes/header.php');?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Change Password</h1>
<?php
if (!empty($errors)) {
  echo '<p style="font-size:16px; color:red" align="center">'. array_shift($errors) . '</p>';
}elseif(isset($data['submit'])){echo '<p style="font-size:16px; color:green" align="center">Password successfully changed!</p>';}
?>

<form name="changepassword" class="user" method="post">

               <div class="row">
                <div class="col-4 mb-3">Current Password</div>
                   <div class="col-8 mb-3">   <input type="Password" class="form-control form-control-user" id="Password" name="current_password"  value="" required="true"></div>
                    </div>  
                    <div class="row">
                      <div class="col-4 mb-3">New Password </div>
                     <div class="col-8 mb-3">  <input type="Password" class="form-control form-control-user" id="newpassword" name="new_password"  value="" required="true"></div>  
                     </div>



                    <div class="row">
                    <div class="col-4 mb-3">Confirm Password </div>
                    <div class="col-8 mb-3">
                      <input type="Password" class="form-control form-control-user" id="confirmpassword" name="new_password_confirm"  value="" required="true"></div>
                    </div>

                    <div class="row" style="margin-top:4%">
                      <div class="col-4"></div>
                      <div class="col-4">
                      <input type="submit" name="submit"  value="Change" class="btn btn-primary btn-user btn-block">
                    </div>
                    </div>
                  
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
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>