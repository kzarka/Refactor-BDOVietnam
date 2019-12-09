"use strict"

var validator = null;
var form = null;
var lastInputTime = new Date();
const TIME_TILL_SAVE = 300000; // 5min
const TIME_RE_CHECK = 10000; // 10s
var intervalSave = null;

$(document).ready(function() {
    initFormSave();
    CKEDITOR.replace('content');
    $('select[name=game]').select2({
        theme: 'bootstrap'
    });

    $('select[name="category[]"]').select2({
        theme: 'bootstrap'
    }).val(selected_categories).trigger('change');

    $('button.save').on('click', function(e) {
        e.preventDefault();
        $('form.validate').submit();
    });

    $('button.preview').on('click', function(e) {
        e.preventDefault();
        $('form.preview').find('[name=content]').val(CKEDITOR.instances.content.getData());
        $('form.preview').find('[name=title]').val($('form.validate').find('[name=title]').val())
        $('form.preview').submit();
    });
    
    $('form.validate').validate({
        rules: {
            images: {
                extension: "jpg|jpeg|png|gif|JPG|JPEG|PNG|GIF",
                maxsize: 2097152
            }
        }
    });

    $("input[name=tags]").tagsinput({
        splitOn: ',',
        cancelConfirmKeysOnEmpty: false
    });

    $('[data-toggle="tooltip"]').tooltip();

    initSlug();
    initToggleState();
    initAutoSave();
    initSelectImage();
    initSelectFormCategory();
});

function initSlug() {
    $('form.validate').on('keyup', 'input[name=title]', function() {
        $('form.validate').find('input[name=slug]').val(slugGenerate($(this).val()));
    });
}

function initToggleState() {
    $('form.validate input.public').on('click', function () {
        if($(this).prop('checked')) {
            $(this).val(1);
        } else {
            $(this).val(0);
        }
    });
}

function triggerSave() {
    $('form.validate').submit();
}

function initFormSave() {
    form = $('form.validate').validate({
        submitHandler: function(form, event) {
            event.preventDefault();
            var formData = new FormData(form);
            formData.append('content', CKEDITOR.instances.content.getData());
            $.ajax({
                url: $(form).attr('action'),
                type: $(form).attr('method'),
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: beforeSaving,
                success: function(response) {
                    if (response.status === 'SUCCESS') {
                        notifySuccess('Saved!');
                    } else if(response.status === 'ERROR') {
                        notifyError(response.message);
                    }
                    afterSaving();
                },
                error: function (xhr, status, error) {
                    var response = JSON.parse(xhr.responseText);
                    if(response.errors) {
                        notifyError('Some fields is not valid');
                        parseFormError(response.errors);
                    } else {
                        $notifyError('System error.');
                    }
                    afterSaving();
                }
            });
            return false;
        }
    });
}

function setAutoSave() {
    // from last input till next 5min, save
    intervalSave = setInterval(function() {
        var current = new Date();
        console.log('Recheck');
        var diff = Math.abs(current - lastInputTime);
        if(diff >= TIME_TILL_SAVE) {
            triggerSave();
            clearInterval(intervalSave);
        }
    }, TIME_RE_CHECK); // check save every 10s
}

function initAutoSave() {
    $('div.card').on('click', function() {
        autoSave();
    });

    CKEDITOR.instances['content'].on('contentDom', function() {
        this.document.on('click', function(event){
            autoSave();
        });
    });
}

function autoSave() {
    lastInputTime = new Date();
    if(intervalSave) {
        clearInterval(intervalSave);
    }
    setAutoSave();
}

function initSelectImage() {

    $('.add-image').on('click', function() {
        $('input[name=images]').trigger('click');
    });

    $('input[name=images]').change(function() {
        readURL(this);
    });

    $('.close-icon').on('click',function() {
        $('#p_remove_image').modal('show');
    });

    $('#confirm_remove').on('click', function() {
        $('input[name=images]').val('');
        $('.cover-image-button.images').addClass('hidden');
    });

    $('.photo-frame').on('click', function() {
        $('#p_preview_image').find('img').attr('src', $(this).find('img').attr('src'));
        $('#p_preview_image').modal('show');
    });
}

function readURL(input) {
    if(input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function(e) {
            $('.cover-image-button.images').removeClass('hidden');
            $('.cover-image-button.images').find('img').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function initSelectFormCategory() {
    
    $('#parent_category').on('change', function() {
        var parentId = $(this).val();
        if(parentId == '' || parentId == null) {
            $('#category').prop('disabled', true).html('');
            return;
        }
        loadChildCategories(parentId);
    });
    initSelectedCategory();
}

function loadChildCategories(parentId, callback = null) {
    if(parentId <= 0) return;
    var children = child_categories[parentId-1];
    $('#category').prop('disabled', false).html('');
    var index = children.length;
    $.each( children, function( value, id ) {
        var row = '<option value="' + id +'">' + value + '</option>';
        $('#category').append(row);
    });
    if(callback) {
        callback();
    }
}

function initSelectedCategory() {
    var parentId = $('#parent_category').val();
    loadChildCategories(parentId, function() {
        $('#category').val(selected_categories).trigger('change');
    });
}

function beforeSaving() {
    $('button.save').prop('disabled', true);
    $('button.save').html('<i class="fa fa-spinner fa-spin"></i> Lưu');
}

function afterSaving() {
    $('button.save').prop('disabled', false);
    $('button.save').html('Lưu');
}