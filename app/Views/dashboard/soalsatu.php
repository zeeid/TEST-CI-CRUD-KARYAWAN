<style>
    .huruf_besar {
        text-transform: capitalize;
    }
</style>

<div class="row" style="margin-top: -25px!important;">
    <!-- [ Form Validation ] start -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5><?= $judul ?></h5>
            </div>
            <div class="card-body">
                <form id="form_satu" >
                    <input type="hidden" id="<?= csrf_token() ?>" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
                    <div class="row">
                        
                        <div class="col-12">
                            <label style="font-weight:bolder">ORANG A</label>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-2 col-form-label">USIA Kematian</label>
                                <div class="col-sm-10">
                                    <input required type="text" id="usia_a" placeholder="10" class="form-control" name="usia_a" value="<?php if(isset($listkaryawan['usia_a'])){echo $listkaryawan['usia_a'];} ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-2 col-form-label">TAHUN Kematian</label>
                                <div class="col-sm-10">
                                    <input required type="text" id="tahun_a" placeholder="12" class="form-control" name="tahun_a" value="<?php if(isset($listkaryawan['tahun_a'])){echo $listkaryawan['tahun_a'];} ?>">
                                </div>
                            </div>
                        </div>         
                        <br>             
                        <div class="col-12">
                            <label style="font-weight:bolder">ORANG B</label>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-2 col-form-label">USIA Kematian</label>
                                <div class="col-sm-10">
                                    <input required type="text" placeholder="13" id="usia_b" class="form-control" name="usia_b" value="<?php if(isset($listkaryawan['usia_b'])){echo $listkaryawan['usia_b'];} ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-2 col-form-label">TAHUN Kematian</label>
                                <div class="col-sm-10">
                                    <input required type="text" id="tahun_b" placeholder="17" class="form-control" name="tahun_b" value="<?php if(isset($listkaryawan['tahun_b'])){echo $listkaryawan['tahun_b'];} ?>">
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
    $("#form_satu").submit(function (e) { 
        e.preventDefault();
        var data = $("#form_satu").serialize()

        $.ajax({
            type: "POST",
            url: "api/koltiva/satu",
            data: data,
            beforeSend: function() {
                // toastr["info"]("Mohon Tunggu..", "Loading")
                // toastr.options = {
                // "closeButton": true,
                // "debug": false,
                // "newestOnTop": false,
                // "progressBar": true,
                // "positionClass": "toast-top-right",
                // "preventDuplicates": false,
                // "onclick": null,
                // "showDuration": "30011111",
                // "hideDuration": "100011111",
                // "timeOut": "500011111",
                // "extendedTimeOut": "100011111",
                // "showEasing": "swing",
                // "hideEasing": "linear",
                // "showMethod": "fadeIn",
                // "hideMethod": "fadeOut"
                // }
            },
            success: function (hasil) {
                $("#debug").html(hasil)
            }
        });
    });
</script>