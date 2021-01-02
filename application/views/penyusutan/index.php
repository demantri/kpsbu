<html>
	<body>
		<div class="x_panel">
 <div class="x_title">
    <h3 class="panel-title"><b>Daftar Peyusutan Aset</b></h3>
  </div>
  	 <div class="x_content">
	   <div class="" role="tabpanel" data-example-id="togglable-tabs">

			<ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
				<li role="presentation" class="active">
					<a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Daftar Penyusutan</a>
				</li>
				
				<li role="presentation" class="">
					<a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Kartu Penyusutan</a>
				</li>
			</ul>
			
			<div id="myTabContent" class="tab-content">
				<div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
					<?php $this->load->view("penyusutan/daftar_penyusutan") ?>
				</div>
				
				<div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
					<!-- <p>Ini kartu penyusutan </p> -->
				</div>
			</div>
		</div>
	</body>
</html>