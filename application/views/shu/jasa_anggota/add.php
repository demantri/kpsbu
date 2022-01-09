<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h3 class="modal-title" id="exampleModalLabel">Jasa Anggota</h3>
        </div>
        <form action="<?= base_url('shu/save_jasa_anggota')?>" method="POST">
            <div class="modal-body">

                <div class="form-group row">
                    <label for="anggota" class="col-sm-4 col-form-label">Anggota</label>
                    <div class="col-sm-8">
                        <select name="anggota" class="form-control" id="anggota" required>
                            <option value="">-</option>
                            <?php foreach ($anggota as $key => $value) { ?>
                            <option value="<?= $value->no_peternak?>"><?= $value->nama_peternak?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div id="show">
                    <div class="form-group row">
                        <label for="total_penjualan" class="col-sm-4 col-form-label">Total Penjualan</label>
                        <div class="col-sm-8">
                            <input type="text" name="total_penjualan" id="total_penjualan" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="jasa_anggota" class="col-sm-4 col-form-label">Jasa Anggota</label>
                        <div class="col-sm-8">
                            <input type="text" name="jasa_anggota" id="jasa_anggota" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="total_trans_susu" class="col-sm-4 col-form-label">Total Transaksi Susu</label>
                        <div class="col-sm-8">
                            <input type="text" name="total_trans_susu" id="total_trans_susu" class="form-control" readonly>
                        </div>
                    </div>

                    <hr>
                    <div class="form-group row">
                        <label for="sisa_hasil_usaha" class="col-sm-4 col-form-label">Sisa Hasil Usaha</label>
                        <div class="col-sm-8">
                            <input type="text" name="sisa_hasil_usaha" id="sisa_hasil_usaha" class="form-control" readonly>
                        </div>
                    </div>

                    <span style="color: red;">*nilai desimal akan dibulatkan pada saat disimpan.</span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btn_simpan">Simpan</button>
            </div>
        </form>
        </div>
    </div>
</div>