<div class="x_panel">
    <div class="x_title">
        <h3 class="panel-title"><b>Daftar Buku Besar</b></h3>
    </div>
    <div class="x_content">

        <body>
            <div class="row">
                <div class="col-sm">
                    <form class='form-inline' method="get" class="form-inline" action="<?php echo site_url() . '/c_keuangan/view_bukubesar'; ?>">

                        <label>Nama Akun </label>
                        <select name="no_coa" class="form-control" required>
                            <option value="">Pilih Akun</option>
                            <?php foreach ($coa as $key => $value) { ?>
                                <option value="<?= $value->no_coa ?>"><?= $value->nama_coa ?></option>
                            <?php } ?>
                        </select>
                        &nbsp&nbsp&nbsp&nbsp
                        <label>Pilih Tahun :</label>
                        <input type="month" class="form-control" name="bulan" required>
                        &nbsp&nbsp&nbsp&nbsp
                        <button class="btn btn-info btn-md" type="submit">Filter</button>
                    </form>
                </div>
                <hr>

                <p>
                    <center><b>
                            <div style="font-size: 25px">KPSBU</div>
                            <div style="font-size: 20px">Buku Besar <?= $nm_akun ?></div>
                            <div style="font-size: 15px">Periode <?= $periode ?></div>
                        </b></center>
                </p>

                <hr>
                <table id="datatable" class="table table-striped table-bordered table-hover jambo_table">
                    <thead>
                        <tr>
                            <th rowspan="2">Tanggal</th>
                            <th rowspan="2">Nama Akun</th>
                            
                            <th rowspan="2">Reff</th>
                            <th rowspan="2" class="text-center">Debet</th>
                            <th rowspan="2" class="text-center">Kredit</th>
                            <th colspan="2" class="text-center">Saldo </th>
                        </tr>
                        <tr>
                            <th class="text-center">Debet</th>
                            <th class="text-center">Kredit</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th class="text-right"></th>
                            <th class="text-right"></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach ((array)$data_buku_besars as $data_buku_besar) :
                            $class = (($data_buku_besar->debet) ? 'DEBET' : (($data_buku_besar->kredit) ? 'KREDIT' : ""));
                        ?>
                            <tr>
                                <td class="text-center" width="130">
                                    <?php echo $data_buku_besar->id_jurnal ?>
                                </td>
                                <td class="text-center">
                                    <?php echo $data_buku_besar->tanggal ?>
                                </td>
                                <td class="text <?= $class ?>">
                                    <?php echo $data_buku_besar->nama_akun ?>
                                </td>
                                <td class=" text-center" width="100">
                                    <?php echo $data_buku_besar->id_akun ?>
                                </td>
                                <td class="text-right">
                                    <?php echo number_format($data_buku_besar->debet) ?>
                                </td>
                                <td class="text-right">
                                    <?php echo number_format($data_buku_besar->kredit) ?>
                                </td>
                                <!-- <td>
                                                <?php //$data_buku_besar['transaksi 
                                                ?>
                                            </td> -->
                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>
        </body>
    </div>