<html>
	<body>
		<div class="x_panel">
			<div class="x_title">
				<h3 class="panel-title"><b>Kartu Penyusutan Aset</b></h3>
			</div>
			<div class="x_content">
				<!-- <div class="row">
					<div class="col-sm-7">
						<form method="post" action="<?php echo site_url().'c_transaksi/kartu_aset' ?> " class="form-inline">
                            <label>Pilih Aset</label>
                            &nbsp&nbsp&nbsp&nbsp
							<select name="aset" class="form-control" required>
								<option value="#" >Pilih Aset</option>
								<?php foreach ($aset as $data ) { ?>
								<option value="<?= $data->id_detail_aset?>"><?= $data->aset?> - <b><?= $data->id_detail_aset?></b></option>
								<?php } ?>
							</select>
							<input type="submit" value="Filter" class="btn btn-info">
						</form>
					</div>
				</div> -->
				<!-- <hr> -->
				<center>
					<h3>Buku Kas Kecil</h3>
				</center>
				<hr>
				<table id="datatable" class="table table-striped table-bordered table-hover jambo_table">
					<thead>
						<tr class="headings">
							<th>#</th>
							<th>Tanggal Transaksi</th>
							<th>ID Ref</th>
							<th>Keterangan</th>
							<th>Debet</th>
							<th>Kredit</th>
							<th>Saldo</th>
						</tr>
					</thead>
					<tbody>
                        <?php 
                        $no = 1;
                        $saldo = 0;
                        foreach ($list as $key => $value) { ?>
                        <?php
                            if ($value->posisi_d_c == 'd') { 
                                # code...
                                $saldo += $value->nominal;
                            } else {
                                # code...
                                $saldo -= $value->nominal;
                            }
                        ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $value->tgl_transaksi ?></td>
                            <td><?= $value->id_ref ?></td>
                            <td><?= $value->keterangan ?></td>
                            <?php if ($value->posisi_d_c == 'd') { ?>
                                <td><?= format_rp($value->nominal) ?></td>
                                <td></td>
                            <?php } else { ?>
                                <td></td>
                                <td><?= format_rp($value->nominal) ?></td>
                            <?php } ?>
                            <td><?= format_rp($saldo) ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
				</table>
			</div>
		</div>
	</body>
</html>