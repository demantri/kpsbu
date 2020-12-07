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
				<form method = "POST" action = "<?php echo site_url('c_masterdata/simpan_aset');?>">
					
					<div class="form-group row">
						<label class="col-sm-1">ID Pembelian Aset</label>	
						<div class="col-sm-3">
					  		<input type = "text" name = "id_aset" class = "form-control" readonly>
						</div>

						<label class="col-sm-1">No Nota</label>	
						<div class="col-sm-3">
					  		<input type = "text" name = "id_aset" class = "form-control" readonly>
						</div>

						<label class="col-sm-2">Tanggal Pembelian</label>	
						<div class="col-sm-2">
					  		<input type = "date" name = "id_aset" class = "form-control">
						</div>
					</div>
					<hr>

					<div class="form-group row">
					  	<label class="col-sm-1">Supplier</label>	
						<div class="col-sm-11">
					  		<input type = "date" name = "id_aset" class = "form-control">
						</div>
					</div>

					<div class="form-group row">
					  	<label class="col-sm-1">Aset</label>	
						<div class="col-sm-11">
					  		<input type = "date" name = "id_aset" class = "form-control">
						</div>
					</div>

					<div class="form-group row">
					  	<label class="col-sm-1">Harga Aset</label>	
						<div class="col-sm-11">
					  		<input type = "date" name = "id_aset" class = "form-control">
						</div>
					</div>

					<div class="form-group row">
					  	<label class="col-sm-1">Biaya</label>	
						<div class="col-sm-11">
					  		<input type = "date" name = "id_aset" class = "form-control">
						</div>
					</div>
					
					
					<hr>
					<input type="submit" class="btn btn-default btn-primary" value="Simpan">
					<a href = "<?php echo site_url()."/c_masterdata/aset"?>" type="button" class="btn btn-default">Kembali</a>
				</form>
			</body>
		</div>
	</div>
</html>