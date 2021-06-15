<html>
	<body>
		<div class="x_panel">
            <div class="x_title">
                <h3 class="panel-title"><b>Daftar Revaluasi</b></h3>
            </div>

            <div class="x_content">

                <div class="" role="tabpanel" data-example-id="togglable-tabs">

                    <!-- <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Daftar Penyusutan</a>
                        </li>
                        
                        <li role="presentation" class="">
                            <a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Kartu Penyusutan</a>
                        </li>
                    </ul> -->
                        
                    <div id="myTabContent" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                            <a href = "<?php echo site_url()."c_transaksi/form_penyusutan"?>" class="btn btn-info btn-sm" role="button"><span class="glyphicon glyphicon-plus"></span> Tambah Data</a>
                            <table id="datatable" class="table table-striped table-bordered table-hover jambo_table">
                                <thead>
                                    <tr class="headings">
                                        <th style="width: 2px;">No</th>
                                        <th>ID Revaluasi</th>
                                        <th>Bulan penyusutan</th>
                                        <th>Nilai penyusutan</th>
                                        <th>Nilai akumulasi penyusutan</th>
                                        <th>Nilai buku</th>
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
	</body>
</html>