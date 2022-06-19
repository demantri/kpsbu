<div class="row">
    <div class="col-sm-12">
        <div class="x_panel">
            <div class="x_content">
                <form>
                    <div class="form-group row">
                        <label for="periode" class="col-sm-2 col-form-label">Periode</label>
                        <div class="col-sm-2">
                            <input type="month" class="form-control" id="periode" name="periode" required>
                        </div>
                        <div class="col-sm-2">
                        <?php 
                        $filterdate = '2022-06-19';
                        $date = date('Y-m-d');
                        if ($date == $filterdate) { ?>
                            <button class="btn btn-primary" type="button" onclick="getList()">Filter</button>
                        <?php } ?>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="x_panel" id="myDiv">
            <div class="x_content">
                <div id="notif" class="mb-20">
                    <p>
                        <strong>
                            Note : <br>
                        </strong>
                            <i>
                                Pengajuan jurnal dilakukan setiap akhir bulan (29 Desember). Nominal yang dijurnal merupakan akumulasi dari seluruh pegawai.
                            </i>
                    </p>
                </div>
                <hr>
                <h4>
                    <i>
                    Berikut merupakan akumulasi jurnal penggajian periode
                    </i>
                </h4>
                <br>
                <form action="" method="post" id="myform">
                    <div class="form-group row">
                        <label for="" class="col-sm-2">Total Gaji Pokok</label>
                        <div class="col-sm-3">
                            <input type="text" readonly class="form-control" id="t_gaji_pokok">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-2">Total Tunjangan Kesehatan</label>
                        <div class="col-sm-3">
                            <input type="text" readonly class="form-control" id="t_tunjangan_kesehatan">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-2">Total Tunjangan Jabatan</label>
                        <div class="col-sm-3">
                            <input type="text" readonly class="form-control" id="t_tunjangan_jabatan">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-2">Total Bonus</label>
                        <div class="col-sm-3">
                            <input type="text" readonly class="form-control" id="t_bonus">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-2">Total Utang PPH21</label>
                        <div class="col-sm-3">
                            <input type="text" readonly class="form-control" id="t_ptkp">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-2">Total Kas</label>
                        <div class="col-sm-3">
                            <input type="text" readonly class="form-control" id="t_kas">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-2"></label>
                        <div class="col-sm-3">
                            <button class="btn btn-primary">Proses</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function getList() {
        var periode = $("#periode").val();
        $("#myDiv").show();
        $.ajax({
            url : "<?= base_url('Penggajian/getTotalNominal')?>",
            method : "post",
            type : "json",
            data : {
                periode : periode
            },
            success:function(e) {
                var obj = JSON.parse(e);
                var t_gaji_pokok = (obj.t_gaji_pokok === null) ? 0 : obj.t_gaji_pokok;
                var t_tunjangan_kesehatan = (obj.t_tunjangan_kesehatan === null) ? 0 : obj.t_tunjangan_kesehatan;
                var t_tunjangan_jabatan = (obj.t_tunjangan_jabatan === null) ? 0 : obj.t_tunjangan_jabatan;
                var t_bonus = (obj.t_bonus === null) ? 0 : obj.t_bonus;
                var t_ptkp = (obj.t_ptkp === null) ? 0 : obj.t_ptkp;
                var t_kas = (obj.t_kas === null) ? 0 : obj.t_kas;
                $("#t_gaji_pokok").val(t_gaji_pokok);
                $("#t_tunjangan_kesehatan").val(t_tunjangan_kesehatan);
                $("#t_tunjangan_jabatan").val(t_tunjangan_jabatan);
                $("#t_bonus").val(t_bonus);
                $("#t_ptkp").val(t_ptkp);
                $("#t_kas").val(t_kas);
            }
        });
    }

    $(document).ready(function() {
        $("#myDiv").hide();
    });
</script>