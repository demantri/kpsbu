<div class="row">
    <div class="col-sm-12">
        <div class="x_panel">
            <div class="x_title">
                <div class="row">
                    <div class="col-sm-10 col-12">
                        <h3 id="quote">Detail Penjualan Waserda</h3>
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
                                <th style="width: 5%;">#</th>
                                <th>Invoice</th>
                                <th>Tgl. Penjualan</th>
                                <th>Nama Barang</th>
                                <th>Qty</th>
                                <th>Subtotal</th>
                                <th>Grand Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;
                            $grandtot = 0;
                            foreach ($detail as $key => $value) { ?>
                            <?php $grandtot += $value->jml * $value->harga ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $value->invoice ?></td>
                                <td><?= $value->tanggal ?></td>
                                <td><?= $value->nama_produk ?></td>
                                <td><?= $value->jml ?></td>
                                <td><?= format_rp($value->harga) ?></td>
                                <td><?= format_rp($grandtot) ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <a href="<?= base_url('Kasir/list_penjualan') ?>" class="btn btn-default">Kembali</a>
                <a href="<?= base_url('Kasir/pdf/'.$value->invoice) ?>" class="btn btn-primary">Print</a>
            </div>
        </div>
    </div>
</div>
