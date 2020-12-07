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
				<form method = "POST" action = "<?php echo site_url('c_transaksi/tambahPembelianAset');?>">
					
					<div class="form-group row">
						<label class="col-sm-1">ID Pembelian Aset</label>	
						<div class="col-sm-3">
					  		<input type = "text" name = "id" class = "form-control" value="<?= $id ?>" readonly>
						</div>

						<label class="col-sm-1">No Nota</label>	
						<div class="col-sm-3">
					  		<input type = "text" name = "no_nota" id="no_nota" class = "form-control" autocomplete="off">
						</div>

						<label class="col-sm-2">Tanggal Pembelian</label>	
						<div class="col-sm-2">
					  		<input type = "date" name = "tgl_pembelian" class = "form-control">
						</div>
					</div>
					<hr>

					<?php $tgl_input = date('Y-m-d');?>
					<input type="hidden" name="tgl_input" value="<?= $tgl_input?>">

					<div class="form-group row">
					  	<label class="col-sm-1">Supplier</label>	
						<div class="col-sm-11">
							<select name="id_supplier" id="supplier" class="form-control">
								<option value="">Pilih supplier</option>
								<?php foreach ($supplier as $data) { ?>
									<option value="<?= $data->id?>"><?= $data->nama_supplier?></option>
								<?php } ?> 
							</select>
						</div>
					</div>

					<div class="form-group row">
					  	<label class="col-sm-1">Aset</label>	
						<div class="col-sm-11">
					  		<select name="id_aset" class="form-control" id="aset">
					  			<option value="">Pilih aset</option>
					  		</select>
						</div>
					</div>

					<div class="form-group row">
					  	<label class="col-sm-1">Harga Aset</label>	
						<div class="col-sm-11">
					  		<input type = "text" name = "harga_aset" class = "form-control" id="harga_aset" autocomplete="off" placeholder="Harga aset">
						</div>
					</div>

					<div class="form-group row">
					  	<label class="col-sm-1">Biaya</label>	
						<div class="col-sm-10">
					  		<input type = "text" name = "biaya" class = "form-control" id="biaya" autocomplete="off" placeholder="Biaya">
						</div>
						<div class="col-sm-1">
					  		<input type = "submit" value="Tambah" class="btn btn-primary btn-tambah" style="width: 100%">
						</div>

					</div>

					<hr>
					<h5>Detail Pembelian Aset</h5>
					<table class="table table-bordered">
						<tr>
							<th class="text-center" style="width: 5%">No</th>
							<th class="text-center" style="width: 15%">Supplier</th>
							<th class="text-center" style="width: 25%">Aset</th>
							<th class="text-center" style="width: 18%">Harga Aset</th>
							<th class="text-center" style="width: 18%">Biaya</th>
							<th class="text-center">Total</th>
						</tr>
					</table>
					
					
					<hr>
					<!-- <input type="submit" class="btn btn-default btn-success" value="Simpan"> -->
					<a href = "<?php echo site_url()."/c_transaksi/pembelian_aset"?>" type="button" class="btn btn-default">Kembali</a>
				</form>
			</body>
		</div>
	</div>

<!-- </html> -->
<script>
	$(document).ready(function () {

		$("#supplier").change(function () {
            // alert("holaaa")
            var id_supplier = $("#supplier").val();
            // console.log(id)
            if (id_supplier != '') {
            	$.ajax({
			    url:"<?php echo base_url("c_transaksi/aset")?>",
			    method:"POST",
			    data:{id_supplier:id_supplier},
			    success:function(data)
				    {
				     // console.log(data)
				     $("#aset").html(data);
				    }
			   	});
            }

        });
	});
</script>
<?php $this->load->view("pembelian_aset/script")?>