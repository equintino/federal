$(document).ready(function() {
    initDatepicker();
    initFlashes();
    initErrorFields();
    initChangeStatusDialog();
    initDeleteDialog();
});

function total($x){
  var x='Total de processos encontrados ('+$x+')';
  document.getElementById('total').innerHTML=x;
}

function initDatepicker() {
    $('.datepicker')
        .attr('readonly', 'readonly')
        .datepicker({
            dateFormat: 'yy-m-d'
        });
}

function initFlashes() {
    var flashes = $("#flashes");
    if (!flashes.length) {
        return;
    }
    setTimeout(function() {
        flashes.slideUp("slow");
    }, 2000);
}

function initErrorFields() {
    $('.error-field').first().focus();
}

function initDeleteDialog() {
    var deleteDialog = $('#delete-dialog');
    var deleteLink = $('#delete-link');
    deleteDialog.dialog({
        autoOpen: false,
        modal: true,
        width: 476,
        buttons: {
            'OK': function() {
                $(this).dialog('close');
                location.href = deleteLink.attr('href');
            },
            'Cancel': function() {
                $(this).dialog('close');
            }
        }
    });
    deleteLink.click(function() {
        deleteDialog.dialog('open');
        return false;
    });
}

function initChangeStatusDialog() {
    var changeStatusDialog = $('#change-status-dialog');
    var changeStatusLink = $('.change-status-link');
    var changeStatusForm = $('#change-status-form');
    changeStatusDialog.dialog({
        autoOpen: false,
        modal: true,
        width: 476,
        buttons: {
            'OK': function() {
                changeStatusForm.submit();
                $(this).dialog('close');
            },
            'Cancel': function() {
                $(this).dialog('close');
            }
        }
    });
    changeStatusLink.click(function() {
        changeStatusForm.attr('action', $(this).attr('href'));
        changeStatusDialog.dialog('option', 'title', $(this).attr('title'));
        changeStatusDialog.dialog('open');
        return false;
    });
}
function createCookie(name,value) {   
    var date = new Date();
    date.setTime(date.getTime()+(60*100));
    var expires = "; expires="+true;
    
    //alert(date.toLocaleString());
    //alert(name+"="+value+expires+"; path=/");
    document.cookie = name+"="+value+expires+"; path=/";
}
