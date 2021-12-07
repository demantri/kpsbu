<div class="row">
    <div class="col-sm-12">
        <div class="x_panel">
            <div class="x_title">
                <div class="row">
                    <div class="col-sm-10 col-12">
                        <h3 id="quote">Penggajian</h3>
                    </div>
                    <div class="col-sm-2 col-12">
                        <h3 id="quote">
                            <!-- <button class="btn pull-right btn-primary" data-target="#add" data-toggle="modal">Tambah data</button> -->
                            <!-- <a href="<?= base_url('penjualan/form_penjualan_susu')?>" class="btn pull-right btn-primary">Tambah data</a> -->
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
                                <th style="width: 4%;">#</th>
                                <th>NIP</th>
                                <th>NPWP</th>
                                <th>Nama Pegawai</th>
                                <th>Jumlah Presensi</th>
                                <th style="width: 15%;" class="text-center">Aksi</th>
                            </tr>
                            <!-- <tr>
                                <th rowspan="2" class="text-center">Nama Pegawai</th>
                                <th rowspan="2" class="text-center">Gaji Pokok</th>
                                <th colspan="4" class="text-center">Presensi</th>
                                <th rowspan="2" class="text-center">Tunjangan Pegawai</th>
                                <th rowspan="2" style="text-align: center;">Action</th>
                            </tr>
                            <tr>
                                <th class="text-center">Masuk</th>
                                <th class="text-center">Sakit</th>
                                <th class="text-center">Izin</th>
                                <th class="text-center">Alfa</th>
                            </tr> -->
                        </thead>
                        <tbody>
                        <?php 
                        $no = 1;
                        foreach ($pegawai as $key => $value) { ?>
                        <?php 
                        $detail = $this->Absensi_model->getDetailPegawai($value->rfid)->result();
                        // print_r($detail);exit;
                        ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $value->nip ?></td>
                                <td><?= $value->npwp ?></td>
                                <td><b><?= $value->rfid ?></b>-<?= $value->nama ?></td>
                                <td><?= $value->total ?? '0' ?></td>
                                <td class="text-center">
                                    <a href="" class="btn btn-md btn-primary">Pembayaran Gaji</a>
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
