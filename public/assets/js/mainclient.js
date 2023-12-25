//--------- AJAX Setup ---------//
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
//--------- SHOW ALERT ---------//
function showSuccessAlert(result) {
    swal.fire({
        title: 'Thành công',
        html: result.message,
        icon: 'success',
        width: 500,
        showCloseButton:true,
        allowOutsideClick:false
    })
}

function showErrorAlert() {
    swal.fire({
        title: 'Oops...',
        html: 'Có lỗi xảy ra. Vui lòng thử lại',
        icon: 'error',
        width: 400,
        showCloseButton:true,
        allowOutsideClick:false
    })
}

function requireLoginAlert() {
    swal.fire({
        title: 'Oops...',
        html: 'Bạn cần phải <b>đăng nhập</b> để sử dụng dịch vụ này.',
        icon: 'info',
        width: 400,
        showCloseButton:true,
        allowOutsideClick:false
    })
}

//--------- SHOW INPUT ERRORS ---------//
function showRegErrors(prefix, val) {
    $('span.'+prefix+'_error').text(val[0])
    $('span.'+prefix+'_error').removeAttr('style')
    $('input[name='+prefix+']').parent().addClass('is-invalid')
    $(document).on('keydown', 'input[name='+prefix+']', function() {
        $('input[name='+prefix+']').parent().removeClass('is-invalid')
        $('span.'+prefix+'_error').text('')
    })
}

function showErrors(prefix, val) {
    $('span.'+prefix+'_error').text(val[0])
    $('span.'+prefix+'_error').attr('style', 'display:inline;')
    $('input[name='+prefix+']').addClass('is-invalid')
    $(document).on('focus', 'input[name='+prefix+']', function() {
        $('input[name='+prefix+']').removeClass('is-invalid')
        $('span.'+prefix+'_error').text('')
        $('span.'+prefix+'_error').removeAttr('style')
    })
}

$('#login-up').on('submit', function(e) {
    e.preventDefault();

    var valid = $('#login-up').validate();
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
                    $('#login-up')[0].reset();
                    showSuccessAlert(result)
                } else {
                    showErrorAlert()
                }
            },
            error: function(result) {
                $.each(result.responseJSON.errors, function(prefix, val) {
                    showRegErrors(prefix, val)
                })
            },
        })
    }
})

function getDateString(value) {
    var str = value.split('/')
    var newStr = str[1] + '/' + str[0] + '/' + str[2]
    return newStr;
}
function getDateRange(startdate, enddate) {
    var start = getDateString(startdate)
    var end = getDateString(enddate)
    var sdate = moment(start, 'MM-DD-YYYY')
    var edate = moment(end, 'MM-DD-YYYY')
   
    return edate.diff(sdate, 'days') + 1;
}

function formatCash(num) {
    str = num.toString();
    return str.split('').reverse().reduce((prev, next, index) => {
        return ((index % 3) ? next : (next + '.')) + prev
    })
}

$(document).on('blur', '#startdate', function() {
    $('#checkAlert').html('')
    var s = $('#startdate').val()
    var e = $('#enddate').val()
    if (getDateRange(s, e) > 0) {
        total = getDateRange(s, e)*$('#price').val()
        
        $('#total').text(formatCash(total) + ' VNĐ')
        $('input[name=enddate]').removeClass('is-invalid')
        $('span.enddate_error').text('')
        $('span.enddate-error').removeAttr('style')
        $('#enddate-error').removeAttr('style')
        $('#checkAvailability').parent().removeClass('align-self-center')
        $('#checkAvailability').parent().addClass('align-self-end')
        $('#checkAvailability').parent().removeClass('mb-1')
    } else {
        $('#total').text('')
        if (e) {
            $('#enddate-error').text('')
            $('#enddate-error').removeAttr('style')
            showErrors('enddate', ['Ngày kết thúc không hợp lệ.'])
            $('#checkAvailability').parent().removeClass('align-self-end')
            $('#checkAvailability').parent().addClass('align-self-center')
            $('#checkAvailability').parent().addClass('mb-1')
        }
    }
})

$(document).on('blur', '#enddate', function() {
    console.log('call')
    $('#checkAlert').html('')
    var s = $('#startdate').val()
    var e = $('#enddate').val()
    if (getDateRange(s, e) > 0) {
        total = getDateRange(s, e)*$('#price').val()
        console.log($('#price').val())
        $('#total').text(formatCash(total) + ' VNĐ')
    } else {
        $('#total').text('')
    }
})

