<!-- Modal -->
<div class="modal fade" id="modelIdedit" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
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
                <input type="hidden" name="id" id="id">
                <?= csrf_field(); ?>

                <div class="modal-body" id="isi">

                    <img src="" alt="" sizes="500px" srcset="" id="img" style="max-width: 100%;">

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Images Car</label></label>
                                <input type="file" class="form-control-file" name="file" id="file" multiple
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
                                <input type="text" class="form-control" name="title" id="title"
                                    aria-describedby="helpId" placeholder="">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Brand</label>
                                <select class="form-control" name="brand" id="brand" required>
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
                                    <textarea class="form-control" name="detail" id="detail" rows="3"
                                        required></textarea>
                                </div>
                            </div>
                        </div>
                        <label for="">More Detail</label>
                    </div>
                    <div id="education_fieldsedit"></div>

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


<?= $this->section('script') ;?>
<script>
$('#loading').hide(0);
var user;

function edit(edit) {
    var id = edit;
    deleteAllDetail();

    $('#loading').show(0);
    $('#isi').hide();
    $('.modal-title').html('Edit <?= $page ?>');
    $('form').attr('action', '<?= base_url() ?>/admin/<?= strtolower($page) ?>/edit');

    $.ajax({
        type: "GET",
        url: `${location.origin}/admin/<?=  strtolower($page) ?>/` + id,
        dataType: "JSON",
        success: function(data) {
            if (data.error == null) {
                $('#img').attr("src", '<?php echo base_url(); ?>' + '/media/upload/' + data.result.image);
                $('#title').val(data.result.title);
                $('#brand').val(data.result.brand_id);
                $('#detail').trumbowyg("html", data.result.detail);
                $('#status').val(data.result.status);
                $('#id').val(data.result.id);

                $.map(data.more_detail, function(value) {
                    addField(value.title, value.value, value.id)
                });

                changeIconAndColor()
            }
        }
    }).done(function() {
        setTimeout(function() {
            $("#loading").fadeOut(300);
            $('#isi').delay(300).show(1000);
        }, 500);
    });
};
var room = 1;

function addField(field, value, id) {
    room++;
    var objTo = document.getElementById('education_fieldsedit')
    var divtest = document.createElement("div");
    divtest.setAttribute("class", "form-group removeclassedit removeclass" + room);
    var rdiv = 'removeclass' + room;
    divtest.innerHTML = `<div class="row">
    <div class="col-sm-6 nopadding">
                            <input type="hidden" name="fieldID[]" value="${id}">
                            <div class="form-group">
                                <input type="text" class="form-control" id="field" name="field[]" value="${field}"
                                    placeholder="field name">
                            </div>
                        </div>
                        <div class="col-sm-6 nopadding">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="value" name="value[]" value="${value}"
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

    console.log(divtest)
}

function education_fields() {
    room++;
    var objTo = document.getElementById('education_fieldsedit')
    var divtest = document.createElement("div");
    divtest.setAttribute("class", "form-group removeclassedit removeclass" + room);
    var rdiv = 'removeclass' + room;
    divtest.innerHTML = `<div class="row">
    <div class="col-sm-6 nopadding">
                            <input type="hidden" name="fieldID[]" value="">
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

function deleteAllDetail() {
    $.map($(".removeclassedit"), function(value) {
        $(value).remove()
    });
}

function remove_education_fields(value) {
    $(value).parent().parent().parent().parent().parent().remove()
    changeIconAndColor()
}
</script>
<?= $this->endSection() ?>