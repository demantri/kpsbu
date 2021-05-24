<?php foreach ($result as $d) { ?>
    <div class="modal fade" id="truck_<?php echo $d["no_trans"]?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail <?= $d['no_trans']?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('c_transaksi/save_truck_information')?>" method="post">
                    <div class="modal-body">
                        <input type="hidden" value="<?= $d['no_trans']?>" name="id_pembelian">
                        <input type="text" class="id_detail_aset">
                        <div class="form-group">
                            <label for="">Aset</label>
                            <div class="">
                                <select name="id_aset" class="form-control id_aset">
                                <option value="">Pilih Aset</option>
                                <?php foreach ($truck as $t) { ?>
                                <option value="<?= $t->id_aset?>"><?= $t->aset?> - <?= $t->id_detail_aset?></option>
                                <?php } ?>
                                </select>
                                <!-- <input type="text" value="<?= $ti?>"> -->
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>
<script>
    $('.id_aset').change(function () {
        var id_aset = $('.id_aset').val()
        // alert(id_aset)
        $.ajax({
            url: "<?= base_url('c_transaksi/getDetailAset')?> ", 
            method: "POST",
            data : {
                id_aset : id_aset
            },
            success:function(data) {
                console.log(data)
            }
        })
    })
</script>