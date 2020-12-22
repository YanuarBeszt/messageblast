<!doctype html>
<html>
<?php $this->load->view('component/admin/head') ?>
<?php
$dashboard_admin = "admin/sidebar_admin";
// $level = $this->session->userdata('level');
?>

<style>
    #overlay {
        position: fixed;
        background: rgba(0, 0, 0, 0.9);
        bottom: 0;
        height: 100%;
        left: 0;
        right: 0;
        top: 0;
        width: 100%;
        margin: 0 auto;
        overflow-y: hidden;
        overflow-x: hidden;
        z-index: 9999;
    }

    .cv-spinner {
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .spinner {
        width: 40px;
        height: 40px;
        border: 4px #ddd solid;
        border-top: 4px #2e93e6 solid;
        border-radius: 50%;
        animation: sp-anime 0.8s infinite linear;
    }

    @keyframes sp-anime {
        100% {
            transform: rotate(360deg);
        }
    }

    .is-hide {
        display: none;
    }
</style>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div id="overlay">
        <div class="cv-spinner">
            <span class="spinner"></span>
        </div>
    </div>
    <div class="wrapper">


        <!-- Navbar -->
        <?php $this->load->view('component/admin/nav') ?>

        <!-- /.navbar -->
        <!-- side bar -->

        <?php $this->load->view('component/' . $dashboard_admin) ?>
        <!-- side bar end -->
        <!-- Content Wrapper. Contains page content -->
        <?php $this->load->view($content) ?>
        <!-- /.content-wrapper -->
        <!-- footer -->
        <?php $this->load->view('component/admin/footer') ?>
        <!-- footer -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <!-- file -->
    <?php $this->load->view('component/admin/file_js') ?>
    <!-- endfile js -->
    <?php $this->load->view('component/admin/js') ?>
</body>

</html>