<!DOCTYPE html>
<html lang="en">
<head>
	<?php 
	$session = session();
	// dd(session()->get());

	if($session->get('logged_in')!=true){
		// dd("NO SESI");
		header("Location: /login"); /* Redirect browser */
		exit();
	}
	?>
    <title>JUDUL</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="PKU CAFE APPS" />
    <meta name="keywords" content="Zeei Developer">
    <meta name="author" content="Zeei Developer" />
    <!-- Favicon icon -->
    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
	<!-- data tables css -->
	<link rel="stylesheet" href="assets/css/plugins/dataTables.bootstrap4.min.css">
    <!-- vendor css -->
    <link rel="stylesheet" href="assets/css/style.css">
	
    <link rel="stylesheet" href="assets/font-awesome.min.css"/>
    <script src="assets/sweetalert.min.js" ></script>
	<!-- select2 css -->
    <link rel="stylesheet" href="assets/css/plugins/select2.min.css">

	<!-- TOASTR -->
	<link rel="stylesheet" href="assets/toastr/toastr.min.css">

    
	<style>
		body {
			font-family: "Open Sans", sans-serif;
			font-size: 14px;
			color: #373a3c;
			font-weight: 400;
			background: #6394ff;
			position: relative;
		}
	</style>

</head>
<body class="">
	<input type="hidden" id="<?= csrf_token() ?>" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
	<!-- [ Pre-loader ] start -->
	<div class="loader-bg">
		<div class="loader-track">
			<div class="loader-fill"></div>
		</div>
	</div>
	<!-- [ Pre-loader ] End -->
	<!-- [ navigation menu ] start -->
        <?= $this->include('layout/dashboard/menusamping') ?>
	
	<!-- [ navigation menu ] end -->
	<!-- [ Header ] start -->
	<header class="navbar pcoded-header navbar-expand-lg navbar-light header-blue">
		
			
				<div class="m-header">
					<a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
					<a href="#!" class="b-brand">
						<!-- ========   change your logo hear   ============ -->
						<!-- <img src="assets/11sibanter_putih_l.png" alt="LOGO" class="logo" style="height: 35px;margin-left: -25px;"> -->
						<h4 style="padding-top: 5px;text-align: center;">JUNDI TEST</h4>
					</a>
					<a href="#!" class="mob-toggler">
						<i class="feather icon-more-vertical"></i>
					</a>
				</div>
				<div class="collapse navbar-collapse">
					<ul class="navbar-nav mr-auto">
						<li class="nav-item">
							<a href="#!" class="pop-search"><i class="feather icon-search"></i></a>
							<div class="search-bar">
								<input type="text" class="form-control border-0 shadow-none" placeholder="Search hear">
								<button type="button" class="close" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
						</li>
					</ul>
					<ul class="navbar-nav ml-auto">
						
						<li>
							<div class="dropdown drp-user">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<i class="feather icon-user"></i>
								</a>
								<div class="dropdown-menu dropdown-menu-right profile-notification">
									<div class="pro-head">
										<img src="assets/images/user/avatar-1.jpg" class="img-radius" alt="User-Profile-Image">
										<span><?= $session->get('nama_user'); ?></span>
										<a href="/logout" class="dud-logout" title="Logout">
											<i class="feather icon-log-out"></i>
										</a>
									</div>
									<ul class="pro-body">
										<li><a href="#" onclick="menu('Profil')" class="dropdown-item"><i class="feather icon-user"></i> Profile</a></li>
										<!-- <li><a href="email_inbox.html" class="dropdown-item"><i class="feather icon-mail"></i> My Messages</a></li> -->
										<li><a href="/logout" class="dropdown-item"><i class="feather icon-power"></i> Keluar</a></li>
									</ul>
								</div>
							</div>
						</li>
					</ul>
				</div>
				
			
	</header>
	<!-- [ Header ] end -->
	
	

