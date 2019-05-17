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
    <!-- Main content -->
    <section class="content">
      <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="card-body">
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
                <div class="box-header">
                  <h3 class="box-title">Data Petugas
                    <a class="btn btn-flat btn-success btn-sm" id="tambahBuku"><i class="fa fa-plus" >Tambah</i></a>
                  </h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <table id="dataPetugas" class="table table-bordered table-hover">

                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Kode Petugas</th>
                        <th>Nama Petugas</th>
                        <th>Alamat</th>
                        <th>username</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                     <?php
                     $i = 1;
                     foreach ($petugas as $item){  ?>
                      <tr>
                        <td><?=$i++;?></td>
                        <td><?=$item->Kd_Petugas;?></td>
                        <td><?=$item->Nama;?></td>
                        <td><?=$item->Alamat;?></td>
                        <td><?=$item->username;?></td>
                        <td>
                            <a href="<?=base_url("/Perpustakaan/hapus/petugas/{$item->Kd_Petugas}");?>" onclick="return confirm('Yakin Hapus Petugas <?=$item->Nama ?>?')" class="btn btn-danger btn-xs" alt=""><i class="fa fa-trash"></i> Hapus</a>
                            <a 
                              data-id_petugas="<?=$item->Kd_Petugas?>"
                              data-nama = "<?=$item->Nama?>"
                              data-alamat = "<?=$item->Alamat?>"
                              data-username = "<?=$item->username?>"
                              data-password = "<?=$item->password?>"
                              class="btn btn-warning btn-xs editbuku" alt="edit Buku"><i class="fa fa-pencil"> Edit</i></a>
                        </td>
                      </tr>
                      <?php } ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>No</th>
                        <th>Kode Petugas</th>
                        <th>Nama Petugas</th>
                        <th>Alamat</th>
                        <th>username</th>
                        <th>Aksi</th>
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->

            </div><!-- /.col -->
          </div><!-- /.row -->

          <!-- Modal -->
          <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                          <h4 class="modal-title" id="myModalLabel">Tambah Petugas</h4>
                      </div>
                      <div class="modal-body">

                          <form class="form-horizontal" method="POST" action="<?php echo base_url('Perpustakaan/addNew/petugas');?>" enctype="multipart/form-data">
                              <div class="form-group">
                                  <label class="col-md-4 control-label">Nama Petugas</label>
                                  <div class="col-md-6 has-error">
                                      <input type="text" class="form-control" name="nama">
                                      <small class="help-block"></small>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label class="col-md-4 control-label">Alamat</label>
                                  <div class="col-md-6">
                                    <textarea class="form-control" name="alamat"></textarea>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label class="col-md-4 control-label">Username</label>
                                  <div class="col-md-6 has-error">
                                      <input type="text" class="form-control" name="username">
                                      <small class="help-block"></small>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label class="col-md-4 control-label">Password</label>
                                  <div class="col-md-6 has-error">
                                      <input type="Password" class="form-control" name="Password">
                                      <small class="help-block"></small>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <div class="col-md-6 col-md-offset-4">
                                      <button type="submit" class="btn btn-primary" id="button-reg">
                                          Simpan
                                      </button>
                                  </div>
                              </div>
                          </form>

                      </div>
                  </div>
              </div>
          </div>
          <!--end of Modal -->
          <!-- Modal -->
          <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                          <h4 class="modal-title" id="myModalLabel">Edit Petugas</h4>
                      </div>
                      <div class="modal-body">

                          <form class="form-horizontal" method="POST" action="<?php echo base_url('Perpustakaan/update/petugas');?>" enctype="multipart/form-data">
                              <input type="hidden" name="id">
                              <div class="form-group">
                                  <label class="col-md-4 control-label">Nama Petugas</label>
                                  <div class="col-md-6 has-error">
                                      <input type="text" class="form-control" name="nama">
                                      <small class="help-block"></small>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label class="col-md-4 control-label">Alamat</label>
                                  <div class="col-md-6">
                                    <textarea class="form-control" name="alamat"></textarea>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label class="col-md-4 control-label">Username</label>
                                  <div class="col-md-6 has-error">
                                      <input type="text" class="form-control" name="username">
                                      <small class="help-block"></small>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label class="col-md-4 control-label">Password</label>
                                  <div class="col-md-6 has-error">
                                      <input type="Password" class="form-control" name="password">
                                      <small class="help-block"></small>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <div class="col-md-6 col-md-offset-4">
                                      <button type="submit" class="btn btn-primary" id="button-reg">
                                          Simpan
                                      </button>
                                  </div>
                              </div>
                          </form>

                      </div>
                  </div>
              </div>
          </div>
          <!--end of Modal -->
    </section>
    </div>
  <!-- /.content-wrapper -->
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

    <script>
      $(function () {

        $('#dataPetugas').DataTable({"pageLength": 10});
          $('#tambahBuku').click(function(){
            $('input+small').text('');
            $('input').parent().removeClass('has-error');
            $('select').parent().removeClass('has-error');

            $('#myModal').modal('show');
            return false;
          });
        $('.editbuku').click(function(){
          $('input+small').text('');
          $('input').parent().removeClass('has-error');
          $('select').parent().removeClass('has-error');

          $('#myModal2').modal('show');

          var form = '#myModal2';

          $(form).find('input[name="id"]').val($(this).attr('data-id_petugas'));
          $(form).find('input[name="nama"]').val($(this).attr('data-nama'));
          $(form).find('input[name="username"]').val($(this).attr('data-username'));
          $(form).find('textarea[name="alamat"]').val($(this).attr('data-alamat'));
          $(form).find('input[name="password"]').val($(this).attr('data-password'));
                

          insert = $(form).find('#formEditKelas').attr('action')+"/"+$(this).attr('data-id_kursi');
          $(form).find('#formEditKelas').attr('action',insert);

          return false;
        });

      });

    </script>

@endsection
