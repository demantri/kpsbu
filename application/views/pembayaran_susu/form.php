<html>
	<head>
		<title>Pembayaran Susu</title>
	</head>
	
	<div class="x_panel">
 		<div class="x_title">
    		<h3 class="panel-title"><b>Form Pembayaran Susu</b></h3>
  		</div>
  	 	
  	 	<div class="x_content">
  	 	
			<body>
				<form method = "POST" action = "<?php echo site_url('c_transaksi/bayar_susu');?>">
					
					<input type="hidden" name="kode_pembayaran" value="<?= $kode_pembayaran ?>">

					<div class="form-group row">
						<label class="col-sm-1">Anggota</label>	
						<div class="col-sm-3">
					  		<select name="id_peternak" id="id_peternak" class="form-control">
					  			<option value="">Pilih anggota</option>
					  			<?php
					  			foreach ($anggota as $data) { ?>
					  			<option value="<?= $data['no_peternak']?>"><?= $data['nama_peternak']?></option>
					  			<?php } ?>
					  		</select>
						</div>
					</div>

					<div class="form-group row" id="jml_susu">
						<label class="col-sm-1">Jumlah liter susu</label>	
						<div class="col-sm-1">
					  		<input type="text" name="jumlah_liter" id="susu" class="form-control" readonly="">
						</div>
						<div style="color: red">*jumlah selama 2 minggu terakhir</div>
					</div>

					<div class="form-group row" id="simpanan_manasuka">
						<label class="col-sm-1">Simpanan Masuka</label>	
						<div class="col-sm-3">
							<input type="text" name="manasuka" class="form-control" value="<?= $manasuka ?>" id="manasuka" readonly>
						</div>
					</div>

					<div class="form-group row" id="jumlah_pembayaran">
						<label class="col-sm-1">Simpanan Wajib</label>	
						<div class="col-sm-3">
					  		<input type="text" name="jumlah_pembayaran" id="hasil_pembayaran" class="form-control" readonly="">
						<div id="info" style="color: red"><strong>jumlah pembayaran didapatkan dari (Rp. 20 x Jumlah liter susu)</strong></div>
						</div>
					</div>

					<input type="hidden" name="jumlah_harga_susu" id="tot_sus" class="form-control" readonly="">

					<div class="form-group row" id="kalo_ngutang">
						<label class="col-sm-1">Pinjaman Anggota</label>	
						<div class="col-sm-3">
							<input type="text" name="pinjaman" class="form-control" id="pinjaman" readonly>
						</div>

						<div id="byr_tunai">
							<label class="col-sm-1">Bayar Tunai</label>	
							<div class="col-sm-3">
								<input type="text" name="piutang" class="form-control" id="piutang" readonly="">
							</div>
						</div>
					</div>

					<div class="form-group row" id="total_bayar">
						<label class="col-sm-1">Total bayar</label>	
						<div class="col-sm-3">
					  		<input type="text" name="total_trans_susu" id="total_trans_susu" class="form-control" readonly="">
						</div>
					</div>

					

					<div id="notif"></div>

					<hr>
					<?php if ($cek_hari) { ?>
						<!-- <input type="submit" name="" value="Bayar" class="btn btn-warning" id="btn-simpan"> -->
						<!-- <input type="" name="" value="asd"> -->
						<input type="submit" name="" value="Bayar" class="btn btn-success" id="btn-simpan">
					<?php } else { ?>
						<!-- <input type="submit" name="" value="Bayar" class="btn btn-success" id="btn-simpan"> -->
						<input type="submit" name="" value="Bayar" class="btn btn-success" id="btn-simpan">
					<?php } ?>
				</form>
			</body>
		</div>
	</div>

	<script type="text/javascript">
		$(document).ready(function () {
			$("#jml_susu").hide();
			$("#simpanan_manasuka").hide();
			$("#jumlah_pembayaran").hide();
			$("#total_bayar").hide();
			$("#btn-simpan").hide();

			$("#kalo_ngutang").hide();

			// set 0 
			// $("#susu").val("-");

			$("#id_peternak").change(function () {
				var id_peternak = $("#id_peternak").val()
				// console.log(id);
				$.ajax({
	                url : "<?php echo site_url('c_transaksi/j_lt');?>",
	                method : "POST",
	                data : {id_peternak: id_peternak},
	                async : true,
	                dataType : 'json',
	                success: function(data){
						$("#jml_susu").show();
						$("#simpanan_manasuka").show();
						$("#jumlah_pembayaran").show();
						$("#total_bayar").show();
						$("#kalo_ngutang").hide();
						$("#btn-simpan").show();


	                	for (i=0; i<data.length; i++) {

	                        var total = data[i].total_jumlah;
	                        var manasuka = $("#manasuka").val() ? 10000 : 0 ;

	                        var simpanan_wajib = ( 20 * total ) ;
	                        var total_trans_susu =  data[i].total_trans_susu;

	                        var rumus = total_trans_susu - simpanan_wajib - manasuka ;

	                        var pinjaman = data[i].pinjaman
	                        var pinjaman_1 = data[i].pinjaman/5

	                        var kurang_bayar = pinjaman_1 - rumus

	                        var total_bayar_lebih_besar = rumus - pinjaman_1
	                        	if (total === null) {
									$("#susu").val(0);
									$("#manasuka").val(0);
									$("#hasil_pembayaran").val(0);
									$("#total_trans_susu").val(0);
									$("#tot_sus").val(0);
									$("#pinjaman").val(0);
									$("#piutang").val(0);

									$("#btn-simpan").prop("disabled", true);
	                        	} else {
									$("#susu").val(total);
									$("#manasuka").val(manasuka);
									$("#hasil_pembayaran").val(simpanan_wajib);
									$("#total_trans_susu").val(rumus);
									$("#tot_sus").val(total_trans_susu);

									if (pinjaman != 0) {
										$("#kalo_ngutang").show();

										$("#pinjaman").val(pinjaman_1);
										$("#piutang").val(kurang_bayar);

										$("#btn-simpan").prop("disabled", true);

									} else {
										$("#kalo_ngutang").hide();

									}
									$("#btn-simpan").prop("disabled", false);
									// $("#kalo_ngutang").show();

	                        	}

	                        	if (rumus > pinjaman_1 ) {
									$("#byr_tunai").hide();
									$("#total_trans_susu").val(total_bayar_lebih_besar);
	                        	}
	                    }
	                    // console.log(rumus)
	                }
	            });
	            return false;
			})

			// $("#id_peternak").change(function () {
			// 	var id_peternak = $("#id_peternak").val()
			// 	// console.log(id);
			// 	var notif = '';
			// 	$.ajax({
	  //               url : "<?php echo site_url('c_transaksi/sum_pembelian');?>",
	  //               method : "POST",
	  //               data : {id_peternak: id_peternak},
	  //               async : true,
	  //               dataType : 'json',
	  //               success: function(data){

	  //    				var today = new Date();
	  //    				var dd = today.getDate();
			// 			var mm = today.getMonth()+1; 
			// 			var yyyy = today.getFullYear();
			// 			if(dd<10) 
			// 			{
			// 			    dd='0'+dd;
			// 			} 

			// 			if(mm<10) 
			// 			{
			// 			    mm='0'+mm;
			// 			}
			// 			var hari_ini = yyyy+'-'+mm+'-'+dd;

	  //    				$("#notif").hide();

	  //    				if (data == null) {
	  //    					$("#notif").show();
	  //    					var notif = 'Anggota belum menyetorkan susu selama 2 minggu terakhir!'
	  //    					$("#notif").html(notif)
	  //    				} else {
	  //    					var id_anggota = data.id_peternak;
		 //     				var tgl_transaksi = data.tgl_transaksi;
		 //     				var next_trans = data.next_trans;
	  //    					if (hari_ini !== next_trans) {
		 //     					$("#btn-simpan").prop("disabled", true);

		 //     					// show notif
		 //     					$("#notif").show();
		 //     					var notif = 'Silahkan lakukan transaksi berikutnya pada : <strong>'+next_trans+'<strong>';
		 //     					$("#notif").html(notif)
		 //     				} else {
		 //     					$("#btn-simpan").prop("disabled", false);

		 //     					// show notif
		 //     					$("#notif").hide();
		 //     					var notif = 'Silahkan lakukan transaksi berikutnya pada' +" "+next_trans
		 //     					$("#notif").html(notif)
		 //     				}
	  //    				}

	  //                   // console.log(data)
	  //               }
	  //           });
	  //           return false;
			// })

			// $("#id_peternak").change(function () {
			// 	var id_peternak = $("#id_peternak").val()
			// 	// console.log(id);
			// 	var notif = '';
			// 	$.ajax({
	  //               url : "<?php echo site_url('c_transaksi/getPinjaman');?>",
	  //               method : "POST",
	  //               data : {id_peternak: id_peternak},
	  //               async : true,
	  //               dataType : 'json',
	  //               success: function(data){
	  //    				var total_bayar = $("#total_trans_susu").val()

	  //    				if (data == null) {
			// 				$("#kalo_ngutang").show();
	  //    					$("#pinjaman").val(0)
	  //    					$("#piutang").val(0)


	  //    				} else {
			// 				$("#kalo_ngutang").show();

	  //    					var nominal = data.nominal
	  //    					var pinjaman_anggota = data.nominal/5
	  //    					var total_bayar = $("#total_trans_susu").val()

	  //    					var kurang_bayar = pinjaman_anggota - total_bayar

	  //    					$("#pinjaman").val(pinjaman_anggota)
	  //    					$("#piutang").val(kurang_bayar)
	  //    				}
	  //                   console.log(total_bayar)
	  //               }
	  //           });
	  //           return false;
			// })
		});
	</script>