$('#checkAvailability').on('click', function(){
    var valid = $('#tourguide-booking-form').validate();
    validator = valid.form();
    
    if (validator) {
    var tourguide_id = $('#tourguide_id').val()
    var startdate = $('#startdate').val()
    var enddate = $('#enddate').val()
    $.ajax({
        type: 'POST',
        datatype: 'JSON',
        data: {tourguide_id, startdate, enddate},
        url: '/tourguides/check-availability',
        success: function (result) {
            if(result.error === false) {
                $('#checkAlert').html('<small style="color:green"><i class="fas fa-check mr-1"></i> Hướng dẫn viên có thể nhận yêu cầu của bạn trong thời gian này</small>')
            } else {
                $('#checkAlert').html('<small style="color:red"><i class="fas fa-times mr-1"></i> Rất tiếc, hướng dẫn viên không thể nhận yêu cầu của bạn trong thời gian này.</small>')
            }
        }
    })
}
})

jQuery.validator.addMethod("gte", 
    function(value, element, params) {
        newValue = getDateString(value)
        paramsValue = getDateString($(params).val())
        if (!/Invalid|NaN/.test(new Date(newValue))) {
            return new Date(newValue) >= new Date(paramsValue);
        }

        return isNaN(value) && isNaN($(params).val()) 
            || (Number(value) >= Number($(params).val())); 
    },'Ngày kết thúc không hợp lệ.'
);

$(function() {
    $('#tourguide-booking-form').validate({
        rules: {
            startdate: {
                required: true,
            },
            enddate: {
                required: true,
                gte: "#startdate",
            },
        },
        messages: {
            startdate: {
                required: "Vui lòng chọn ngày bắt đầu chuyến đi.",
            },
            enddate: {
                required: "Vui lòng chọn ngày kết thúc chuyến đi.",
            },
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
            $('#checkAvailability').parent().removeClass('align-self-end')
            $('#checkAvailability').parent().addClass('align-self-center')
            $('#checkAvailability').parent().addClass('mb-1')
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
            if (!$('#enddate').hasClass('is-invalid')) {
                $('#checkAvailability').parent().removeClass('align-self-center')
                $('#checkAvailability').parent().removeClass('mb-1')
                $('#checkAvailability').parent().addClass('align-self-end')
            }
        }
    });
}); 

$('#tourguide-booking-form').on('submit', function(e) {
    e.preventDefault();

    var valid = $('#tourguide-booking-form').validate();
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
                if (result.overlapping === true) {
                    $('#checkAlert').html('<small style="color:red"><i class="fas fa-times mr-1"></i> Rất tiếc, hướng dẫn viên không thể nhận yêu cầu của bạn trong thời gian này.</small>')
                } else {
                    if(result.error === false) {
                        $('#tourguide-booking-form')[0].reset();
                        $('#tourguide-booking').modal('hide');
                        showSuccessAlert(result)
                    } 
                    else {
                        showErrorAlert()
                    }
                } 
            },
            error: function(result) {
                $.each(result.responseJSON.errors, function(prefix, val) {
                    showErrors(prefix, val)
                })
            },
        })
    }
});

$('#edit-user-profile-form').on('submit', function(e) {
    e.preventDefault();

    var valid = $('#edit-user-profile-form').validate();
    isValid = valid.form();

    var form = this;

    if (isValid) {
        $.ajax({
            url: $(form).attr('action'),
            method: 'POST',
            data: new FormData(this),
            processData: false,
            dataType: 'JSON',
            contentType: false,
            beforeSend: function() {
                $(document).find('span.invalid-feedback').text('')
            },
            success: function(result) {
                if(result.error === false) {
                    $('.user-name').each(function(){
                        $(this).html($('#edit-user-profile-form').find($('input[name="name"]')).val());
                    })
                    var newName = $('input[name="name"]').val()
                    var name = newName.split(' ')
                    var count = name.length
                    $('.user-name-nav').html(name[count-1])
                    $('.user-bio').html($('input[name="bio"]').val())
                    $('.user-phone').html($('input[name="phone"]').val())
                    $('#edit-user-profile').modal('hide');
                    showSuccessAlert(result)
                } else {
                    showErrorAlert()
                }
            },
            error: function(result) {
                console.log(result)
            },
        })
    }
})

$('#edit-tourguide-info-form').on('submit', function(e) {
    e.preventDefault();

    var valid = $('#edit-tourguide-info-form').validate();
    isValid = valid.form();

    var form = this;

    if (isValid) {
        $.ajax({
            url: $(form).attr('action'),
            method: 'POST',
            data: new FormData(this),
            processData: false,
            dataType: 'JSON',
            contentType: false,
            beforeSend: function() {
                $(document).find('span.invalid-feedback').text('')
            },
            success: function(result) {
                if(result.error === false) {
                    $('.user-name').each(function(){
                        $(this).html($('#edit-tourguide-info-form').find($('#name')).val());
                    })
                    var newName = $('#name').val()
                    var name = newName.split(' ')
                    var count = name.length
                    $('.user-name-nav').html(name[count-1])
                    $('.user-bio').html($('#bio').val())
                    $('#edit-tourguide-profile').modal('hide');
                    showSuccessAlert(result)
                } else {
                    showErrorAlert()
                }
            },
            error: function(result) {
                console.log(result)
            },
        })
    }
})

