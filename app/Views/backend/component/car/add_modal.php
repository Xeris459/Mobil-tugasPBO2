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
                <!-- default set for edit -->
                <?= csrf_field(); ?>

                <div class="modal-body" id="isi">

                    <img src="" alt="" sizes="500px" srcset="" style="max-width: 100%;">

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Images Car</label></label>
                                <input required type="file" class="form-control-file" name="file" multiple
                                    placeholder="" aria-describedby="fileHelpId">
                                <small id="fileHelpId" class="form-text text-muted">ukuran file tidak boleh leboh dari
                                    2MB dan
                                    memiliki format png/jpg/jpeg</small>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Car Name / Model</label>
                                <input type="text" class="form-control" name="title" aria-describedby="helpId"
                                    placeholder="">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Brand</label>
                                <select class="form-control" name="brand" required>
                                    <option value="" disabled selected>-- select one -- </option>
                                    <?php foreach ($brand as $item) : ?>
                                    <option value="<?= $item->id ?>"><?= $item->title ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="">Deskripsi Mobil</label>
                                    <textarea class="form-control" name="detail" rows="3" required></textarea>
                                </div>
                            </div>
                        </div>
                        <label for="">More Detail</label>
                        <div class="row">
                            <div class="col-sm-6 nopadding">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="field[]" value=""
                                        placeholder="field name">
                                </div>
                            </div>
                            <div class="col-sm-6 nopadding">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="value[]" value=""
                                            placeholder="value of the field">
                                        <div class="input-group-btn buttonGroup">
                                            <button class="btn btn-success" type="button" onclick="education_fields();">
                                                <span class="fas fa-plus" aria-hidden="true"></span> </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>
                    <div id="education_fields"></div>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Status</label>
                                <select class="form-control" name="status" required>
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


<?= $this->section('script') ;?>
<script>
$('#loading').hide(0);

//change back
$('.tambah').on('click', () => {
    $('#loading').hide(0);
    $('#isi').show(0);
    $('.modal-title').html('Tambah <?= $page ?>');
    $('#form').attr('action', '<?= base_url() ?>/admin/<?= strtolower($page) ?>');
});

var room = 1;

function education_fields() {
    room++;
    var objTo = document.getElementById('education_fields')
    var divtest = document.createElement("div");
    divtest.setAttribute("class", "form-group removeclass removeclass" + room);
    var rdiv = 'removeclass' + room;
    divtest.innerHTML = `<div class="row">
    <div class="col-sm-6 nopadding">
                            <div class="form-group">
                                <input type="text" class="form-control" id="field" name="field[]" value=""
                                    placeholder="field name">
                            </div>
                        </div>
                        <div class="col-sm-6 nopadding">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="value" name="value[]" value=""
                                        placeholder="value of the field">
                                    <div class="input-group-btn buttonGroup">
                                        <button class="btn btn-danger" type="button" onclick="education_fields();">
                                            <span class="fas fa-minus" aria-hidden="true"></span> </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>`;

    objTo.appendChild(divtest)
    changeIconAndColor()
}

function changeIconAndColor() {
    $.map($(".buttonGroup"), function(value, index) {
        if (index == $(".buttonGroup").length - 1) {
            console.log(value)
            $(value).children().addClass("btn-success")
            $(value).children().removeClass("btn-danger")
            $(value).children().children().removeClass("fa-minus")
            $(value).children().children().removeClass("fa-plus")
            $(value).children().children().addClass("fa-plus")
            if (!$(value).parent().parent().parent().parent().parent().hasClass("removeclass"))
                $(value).children().attr("onclick", `education_fields()`)

        } else {
            $(value).children().removeClass("btn-success")
            $(value).children().addClass("btn-danger")
            $(value).children().children().removeClass("fa-plus")
            $(value).children().children().addClass("fa-minus")
            $(value).children().attr("onclick", `remove_education_fields(this)`)
        }
    });
}

function remove_education_fields(value) {
    $(value).parent().parent().parent().parent().parent().remove()
    changeIconAndColor()
}
</script>
<?= $this->endSection() ?>