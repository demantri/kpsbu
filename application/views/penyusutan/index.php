<html>
	<body>
		<div class="x_panel">
 <div class="x_title">
    <h3 class="panel-title"><b>Daftar Peyusutan Aset</b></h3>
  </div>
  	 <div class="x_content">
  	 	
  	 		<a href = "<?php echo site_url()."c_transaksi/form_penyusutan"?>" class="btn btn-info" role="button"><span class="glyphicon glyphicon-plus"></span> Tambah Data</a>

  	 	 <table id="datatable" class="table table-striped table-bordered table-hover jambo_table">
		 	<thead>
				<tr class="headings">
					<th style="width: 2px;">No</th>
					<th>ID Penyusutan</th>
					<th>Bulan penyusutan</th>
					<th>Nilai penyusutan</th>
					<th>Nilai buku</th>
					<!-- <th>Status</th> -->
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$no = 1;
				foreach ($penyusutan as $data) { ?>
					<tr>
						<td><?= $no++ ?></td>
						<td><?= $data->id_penyusutan ?> </td>
						<td><?= $data->bulan_penyusutan ?> </td>
						<td><?= penyusutan($data->total_penyusutan) ?></td>
						<td><?= penyusutan($data->nilai_akhir) ?></td>
						<td>
							<a href="" class="btn btn-sm btn-info">Detail
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>

	
	
	</body>
</html>