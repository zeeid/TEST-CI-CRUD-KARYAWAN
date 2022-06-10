<!DOCTYPE html>
<html lang="en">
<head>

	<title><?= $tittle ?></title>
	<!-- Meta -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="description" content="" />
	<meta name="keywords" content="">
	<meta name="author" content="Phoenixcoded" />
	<!-- Favicon icon -->
	<link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">

	<!-- vendor css -->
	<link rel="stylesheet" href="assets/css/style.css">
	
	<!-- TOASTR -->
	<link rel="stylesheet" href="assets/toastr/toastr.min.css">
    	<!-- sweet alert Js -->
	<script src="assets/js/plugins/sweetalert.min.js"></script>
	<script src="assets/js/pages/ac-alert.js"></script>


</head>

<!-- [ auth-signin ] start -->
<div class="auth-wrapper">
	<div class="auth-content">
		<div class="card">
			<div class="row align-items-center text-center">
                <div class="col-md-12">
                    <form id="form_login">
                        <input type="hidden" id="<?= csrf_token() ?>" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
                        <div class="card-body">
                            <!-- <img src="assets/images/logo-dark.png" alt="" class="img-fluid mb-4"> -->
                            <h4 class="mb-3 f-w-400">Login</h4>
                            <div class="form-group mb-3">
                                <label class="floating-label" for="Email">Email address</label>
                                <input type="text" class="form-control" name="email" id="Email" placeholder="">
                            </div>
                            <div class="form-group mb-4">
                                <label class="floating-label" for="Password">Password</label>
                                <input type="password" class="form-control" name="sandi" id="Password" placeholder="">
                            </div>
                            <div class="custom-control custom-checkbox text-left mb-4 mt-2" style="display: none;">
                                <input type="checkbox" class="custom-control-input" id="customCheck1">
                                <label class="custom-control-label" for="customCheck1">Save credentials.</label>
                            </div>
                            <button type="submit" class="btn btn-block btn-primary mb-4">Login</button>
                            <p class="mb-2 text-muted">Forgot password? <a href="/lupa-sandi" class="f-w-400">Reset</a></p>
                            <p class="mb-0 text-muted">Don’t have an account? <a href="/register" class="f-w-400">Register</a></p>
                        </div>
                    </form>

                    <div id="debug">

                    </div>
                </div>
			</div>
		</div>
	</div>
</div>
<!-- [ auth-signin ] end -->

<!-- Required Js -->
<script src="assets/js/vendor-all.min.js"></script>
<script src="assets/js/plugins/bootstrap.min.js"></script>
<script src="assets/js/ripple.js"></script>
<script src="assets/js/pcoded.min.js"></script>
<!-- TOASTR -->
<script src="assets/toastr/toastr.min.js"></script>

<script>
    $("#form_login").submit(function (e) { 
        e.preventDefault();
        var data = $("#form_login").serialize()
        $.ajax({
            type: "POST",
            url: "api/auth/login",
            data: data,
            beforeSend: function() {
                toastr["info"]("Mohon Tunggu..", "Loading")
                toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "30011111",
                "hideDuration": "100011111",
                "timeOut": "500011111",
                "extendedTimeOut": "100011111",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
                }
            },
            success: function (hasil) {
                // $("#debug").html(hasil)
                // Remove current toasts using animation
                toastr.remove()
                toastr.clear()

                const obj   = JSON.parse(hasil);
                var status  = obj.status
                var pesan   = obj.Pesan

                if (status ==200) {
                    toastr["success"]("Mogon Tunggu..", "Berhasil Login")
                    window.setTimeout(function () {
                        window.location.href = "/dashboard";
                    }, 1800);
                    
                }else{
                    toastr["error"](pesan, "Gagal Login")
                }          
            },
            error: function(xhr) { // if error occured
                alert("statusText : \n"+xhr.statusText+"\n\n responseText: \n"+xhr.responseText);
                // $(placeholder).append(xhr.statusText + xhr.responseText);
                // $(placeholder).removeClass('loading');
            },
        });
    });
</script>

</body>

</html>