$(function () {
    $('#change-user-pwd-form').validate({
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

$('#change-user-pwd-form').on('submit', function(e) {
    e.preventDefault();

    var valid = $('#change-user-pwd-form').validate();
    isValid = valid.form();

    var form = this;

    if (isValid) {
        $.ajax({
            url: $(form).attr('action'),
            method: 'POST',
            data: new FormData(this),
            processData: false,
            dataType: 'JSON',
            contentType: false,
            beforeSend: function() {
                $(document).find('span.invalid-feedback').text('')
            },
            success: function(result) {
                if(result.error === false) {
                    $('#change-user-pwd').modal('hide');
                    $('#change-user-pwd-form')[0].reset();
                    showSuccessAlert(result)
                } else {
                    swal.fire({
                        title: 'Oops...',
                        html: result.message,
                        icon: 'error',
                        width: 400,
                        showCloseButton:true,
                        allowOutsideClick:false
                    })
                }
            },
            error: function(result) {
                console.log(result)
            },
        })
    }
})

function replaceElement(element, val) {
    return (val != '') ? element.html(val) : ''
}

$('#edit-tourguide-profile-form').on('submit', function(e) {
    e.preventDefault();

    var valid = $('#edit-tourguide-profile-form').validate();
    isValid = valid.form();

    var form = this;

    if (isValid) {
        $.ajax({
            url: $(form).attr('action'),
            method: 'POST',
            data: new FormData(this),
            processData: false,
            dataType: 'JSON',
            contentType: false,
            beforeSend: function() {
                $(document).find('span.invalid-feedback').text('')
            },
            success: function(result) {
                if(result.error === false) {
                    $('#edit-tourguide-profile').modal('hide');
                    $('#edit-tourguide-profile-form')[0].reset();
                    swal.fire({
                        title: 'Thành công',
                        html: result.message,
                        icon: 'success',
                        width: 500,
                        showCloseButton:true,
                        allowOutsideClick:false
                    }).then(function(){
                        location.reload();
                    })
                    
                } else {
                    showErrorAlert()
                }
            }
        })
    }
})

function setBookingDone(id, url) {
    swal.fire({
        title: 'DalaHabo',
        html: 'Bạn muốn hoàn thành đơn hàng này?',
        icon: 'question',
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
                type: 'POST',
                datatype: 'JSON',
                data: {id},
                url: url,
                success: function (result) {
                    if(result.error === false) {
                        $('#status').html('<span class="badge badge-pill badge-success">Đã thanh toán</span>')
                        $('#doneBtn').attr('style','display:none;')
                        showSuccessAlert(result)
                    } else {
                        showErrorAlert()
                    }
                }
            })
        }
    });
}

function cancelBooking(id, url, tableId) {
    swal.fire({
        title: 'DalaHabo',
        html: 'Bạn có chắc chắn muốn hủy yêu cầu thuê này không?',
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
                type: 'POST',
                datatype: 'JSON',
                data: {id},
                url: url,
                success: function (result) {
                    if(result.error === false) {
                        swal.fire({
                            title: 'Thành công',
                            html: result.message,
                            icon: 'success',
                            width: 500,
                            showCloseButton:true,
                            allowOutsideClick:false
                        }).then(function(){
                            location.reload();
                        })
                    } else {
                        showErrorAlert()
                    }
                }
            })
        }
    });
}

