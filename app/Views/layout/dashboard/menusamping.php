<?php 
	$session = session();
	// dd(session()->get());

	if($session->get('logged_in')!=true){
		// dd("NO SESI");
		header("Location: /login"); /* Redirect browser */
		exit();
	}
	?>
    
<nav class="pcoded-navbar menu-light ">
    <div class="navbar-wrapper  ">
        <div class="navbar-content scroll-div " >
            
            <div class="">
                <div class="main-menu-header">
                    <img class="img-radius" src="assets/user.png" alt="User-Profile-Image">
                    <div class="user-details">
                        <div id="more-details"><?= $session->get('nama_user'); ?><i class="fa fa-caret-down"></i></div>
                    </div>
                </div>
                <div class="collapse" id="nav-user-link">
                    <ul class="list-inline">
                        <li class="list-inline-item"><a href="#" onclick="menu('Profil')" data-toggle="tooltip" title="View Profile"><i class="feather icon-user"></i></a></li>
                        <li class="list-inline-item"><a href="/logout" data-toggle="tooltip" title="Logout" class="text-danger"><i class="feather icon-power"></i></a></li>
                    </ul>
                </div>
            </div>
            
            <ul class="nav pcoded-inner-navbar " style="display:<?= ($session->get('status') == 'super') ? 'block' : 'none' ?>">
                <li class="nav-item pcoded-menu-caption">
                    <label>Kelola Menu</label>
                </li>

                <li class="nav-item">
                    <a class="nav-link " onclick="menu('Karyawan')"><span class="pcoded-micon"><i class="fa fa-users"></i></span><span class="pcoded-mtext">Karyawan</span></a>
                </li>
                
            </ul>

            <ul class="nav pcoded-inner-navbar " style="display:<?= ($session->get('status') == 'super') ? 'none' : 'block' ?>">
                <li class="nav-item pcoded-menu-caption">
                    <label>Menu <?= $session->get('status')?></label>
                </li>

                <li class="nav-item">
                    <a class="nav-link " onclick="menu('Profil')"><span class="pcoded-micon"><i class="fa fa-user"></i></span><span class="pcoded-mtext">Profil</span></a>
                </li>
                
            </ul>
            
            
        </div>
    </div>
</nav>