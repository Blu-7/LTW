//--------- AJAX Setup ---------//
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

//--------- DELETE MULTI ROWS ---------//
$(document).on('click', 'input[name="main_checkbox"]', function() {
    if(this.checked) {
        $('input[name="item_checkbox"]').each(function() {
            this.checked = true;
        })
    } else {
        $('input[name="item_checkbox"]').each(function() {
            this.checked = false;
        })
    }
    toggleDeleteAllBtn()
})

$('.alert-success').show(function (){
    this.remove();
})
$('#upload').change(function(){
    var self = this;
    const form = new FormData();

    form.append('upload', this.files[0]);

    data = $('#poster').val()
    if(data !== '') {
        removeUploadStorage(data)
    }

    $.ajax({
        processData: false,
        contentType: false,
        type: 'POST',
        dataType: 'JSON',
        data: form,
        url: '/admin/upload/service',
        success: function(result) {
            if (result.success === true) {
                var show = $('#image_show');
                show.textContent = '';
                show.html('<a href="' + result.url + '" target="_blank">' +
                    '<img src="' + result.url + '" width=100% class="img-thumbnail" alt="image"></a>');
                var fileName = self.files[0].name;
                $('#file').text(fileName);
                $('#poster').val(result.url);
            } else {
                showErrorAlert()
            }
        }
    })
})

$(document).on('change', 'input[name="item_checkbox"]', function() {
    if($('input[name="item_checkbox"]').length == $('input[name="item_checkbox"]:checked').length) {
        $('input[name="main_checkbox"]').prop('checked', true);
    } else {
        $('input[name="main_checkbox"]').prop('checked', false);
    }
    toggleDeleteAllBtn()
})

function toggleDeleteAllBtn() {
    var rows = $('input[name="item_checkbox"]:checked').length
    if (rows > 0) {
        $('#deleteAllBtn').text('Xóa (' + rows + ')').removeClass('d-none');
    } else {
        $('#deleteAllBtn').addClass('d-none');
    }
}

//--------- SHOW ALERT ---------//
function showSuccessAlert(result) {
    swal.fire({
        title: 'Hacimi',
        text: result.msg,
        icon: 'success',
        width: 400,
        showCloseButton:true,
        allowOutsideClick:false,
    }).then(function (){
        location.reload();
    });
}

function showErrorAlert() {
    swal.fire({
        title: 'Hacimi',
        html: 'Có lỗi xảy ra. Vui lòng thử lại',
        icon: 'error',
        width: 400,
        showCloseButton:true,
        allowOutsideClick:false
    }).then(function(){
       location.reload()
    });
}

//--------- SHOW INPUT ERRORS ---------//
function showErrors(prefix, val) {
    $('span.'+prefix+'_error').text(val[0])
    $('span.'+prefix+'_error').removeAttr('style')
    $('input[name='+prefix+']').addClass('is-invalid')
    $(document).on('keydown', 'input[name='+prefix+']', function() {
        $('input[name='+prefix+']').removeClass('is-invalid')
        $('span.'+prefix+'_error').text('')
    })
}

//--------- ADD & UPDATE NEW RECORD ---------//
function resetFormImgsAndCKE() {
    $('#images-show').html('');
    $('#images').val('');
    CKEDITOR.instances['description'].setData('');
}

function resetFormImg() {
    $('#image_show').html('');
    $('#image').val('');
}

//---- 1. Slider:
$('#add-slider-form').on('submit', function(e) {
    e.preventDefault();

    var valid = $('#add-slider-form').validate();
    validator = valid.form();

    var form = this;

    if (validator) {
        $.ajax({
            url: $(form).attr('action'),
            method: 'POST',
            data: new FormData(form),
            processData: false,
            dataType: 'JSON',
            contentType: false,
            success: function(result) {
                if(result.error === false) {
                    $('#add-slider-form')[0].reset();
                    resetFormImg()
                    showSuccessAlert(result)
                } else {
                    showErrorAlert()
                }
            }
        })
    }
})

$('#edit-slider-form').on('submit', function(e) {
    e.preventDefault();

    var validator = $('#edit-slider-form').validate();
    isValid = validator.form();

    var form = this

    if (isValid) {
        $.ajax({
            url: $(form).attr('action'),
            method: 'POST',
            data: new FormData(form),
            processData: false,
            dataType: 'JSON',
            contentType: false,
            success: function(result) {
                if(result.error === false) {
                    showSuccessAlert(result)
                } else {
                    showErrorAlert()
                }
            },
            error: function(result) {
                $.each(result.responseJSON.errors, function(prefix, val) {
                    showErrors(prefix, val)
                })
            },
        })
    }
})

