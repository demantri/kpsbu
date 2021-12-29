
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V15</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="<?= base_url('assets/t_absen')?>/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/t_absen')?>/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/t_absen')?>/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/t_absen')?>/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/t_absen')?>/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/t_absen')?>/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/t_absen')?>/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/t_absen')?>/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/t_absen')?>/css/util.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/t_absen')?>/css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
        
		<div class="container-login100">
            
			<div class="wrap-login100">
				<div class="login100-form-title" style="background-image: url(images/bg-01.jpg);">
					<span class="login100-form-title-1">
						Presensi Kehadiran
					</span>
				</div>

				<form class="login100-form validate-form" style="padding: 50px !important;" action="" id="form-absen">
                    <div class="btnLogin" style="margin-bottom: 40px;">
                        <a href="<?= base_url('c_login/home')?>" class="btn btn-light">
                            Halaman Login
                        </a>
                    </div>
                    <hr>
                    <div class="col-lg-12" id="notif-row">
                        <?php $this->form_validation->set_error_delimiters('<div class="alert alert-danger">','</div>')?>
                        <?php echo validation_errors();?>
                        <?php echo $this->session->flashdata('notif'); ?>
                    </div>

					<div class="wrap-input100 validate-input m-b-26">
                        <input class="input100" type="text" name="username" placeholder="Enter RFID Number" autofocus>
					</div>
                    
				</form>
			</div>
		</div>
	</div>
	
<!--===============================================================================================-->
	<script src="<?= base_url('assets/t_absen')?>/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="<?= base_url('assets/t_absen')?>/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="<?= base_url('assets/t_absen')?>/vendor/bootstrap/js/popper.js"></script>
	<script src="<?= base_url('assets/t_absen')?>/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="<?= base_url('assets/t_absen')?>/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="<?= base_url('assets/t_absen')?>/vendor/daterangepicker/moment.min.js"></script>
	<script src="<?= base_url('assets/t_absen')?>/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="<?= base_url('assets/t_absen')?>/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="<?= base_url('assets/t_absen')?>/js/main.js"></script>
    <script src="<?= base_url('assets/format.js')?>"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#form-absen").submit(function(e){
                e.preventDefault();
                var rfid = $("#rfid").val();
                // console.log(rfid)
                $.ajax({
                    url:"<?= base_url('Absensi/save/')?>"+rfid,
                    success:function(response){
                        data = JSON.parse(response);
                        console.log(custom_notification('success','Berhasil Absen'));
                        // console.log(data)
                        if(data.status){
                            custom_notification('success',data.info);
                            $("#rfid").val('');
                            $("#rfid").focus();
                        }else{
                            custom_notification('danger',data.info);
                            $("#rfid").val('');
                            $("#rfid").focus();
                        }
                    }
                });
            });
        })
    </script>
</body>
</html>