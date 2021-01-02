<html>
	<!-- <head><center><h3><b>Master Data Bahan Baku</b></h3></center></head>
	<hr> -->
	<body>
		<div class="x_panel">
 <div class="x_title">
    <h3 class="panel-title"><b>Daftar Pembelian Aset</b></h3>
  </div>
  	 <div class="x_content">
  	 	
  	 		<a href = "<?php echo site_url()."c_transaksi/form_pembelian_aset"?>" class="btn btn-info" role="button"><span class="glyphicon glyphicon-plus"></span> Tambah Data</a>

  	 	 <table id="datatable" class="table table-striped table-bordered table-hover jambo_table">
		 	<thead>
				<tr class="headings">
					<th style="width: 2px;">No</th>
					<th>ID Pembelian</th>
					<th>No Nota</th>
					<th>Tanggal Pembelian</th>
					<th>Total</th>
					<th>Status</th>
					<th style="width: 10px;" class="text-center">Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$no = 1;
				foreach ($detail as $data) { ?>
					<tr>
						<td><?= $no++ ?></td>
						<td><?= $data->id_pembelian ?></td>
						<td><?= $data->no_nota ?></td>
						<td><?= $data->tgl_input ?></td>
						<td><?= format_rp($data->total) ?></td>
						<td><?= $data->status ?></td>
						<td>
							<a href="<?= site_url("c_transaksi/perolehanDetail/".$data->id_pembelian)?>" class="btn btn-xs btn-info">Detail Pembelian</a>
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>

	
	
	</body>
</html>