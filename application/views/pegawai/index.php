<div class="row">
    <div class="col-sm-12">
        <div class="x_panel">
            <div class="x_title">
                <div class="row">
                    <div class="col-sm-10 col-12">
                        <h3 id="quote">Pegawai</h3>
                    </div>
                    <div class="col-sm-2 col-12">
                        <h3 id="quote">
                            <!-- <button class="btn pull-right btn-primary" data-target="#add" data-toggle="modal">Tambah data</button> -->
                            <a href="#add" data-toggle="modal" data-target=".bd-example-modal-lg" class="btn pull-right btn-primary">Tambah Data</a>
                        </h3>
                    </div>
                </div>
            </div>
            <div class="x_content">
                <div id="notif">
                    <?php echo $this->session->flashdata('notif_ubah'); ?>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="datatable">
                        <thead>
                            <tr>
                                <th style="width: 5%;">No</th>
                                <th>NIP</th>
                                <th>NPWP</th>
                                <th>Pegawai</th>
                                <th>No Telp</th>
                                <th>Alamat</th>
                                <th>TTL</th>
                                <th>Status</th>
                                <th style="width: 7%;" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $no = 1;
                        foreach ($list as $key => $value) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $value->nip ?></td>
                                <td><?= $value->npwp ?></td>
                                <td><?= $value->nama ?></td>
                                <td><?= $value->no_telp ?></td>
                                <td><?= $value->alamat ?></td>
                                <td><?= $value->tgl_lahir ?></td>
                                <td><?= $value->status ? 'aktif' : 'tidak aktif'; ?></td>
                                <td>
                                    <a href="" class="btn btn-md btn-default">Detail</a>
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
<?php $this->load->view('pegawai/add');?>
<script>
    $(document).ready(function() {
        $("#hide_ptkp").hide()
        $('#jp').on('change', function () {
            $("#hide_ptkp").hide()
            var val = $(this).val()
            if (val == 'Tetap') {
                $("#hide_ptkp").show() 
            }
            console.log(val)
        })
    })
</script>