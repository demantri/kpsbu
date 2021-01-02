<!-- <html> -->
<head>
    <title>Master Data Aset</title>
</head>
	
<div class="x_panel">
    <div class="x_title">
        <h3 class="panel-title"><b>Detail Pembelian Aset</b></h3>
    </div>
    
    <div class="x_content">
    
        <body>  
            <div class="form-group row">
                <label class="col-sm-2">ID Pembelian</label>	
                <div class="col-sm-2">
                    <strong>
                        <p>: <?= $id?></p>
                    </strong>
                </div>

                <label class="col-sm-2">No Nota</label>	
                <div class="col-sm-3">
                    <strong>
                        <p>: <?= $pembelian_aset->no_nota?></p>
                    </strong>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2">Tanggal Pembelian</label>	
                <div class="col-sm-3">
                    <strong>
                        <p>: <?= $pembelian_aset->tgl_input?></p>
                    </strong>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2">No Nota</label>	
                <div class="col-sm-3">
                    <strong>
                        <p>: <?= $id?></p>
                    </strong>
                </div>
            </div>
            <hr>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Aset</th>
                        <th>Supplier</th>
                        <th>Nominal</th>
                        <th>Biaya</th>
                        <th>Nilai Sisa</th>
                        <th>Total Perolehan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    foreach ($detailPerolehan as $data) { ?>
                        <tr>
                            <td><?= $no++?></td>
                            <td><?= $data->id_aset?> - <?= $data->aset?></td>
                            <td><?= $data->id_supplier?> - <?= $data->aset?></td>
                            <td class="text-right"><?= format_rp($data->nominal)?></td>
                            <td class="text-right"><?= format_rp($data->biaya)?></td>
                            <td class="text-right"><?= format_rp($data->nilai_sisa)?></td>
                            <td class="text-right"><?= format_rp($data->subtotal)?></td>
                        </tr>
                    <?php }?>
                </tbody>
            </table>
            
            <a href="<?= site_url("c_transaksi/pembelian_aset")?>" class="btn btn-sm btn-default">Balik atuh bray</a>
        </body>
    </div>
</div>