//---- 2. Danh mục:
$('#add-category-form').on('submit', function(e) {
    e.preventDefault();

    var valid = $('#add-category-form').validate();
    validator = valid.form();

    var form = this;

    if (validator) {
        $.ajax({
            url: $(form).attr('action'),
            method: 'POST',
            data: new FormData(form),
            processData: false,
            dataType: 'JSON',
            contentType: false,
            success: function(result) {
                if(result.error === false) {
                    $('#add-category-form')[0].reset();
                    showSuccessAlert(result)
                } else {
                    showErrorAlert()
                }
            }
        })
    }
})

$('#edit-category-form').on('submit', function(e) {
    e.preventDefault();

    var validator = $('#edit-category-form').validate();
    isValid = validator.form();

    var form = this

    if (isValid) {
        $.ajax({
            url: $(form).attr('action'),
            method: 'POST',
            data: new FormData(form),
            processData: false,
            dataType: 'JSON',
            contentType: false,
            success: function(result) {
                if(result.error === false) {
                    showSuccessAlert(result)
                } else {
                    showErrorAlert()
                }
            },
            error: function(result) {
                $.each(result.responseJSON.errors, function(prefix, val) {
                    showErrors(prefix, val)
                })
            },
        })
    }
})

//---- 3. Địa điểm:
$('#add-place-form').on('submit', function(e) {
    e.preventDefault();

    var valid = $('#add-place-form').validate();
    validator = valid.form();

    var form = new FormData(this)
    form.append('file', $('.custom-file-label').html())

    if (validator) {
        $.ajax({
            url: $(form).attr('action'),
            method: 'POST',
            data: form,
            processData: false,
            dataType: 'JSON',
            contentType: false,
            success: function(result) {
                if(result.error === false) {
                    $('#add-place-form')[0].reset();
                    resetFormImgsAndCKE();
                    showSuccessAlert(result);
                } else {
                    showErrorAlert();
                }
            }
        })
    }
})

$('#edit-place-form').on('submit', function(e) {
    e.preventDefault();

    var validator = $('#edit-place-form').validate();
    isValid = validator.form();

    var form = this

    if (isValid) {
        $.ajax({
            url: $(form).attr('action'),
            method: 'POST',
            data: new FormData(form),
            processData: false,
            dataType: 'JSON',
            contentType: false,
            success: function(result) {
                if(result.error === false) {
                    showSuccessAlert(result)
                } else {
                    showErrorAlert()
                }
            },
            error: function(result) {
                $.each(result.responseJSON.errors, function(prefix, val) {
                    showErrors(prefix, val)
                })
            },
        })
    }
})

//---- 4. Hướng dẫn viên:
$('#add-tourguide-form').on('submit', function(e) {
    e.preventDefault();

    var valid = $('#add-tourguide-form').validate();
    validator = valid.form();

    var form = new FormData(this)
    form.append('file', $('.custom-file-label').html())

    if (validator) {
        $.ajax({
            url: $(form).attr('action'),
            method: 'POST',
            data: form,
            processData: false,
            dataType: 'JSON',
            contentType: false,
            success: function(result) {
                if(result.error === false) {
                    $('#add-tourguide-form')[0].reset();
                    resetFormImgsAndCKE();
                    showSuccessAlert(result);
                } else {
                    showErrorAlert();
                }
            },
            error: function(result) {
                $.each(result.responseJSON.errors, function(prefix, val) {
                    showErrors(prefix, val)
                })
            },
        })
    }
})

$('#edit-tourguide-form').on('submit', function(e) {
    e.preventDefault();

    var validator = $('#edit-tourguide-form').validate();
    isValid = validator.form();

    var form = this

    if (isValid) {
        $.ajax({
            url: $(form).attr('action'),
            method: 'POST',
            data: new FormData(form),
            processData: false,
            dataType: 'JSON',
            contentType: false,
            success: function(result) {
                if(result.error === false) {
                    showSuccessAlert(result)
                } else {
                    showErrorAlert()
                }
            },
            error: function(result) {
                $.each(result.responseJSON.errors, function(prefix, val) {
                    showErrors(prefix, val)
                })
            },
        })
    }
})

