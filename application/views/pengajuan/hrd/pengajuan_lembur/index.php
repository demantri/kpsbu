<div class="row">
    <div class="col-sm-12">
        <div class="x_panel">
            <div class="x_title">
                <div class="row">
                    <div class="col-sm-10 col-12">
                        <h4 id="quote">Lembur Pegawai</h4>
                    </div>
                    <div class="col-sm-2 col-12">
                        <h3 id="quote">
                            <a href="#add" data-toggle="modal" class="btn pull-right btn-primary">Tambah</a>
                        </h3>
                    </div>
                </div>
            </div>
            <div class="x_content">
                <div id="notif">
                    <?php echo $this->session->flashdata('notif_ubah'); ?>
                </div>
                <div style="margin-bottom: 20px;">
                    <strong>Note :<br></strong>
                    <p>*untuk lembur pegawai, maksimal 6 jam <br></p>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="datatable">
                        <thead>
                            <tr>
                                <th style="width: 5%;">#</th>
                                <th>ID Pengajuan</th>
                                <th>Tanggal Pengajuan</th>
                                <th>Nama Pegawai</th>
                                <th>Jumlah Pengajuan (jam lembur)</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        $no = 1;
                        foreach ($lembur as $key => $value) { ?>
                            <tr>
                                <td><?= $no++?></td>
                                <td><?= $value->id_pengajuan?></td>
                                <td><?= $value->tgl_pengajuan?></td>
                                <td><?= $value->nama?></td>
                                <td><?= $value->total_jam?></td>
                                <td class="text-center">
                                    <?= $value->status == 0 ? '<span class="label label-warning">Menunggu persetujuan</span>' : (($value->status == 1) ? '<span class="label label-success">Sudah disetujui</span>' : '<span class="label label-danger">Ditolak</span>'); ?>
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-default btn-xs" id="setuju"><i class="fa fa-check"></i></button>
                                    <button class="btn btn-default btn-xs" id="tolak"><i class="fa fa-times"></i></button>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('pengajuan/hrd/pengajuan_lembur/add');?>