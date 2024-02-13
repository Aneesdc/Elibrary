<?php
require_once 'config.inc.php';
require_once 'connection.php';
$error = 0;
$errorMessage = [];

if(!empty($_POST)) //post submit button
{
    //server side validation
    if(empty($_POST['email']))
    {
        $errorMessage['email'] = 'Email is Required';
        $error++;
    }
    if(empty($_POST['password']))
    {
        $errorMessage['password'] = 'Password is Required';
        $error++;
    }

    if($error == 0){
        //success
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $sql = "select * from admin where email = '$email' AND password = '$password' AND status = 1";
        $resultset = mysqli_query($con,$sql);
        $admin_data = mysqli_fetch_array($resultset);
        if($admin_data)
        {
            $_SESSION['admin']['user_id'] = $admin_data['id'];
            $_SESSION['admin']['name'] = $admin_data['fullname'];
            $_SESSION['admin']['email'] = $admin_data['email'];
            $_SESSION['admin']['type'] = $admin_data['type'];
            header("Location: dashboard.php");
        }
        else
        {
          $errorMessage['error'] = 'Email or password is incorrect.';
          $error++;
        } 
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo APP_NAME;?></title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="login.php" class="h1"><b><?php echo APP_NAME;?></b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="login.php" method="post">
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo (!empty($_POST['email'])) ? $_POST['email'] : '' ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
        </div>
          
        <div class="row">

        <?php 
        if($error != 0){
        ?>    
        <div class="col-12 mt-3">
              <div class="alert alert-danger">
                <p>
                    <strong>Error</strong><br>
                    <?php
                    foreach($errorMessage as $key => $val)
                    {
                        echo '<span>'.($key).': '.$val.'</span><br>';
                    }
                    ?>
                </p>
              </div>
        </div>
        <?php } ?>
          <!-- /.col -->
        </div>
      </form>
      <p class="mb-1">
        <a href="#">I forgot my password</a>
      </p>
    </div>

    
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/dist/js/adminlte.min.js"></script>
</body>
</html>