//Blogs

//---- 6. Tài khoản:
$('#add-user-form').on('submit', function(e) {
    e.preventDefault();

    var valid = $('#add-user-form').validate();
    validator = valid.form();

    var form = this;

    if (validator) {
        $.ajax({
            url: $(form).attr('action'),
            method: 'POST',
            data: new FormData(form),
            processData: false,
            dataType: 'JSON',
            contentType: false,
            beforeSend: function() {
                $(document).find('span.invalid-feedback').text('')
            },
            success: function(result) {
                if(result.error === false) {
                    $('#add-user-form')[0].reset();
                    resetFormImg()
                    showSuccessAlert(result)
                } else {
                    showErrorAlert()
                }
            },
            error: function(result) {
                $.each(result.responseJSON.errors, function(prefix, val) {
                    showErrors(prefix, val)
                })
            },
        })
    }
})

$('#edit-user-form').on('submit', function(e) {
    e.preventDefault();

    var validator = $('#edit-user-form').validate();
    isValid = validator.form();

    var form = this

    if (isValid) {
        $.ajax({
            url: $(form).attr('action'),
            method: 'POST',
            data: new FormData(form),
            processData: false,
            dataType: 'JSON',
            contentType: false,
            success: function(result) {
                if(result.error === false) {
                    showSuccessAlert(result)
                } else {
                    showErrorAlert()
                }
            },
            error: function(result) {
                $.each(result.responseJSON.errors, function(prefix, val) {
                    showErrors(prefix, val)
                })
            },
        })
    }
})

//--------- REMOVE ---------//
function setCount() {
    var count = $('tr[name="item"]').length
    if (count > 0) {
        $('#count').html('<strong>Số lượng: ' + count + '</strong>')
    } else {
        $('#count').html('<strong>Chưa có dữ liệu</strong>')
    }
}

//---- 1. Remove a record:
function removeRow(id, url, tableId) {
    swal.fire({
        title: 'Hacimi',
        html: 'Bạn có chắc chắn muốn <b>xóa</b> mục này không?',
        icon: 'warning',
        showCloseButton:true,
        showCancelButton:true,
        cancelButtonText:'Cancel',
        confirmButtonText:'OK',
        cancelButtonColor:'#d33',
        confirmButtonColor:'#556ee6',
        allowOutsideClick:false
    }).then(function(result){
        if(result.value){
            $.ajax({
                type: 'DELETE',
                datatype: 'JSON',
                data: {id},
                url: url,
                success: function (result) {
                    if(result.success === true) {
                        // $('#' + tableId + ' tbody #' + id).remove();
                        setCount();
                        showSuccessAlert(result);
                    } else {
                        showErrorAlert()
                    }
                }
            })
        }
    });
}

//---- 2. Remove records:
function removeAll(url, tableId) {
    var checkedItem = new Array();
    $('input[name="item_checkbox"]:checked').each(function() {
        checkedItem.push($(this).data('id'));
    });

    var ids = checkedItem.toString()

    swal.fire({
        title: 'DalaHabo Admin',
        html: 'Xóa không thể khôi phục. <br> Bạn có chắc chắn muốn <b>xóa (' + checkedItem.length + ')</b> mục này không?',
        icon: 'warning',
        showCloseButton:true,
        showCancelButton:true,
        cancelButtonText:'Cancel',
        confirmButtonText:'OK',
        cancelButtonColor:'#d33',
        confirmButtonColor:'#556ee6',
        allowOutsideClick:false,
        width: 500,
    }).then(function(result){
        if(result.value){
            $.ajax({
                type: 'DELETE',
                datatype: 'JSON',
                data: {ids},
                url: url,
                success: function (result) {
                    if(result.error === false) {
                        checkedItem.forEach(function(id) {
                            $('#' + tableId + ' tbody #' + id).remove();
                        })
                        setCount()
                        $('#deleteAllBtn').addClass('d-none');
                        $('#deleteAllBtn').html('');
                        showSuccessAlert(result)
                    } else {
                        showErrorAlert()
                    }
                }
            })
        }
    });
}

