<div class="row" style="margin-top: -25px!important;">
    <!-- [ Form Validation ] start -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5><?= $judul ?></h5>
            </div>
            <div class="card-body" style="padding-bottom: 10px;padding-top: 5px;">
                <button type="button" class="btn btn-primary btn-sm rounded" onclick="fmenu('Tambah Karyawan')"> <i class="fa fa-plus-square-o" aria-hidden="true"></i> Tambah <?= $judul ?></button>
            </div>
            
            <div class="row">
                <div class="col-sm-12">
                    <div class="cardx">
                        <div class="card-body" style="padding-top: 0px;">
                            <div class="dt-responsive table-responsive listkaryawannya">
                                <table id="table-style-hover" data-show-export="true"  class="table table-striped table-hover table-bordered nowrap">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>Nama</th>
                                            <th>Tanggal Lahir</th>
                                            <th>Gaji</th>
                                            <th>Status Karyawan</th>
                                            <th>AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                    
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- END CARD -->
                </div>
                <!--  -->
            </div>
        </div>
    </div>
    <!-- [ Form Validation ] end -->
</div>

<div id="debug"></div>

<!-- datatable Js -->
<script src="assets/js/plugins/jquery.dataTables.min.js"></script>
<script src="assets/js/plugins/dataTables.bootstrap4.min.js"></script>
<script src="assets/js/pages/data-styling-custom.js"></script>

<script>
    

    var kunciku = $("#kunciku").val()

    function getkaryawan() {
        $.ajax({
            type: "POST",
            url: "api/karyawan/listkaryawan",
            data: "kunciku="+kunciku,
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

                $(".listkaryawannya").html(hasil)
                
                // $('#table-style-hover').DataTable({
                //     dom: 'Bfrtip',
                //     buttons: [
                //         'copy', 'csv', 'excel', 'pdf', 'print'
                //     ]
                // });
            },
            error: function(xhr) { // if error occured
                // $("#debug").html(xhr)
                // alert("statusText : \n"+xhr.statusText+"\n\n responseText: \n"+xhr.responseText);
                // $(placeholder).append(xhr.statusText + xhr.responseText);
                // $(placeholder).removeClass('loading');
            },
        });
    }


    $(document).ready(function () {
        getkaryawan()
    });
    
    function hapus_karyawan(id) {

        swal({
            title: "Apakah Anda Yakin?",
            text: "Data tidak dapat dikembalikan jika berhasil hapus !",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "POST",
                    url: "api/karyawan/hapuskaryawan",
                    data: "kunciku="+kunciku+"&id="+id,
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
                        // menu('Karyawan')
                        getkaryawan()
                    },
                    error: function(xhr) { // if error occured
                        // $("#debug").html(xhr)
                        alert("statusText : \n"+xhr.statusText+"\n\n responseText: \n"+xhr.responseText);
                    },
                });
            } 
        });

    }
</script>