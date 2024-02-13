<?php
require_once 'config.inc.php';
require_once 'connection.php';
require_once 'functions.php';
checkLogin(false);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin -
        <?php echo APP_NAME; ?>
    </title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
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
                            <h1>Admin / Moderator</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                                <li class="breadcrumb-item active">Admin / Moderator</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Show all admin / Moderator</h3>
                                    <a href="admin_new.php" class="btn btn-info float-right">New Admin / Moderator</a>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <?php include_once('alert.php'); ?>
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Type</th>
                                                <th>Status</th>
                                                <th>Created At</th>
                                                <th>Modified At</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql = "SELECT * from admin";
                                            $resultset = mysqli_query($con, $sql);
                                            while ($admin = mysqli_fetch_array($resultset)) {
                                                ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $admin['id'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $admin['fullname'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $admin['email'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $admin['type'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo ($admin['status'] == 1) ? '<a href="admin_status.php?id=' . $admin['id'] . '"><span class="text-success">Active</span></a>' : '<a href="admin_status.php?id=' . $admin['id'] . '"><span class="text-danger">Deactive</span></a>'; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $admin['created_at'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $admin['modified_at'] ?>
                                                    </td>
                                                    <td><a href="admin_delete.php?id=<?php echo $admin['id'] ?>"
                                                            onClick="return confirm('Are you sure to delete?')"><i
                                                                class="fa fa-trash " style="margin-right: 10px"></i></a><a
                                                            href="admin_update.php?id=<?php echo $admin['id'] ?>"><i
                                                                class="fa fa-edit" style="margin-right: 10px"></a></td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
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
    <!-- DataTables  & Plugins -->
    <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="assets/plugins/jszip/jszip.min.js"></script>
    <script src="assets/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="assets/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <!-- AdminLTE App -->
    <script src="assets/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="assets/dist/js/demo.js"></script>
    <!-- Page specific script -->
    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
</body>

</html>