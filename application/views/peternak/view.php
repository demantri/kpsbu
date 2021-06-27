<html>
	<!-- <head><center><h3><b>Master Data Peternak</b></h3></center></head>
	<hr> -->
	<body>
		<div class="x_panel">
 <div class="x_title">
    <h3 class="panel-title"><b>Daftar Peternak</b></h3>
  </div>
  	 <div class="x_content">
  	 		<a href = "<?php echo site_url()."/c_masterdata/form_peternak"?>" class="btn btn-info" role="button"><span class="glyphicon glyphicon-plus"></span> Tambah Data</a>
  	 	 <table id="datatable" class="table table-striped table-bordered table-hover jambo_table">
		 	<thead>
			<tr class="headings">
				<th>ID Peternak</th>
				<th>Kode TPS</th>
				<th>Nama Peternak</th>
				<th>Nama Peternakan</th>
				<th>No. Telepon</th>
				<th>Alamat</th>
				<th>Tanggal Daftar</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php
			$no=1;
				foreach($result as $data){
					echo "
						<tr>
							<td>".$data['no_peternak']."</td>
							<td>".$data['alamat_tps']."</td>
							<td>".$data['nama_peternak']."</td>
							<td>".$data['nm_peternakan']."</td>
							<td align='right'>".$data['notel']."</td>
							<td>".$data['alamat']."</td>
							<td>".$data['create_date']."</td>"?>
							<td>
								<a href="" data-target="#kartu_simpanan_<?= $data['no_peternak']?>" data-toggle="modal">
									<span class="fa-stack">
									<i class="fa fa-square fa-stack-2x" style="color:#2A3F54;"></i>
									<span class="glyphicon glyphicon-file fa-stack-1x" aria-hidden="true" style="color:white"></span>
									</span>
								</a>
								<a href="isi_edit_peternak/<?php echo $data['no_peternak']; ?>">
									<span class="fa-stack">
									<i class="fa fa-square fa-stack-2x" style="color:#2A3F54;"></i>
									<span class="glyphicon glyphicon-pencil fa-stack-1x" aria-hidden="true" style="color:white"></span>
									</span>
								</a>
								<a href="deactive/<?php echo $data['no_peternak']; ?>" onclick="return confirm('Anda yakin?')">
									<span class="fa-stack">
									<i class="fa fa-square fa-stack-2x" style="color:#2A3F54;"></i>
									<span class="glyphicon glyphicon-ban-circle fa-stack-1x" aria-hidden="true" style="color:white"></span>
									</span>
								</a>
							</td>
						</tr>
						
					<?php
					$no++;
				}
			?>
			</tbody>
		</table>
	</body>
</html>
<?php $this->load->view('peternak/modal_kartu_simpanan');?>