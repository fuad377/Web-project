<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

// ++Fuad

$data = $_POST;
$adminid = $_SESSION['aid'];

if ($_SESSION['aid'] == 0) { 
  header('Location: logout.php'); // Ты кто такой давай досвидания =)
}else{
  if($data['submit']){
    $user = R::findOne('tbladmin', "id = ?", [$adminid]);
    $user->admin_name = ($user->admin_name == $data['admin_name']) ? $user->admin_name :  $data['admin_name'];
    $user->admin_username = ($user->admin_username == $data['admin_username']) ? $user->admin_username :  $data['admin_username'];
    $id = R::store($user);
    R::load('tbladmin', $id);
    header("Location: logout.php");
  }
}

// Темная ночь, только пули свистят по степи..
// Только ветер гудит провода, тускло звезды миерцаааююют
//  В тёмную ночь ты любимая знаю не спищь
// И у детской кравати тайком ты слезу вытираешь
//  как я люблю глубину твоих лааасковых глаз
// каааак я хочу к ним прижаться сейчас...
// ТЕЕЕЕЕЕЕЕЕЕЕЕМНАЯЯЯЯ НОООЧЬ
// разделяет любимая нас
//
//
// --Fuad


if ($_SESSION['aid']==0) {
  header('Location: logout.php');
}else{
  if(isset($_POST['submit']))
  {
    $AName = $_POST['admin_name'];
    $query = mysqli_query($con, "update tbladmin set admin_name ='$AName' where ID='$adminid'");
    
    if ($query) {
      $msg = array(true, "Admin profile has been updated.");
    }else
    {
      $msg = array(false, "Something Went Wrong. Please try again.");// 
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

  <title>Admin Profile</title>

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
          <h1 class="h3 mb-4 text-gray-800">Admin Profile</h1>

<!-- <p style="font-size:16px; color:red" align="center"> <?php // if($msg){
    //echo $msg;
  //}  ?> </p> -->

  <?php
  if ($msg[0]) {
    echo '<p style="font-size:16px; color:green" align="center">' . $msg [1] . '</p>';
  }else{
    echo '<p style="font-size:16px; color:red" align="center">' . $msg [1] . '</p>';  
  }
  ?>

<form class="user" method="post" action="">
<?php
$user = R::getAll('SELECT admin_name, admin_username, admin_reg_date FROM tbladmin WHERE id = ?', [$adminid] );
?>
               <div class="row">
                <div class="col-4 mb-3">Admin Name</div>
                   <div class="col-8 mb-3">   <input type="text" class="form-control form-control-user" id="AdminName" name="admin_name" aria-describedby="emailHelp" required="true" value="<?php  echo $user[0]['admin_name'];?>"></div>
                    </div>  
                    <div class="row">
                      <div class="col-4 mb-3">User Name </div>
                     <div class="col-8 mb-3">  <input type="text" class="form-control form-control-user" id="UserName" name="admin_username" aria-describedby="emailHelp" value="<?php  echo $user[0]['admin_username'];?>"></div>  
                     </div>



                    
                    <div class="row">
                      <div class="col-4 mb-3">Admin Registration Date(yyyy-mm-dd)</div>
                    <div class="col-8  mb-3">
                      <input type="text" class="form-control form-control-user" readonly="true" value="<?php  echo $user[0]['admin_reg_date'];?>" id="AdminRegdate" name="admin_reg_date" aria-describedby="emailHelp" >
                    </div></div>
                    <div class="row" style="margin-top:4%">
                      <div class="col-4"></div>
                      <div class="col-4">
                      <input type="submit" name="submit"  value="Update" class="btn btn-primary btn-user btn-block">
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
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
<?php }  ?>
