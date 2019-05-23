<!DOCTYPE html>
<html>
<?php $this->load->view('admin/layout/head') ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php $this->load->view('admin/layout/header') ?>
  <!-- Left side column. contains the logo and sidebar -->
  <?php $this->load->view('admin/layout/sidebar') ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Form Peminjaman Buku</h3>
              </div><!-- /.box-header -->
              
              <div class="box-body">
                <?php if($this->session->flashdata('msg_alert_error')) { ?>
                    <div class="alert alert-danger">
                        <?=$this->session->flashdata('msg_alert_error');?>
                    </div>
                <?php } ?>
                <?php if($this->session->flashdata('msg_alert')) { ?>
                    <div class="alert alert-success">
                        <?=$this->session->flashdata('msg_alert');?>
                    </div>
                <?php } ?>
                <form method="POST" action="<?php echo base_url('Perpustakaan/peminjaman/');?>" enctype="multipart/form-data">
                  <div class="box-body">
                    <div class="form-group">
                      <label>Pilih Nama Anda</label>
                      <select class="form-control" name="anggota">
                        <option value="">===PILIH===</option>
                        <?php foreach ($anggota as $data) { ?>
                          <option value="<?=$data->Kd_Anggota;?>"><?=$data->Nama;?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Nama Petugas</label>
                        <select class="form-control" name="petugas" id="petugas" >
                            <?php foreach ($petugas as $data) {?>
                            <option value="<?=$data->Kd_Petugas?>"><?=$data->Nama?></option>
                            <?php } ?>
                        </select>  
                    </div>
                    <div class="form-group">
                      <label>Pilih Buku</label>
                        <select class="form-control" name="buku" >
                            <?php foreach ($buku as $data) {?>
                            <option value="<?=$data->Kd_Register?>"><?=$data->JudulBuku?></option>
                            <?php } ?>
                        </select>    
                    </div> 
                    <!-- Btn -->
                    <div class="form-group">
                     <input type="submit" name="submit" value="Pinjam" class="btn btn-success">
                    </div>
                  </div>
                 </form> 
                
              </div><!-- /.box-body -->
            </div><!-- /.box -->

          </div><!-- /.col -->
        </div><!-- /.row -->
      </section>
    </div>

          

<?php $this->load->view('admin/layout/footer') ?>


  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<?php $this->load->view('admin/layout/scrip') ?>     
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script src="<?=base_url('assets/admin/plugins')?>/datatables/jquery.dataTables.min.js"></script>
  <script src="<?=base_url('assets/admin/plugins')?>/datatables/dataTables.bootstrap.min.js"></script>

