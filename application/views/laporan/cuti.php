<div class="col-sm-12">
    <div class="x_panel">
        <div class="x_content">
            <form action="<?= base_url('Laporan/lap_cuti')?>" method="post">
                <div class="form-group row">
                    <label for="periode" class="col-sm-1">Periode</label>
                    <div class="col-sm-2">
                        <select name="bulan" id="bulan" class="form-control" required>
                        <option value="">-</option>
                        <option value="01">Januari</option>
                        <option value="02">Februari</option>
                        <option value="03">Maret</option>
                        <option value="04">April</option>
                        <option value="05">Mei</option>
                        <option value="06">Juni</option>
                        <option value="07">Juli</option>
                        <option value="08">Agustus</option>
                        <option value="09">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>
                        </select>
                    </div>
                    <div class="col-sm-1">
                        <select name="tahun" id="tahun" class="form-control" required>
                            <option value="">-</option>
                            <?php for ($i=2020; $i <= 2025; $i++) { ?>
                                <option value="<?= $i ?>"><?= $i ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-sm-2">
                        <button class="btn btn-primary" type="submit">Filter</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="col-md-12 col-sm-6 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
        <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
            <li><a class="close-link"><i class="fa fa-close"></i></a>
            </li>
        </ul>
        <div class="clearfix"><h3>Laporan Cuti</h3></div>
        </div>
        <div class="x_content">
            
            <table class="table table-bordered" id="datatable-buttons">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Cuti</th>
                        <th>Jumlah Cuti</th>
                        <th>Nama Karyawan</th>
                        <th>Alasan Cuti</th>
                        <th>Tgl. Mulai</th>
                        <th>Tgl. Selesai</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                $no = 1;
                foreach ($cuti as $row) { ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $row->id_pengajuan ?></td>
                        <td><?= $row->jumlah_hari ?></td>
                        <td><?= $row->nama ?></td>
                        <td><?= $row->alasan_cuti ?></td>
                        <td><?= $row->tgl_mulai ?></td>
                        <td><?= $row->tgl_selesai ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>