<!-- [ Main Content ] start -->
<section class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header" style="margin-top: -165px!important;">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <!-- <div class="page-header-title">
                            <h5 class="m-b-10">Form Validation</h5>
                        </div> -->
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#" onclick="isadmin()"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item" ><a href="#!" id="item_b1">Dashboard Analytics</a></li>
                            <li class="breadcrumb-item" ><a href="#!" id="item_b2"></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div id="loading_konten"></div>
        <div id="konten">
			<?= $this->renderSection('konten') ?>
        </div>
        
        <!-- [ Main Content ] end -->
    </div>
</section>
<!-- [ Main Content ] end -->

    <!-- Required Js -->
    <script src="assets/js/vendor-all.min.js"></script>
    <script src="assets/js/plugins/bootstrap.min.js"></script>
    <script src="assets/js/ripple.js"></script>
    <script src="assets/js/pcoded.min.js"></script>
	<!-- <script src="assets/js/menu-setting.min.js"></script> -->

	<!-- jquery-validation Js -->
	<script src="assets/js/plugins/jquery.validate.min.js"></script>
	<!-- form-picker-custom Js -->
	<script src="assets/js/pages/form-validation.js"></script>
	<!-- notification Js -->
	<script src="assets/js/plugins/bootstrap-notify.min.js"></script>
	<script src="assets/js/pages/ac-notification.js"></script>
	<!-- sweet alert Js -->
	<script src="assets/js/plugins/sweetalert.min.js"></script>
	<script src="assets/js/pages/ac-alert.js"></script>

	<!-- Apex Chart -->
	<!-- <script src="assets/js/plugins/apexcharts.min.js"></script> -->
	<!-- custom-chart js -->
	<!-- <script src="assets/js/pages/dashboard-main.js"></script> -->

	<script src="assets/Chart.min.js"></script>
	<script src="assets/chartjs-plugin-datalabels@0.7.0"></script>

	<!-- select2 Js -->
	<script src="assets/js/plugins/select2.full.min.js"></script>
	<!-- TOASTR -->
	<script src="assets/toastr/toastr.min.js"></script>

<script>
	function menu(menu) {
	    $(".pcoded-navbar").removeClass("mob-open")
	    
		$('#notifnya').remove(); 
		var kunciku = $("#kunciku").val()
        $.ajax({
            type: "post",
            url: "api/menu",
            data: "menu="+menu+"&kunciku="+kunciku,
            beforeSend: function() {
                // setting a timeout
				$("#konten").html('')
                $('#loading_konten').html('<i class="fas fa-spinner fa-spin"></i> Sedang Memuat Konten ...');
            },
            success: function (hasil) {
				$(".pcoded-navbar").removeClass("mob-open")
                $('#loading_konten').html('')
                $("#item_b1").text(menu)
                $("#item_b2").text('')
                $("#konten").html(hasil)
                
            },
			error: function(xhr) { // if error occured
				alert("status : \n"+xhr.statusText +"\n\n Response: \n\n"+ xhr.responseText);
				// $(placeholder).append(xhr.statusText + xhr.responseText);
				// $(placeholder).removeClass('loading');
			},
        });
    }

    function fmenu(menu,id=false) {
        
		$('#notifnya').remove(); 
		if (id!=false) {
			var data = "menu="+menu+"&id="+id
		}else{
			var data = "menu="+menu
		}

		var kunciku = $("#kunciku").val()

        $.ajax({
            type: "post",
            url: "api/menu",
            data: data+"&kunciku="+kunciku,
            beforeSend: function() {
                // setting a timeout
                $('#loading_konten').html('<i class="fas fa-spinner fa-spin"></i> Sedang Memuat Konten ...');
            },
            success: function (hasil) {
                $('#loading_konten').html('')
                $("#item_b2").text(menu)
                $("#konten").html(hasil)
                
            },
			error: function(xhr) { // if error occured
				alert("status : \n"+xhr.statusText +"\n\n Response: \n\n"+ xhr.responseText);
				// $(placeholder).append(xhr.statusText + xhr.responseText);
				// $(placeholder).removeClass('loading');
			},
        });
    }
</script>

</body>
</html>
