<html>
	<head>
		<title>Master Data Aset</title>
	</head>
	
	<div class="x_panel">
 		<div class="x_title">
    		<h3 class="panel-title"><b>Form Aset</b></h3>
  		</div>
  	 	
  	 	<div class="x_content">
  	 	
			<body>
				<form method = "POST" action = "<?php echo site_url('c_transaksi/tambah_peny');?>">

					<?php $tgl_input = date("Y-m-d"); ?>
					<input type="hidden" name="tgl_input" value="<?= $tgl_input?>" >
					<input type="hidden" name="id" value="<?= $detail_peny->id ?>">
					
					<div class="form-group row">
						<label class="col-sm-1">ID Penyusutan</label>	
						<div class="col-sm-3">
					  		<input type="text" class="form-control" name="id_penyusutan" value="<?= $id_penyusutan?>" readonly>
						</div>

						<label class="col-sm-1">Bulan penyusutan</label>	
						<div class="col-sm-3">
					  		<input type="text" class="form-control" name="bln_peny" value="<?= $month_now ?>" readonly>
						</div>
					</div>

					<hr>

					<div class="form-group row">
						<label class="col-sm-1">Nama aset</label>	
						<div class="col-sm-3">
					  		<input type="text" class="form-control" name="aset" value="<?= $detail_peny->aset?>" readonly>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-1">Harga perolehan</label>	
						<div class="col-sm-3">

					  		<?php if (empty($log_penyusutan_kosong)) { ?>
					  		<?php $rumus = $detail_peny->subtotal/$detail_peny->jumlah ?>
					  		<input type="text" class="form-control" name="harga_perolehan" value="<?= format_rp($rumus) ?> " readonly>
					  		<?php } else { ?>
					  		<input type="text" class="form-control" name="harga_perolehan" value="<?= format_rp($log_penyusutan_kosong->nilai_akhir)?>" readonly>
					  		<?php } ?>

						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-1">Nilai sisa</label>	
						<div class="col-sm-3">
					  		<input type="text" class="form-control" name="nilai_sisa" value="<?= format_rp($detail_peny->nilai_sisa)?>" readonly>
						</div>
					</div>

					<hr>

					<div class="form-group row">
						<label class="col-sm-1">Nilai penyusutan</label>	
						<div class="col-sm-6">
					  		<input type="text" class="form-control" name="nilai_penyusutan" value="<?= penyusutan($nilai_penyusutan)?>" readonly>

					  		<?php
					  		if (empty($log_penyusutan_kosong)) { ?>
					  			<?php $rumus = $detail_peny->subtotal/$detail_peny->jumlah ?>
					  			<input type="hidden" name="nilai_akhir" value="<?= penyusutan($rumus - $nilai_penyusutan)?>" readonly>
					  		<?php } else { ?>
					  			<input type="hidden" name="nilai_akhir" value="<?= penyusutan($nilai_penyusutan)?>" readonly>
					  		<?php } ?>


						</div>

						<div class="col-sm-1">
							<input style="width: 100%" type="submit" name="submit" value="Simpan" class="btn btn-success" >
						</div>
					</div>
				</form>
			</body>
		</div>
	</div>

<!-- <?php $this->load->view("pembelian_aset/script")?>