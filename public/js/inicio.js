
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


var modalBs = $('#modalBs');
var modalBsContent = $('#modalBs').find(".modal-content");

$(function(){
   
handleAjaxModal();
});




function handleAjaxModal() {


    
    // Limpia los eventos asociados para elementos ya existentes, asi evita duplicación
    $("a[data-modal]").unbind("click");
    // Evita cachear las transaccione Ajax previas
    $.ajaxSetup({ cache: false });

    // Configura evento del link para aquellos para los que desean abrir popups
    $("a[data-modal]").on("click", function (e) {

        var dataModalValue = $(this).data("modal");
        modalBsContent.load(this.href, function (response, status, xhr) {

            switch (status) {
                case "success":

                    modalBs.modal({ backdrop: 'static', keyboard: false }, 'show');

                    if (dataModalValue == "modal-lg") {
                        modalBs.find(".modal-dialog").addClass("modal-lg");
                    } else {
                        modalBs.find(".modal-dialog").removeClass("modal-lg");
                    }

                    break;

                case "error":
                    var message = "Error de ejecución: " + xhr.status + " " + xhr.statusText;
                    if (xhr.status == 403) $.msgbox(response, { type: 'error' });
                    else $.msgbox(message, { type: 'error' });
                    break;
            }

        });
        return false;
    });
}


function EventoFormularioModal(modal, onSuccess) {
    modal.find('form').submit(function () {
        $.ajax({
            url: this.action,
            type: this.method,
            data: $(this).serialize(),
            success: function (result) {
                onSuccess(result);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                var message = "Error de ejecución: " + textStatus + " " + errorThrown;
                $.msgbox(message, { type: 'error' });
                console.log("Error: ");
            }
        });
        return false;
    });
}

jQuery.fn.reset = function () {
    $(this).each (function() { this.reset(); });
}

function validarNumeros($texto)
{
    var filter6=/^[0-9\s\xF1\xD1]+$/;
    if (filter6.test($texto)){
        return true;
    }
    else{
        return false;
    }
}
function validarTexto($texto){
    var filter6=/^[A-Za-z\ \s\xF1\xD1]+$/;
    if (filter6.test($texto)){
        return true;
    }
    else{
        return false;
    }
}

function validarEmail(campo){
    expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (campo.val() != ""){
        if (!expr.test(campo.val())) {
            campo.parent().addClass("has-error");
            campo.focus();
        }
        else {
            campo.parent().removeClass("has-error");
            campo.parent().addClass("has-success");
        }
    }
    else {
        campo.parent().removeClass("has-error").removeClass("has-success");
    }
}

function justNumbers(e)
{
    var keynum = window.event ? window.event.keyCode : e.which;
    if (keynum == 8)
        return true;
    return /\d/.test(String.fromCharCode(keynum));
}

function justletters(e) {
    var keynum = window.event ? window.event.keyCode : e.which;
    patron =/[A-Za-zñÑ\s]/;
    te = String.fromCharCode(keynum);
    return patron.test(te);
}