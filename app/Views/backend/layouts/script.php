<!-- Bootstrap core JavaScript-->
<script src="<?= base_url() ?>/vendor/jquery/jquery.min.js"></script>

<script src="<?= base_url() ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url() ?>/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url() ?>/js/sb-admin-2.min.js"></script>

<script src="<?= base_url() ?>/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>/vendor/chart.js/Chart.bundle.min.js"></script>

<!-- sweet alert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<!-- custom JS -->
<script src="<?= base_url('/js/trumbowyg/dist/trumbowyg.min.js') ?>"> </script>

<script src="<?= base_url('/js/trumbowyg/dist/plugins/upload/trumbowyg.upload.js') ?>"></script>
<script src="<?= base_url('/js/trumbowyg/dist/plugins/pasteembed/trumbowyg.pasteembed.min.js') ?>"></script>
<script src="<?= base_url('/js/trumbowyg/dist/plugins/pasteimage/trumbowyg.pasteimage.min.js') ?>"></script>
<script src="<?= base_url('/js/trumbowyg/dist/plugins/lainnya/trumbowyg.lainnya.js') ?>"></script>

<script>
//textarea
$('textarea').trumbowyg();

$('#dataTable').DataTable();

$(document).ready(function() {
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function() {
            $(this).remove();
        });
    }, 4000);
});

let deleteCurrentRow = (elem, id) => {
    const Loc = window.location.pathname.split('/')[2] || window.location.pathname.split('/')[1]
    const type = $(elem).data('type');
    const message = `Are you sure you want to delete this ${type}?`

    Swal.fire({
        title: `${message}`,
        text: "You will not be able to restore it once it has been deleted!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'I know, delete it!',
        cancelButtonText: "don't delete"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "DELETE",
                url: `${location.origin}/admin/${Loc.toLowerCase()}/${id}`,
                dataType: "JSON",
                success: function(res) {
                    if (res.error == null) {
                        Swal.fire({
                            icon: 'success',
                            title: `${type} deleted successfully`,
                            showConfirmButton: false,
                            timer: 1500
                        })

                        location.reload()
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: res.messages.error,
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                },
                error: function(data) {
                    var text = '';
                    $.map(data.responseJSON.messages, function(val) {
                        text +=
                            `<div class="card"><div class="card-body">${val}</div></div><br>`;
                    });


                    Swal.fire({
                        icon: 'error',
                        title: 'ops..',
                        html: text,
                        showConfirmButton: false,
                        timer: 8000
                    })
                },
                complete: function(data) {
                    if (data.status == 500) {
                        console.log(data)
                        Swal.fire({
                            icon: 'error',
                            title: 'server time out: <br>' + data.responseJSON
                                .message,
                            showConfirmButton: false,
                            timer: 8000
                        })
                    }
                },
                beforeSend: function() {
                    Swal.fire({
                        title: 'Please Wait !',
                        html: 'trying saving data',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        willOpen: () => {
                            Swal.showLoading()
                        },
                    });
                }
            });
        }
    });
}
</script>

<?= $this->renderSection('script') ;?>