<?= $this->extend('backend/layouts/content'); ?>

<?=  $this->section('content') ?>

<button type="button" class="btn tambah btn-primary mb-3" data-toggle="modal" data-target="#modelId">
    Tambah <?= $page ?>
</button>

<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    Tambah <?= $page ?>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="" id="form" enctype="multipart/form-data">
                <div class='modal-body' id="loading">
                    <div class="lds-dual-ring"></div>
                </div>
                <!-- default set for edit -->
                <input type="hidden" name="id" id="id">
                <?= csrf_field(); ?>

                <!-- end ganti password -->
                <div class="modal-body" id="isi">

                    <img src="" alt="" sizes="500px" srcset="" id="img" style="max-width: 100%;">

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Thumbnail Banner</label></label>
                                <input required type="file" class="form-control-file" name="file" id="file"
                                    placeholder="" aria-describedby="fileHelpId">
                                <small id="fileHelpId" class="form-text text-muted">ukuran file tidak boleh leboh dari
                                    2MB dan
                                    memiliki format png/jpg/jpeg</small>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Brand Name</label>
                                <input type="text" class="form-control" name="title" id="title"
                                    aria-describedby="helpId" placeholder="">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Detail</label>
                                <textarea class="form-control" name="detail" id="detail" rows="3" required></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Status</label>
                                <select class="form-control" name="status" id="status" required>
                                    <option value="" disabled>-- select one -- </option>
                                    <option value="publish">publish</option>
                                    <option value="unpublish">unpublish</option>
                                </select>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="submit" value="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- tabel -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Manage <?= $page ?></h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Brand Id</th>
                        <th>Image</th>
                        <th>Brand Name</th>
                        <th>Detail</th>
                        <th>Status </th>
                        <th>Created </th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $item) : ?>
                    <tr>
                        <td><?= $item->id ?></td>
                        <td>
                            <img src="<?= base_url() . '/media/upload/' . $item->image ?>"
                                class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}"
                                alt="">
                        </td>
                        <td><?= $item->title ?></td>
                        <td><?= $item->detail ?></td>
                        <td><?= $item->status ?></td>
                        <td><?= $item->created_at ?></td>
                        <td>
                            <div class='input-group'>
                                <span class='input-group-btn'>
                                    <button type='button' class='btn btn-secondary dropdown-toggle' aria-label=''
                                        data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                        Action
                                    </button>
                                    <div class='dropdown-menu'>
                                        <button class='dropdown-item edit' href='#' id='<?= $item->id ?>'
                                            data-toggle='modal' data-target='#modelId' onclick='edit(this.id)'>
                                            <span class='fas fa-edit'>
                                            </span>
                                            Edit
                                        </button>
                                        <div role='separator' class='dropdown-divider'></div>
                                        <button class='dropdown-item delete'
                                            onclick='deleteCurrentRow(this, <?= $item->id ?>)' data-type='Brand'>
                                            <span class='fa fa-trash'>
                                            </span>
                                            Hapus
                                        </button>
                                    </div>
                                </span>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('script') ;?>
<script>
$('#loading').hide(0);

//change back
$('.tambah').on('click', () => {
    $('#loading').hide(0);
    $('#isi').show(0);
    $('.modal-title').html('Tambah <?= $page ?>');
    $('#form').attr('action', '<?= base_url() ?>/admin/<?= strtolower($page) ?>');

    $('#title ').val('');
    $('#detail ').val('');
    $('#status').val('');
    $('#file').val('');
    $('#id').val('');
    $('#file').prop('required', true);
});

var user;

function edit(edit) {
    var id = edit;

    $('#loading').show(0);
    $('#isi').hide();
    $('.modal-title').html('Edit <?= $page ?>');
    $('#form').attr('action', '<?= base_url() ?>/admin/<?= strtolower($page) ?>/edit');

    $.ajax({
        type: "GET",
        url: `${location.origin}/admin/<?=  strtolower($page) ?>/` + id,
        dataType: "JSON",
        success: function(data) {
            if (data.error == null) {
                $('#img').attr("src", '<?php echo base_url(); ?>' + '/media/upload/' + data.result.image);
                $('#status').val(data.result.status);
                $('#title').val(data.result.title);
                $('#detail').val(data.result.detail);
                $('#id').val(data.result.id);
                $('#file').prop('required', false);
            }
        }
    }).done(function() {
        setTimeout(function() {
            $("#loading").fadeOut(300);
            $('#isi').delay(300).show(1000);
        }, 500);
    });
};
</script>
<?= $this->endSection() ?>