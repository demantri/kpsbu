<div class="row">
    <div class="col-sm-12">
        <div class="x_panel">
            <div class="x_title">
                <div class="row">
                    <div class="col-sm-10 col-12">
                        <h3 id="quote">Pembagian SHU</h3>
                    </div>
                    <div class="col-sm-2 col-12">
                        <h3 id="quote">
                            <button class="btn pull-right btn-primary" data-target="#add" data-toggle="modal">Tambah</button>
                        </h3>
                    </div>
                </div>
            </div>
            <div class="x_content">
                <div id="notif">
                    <?php echo $this->session->flashdata('notif_ubah'); ?>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="datatable">
                        <thead>
                            <tr>
                                <th style="width: 5%;">No</th>
                                <th>Kode</th>
                                <th>Tanggal</th>
                                <th>Nominal</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('shu/jasa_anggota/add')?>
<script>
    $(document).ready(function() {
        $("#show").hide()
        $("#btn_simpan").prop('disabled', true)
        $("#anggota").on('change', function () {
            var val = $(this).val()
            if (val) {
                $("#show").show()
                $("#btn_simpan").prop('disabled', false)

                $.ajax({
                    url : "<?= base_url('shu/get_data_jasa_anggota')?>",
                    method : "post", 
                    data : {
                        id : val
                    },
                    success : function(e) {
                        var obj = JSON.parse(e)
                        console.log(obj)
                        var shu = (obj.total_penjualan / obj.jasa_anggota) * obj.total_transaksi
                        $("#total_penjualan").val(obj.total_penjualan)
                        $("#jasa_anggota").val(obj.jasa_anggota)
                        $("#total_trans_susu").val(obj.total_transaksi)
                        $("#sisa_hasil_usaha").val(shu)
                    }
                })
            } else {
                $("#show").hide()
                $("#btn_simpan").prop('disabled', true)
            }
            console.log(val)
        })
    })
</script>
