<?= $this->extend('backend/layouts/content'); ?>

<?=  $this->section('content') ?>

<button type="button" class="btn tambah btn-primary mb-3" data-toggle="modal" data-target="#modelId">
    Tambah <?= $page ?>
</button>
<?= $this->include('backend/component/car/add_modal') ?>
<?= $this->include('backend/component/car/edit_modal') ?>

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
                        <th>Cars Name</th>
                        <th>Brand</th>
                        <th>status</th>
                        <th>Created </th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $item) : ?>
                    <tr>
                        <td><?= $item->title ?></td>
                        <td><?= $item->brand ?></td>
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
                                            data-toggle='modal' data-target='#modelIdedit' onclick='edit(this.id)'>
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