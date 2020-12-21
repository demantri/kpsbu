<html>
	<body>
	<!-- 	
	<center><h3><b>Jurnal</b></h3></center>
	<hr> -->
		<div class="x_panel">
 <div class="x_title">
    <h3 class="panel-title"><b>Kartu simpanan susu</b></h3>
  </div>
  	 <div class="x_content">
  	 	<div class="row">
  	 		<div class="col-sm-7">
  	 			<form method="post" action="<?php echo site_url().'simpanan/kartu_simpanan_susu' ?> " class="form-inline">

					<label>Pilih anggota</label>
					<select name="id_peternak" class="form-control">
						<option value="#" >Pilih anggota</option>
						<?php foreach ($peternak as $data ) { ?>
						<option value="<?= $data->no_peternak?>"><?= $data->nama_peternak?></option>
						<?php } ?>
					</select>&nbsp&nbsp

					<!-- <input type = "submit" >&nbsp&nbsp -->

					<input type="submit" value="Filter" class="btn btn-info">
				</form>
			</div>
			<hr>
		</div>
		<hr>

	<p>ID Anggota : <?= $anggota->no_peternak?> </p>
	<p>Nama Anggota :  </p>
	<hr>
	<table id="datatable" class="table table-striped table-bordered table-hover jambo_table">
		<thead>
			<tr class="headings">
				<th style="width:2px">No</th>
				<th>No transaksi</th>
				<th>Tanggal</th>
				<th>Anggota</th>
				<th>Jumlah susu</th>
				<th>Harga susu</th>
				<th>Total pendapatan susu</th>
			</tr>
		</thead>
		<tbody>
			<?php $no = 1; 
			foreach ($detail as $data) { ?>
			<tr>
				<td><?= $no++ ?></td>
				<td><?= $data->no_trans ?></td>
				<td><?= $data->tgl_trans ?></td>
				<td><?= $data->nama_peternak ?></td>
				<td><?= $data->jumlah ?></td>
				<td><?= $data->harga ?></td>
				<td><?= $data->subtotal ?></td>
			</tr>
			<?php } ?>
		</tbody>
		<tr>
			<td colspan="6" align='center'>Subtotal</td>
			<td align='center'>Subtotal</td>
		</tr>
	
	</table>

	
	</body>
	</html>