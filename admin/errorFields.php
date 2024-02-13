<?php
if ($error != 0) {
    ?>
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="icon fas fa-ban"></i> Alert!</h5>
        <?php
        foreach ($ErrorMessage as $key => $val) {
            echo '<span>' . ucfirst($key) . ': ' . $val . '</span><br>';
        }
        ?>
    </div>
    <?php
}
?>