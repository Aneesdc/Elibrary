<?php
require_once 'config.inc.php';
require_once 'connection.php';
require_once 'functions.php';
checkLogin(false);
$error = 0;
$errorMessage = [];

if (!empty($_POST)) {
  if (empty($_POST['fullname'])) {
    $errorMessage['fullname'] = 'Name is required.';
    $error++;
  }
  if (empty($_POST['email'])) {
    $errorMessage['email'] = 'Email is required.';
    $error++;
  }
  if (empty($_POST['password'])) {
    $errorMessage['password'] = 'Password is required.';
    $error++;
  }
  if (empty($_POST['type'])) {
    $errorMessage['type'] = 'Type is required.';
    $error++;
  }

  if ($error == 0) {
    $name = $_POST['fullname'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $type = $_POST['type'];
    $created_at = date("Y-m-d h:i:s");

    $sql = "select * from admin where email = '$email'";
    $resultset = mysqli_query($con, $sql);
    $reseultcount = mysqli_num_rows($resultset);
    if ($reseultcount > 0) {
      $errorMessage['email'] = 'This email already exists.';
      $error++;
    } else {
      //
      $sql = "insert into admin (fullname, email, password, type, created_at) VALUES ('$name','$email','$password','$type','$created_at')";
      mysqli_query($con, $sql);
      header("Location: admin_index.php?success=" . urlencode(ucfirst($type) . " has been saved successfully."));
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
  <title>New Admin / Moderator -
    <?php echo APP_NAME ?>
  </title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
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
              <h1>New Admin / Moderator</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item"><a href="admin_index.php">Admin / Moderator</a></li>
                <li class="breadcrumb-item active">New Admin / Moderator</li>
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
                <form method="post" action="admin_new.php">
                  <div class="card-body">
                    <?php include_once('alert.php'); ?>
                    <div class="form-group">
                      <label for="fullname">Full Name</label>
                      <input type="text" name="fullname" class="form-control" id="fullname"
                        placeholder="Enter Full Name"
                        value="<?php echo (!empty($_POST['fullname'])) ? $_POST['fullname'] : ''; ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email address</label>
                      <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                        placeholder="Enter email"
                        value="<?php echo (!empty($_POST['email'])) ? $_POST['email'] : ''; ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Password</label>
                      <input type="password" name="password" class="form-control" id="exampleInputPassword1"
                        placeholder="Password">
                    </div>
                    <div class="form-group">
                      <label for="type">Type</label>
                      <select name="type" class="form-control" id="type">
                        <option value="admin">Admin</option>
                        <option value="moderator">Moderator</option>
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