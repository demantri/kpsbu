<?= $data ?>
<br>
<?= $x ?>
<br>
<select name="" id="">
    <option value=""></option>
    <?php foreach ($pegawai as $key => $value) { ?>
    <option value=""><?= $value->nama?></option>
    <?php } ?>
</select>