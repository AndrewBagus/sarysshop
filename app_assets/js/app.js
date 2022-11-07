//Disable the Context Menu event.
$('.nav-item').contextmenu(function () {
    return false;
});

$('.nav-item').click(function (e) {
    if (e.ctrlKey) {
        return false;
    }
});

//Positive integer
$(".positive-integer").numeric({
  decimal: false,
  negative: false
}, function () {
  alert("Positive integers only");
  this.value = "";
  this.focus();
});

function positive_integer_load() {
  //Positive integer
  $(".positive-integer").numeric({
    decimal: false,
    negative: false
  }, function () {
    alert("Positive integers only");
    this.value = "";
    this.focus();
  });
}

//Set min & max input
function minmax(value, min, max) {
  if (parseInt(value) < min || isNaN(parseInt(value))) {
    return min;
  }
  else if (parseInt(value) > max) {
    var setValue = value.substring(value.length - max.toString().length, max.toString().length + 1);
    if (parseInt(setValue) > max) {
      return max;
    } else {
      return setValue;
    }
  }
  else {
    return (parseInt(value));
  }
}
//replace keycode 222 
$('input[type=text]').on('keyup', function (e) {
  //if ((e.which === 32 && e.target.selectionStart === 0) || e.which === 222) {
  //  $(this).val($(this).val().replace(/'/g, "\""));
  //}
  $(this).val($(this).val().replace(/'/g, "\""));
});

function switch_bootstrap(nameID,onText,offText) {
  $('#' + nameID).find(".switchBootstrap").each(function () { $(this).parent.removeClass("switchBootstrap"); });
  $('#' + nameID).bootstrapSwitch("handleWidth", 50);
  $('#' + nameID).bootstrapSwitch("size", "small");
  $('#' + nameID).bootstrapSwitch("animate", "false");
  $('#' + nameID).bootstrapSwitch("onColor", "custom_blue");
  $('#' + nameID).bootstrapSwitch("onText", onText);
  $('#' + nameID).bootstrapSwitch("offText", offText);
}
function clear_validate_from(form_id) {
  $(".icon-remove").remove();
  $("#keterangan_form").html(' Keterangan <span>( <i style="color:red">*</i> )</span> : Harus dipilih / di isi');
  $("#" + form_id).find(".cannot-null").each(function () {
    $(this).parent().find('.text-danger').text("");
   // $(this).parent().parent().removeClass("has-danger");
  })
}
function validate_form(form_id) {
  error = 0;
  $(".icon-remove").remove();
  $("#" + form_id).find(".cannot-null").each(function () {
    if ($(this).val() == "" || $(this).val() == null) {
     // $(this).parent().parent().addClass("has-danger");
      $(this).parent().find('.text-danger').text("wajib di isi / di pilih");
      //$(this).parent().find('.select-danger').text("wajib di pilih");
      $(this).parent().append("<span class='form-control-position'><i style='margin-right:15px' class='icon-remove danger'></i></span>");
      error++;
    }
    else {
      $(this).parent().find('.text-danger').text("");
      $(this).parent().find('.select-danger').text("");
      $(this).parent().parent().removeClass("has-danger");
    }
  });
  //console.log("e: " + error);
  return error;
}

function open_loader() {
  document.getElementById("loading").style.display = "block";
}
function close_loader() {
  document.getElementById("loading").style.display = "none";
}

//var get_data_sekolah = function () {
//  return {
//    m_sekolah_id: function () {
//      $.ajax({
//        url: glsGlobal.getBaseUrl() + '/get_data_sekolah',
//        type: 'post',
//        dataType: 'json',
//        data: {
//          table: "m_sekolah_id"
//        },
//        success: function (result) {
//          $.each(result.data, function (i, val) {
//            $("#m_sekolah_id").val(val.m_sekolah_id);
//          });
//        }
//        ,
//        error: function (xhr, status, error) {
//          $("#m_sekolah_id").val("eror");
//          console.log(error);
//        }
//      })
//    }
//  }
//}();

var glsGlobal = function () {
    return {
        getBaseUrl: function () {
            var re = new RegExp(/^.*\//);
            return re.exec(window.location.href).input;
            //return 'http://localhost/IIS/';
        },

        getRootUrl: function () {
            return window.location.origin ? window.location.origin + '/' : window.location.protocol + '/' + window.location.host + '/';
        },

        iif: function (condition, if_true, if_false) {
            if (condition)
                return if_true;
            else
                return if_false;
        }
    };
}();

var glsUI = function () {
    return {
        //F001 Fungsi global untuk menampilkan MessageBox, pradikta 20170601
        showMessage: function (sa_title, sa_message, sa_type, sa_confirmButtonClass,
            sa_cancelButtonClass, sa_allowOutsideClick, sa_showConfirmButton,
            sa_showCancelButton, sa_closeOnConfirm, sa_closeOnCancel,
            sa_confirmButtonText, sa_cancelButtonText, sa_popupTitleSuccess,
            sa_popupMessageSuccess, sa_popupTitleCancel, sa_popupMessageCancel) {
            if (sa_title === undefined) sa_title = 'Information';
            if (sa_message === undefined) sa_message = 'Message';
            if (sa_type === undefined) sa_type = 'info';
            if (sa_confirmButtonClass === undefined) sa_confirmButtonClass = 'btn-default';
            if (sa_cancelButtonClass === undefined) sa_cancelButtonClass = 'btn-default';
            if (sa_allowOutsideClick === undefined) sa_allowOutsideClick = undefined;
            if (sa_showConfirmButton === undefined) sa_showConfirmButton = undefined;
            if (sa_showCancelButton === undefined) sa_showCancelButton = undefined;
            if (sa_closeOnConfirm === undefined) sa_closeOnConfirm = undefined;
            if (sa_closeOnCancel === undefined) sa_closeOnCancel = undefined;
            if (sa_confirmButtonText === undefined) sa_confirmButtonText = 'Yes';
            if (sa_cancelButtonText === undefined) sa_cancelButtonText = 'Cancel';
            if (sa_popupTitleSuccess === undefined) sa_popupTitleSuccess = 'Success';
            if (sa_popupMessageSuccess === undefined) sa_popupMessageSuccess = 'Success';
            if (sa_popupTitleCancel === undefined) sa_popupTitleCancel = 'Cancelled';
            if (sa_popupMessageCancel === undefined) sa_popupMessageCancel = 'You have canceled';
            swal({
                title: sa_title,
                text: sa_message,
                type: sa_type,
                allowOutsideClick: sa_allowOutsideClick,
                showConfirmButton: sa_showConfirmButton,
                showCancelButton: sa_showCancelButton,
                confirmButtonClass: sa_confirmButtonClass,
                cancelButtonClass: sa_cancelButtonClass,
                closeOnConfirm: sa_closeOnConfirm,
                closeOnCancel: sa_closeOnCancel,
                confirmButtonText: sa_confirmButtonText,
                cancelButtonText: sa_cancelButtonText
            },
                function (isConfirm) {
                    if (isConfirm && sa_showConfirmButton !== undefined) {
                        swal(sa_popupTitleSuccess, sa_popupMessageSuccess, "success");
                    } else {
                        swal(sa_popupTitleCancel, sa_popupMessageCancel, "error");
                    }
                });
        },

        //F002 Fungsi global untuk menampilkan Notifikasi, pradikta 20170601
        showNotif: function (title, message, type) {
            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toast-bottom-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "1000",
                "hideDuration": "1000",
                "timeOut": "1000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }

            if (type === undefined) type = 'info';
            if (message === undefined) message = 'Message';

            if (type === 'success') {
                if (title === undefined) title = 'Success';
                toastr.success(title, message);
            } else if (type === 'warning') {
                if (title === undefined) title = 'Warning';
                toastr.warning(title, message);
            } else if (type === 'error') {
                if (title === undefined) title = 'Error';
                toastr.error(title, message);
            } else {
                if (title === undefined) title = 'Information';
                toastr.info(title, message);
            }
        },

        //F003 Fungsi global untuk menampilkan konfirmasi, pradikta 20170601
        showConfirmation: function (title, message, callback) {
            bootbox.confirm({
                title: title,
                message: message,
                buttons: {
                    cancel: {
                      label: '<i class="icon-times"></i> Tidak',
                        className: 'btn-default'
                    },
                    confirm: {
                      label: '<i class="icon-check"></i> Ya',
                        className: 'btn-info'
                    }
                },
              callback: function (result) {
                if (result === true) {
                  callback();
                }
              }
            });
        }
    };
}();


function ReplaceString(value) {
    if (value !== null) {
        return encodeURI(value);
    } else {
        return "";
    }
}

function readonly_select(objs, action) {
    if (action === true)
        objs.prepend('<div class="disabled-select"></div>');
    else
        $(".disabled-select", objs).remove();
}

function DateNow(value) {
    var today = new Date(getDate() + '/' + getMonth() + 1 + '/' + getFullYear());
    var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();

    if (dd < 10) {
        dd = '0' + dd
    }

    if (mm < 10) {
        mm = '0' + mm
    }
    today = mm + '/' + dd + '/' + yyyy;
}

function gls_antiforgerytoken() {
    var token = $('input[name="__RequestVerificationToken"]').val();
    return token;
}
