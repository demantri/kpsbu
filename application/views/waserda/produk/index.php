<div class="x_panel">
    <div class="x_title">
        <div class="row">
            <div class="col-sm-10 col-12">
                <h3 id="quote"><?= $this->uri->segment(1);?></h3>
            </div>
            <div class="col-sm-2 col-12">
                <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#add">Tambah Produk</button>
            </div>
        </div>
    </div>
    <div class="x_content">
        <div id="notif">
            <?php echo $this->session->flashdata('notif'); ?>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered" id="datatable">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Nama Produk</th>
                        <th>Kategori Produk</th>
                        <th>Satuan</th>
                        <th>Stok Akhir</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($produk as $value) { ?>
                        <tr>
                            <td><?= $value->kode?></td>
                            <td><?= $value->nama_produk?></td>
                            <td><?= $value->deskripsi?></td>
                            <td><?= $value->satuan_produk?></td>
                            <td><?= $value->jml?></td>
                            <td>
                                <?php if ($value->status == 1) { ?>
                                    <button style="width: 100%;" class="btn-sm btn btn-success">Aktif</button>
                                <?php } else { ?>
                                    <button style="width: 100%;" class="btn-sm btn btn-danger">Tidak Aktif</button>
                                <?php } ?>
                            </td>
                            <td class="text-center" style="width: 7%;">
                                <div class="btn-group btn-group-sm">
                                    <a href="" class="btn btn-default"> <i class="fa fa-eye"></i></a>
                                    <a href="" class="btn btn-warning"> <i class="fa fa-pencil"></i></a>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $this->load->view('script');?>
<?php $this->load->view('waserda/produk/add');?>