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
                <form id="form_karyawan" >
                    <input type="hidden" id="<?= csrf_token() ?>" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
                    <div class="row">
                        
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
                        
                        <div class="col-12">
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Gaji</label>
                                <div class="col-sm-10">
                                    <input required type="number" placeholder="Contoh: 15000 [Hanya Angka]" id="gaji" class="form-control readonlyc" name="gaji" value="<?php if(isset($listkaryawan['gaji'])){echo $listkaryawan['gaji'];} ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Status Karyawan </label>
                                <div class="col-sm-10">
                                    <select required name="status_karyawan" id="status_karyawan" class="form-control">
                                        <option value="" selected disabled>--Pilih salah satu--</option>
                                        <option <?php if(isset($listkaryawan['status_karyawan'])){if($listkaryawan['status_karyawan']=='1'){echo "selected";}} ?> value="1" >Aktif</option>
                                        <option <?php if(isset($listkaryawan['status_karyawan'])){if($listkaryawan['status_karyawan']=='0'){echo "selected";}} ?> value="0" >Tdak Aktif</option>
                                    </select>
                                </div>
                            </div>
                        </div>                        
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm rounded"><?php if(isset($listkaryawan['id'])){echo 'Update';}else{echo 'Simpan';} ?></button>
                    <button type="button" class="btn btn-info btn-sm rounded" onclick="menu('Karyawan')"> Kembali</button>
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
        var data = $("#form_karyawan").serialize();
        $.ajax({
            type: "POST",
            url: "api/karyawan/simpan",
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
                            menu('Karyawan')
                        } 
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