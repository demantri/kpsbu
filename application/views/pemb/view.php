<html>
	<body>
		<div class="x_panel">
			<div class="x_title">
				<h3 class="panel-title"><b>Daftar Pembelian Bahan Baku</b></h3>
			</div>
  	 	
		   	<div class="x_content">
				<?php if ($cek == TRUE){ echo "<div class='alert alert-success'><li>".$error."</li></div>"; }?>
				<?php if($cek == TRUE){?>
					<a href = "#" class="btn btn-info" role="button" disabled="disabled"><span class="glyphicon glyphicon-plus"></span> Tambah Data</a>
				<?php }else{ ?>
				<a href = "<?php echo site_url()."/c_transaksi/form_pemb"?>" class="btn btn-info" role="button"><span class="glyphicon glyphicon-plus"></span> Tambah Data</a>
						<?php } ?>
				<table id="datatable" class="table table-striped table-bordered table-hover jambo_table">
					<thead>
						<tr class="headings">
							<th style="width: 2px;">No</th>
							<th>ID Transaksi</th>
							<th>Tanggal Transaksi</th>
							<th>Informasi Truck</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$no=1;
							foreach($result as $data){ ?>
							<tr>
								<td><?= $no++ ?></td>
								<td><?= $data['no_trans'] ?></td>
								<td><?= $data['tgl_trans'] ?></td>
								<td style="width: 20%;" class="text-center">
									<?php if ($data['nama_aset'] == '') { ?>
										<button data-target='#truck_<?= $data["no_trans"]?>' data-toggle='modal' class="btn btn-default btn-sm">set truck</button>
									<?php } else { ?>
										<span>
											
											<button class="btn btn-success btn-sm"><?= $data['nama_aset']?></button>
											<a href="/" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></a>
											<a href="delete_truck/<?= $data['no_trans']?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
										</span>
									<?php } ?>
								</td>
								<td style="width: 20%;" class="text-center">
									<a href="isi_edit_pemb/<?= $data['no_trans']?>" class="btn btn-default btn-sm"> Detail Pembelian Bahan Baku</a>
								</td>
							</tr>
							<?php }
						?>
					</tbody>
				</table>
			</div>
		</div>
		<?php $this->load->view('pemb/modal_truck');?>
	</body>
</html>