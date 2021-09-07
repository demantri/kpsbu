<html>
	<!-- <head><center><h3><b>Master Data Bahan Baku</b></h3></center></head>
	<hr> -->
	<body>
		<div class="x_panel">
 	<div class="x_title">
    	<h3 class="panel-title"><b>Buku Pembantu Pinjaman</b></h3>
  	</div>
  	
  	<div class="x_content">
  	 	<!-- <a href = "<?php echo site_url()."c_transaksi/form_pinjaman"?>" class="btn btn-info" role="button"><span class="glyphicon glyphicon-plus"></span> Tambah Data</a> -->

  	 	 <table id="datatable" class="table table-striped table-bordered table-hover jambo_table">
            <thead>
                <tr>
                    <th rowspan="2" class="text-center">Waktu Bayar</th>
                    <th rowspan="2" class="text-center">Keterangan</th>
                    <th colspan="2" class="text-center">Mutasi</th>
                    <th colspan="2" class="text-center">Saldo</th>
                </tr>
                <tr>
                    <th class="text-center">Debit</th>
                    <th class="text-center">Kredit</th>
                    <th class="text-center">Debit</th>
                    <th class="text-center">Kredit</th>
                </tr>
            </thead>
            <tbody>
            <?php 
            $saldo = 0;
            foreach ($list as $key => $value) { ?>
                <tr>
                    <td><?= $value->waktu_bayar?></td>
                    <td><?= $value->nama_coa?></td>

                    <?php if ($value->nama_coa == 'Kas') { ?>
                        <td class="text-right"><?= format_rp($value->nominal)?></td>
                        <td></td>
                    <?php } else { ?>
                        <td></td>
                        <td class="text-right"><?= format_rp($value->nominal)?></td>
                    <?php } ?>
                    
                    <!-- hitung saldo -->

                    <?php if ($value->nama_coa == 'Kas') { ?>
                        <?php $saldo += $value->nominal?>
                    <?php } else { ?>
                        <?php $saldo -= $value->nominal?></td>
                    <?php } ?>

                    <?php if ($value->nama_coa == 'Kas') { ?>
                        <td class="text-right"><?= format_rp($saldo) ?></td>
                        <td></td>
                    <?php } else { ?>
                        <td class="text-right"><?= format_rp($saldo) ?></td>
                        <td></td>
                    <?php } ?>
                </tr>
            <?php } ?>
            </tbody>
		</table>
	</body>
</html>