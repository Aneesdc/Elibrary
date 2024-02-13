<?php
require_once 'config.inc.php';
require_once 'connection.php';
require_once 'functions.php';
checkLogin(false);
$error = 0;
$errorMessage = [];

if(empty($_GET['id']))
{
    header("Location: admin_index.php?error=Please select a record.");
    exit;
}

$id = $_GET['id'];
$sql = "select * from admin where id = $id";
$resultset = mysqli_query($con,$sql);
$fetcharray = mysqli_fetch_array($resultset);
if(empty($fetcharray))
{
    header("Location: admin_index.php?error=Invalid ID.");
    exit;
}

if(!empty($_POST))
{
      if(empty($_POST['fullname']))
      {
          $errorMessage['fullname'] = 'Name is required.';
          $error++;
      }
      if(empty($_POST['email']))
      {
          $errorMessage['email'] = 'Email is required.';
          $error++;
      }
      if(empty($_POST['type']))
      {
          $errorMessage['type'] = 'Type is required.';
          $error++;
      }

      if($error == 0)
      {
        $id = $_POST['id'];
        $name = $_POST['fullname'];
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $type = $_POST['type'];
        $modified_at = date("Y-m-d h:i:s");
         
        $sql = "select * from admin where email = '$email'";
        $resultset = mysqli_query($con, $sql);
        $fetcharray1 = mysqli_fetch_array($resultset);
        $reseultcount = mysqli_num_rows($resultset);
        if($reseultcount > 0 && $fetcharray1['id'] != $id)
        {
          $errorMessage['email'] = 'This email already exists.';
          $error++;
        }
        else{
            if(empty($_POST['password']))
            {
                $sql = "update admin set fullname = '$name', email = '$email', type='$type', modified_at='$modified_at' where id = $id";
            }
            else{
                $sql = "update admin set fullname = '$name', email = '$email', password='$password', type='$type', modified_at='$modified_at' where id = $id";
            }
            mysqli_query($con, $sql);
            header("Location: admin_index.php?success=".ucfirst($type)." has been updated successfully.");
            exit;
        }
         
      }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Update Admin / Moderator - <?php echo APP_NAME?></title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <?php include_once("layouts/navbar.inc.php"); ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include_once("layouts/sidebar.inc.php"); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Update Admin / Moderator</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item"><a href="admin_index.php">Admin / Moderator</a></li>
              <li class="breadcrumb-item active">Update Admin / Moderator</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Admin / Moderator</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="admin_update.php?id=<?php echo $id?>">
                <input type="hidden" name="id" value="<?php echo $fetcharray['id']?>">
                <div class="card-body">
                  <?php include_once('alert.php');?>
                  <div class="form-group">
                    <label for="fullname">Full Name</label>
                    <input type="text" name="fullname" class="form-control" id="fullname" placeholder="Enter Full Name"
                    value="<?php echo $fetcharray['fullname'];?>"
                    >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="<?php echo $fetcharray['email'];?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                  </div>
                  <div class="form-group">
                    <label for="type">Type</label>
                    <select name="type" class="form-control" id="type">
                        <option value="admin" <?php echo ($fetcharray['type'] == 'admin') ? 'selected' : '';?>>Admin</option>
                        <option value="moderator" <?php echo ($fetcharray['type'] == 'moderator') ? 'selected' : '';?>>Moderator</option>
                    </select>
                  </div>
                </div>
                <?php include_once("errorFields.php"); ?>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include_once("layouts/footer.inc.php"); ?>

  <!-- Control Sidebar -->
  <?php include_once("layouts/rightsidebar.inc.php"); ?>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 --> 
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- jquery-validation -->
<script src="assets/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="assets/plugins/jquery-validation/additional-methods.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="assets/dist/js/demo.js"></script>
<!-- Page specific script -->
</body>
</html>
