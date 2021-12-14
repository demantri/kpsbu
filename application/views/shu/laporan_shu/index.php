<div class="row">
    <div class="col-sm-12">
        <div class="x_panel">
            <div class="x_title">
                <div class="row">
                    <div class="col-sm-10 col-12">
                        <h3 id="quote">Laporan SHU</h3>
                    </div>
                    <div class="col-sm-2 col-12">
                        <h3 id="quote">
                            <!-- <button class="btn pull-right btn-primary" data-target="#add" data-toggle="modal">Tambah Jadwal Shift</button> -->
                        </h3>
                    </div>
                </div>
            </div>
            <div class="x_content">
                <div id="notif">
                    <?php echo $this->session->flashdata('notif_ubah'); ?>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th colspan="3">Pendapatan</th>
                        </tr>
                        <tr>
                            <td>Penjualan</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                        <tr>
                            <td>Harga pokok penjualan</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                        <tr>
                            <th>Laba kotor</th>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                        <tr>
                            <td>Pendapatan lain-lain</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                        <tr>
                            <th>Total penjualan</th>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                        <tr>
                            <th colspan="3">Beban Operasional</th>
                        </tr>
                        <tr>
                            <th>Total beban operasional</th>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                        <tr>
                            <th>SHU sebelum pajak</th>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                        <tr>
                            <th>Pajak (1%)</th>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                        <tr>
                            <th>SHU setelah pajak</th>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
