<!-- <html> -->
	<head>
		<title>Master Data Aset</title>
	</head>
	
	<div class="x_panel">
 		<div class="x_title">
    		<h3 class="panel-title"><b>Form Aset</b></h3>
  		</div>
  	 	
  	 	<div class="x_content">
  	 	
			<body>
				<form method = "POST" action = "<?php echo site_url('c_transaksi/disusutkan');?>">
					
					<div class="form-group row">
						<label class="col-sm-1">Pilih Aset</label>	
						<div class="col-sm-3">
					  		<select name="id" id="id" class="form-control">
					  			<option value="">Pilih aset</option>
					  			<?php
					  			foreach ($aset as $data) { ?>
					  			<option value="<?= $data->id?>"><?= $data->id_pembelian?> - <?= $data->aset?> - <?= ($data->sisa_umur) ?> Bulan </option>
					  			<?php } ?>
					  		</select>
						</div>
						<button type="submit" class="btn btn-primary">Susutkan</button>
					</div>
					<hr>
				</form>
			</body>
		</div>
	</div>

<!-- <?php $this->load->view("pembelian_aset/script")?> -->