<link href="<?php echo base_url(); ?>assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

<p>Waserda KPSBU</p>
<p>Jl. Kayu Ambon Dalam No. 5, Lembang. Kec. Lembang. Kab. Bandung Barat.</p>



<table class="table">
    <tr>
        <th>no</th>
        <th>item</th>
        <th>qty</th>
        <th>subtotal</th>
    </tr>
    <?php 
    $no =1;
    $subtotal = 0;
    foreach ($detail as $value) { ?>
    <?php $subtotal = $value->jml * $value->harga ?> 
    <tr>
        <td><?= $no++ ?></td>
        <td><?= $value->nama_produk ?></td>
        <td><?= $value->jml.' '.'@'.$value->harga ?></td>
        <td><?= format_rp($subtotal) ?></td>
    </tr>
    <?php } ?>
</table>