//--------- UPLOAD/REMOVE IMAGES ---------//
//---- 2. Upload images:
$("#mul-file-input").change(function(e) {

    var files = Array.from(this.files)

    flength = files.length;

    if (flength > 0) {
        var fileName = files.map(f =>{return f.name}).join(", ")
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);

        str = $('.store-image').get()
        arr = Object.values(str)

        if (arr.length > 0) {
            $('#images').val('')
            removeMultipleUploadStorage(arr)
        }

        for(var i=0; i < flength; i++) {
            const form = new FormData();
            form.append('file', files[i]);
            form.append('folder',$('#folder').val())

            if(fileName !== '') {
                $('#images-show:first').html('');
            }

            $.ajax({
                processData: false,
                contentType: false,
                type: 'POST',
                dataType: 'JSON',
                data: form,
                url: '/admin/upload-gallery/services',
                success: function(result) {
                    if (result.error === false) {
                        images = $('#images').val();
                        html = $('#images-show').html();
                        $('#images-show').html(html +
                                '<div class="mt-3 col-md-3">' +
                                    '<a href="' + result.url + '"target="_blank">' +
                                        '<img src="' + result.url + '"width=100% class="img-thumbnail" id="img">' +
                                    '</a>' +
                                '</div>' +
                                '<input type="hidden" class="store-image" value="'+ result.url + '" id="image">');

                        $('#images').val(images + result.url + ',')
                    } else {
                        showErrorAlert()
                    }
                }
            })
        }
    }
});

//---- 3. Remove an image:
function removeUploadStorage(val) {
    $.ajax({
        type: 'DELETE',
        datatype: 'JSON',
        data: {val},
        url: '/admin/destroy/service',
    })
}

//---- 4. Remove images:
function removeMultipleUploadStorage(arr) {
    for (var i = 0; i < arr.length; i++) {
        val = arr[i].value
        removeUploadStorage(val)
    }
}


//--------- USER'S PROFILE ---------//
//---- 1. Update user's info:
$(function () {
    $('#profile-user-form').validate({
        rules: {
            name: {
                required: true,
            },
            phone: {
                required: true,
            },
        },
        messages: {
            name: {
                required: "Tên người dùng không được để trống.",
            },
            phone: {
                required: "Số điện thoại không được để trống.",
            },
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });
});

$('#profile-user-form').on('submit', function(e) {
    e.preventDefault();

    var validator = $('#profile-user-form').validate();
    isValid = validator.form();

    if (isValid) {
        $.ajax({
            url: '/admin/user-profile/update',
            method: 'POST',
            data: new FormData(this),
            processData: false,
            dataType: 'JSON',
            contentType: false,
            success: function(result) {
                if(result.error === false) {
                    $('.admin-name').each(function(){
                        $(this).html($('#profile-user-form').find($('input[name="name"]')).val());
                    })
                    showSuccessAlert(result)
                } else {
                    showErrorAlert()
                }
            }
        })
    }
})

//---- 2. Change password:
$(function () {
    $('#form-pwd').validate({
        rules: {
            old_password: {
                required: true,
            },
            new_password: {
                minlength: 8,
                required: true,
            },
            confirm_password: {
                required: true,
                equalTo: "#new_password"
            },
        },
        messages: {
            old_password: {
                required: "Vui lòng nhập mật khẩu cũ.",
            },
            new_password: {
                minlength : "Mật khẩu phải chứa ít nhất 8 ký tự.",
                required: "Vui lòng nhập mật khẩu mới.",
            },
            confirm_password: {
                required: "Vui lòng xác nhận mật khẩu.",
                equalTo: "Mật khẩu không khớp. Vui lòng xác nhận lại mật khẩu."
            },
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });
})

$('#form-pwd').on('submit', function(e) {
    e.preventDefault();

    var valid = $('#form-pwd').validate();
    validator = valid.form();

    if (validator) {
        $.ajax({
            url: '/admin/user-profile/change-password',
            method: 'POST',
            data: new FormData(this),
            processData: false,
            dataType: 'JSON',
            contentType: false,

            success: function(result) {
                $('#form-pwd')[0].reset();
                if(result.error === false) {
                    showSuccessAlert(result)
                } else {
                    swal.fire({
                        title: 'DalaHabo Admin',
                        html: result.message,
                        icon: 'error',
                        width: 400,
                        showCloseButton:true,
                        allowOutsideClick:false
                    })
                }
            }
        })
    }
})