function removeFromWishList(placeId) {
    $.ajax({
        type: 'DELETE',
        datatype: 'JSON',
        data: {
            place_id: placeId
        },
        url: '/wishlist/remove',
        success: function (result) {
            if(result.error === false) {
                toastr.options = {
                    "positionClass": "toast-bottom-center",
                    "preventDuplicates": true,
                    "showMethod": "slideDown"
                }
                toastr.success(result.message)
            } else {
                swal.fire({
                    title: 'Oops...',
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
function addToWishList(placeId) {
    $.ajax({
        type: 'POST',
        datatype: 'JSON',
        data: {
            place_id: placeId
        },
        url: '/wishlist/add',
        success: function (result) {
            if(result.error === false) {
                toastr.options = {
                    "positionClass": "toast-bottom-center",
                    "preventDuplicates": true,
                }
                toastr.success(result.message)
            } else {
                swal.fire({
                    title: 'Oops...',
                    html: result.message,
                    icon: 'info',
                    width: 400,
                    showCloseButton:true,
                    allowOutsideClick:false
                })
            }
        }
    })
}
$('.addToWishListBtn').on('click', function(e) {
    e.preventDefault();

    var isLogin = $('#checklogin').html()
    if (isLogin) {
        var placeId = $(this).closest('.each-content').find('.place-id').val()
        var element = $(this).closest('.heart a')

        if (element.hasClass('filled')) {
            element.removeClass('filled')
            removeFromWishList(placeId)
        } else {
            element.addClass('filled')
            addToWishList(placeId)
        }
    } else {
        swal.fire({
            title: 'Oops...',
            html: 'Bạn cần phải <b>đăng nhập</b> để sử dụng chức năng này',
            icon: 'info',
            width: 400,
            showCloseButton:true,
            allowOutsideClick:false
        })
    }
    
});

$('.addToWishList').on('click', function(e) {
    e.preventDefault();
    var placeId = $(this).closest('.each-content').find('.place-id').val()
    swal.fire({
        title: 'DalaHabo',
        html: 'Xóa địa điểm này khỏi <br> <b>địa điểm quan tâm</b>?',
        icon: 'warning',
        width: 400,
        showCloseButton:true,
        allowOutsideClick:false
    }).then(function(result) {
        if(result.value) {
            $.ajax({
                type: 'DELETE',
                datatype: 'JSON',
                data: {
                    place_id: placeId
                },
                url: '/wishlist/remove',
                success: function (result) {
                    if(result.error === false) {
                        toastr.options = {
                            "positionClass": "toast-bottom-center",
                            "preventDuplicates": true,
                            "showMethod": "slideDown"
                        }
                        swal.fire({
                            title: 'DalaHabo.',
                            html: result.message,
                            icon: 'success',
                            width: 400,
                            showCloseButton:true,
                            allowOutsideClick:false
                        }).then(function(){
                            window.location.reload()
                        })
                    } else {
                        swal.fire({
                            title: 'Oops...',
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
});

$('#tourguide-rating-form').on('submit', function(e) {
    e.preventDefault();
    
    var form = this;

    if ($('#rate').val() != '') {
        $.ajax({
            url: $(form).attr('action'),
            method: 'POST',
            data: new FormData(form),
            processData: false,
            dataType: 'JSON',
            contentType: false,
    
            success: function(result) {
                if(result.error === false) {
                    $('#loadRatings').html(result.html);
                    var element = $('#qty').html()
                    var length = element.length
                    var count = Number(element[length - 2]) + 1
                    $('#qty').html('Đánh giá (' + count + ')');
                    $('#tourguide-rating').modal('hide');
                    showSuccessAlert(result)
                } else {
                    showErrorAlert(result)
                }
            }
        })
    } else {
        swal.fire({
            title: 'Oops...',
            html: 'Vui lòng chọn số sao đánh giá',
            icon: 'warning',
            width: 400,
            showCloseButton:true,
            allowOutsideClick:false
        })
    }
})

//---- Remove a rating:
function removeRating(id, url) {
    swal.fire({
        title: 'DalaHabo',
        html: 'Bạn có chắc chắn muốn <b>xóa</b> đánh giá này không?',
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
                    if(result.error === false) {
                        $('#' + id).remove();
                        var element = $('#qty').html()
                        var length = element.length
                        var count = Number(element[length - 2]) - 1
                        $('#qty').html('Đánh giá (' + count + ')');
                        showSuccessAlert(result)
                    } else {
                        showErrorAlert()
                    }
                }
            })
        }
    });
}

//---- Load more comments:
function loadMoreRatings() {
    
    const page = Number($('#page').val());
    var tourguide_id = $('#tourguide_id_rating').val();

    $.ajax({
        type: 'POST',
        datatype: 'JSON',
        data: {
            page: page,
            tourguide_id: tourguide_id
        },
        url: '/services/load-ratings',
        success: function (result) {
            if(result.html != '') {
                $('#loadRatings').append(result.html);
                $('#page').val(page + 1);
            } else {
                $('#btn-loadmoreratings').attr('style', 'display:none;');
            }
        }
    })
}

$('.categoryFilter').on('click', function(e) {
    e.preventDefault();
    var catId = $(this).data("id");

    if(catId == 'all') {
        $('.each-content').css('display', 'block')
    } else {
        $('.each-content').css('display', 'none')
        $('.content-' + catId).css('display', 'block')
    }
});

//---- Load more place:
function loadMorePlaces() {
    
    const page = Number($('#page').val());

    $.ajax({
        type: 'POST',
        datatype: 'JSON',
        data: {
            page: page,
        },
        url: '/services/load-places',
        success: function (result) {
            if(result.html != '') {
                $('#loadPlaces').append(result.html);
                $('#page').val(page + 1);
            } else {
                $('#btn-loadmoreplaces').attr('style', 'display:none;');
            }
        }
    })
}