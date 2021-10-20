<div class="row">
    <div class="col-sm-5">
        <div class="x_panel">
            <div class="x_title">
                <div class="row">
                    <div class="col-sm-10 col-12">
                        <h3>POS Penjualan</h3>
                    </div>
                    <div class="col-sm-2">
                        <h5 class="clock"></h5>
                    </div>
                </div>
            </div>
            <div class="x_content">
                <div id="notif">
                    <?php echo $this->session->flashdata('notif'); ?>
                </div>
                <form action="<?= base_url('Kasir/add_detail')?>" method="POST">
                    <div class="form-group row">
                        <label for="invoice" class="col-sm-2 col-form">Inovice</label>
                        <div class="col-sm-10">
                            <input type="text" readonly class="form-control" id="invoice" name="invoice" value="<?= $kode ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kasir" class="col-sm-2 col-form">Kasir</label>
                        <div class="col-sm-10">
                            <input type="text" readonly class="form-control" id="kasir" value="<?= $user ?>">
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <label for="barang" class="col-sm-2 col-form">Product</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <input type="text" name="barang" class="form-control scan_barcode" id="barang" placeholder="scan product here" autofocus required>
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-default" id="btn-search" data-target="#show" data-toggle="modal"><i class="fa fa-search"></i></button>
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <input type="number" class="form-control" name="qty" id="qty" value="1" min="1">
                        </div>
                    </div>
                    <hr>
                    <div class="text-right">
                        <button type="submit" class="btn btn-sm btn-secondary">Lanjutkan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-sm-7">
        <div class="x_panel">
            <div class="x_title">
                <div class="row">
                    <div class="col-sm-10 col-12">
                        <h3>Detail Penjualan</h3>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Kode Produk</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th class="text-center">Qty</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            foreach ($detail as $key => $value) { ?>
                                <tr>
                                    <td><?= $value->kode ?></td>
                                    <td><?= $value->nama_produk ?></td>
                                    <td><?= format_rp($value->harga) ?></td>
                                    <td style="width:50px;">
                                        <input style="width:50px;" type="number" value="<?= $value->jml?>" min="0" name="qty_update">
                                    </td>
                                    <td class="text-center" style="width: 15%;">
                                        <a href="<?= base_url('Kasir/update_qty/'.$value->kode.'/'.$value->invoice) ?>" class="btn btn-xs btn-warning">Update</a>
                                        <button class="btn btn-xs btn-danger">Hapus</button>
                                    </td>
                                </tr>
                        <?php } ?>
                    </tbody>
                    <input type="hidden" value="<?= $total?>" name="total">
                </table>

                <h3>Grand Total : <?= $total = (empty($total)) ? '-' : format_rp($total) ?></h3>
                <hr>
                <div class="text-left">
                    <button class="btn btn-sm btn-primary">Bayar</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- asjhdajkhsdkjahsdkjahsdd -->
<?php $this->load->view('script');?>
<?php $this->load->view('Kasir/show');?>
<script type="text/javascript">
	$(document).ready(function(){
        time()
        show()
        autocomplete()


		$("#myForm").submit(function(e){
			e.preventDefault();
			var barcode = $("#barang").val();
			var invoice = $("#invoice").val();
			var qty = $("#qty").val();
            // console.log(barcode)
			$.ajax({
				url:"<?= base_url('Kasir/detail_barcode/')?>"+qty+"/"+invoice+"/"+barcode,
				success:function(response){
					data = JSON.parse(response);
                    console.log(data)
				}
			});
		});
	})
</script>
<script>
    function time(){
        // 24 hour clock  
        setInterval(function() {

        var currentTime = new Date();
        var hours = currentTime.getHours();
        var minutes = currentTime.getMinutes();
        var seconds = currentTime.getSeconds();

        // Add leading zeros
        hours = (hours < 10 ? "0" : "") + hours;
        minutes = (minutes < 10 ? "0" : "") + minutes;
        seconds = (seconds < 10 ? "0" : "") + seconds;

        // Compose the string for display
        var currentTimeString = hours + ":" + minutes + ":" + seconds;
        $(".clock").html(currentTimeString);

        }, 1000);
    }

    function show() {
        // $('#btn-search').on('click', function() {
        //     alert('clicked')
        // })
    }

    function autocomplete() {
        $( function() {
            // var availableTags = '<?php echo base_url('Kasir/list')?>';
            // console.log(availableTags)
            $("#barang").autocomplete({
                // source: availableTags, 
                // minLength: 2
                source: function(request, response){
                    $.ajax({
                        url : '<?= base_url('Kasir/list')?>', 
                        type: 'post',
                        dataType: 'json',
                        data: {
                            search : request.term
                        }, 
                        success:function(data) {
                            response(data)
                        }
                    })
                }, 
                select: function(event, ui) {
                    $('#barang').val(ui.item.label)
                    return false;
                }, 
                minLength: 3
            });
        });
    }

    $(function () {
        $('.btn-select').on('click', function () {
            // INSERT DATA DISINI

            alert('asdasdasASDASD')
        })
    })
</script>