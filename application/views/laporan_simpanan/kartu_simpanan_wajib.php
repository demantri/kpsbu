<html>
	<body>
		<div class="x_panel">
			<div class="x_title">
				<h3 class="panel-title"><b>Kartu Simpanan Wajib</b></h3>
			</div>
			<div class="x_content">
				<div class="row">
					<div class="col-sm-7">
						<form method="post" action="<?php echo site_url().'simpanan/kartu_simpanan_wajib' ?> " class="form-inline">
							<label>Pilih anggota</label>
							<select name="id_peternak" class="form-control">
								<option value="#" >Pilih anggota</option>
								<?php foreach ($peternak as $data ) { ?>
								<option value="<?= $data->no_peternak?>"><?= $data->nama_peternak?></option>
								<?php } ?>
							</select>&nbsp&nbsp
							<input type="submit" value="Filter" class="btn btn-info">
						</form>
					</div>
				</div>
				<hr>
				<center>
					<h3>Kartu Simpanan Wajib</h3>
				</center>
				<hr>
				<table id="datatable" class="table table-striped table-bordered table-hover jambo_table">
					<thead>
						<tr class="headings">
							<th style="width:2px">No</th>
							<th>No transaksi</th>
							<th>Tanggal</th>
							<th>Anggota</th>
							<th>Jumlah Simpanan</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$no = 1;
						foreach ($detail as $data) { ?>
						<tr>
							<td><?= $no++ ?></td>
							<td><?= $data->id_pembayaran ?></td>
							<td><?= $data->tgl_transaksi ?></td>
							<td><?= $data->nama_peternak ?></td>
							<td align='right'><?= format_rp($data->simpanan_wajib) ?></td>

						</tr>

						<?php } ?>
					</tbody>
					<tr>
						<td colspan="4" align='left'>Subtotal</td>
						<?php
						if (is_null($total)) {
							$total = 0;
						} else { 
							$total = $total;
						}?>
						<td align='right'><?= format_rp($total) ?></td>
					</tr>
				</table>
			</div>
		</div>
	</body>
</html>