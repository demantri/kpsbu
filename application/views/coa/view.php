<html>
	
		<div class="x_panel">
 <div class="x_title">
    <h3 class="panel-title"><b>Daftar COA</b></h3>
  </div>
  	 <div class="x_content">

		<a href = "<?php echo site_url()."/c_masterdata/form_coa"?>" class="btn btn-info" role="button"><span class="glyphicon glyphicon-plus"></span> Tambah Data</a>
		 <table id="datatable" class="table table-striped table-bordered table-hover jambo_table">
		 	<thead>
			<tr class="headings">
				<th>No COA</th>
				<th>Nama COA</th>
				<!-- <th></th> -->
				<!-- <th>Jenis COA</th> -->
			</tr>
		</thead>
		<tbody>
			<?php
			$no=1;
				foreach($result as $data){
					echo "
							<td>".$data['no_coa']."</td>
							<td>".$data['nama_coa']."</td>
							" ?>
							<!-- <td align="center">
							<a class="btn btn-primary" href="edit_form_coa/<?= $data['id']?>">Ubah</a>
							</td> -->
						</tr>
					<?php
					$no++;
				}
			?>
		</tbody>
		</table>


	</body>
</html>