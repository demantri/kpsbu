<div class="row">
    <div class="col-sm-12">
        <div class="x_panel">
            <div class="x_title">
                <div class="row">
                    <div class="col-sm-10 col-12">
                        <h3 id="quote">Laporan Simpanan</h3>
                    </div>
                    <div class="col-sm-2 col-12">
                        <h3 id="quote">
                            <!-- <button class="btn pull-right btn-primary" data-target="#add" data-toggle="modal">Tambah Jadwal Shift</button> -->
                        </h3>
                    </div>
                </div>
            </div>
            <div class="x_content">
                <div id="notif">
                    <?php echo $this->session->flashdata('notif_ubah'); ?>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th rowspan="2" class="text-center">Nama anggota</th>
                                <th colspan="3" class="text-center">Laporan Simpanan</th>
                                <th rowspan="2" class="text-center">Total</th>
                            </tr>
                            <tr> 
                                <th>Pokok</th>
                                <th>Wajib</th>
                                <th>Masuka</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($list as $item) { ?>
                            <tr>
                                <td><?= $item->nama_peternak?></td>
                                <td><?= format_rp($item->deposit) ?? 0 ?></td>
                                <td><?= format_rp($item->total_simpanan_wajib) ?? 0?></td>
                                <td><?= format_rp($item->total_masuka) ?? 0?></td>
                                <td><?= $item->nama_peternak?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
