<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('admin/layout/head') ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php $this->load->view('admin/layout/header') ?>
  <!-- Left side column. contains the logo and sidebar -->
  <?php $this->load->view('admin/layout/sidebar') ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <div class="box">
            <!-- /.box-header -->
             <div class="box box-default">
              <div class="box-header with-border">
                <h3 class="box-title">PROGRAM PERPUSTAKAAN</h3>
              </div>
              <div class="box-body">
                <h1>Login berhasil !</h1>
                <h2>Hai, <?php echo $this->session->userdata("nama"); ?></h2>
              </div>
              
              <!-- /.box-body -->
          
  </body>

</html>