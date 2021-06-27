<html>
	<head>
		<title>Form Input COA</title>
	</head>
	<!-- <center><h3><b>Master Data COA</b></h3></center>
	<hr> -->
		<div class="x_panel">
 <div class="x_title">
    <h3 class="panel-title"><b>Form COA</b></h3>
  </div>
  	 <div class="x_content">
	<body>
		<form method = "POST" action = "<?php echo site_url('c_masterdata/isi_edit_COA');?>">
            <input type="hidden" value="<?= $coa->id?>" name="id">
			<div class="form-group">
			  <label>No COA</label>
			  <input type = "text" name = "no_coa" class = "form-control" length="11" value="<?= $coa->no_coa?>" autocomplete="off">
			  <?php echo form_error('no_coa'); ?>
			</div>

			<div class="form-group">
			  <label>Nama COA</label>
			  <input type = "text" name = "nama_coa" class = "form-control" value="<?= $coa->nama_coa?>" readonly>
			  
			  <?php echo form_error('nama_coa'); ?>
			
			</div>
			<hr>
			<a href = "<?php echo site_url()."/c_masterdata/lihat_coa"?>" type="button" class="btn btn-default">Kembali</a>
			<button type="submit" class="btn btn-default btn-primary">Simpan</button>
		</form>
	</body>
</html>