<style>
    .huruf_besar {
        text-transform: capitalize;
    }
</style>

<?php 
    // dd($listkaryawan);
?>

<div class="row" style="margin-top: -25px!important;">
    <!-- [ Form Validation ] start -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Form <?= $judul ?></h5>
            </div>
            <div class="card-body">
                <div class="text-center">
                    <img src="upload/<?php if(isset($listkaryawan['fotonya'])){echo $listkaryawan['fotonya'];}else{echo "default.png";} ?>" class="rounded" style="width: 200px;height:200px;">
                </div>
                <form id="form_karyawan" >
                    <input type="hidden" id="<?= csrf_token() ?>" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
                    <div class="row">
                        
                        <div class="col-12">
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input required type="email" id="email" class="form-control" name="email" value="<?php if(isset($listkaryawan['email'])){echo $listkaryawan['email'];} ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-10">
                                    <input required type="password" id="password" class="form-control" name="password" value="<?php if(isset($listkaryawan['password'])){echo $listkaryawan['password'];} ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Foto</label>
                                <div class="col-sm-10">
                                    <input type="hidden" name="foto_old" value="<?php if(isset($listkaryawan['fotonya'])){echo $listkaryawan['fotonya'];} ?>">
                                    <input type="file" id="fotonya" class="form-control" name="fotonya" value="<?php if(isset($listkaryawan['fotonya'])){echo $listkaryawan['fotonya'];} ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Nama Karyawan</label>
                                <div class="col-sm-10">
                                    <input required type="text" id="nama" class="form-control readonlyc huruf_besar" name="nama" value="<?php if(isset($listkaryawan['nama'])){echo $listkaryawan['nama'];} ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                                <div class="col-sm-10">
                                    <input required type="date" id="tanggal_lahir" class="form-control readonlyc" name="tanggal_lahir" value="<?php if(isset($listkaryawan['tanggal_lahir'])){echo $listkaryawan['tanggal_lahir'];} ?>">
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-12" style="display: none;">
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Gaji</label>
                                <div class="col-sm-10">
                                    <input readonly type="number" placeholder="Contoh: 15000 [Hanya Angka]" id="gaji" class="form-control readonlyc" name="gaji" value="<?php if(isset($listkaryawan['gaji'])){echo $listkaryawan['gaji'];} ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-12" style="display: none;">
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Status Karyawan </label>
                                <div class="col-sm-10">
                                    <input readonly type="hidden" id="status_karyawanx" class="form-control readonlyc" name="status_karyawan" value="<?php if(isset($listkaryawan['status_karyawan'])){echo $listkaryawan['status_karyawan'];} ?>">
                                </div>
                            </div>
                        </div>                        
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm rounded"><?php if(isset($listkaryawan['id'])){echo 'Update';}else{echo 'Simpan';} ?></button>
                    
                    <input type="hidden" readonly name="mode" value="<?php if(isset($listkaryawan['id'])){echo 'update';}else{echo 'simpan';} ?>">
                    <input type="hidden" readonly name="id" value="<?php if(isset($listkaryawan['id'])){echo $listkaryawan['id'];}else{echo '';} ?>">
                    <input type="hidden" id="is_new" name="is_new" value="" readonly>

                </form>
            </div>
        </div>
        <div id="debug"></div>
    </div>
    <!-- [ Form Validation ] end -->
</div>
<!-- notification Js -->
<script src="assets/js/plugins/bootstrap-notify.min.js"></script>
<script src="assets/js/pages/ac-notification.js"></script>

<script>
    $(document).ready(function () {
        $("#status_karyawan").select2();
    });

    $("#form_karyawan").submit(function (e) { 
        e.preventDefault();
        // var data = $("#form_karyawan").serialize();

        var formData = new FormData($('#form_karyawan')[0]);

        $.ajax({
            type: "POST",
            url: "api/karyawan/simpan",
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
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
                const obj   = JSON.parse(hasil);
                var status  = obj.status
                var pesan   = obj.pesan

                if (status ==200) {
                    swal({
                        title: "Sukses",
                        text: pesan,
                        icon: "success",
                        buttons: [false,'OKE'],
                        dangerMode: false,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            menu('Profil')
                        } 
                    });
                }
                else{
                    swal({
                        title: "GAGAL",
                        text: pesan,
                        icon: "error",
                        button: "OKE",
                    });
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