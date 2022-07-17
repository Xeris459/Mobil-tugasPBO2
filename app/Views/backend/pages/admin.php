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

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Full name</label>
                                <input type="text" class="form-control" name="name" id="name" aria-describedby="helpId"
                                    placeholder="">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" class="form-control" name="email" id="email" aria-describedby="helpId"
                            placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" class="form-control" name="password" aria-describedby="helpId"
                            placeholder="">
                        <small id="helpId" class="form-text text-muted">password must contain min 8 character and max 32
                            character</small>
                    </div>

                    <div class="form-group">
                        <label for="">Re-Password</label>
                        <input type="password" class="form-control" name="repassword" aria-describedby="helpId"
                            placeholder="">
                        <small id="helpId" class="form-text text-muted">password must contain min 8 character and max 32
                            character</small>
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
                        <th>user id</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Created </th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $item) : ?>
                    <tr>
                        <td><?= $item->id ?></td>
                        <td><?= $item->username ?></td>
                        <td><?= $item->email ?></td>
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
                                            onclick='deleteCurrentRow(this, <?= $item->id ?>)' data-type='Admin'>
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
    $('.modal-title').html('Tambah Admin');
    $('#form').attr('action', '<?= base_url() ?>/admin/<?= $page ?>/create');

    $('#name').val('');
    $('#email').val('');
    $('#id').val('');
});

var user;

function edit(edit) {
    var id = edit;

    $('#loading').show(0);
    $('#isi').hide();
    $('.modal-title').html('Edit <?= $page ?>');
    $('#form').attr('action', '<?= base_url() ?>/admin/<?= $page ?>/edit');

    $.ajax({
        type: "GET",
        url: `${location.origin}/admin/<?=  strtolower($page) ?>/` + id,
        dataType: "JSON",
        success: function(data) {
            if (data.error == null) {
                $('#name').val(data.result.username);
                user = data.result.username;
                $('#email').val(data.result.email);
                $('#id').val(data.result.id);
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