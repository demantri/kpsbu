<div class="row">
    <div class="col-sm-12">
        <div class="x_panel">
            <div class="x_title">
                <div class="row">
                    <div class="col-sm-10 col-12">
                        <h3 id="quote">Pembayaran Kredit</h3>
                    </div>
                    <div class="col-sm-2 col-12">
                        <h3 id="quote">
                            <!-- <a href="" class="btn pull-right btn-primary">Tambah Pembayaran Kredit</a> -->
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
                                <th>Tanggal Pembayaran</th>
                                <th>Kode Pembayaran</th>
                                <th>Invoice</th>
                                <th>Nama Pembeli</th>
                                <th>Total</th>
                                <th style="width: 15%;" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $no = 1;
                        foreach ($list as $key => $value) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $value->tanggal ?? '-' ?></td>
                                <td><?= $value->id_pembayaran ?? '-' ?></td>
                                <td><?= $value->invoice ?></td>
                                <td><?= $value->nama ?></td>
                                <td><?= format_rp($value->nominal) ?></td>
                                <td class="text-center">
                                    <?php if (date('d') == '28') { ?>
                                        <a href="#bayar" data-toggle="modal" class="btn btn-md btn-primary bayar" 
                                        data-invoice="<?= $value->invoice?>"
                                        data-pembeli="<?= $value->nama?>"
                                        data-total="<?= $value->nominal?>"
                                        >Bayar</a>
                                    <?php } ?>
                                    <a href="" class="btn btn-md btn-default">Detail</a>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('waserda/pmb_kredit/bayar');?>
<script>
    $(document).on("click", ".bayar", function () {
        var invoice = $(this).data('invoice');
        var pembeli = $(this).data('pembeli');
        var total = $(this).data('total');
        $(".modal-body #invoice").val( invoice );
        $(".modal-body #nm_pembeli").val( pembeli );
        $(".modal-body #total").val( total );
    });
</script>