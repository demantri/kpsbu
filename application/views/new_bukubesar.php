
<div class="x_panel">
    <div class="x_title">
        <h3 class="panel-title"><b>Daftar Buku Besar</b></h3>
    </div>
    <div class="x_content">
	<body>
        <div class="row">
            <div class="col-sm">
            <form class = 'form-inline' method = "POST" class = "form-inline" action = "<?php echo site_url().'/c_keuangan/bukubesar';?>">
            
            <label>Nama Akun </label> 
            <select name ="no_coa" class ="form-control" required>
                <option value="">Pilih Akun</option>
                <?php foreach ($coa as $key => $value) { ?>
                <option value="<?= $value->no_coa?>"><?= $value->nama_coa?></option>
                <?php } ?>
            </select>
            &nbsp&nbsp&nbsp&nbsp
            <label>Pilih Tahun :</label>
            <input type="month" class="form-control" name="bulan" required>
            &nbsp&nbsp&nbsp&nbsp
            <button class = "btn btn-info btn-md" type = "submit">Filter</button>
            </form>
        </div>
        <hr>
		
        <p><center><b>
  	 	    <div style="font-size: 25px">KPSBU</div>
            <div style="font-size: 20px">Buku Besar <?= $nm_akun ?></div>
            <div style="font-size: 15px">Periode <?= $periode ?></div>
        </b></center></p>

        <hr>
        <table id="datatable" class="table table-striped table-bordered table-hover jambo_table">
            <thead>
                <tr class="headings">
                    <th>Tanggal</th>
                    <th>Keterangan</th>
                    <th>Debit</th>
                    <th>Kredit</th>
                    <th>Saldo</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>0000-00-00</td>
                    <td>Saldo Awal</td>
                    <td colspan="2"></td>
                    <td class="text-right"><?= format_rp($saldo)?></td>
                </tr>
                <?php $saldo_awal = $saldo; ?>
                <?php foreach ($list as $key => $value) { ?>
                    <?php $hedaer = substr($value->no_coa, 0,1) ?>
                    <tr>
                        <td><?= $value->tgl_jurnal?></td>
                        <td><?= $value->nama_coa?></td>
                        <?php if ($value->posisi_dr_cr == 'd') {?>
                            <?php if ($hedaer == 1 OR $hedaer == 5 OR $hedaer == 6 ) { ?>
                                <?php $saldo_awal = $saldo_awal + $value->nominal; ?>
                            <?php } else { ?>
                                <?php $saldo_awal = $saldo_awal - $value->nominal; ?>
                            <?php } ?>
                            <td class="text-right"><?= format_rp($value->nominal)?></td>
                            <td></td>
                        <?php } else { ?>
                            <?php if ($hedaer == 1 OR $hedaer == 5 OR $hedaer == 6 ) { ?>
                                <?php $saldo_awal = $saldo_awal - $value->nominal; ?>
                            <?php } else { ?>
                                <?php $saldo_awal = $saldo_awal + $value->nominal; ?>
                            <?php } ?>
                            <td></td>
                            <td class="text-right"><?= format_rp($value->nominal)?></td>
                        <?php } ?>
                        <td class="text-right"><?= format_rp($saldo_awal)?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </body>
</div>