(function ($) {


    $.fn.inputFileImage = function (option) {
        var opc = $.extend({
            width: 214,
            height: 250,
            maxlength: 6,
            maxfilesize: 5120,
            minWidthImage: 100,
            maxWidthImage:5000,
            maxHeightImage:5000,
            minHeightImage: 100,
            prepreview: false,
            minType: [],
        }, option);

        this.each(function () {

            var elementoprimario = $(this);
            var contenedorTotal = document.createElement("div");
            contenedorTotal.setAttribute("class", "div-container-fileinput");
            var customInput = document.createElement('div');
            customInput.setAttribute("class", "custom-input-file");
            elementoprimario.after(customInput);
            var inputtextlabel = document.createElement("div");
            inputtextlabel.setAttribute("class", "input-text-label form-control");
            var cargar = document.createElement("span");
            cargar.setAttribute("class", "cargar");
            cargar.setAttribute("data-element", $(this).attr("id"));
            cargar.innerHTML = '<i class="fa fa-folder-open" aria-hidden="true"></i> Explorar';

            var conteArventencias = document.createElement("div");

            texto = "Los formatos aceptados son ";

            if(opc.minType.length > 0){
                for(i=0;i<opc.minType.length;i++){
                    if(i==opc.minType.length-1){
                        texto += opc.minType[i]+".";
                    }else{
                        texto += opc.minType[i]+", ";
                    }
                }
            }else{
                texto +="jpg, png, gif. ";
            }

            texto +=" Maximo "+opc.maxlength+ " imagenes. ";

            texto +="El tamaño maximo permitido para las imagenes es "+(opc.maxfilesize/1024)+" MB";

            conteArventencias.innerHTML = texto;

            conteArventencias.style.fontWeight ="bold";
            conteArventencias.style.color = "#646464";
            conteArventencias.style.fontSize="13px";

            $(customInput).append(elementoprimario);
            $(customInput).append(inputtextlabel);
            $(customInput).append(cargar);
            $(customInput).before(contenedorTotal);
            $(contenedorTotal).append(customInput);
            $(contenedorTotal).append(conteArventencias);

            cargar.addEventListener("click", simulaclick);


            $(elementoprimario).data("files", []);
            $(elementoprimario).parent(".custom-input-file").siblings(".div-contenPreviw-inputfile").remove();
            var contenPreviw = document.createElement("output");
            contenPreviw.setAttribute("class", "div-contenPreviw-inputfile");
            $(elementoprimario).parent(".custom-input-file").before(contenPreviw);
            contenPreviw.innerHTML = "";
            if(option.prepreview){
                for( i = 0; i < 4; i++){
                    precargas(opc.width, opc.height, contenPreviw);
                }
            }else{
                precargas(opc.width, opc.height, contenPreviw);
            }


            $(this).change(function (evt) {
                var files = evt.target.files; // FileList object
                if (files.length > 0) {
                    var error = document.createElement("div");
                    error.setAttribute("class", "alert alert-danger");
                    error.setAttribute("role", "alert");
                    error.innerHTML = '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                    var ullisError = document.createElement("ul");
                    ullisError.setAttribute("class", "ul-list-errores-flieinput");
                    $(this).data("files", []);
                    $(this).parent(".custom-input-file").siblings(".div-contenPreviw-inputfile").remove();
                    var contenPreviw = document.createElement("output");
                    contenPreviw.setAttribute("class", "div-contenPreviw-inputfile");
                    $(this).parent(".custom-input-file").before(contenPreviw);
                    contenPreviw.innerHTML = "";
                    var totalArchivos = 0;
                    if (files.length <= opc.maxlength) {
                        var arrayError = new Array();
                        for (var i = 0, f; f = files[i]; i++) {
                            // Only process image files.
                            if (!f.type.match('image.*')) {
                                continue;
                            }
                            if ((opc.maxfilesize * 1024) < f.size) {
                                arrayError.push('El peso de la imagen "' + f.name + '" supera el peso permitido ' + opc.maxfilesize + 'KB');
                                continue;
                            }
                            if (opc.minType.length > 0) {
                                var type = f.type.split("/");
                                if (opc.minType.indexOf(type[1]) == -1) {
                                    arrayError.push('El formato de la imagen "' + f.name + '" no es un formato valido');
                                    continue;
                                }
                            }
                            totalArchivos++;
                            f.key = i;
                            f.elemento = $(this).attr("id");
                            filesArray = $(this).data("files");
                            filesArray.push(f);
                            $(this).data("files", filesArray);
                            var reader = new FileReader();
                            // Closure to capture the file information.
                            reader.onload = (function (theFile) {
                                return function (e) {
                                    var imagen = new Image();
                                    imagen.archivo = e;
                                    imagen.file = theFile;
                                    imagen.errores = [];
                                    imagen.onload = function () {
                                        var e = imagen.archivo;
                                        var theFile = imagen.file;
                                        var divPreview = document.createElement('div');
                                        $(divPreview).addClass("div-preview-inpufile");
                                        $(divPreview).width(opc.width);
                                        $(divPreview).height(opc.height);
                                        var altoImagen = opc.height - 44;
                                        $(divPreview).append('<img class="img-thumb-preview-inpufile" src="' + e.target.result + '" title="' + theFile.name + '" width="100%" height="' + altoImagen + '"/>');
                                        var divAcciones = document.createElement('div');
                                        divAcciones.setAttribute("class", "div-acciones-preview-inpufile");
/*                                        var spantitulo = document.createElement('span');
                                        spantitulo.innerHTML = theFile.name;
                                        spantitulo.style.float = "left";
                                        spantitulo.style.fontSize = "11px"*/
                                        var divEliminar = document.createElement('div');
                                        divEliminar.setAttribute("class", "div-elimnar-preview-inpufile");
                                        divEliminar.innerHTML = '<i class="fa fa-trash" aria-hidden="true"></i>';
                                        divEliminar.addEventListener("click", eliminarImagen);
                                        divEliminar.setAttribute("data-key", theFile.key);
                                        divEliminar.setAttribute("data-padreId", theFile.elemento);
                                        // divAcciones.appendChild(spantitulo);
                                        divAcciones.appendChild(divEliminar);
                                        divPreview.appendChild(divAcciones);
                                        contenPreviw.appendChild(divPreview);
                                        if (this.width <= opc.minWidthImage) {
                                            $(divEliminar).trigger("click");
                                            var lierror = document.createElement("li");
                                            lierror.innerHTML = 'El ancho de la imagen "' + theFile.name + '" debe ser minimo de ' + opc.minWidthImage + 'px';
                                            ullisError.appendChild(lierror);
                                            $(error).append(ullisError);
                                            $(contenPreviw).append(error);
                                        }else if (this.height <= opc.minHeightImage) {
                                            $(divEliminar).trigger("click");
                                            var lierror = document.createElement("li");
                                            lierror.innerHTML = 'El alto de la imagen "' + theFile.name + '" debe ser minimo de ' + opc.minHeightImage + 'px';
                                            ullisError.appendChild(lierror);
                                            $(error).append(ullisError);
                                            $(contenPreviw).append(error);
                                        }else if(this.width > opc.maxWidthImage){
                                            $(divEliminar).trigger("click");
                                            var lierror = document.createElement("li");
                                            lierror.innerHTML = 'El ancho de la imagen "' + theFile.name + '" debe ser menor a ' + opc.maxWidthImage + 'px';
                                            ullisError.appendChild(lierror);
                                            $(error).append(ullisError);
                                            $(contenPreviw).append(error);
                                        }else if(this.height> opc.maxHeightImage){
                                            $(divEliminar).trigger("click");
                                            var lierror = document.createElement("li");
                                            lierror.innerHTML = 'El alto de la imagen "' + theFile.name + '" debe ser menor a ' + opc.maxHeightImage + 'px';
                                            ullisError.appendChild(lierror);
                                            $(error).append(ullisError);
                                            $(contenPreviw).append(error);
                                        }
                                    }
                                    imagen.src = e.target.result;
                                    // Render thumbnail.
                                };
                            })(f);
                            // Read in the image file as a data URL.
                            reader.readAsDataURL(f);
                        }
                    } else {
                        var lierror = document.createElement("li");
                        lierror.innerHTML = "puede subir un maximo de " + opc.maxlength + " imagenes."
                        ullisError.appendChild(lierror);
                        $(error).append(ullisError);
                        $(contenPreviw).append(error);
                    }
                }
                if (arrayError.length > 0) {
                    for (i = 0; i < arrayError.length; i++) {
                        var lierror = document.createElement("li");
                        lierror.innerHTML = arrayError[i];
                        ullisError.appendChild(lierror);
                    }
                    $(error).append(ullisError);
                    $(contenPreviw).append(error);
                }
                if (totalArchivos > 0) {
                    inputtextlabel.innerHTML = '<i class="fa fa-file" aria-hidden="true"></i> ' + totalArchivos + ' archivos selecionado(s)';
                }
            })
        })
        return this;
    }

    function eliminarImagen() {
        var element = this;
        $(element).parent().parent().remove();
        var key = $(this).data("key");
        var fileinput = $(this).data("padreid");
        var files = $("#" + fileinput).data("files");
        for (i = 0; i < files.length; i++) {
            if (files[i].key == key) {
                files.splice(i, 1);
                break;
            }
        }
        if (files.length > 0) {
            $("#" + fileinput).siblings(".input-text-label").html('<i class="fa fa-file" aria-hidden="true"></i> ' + files.length + ' archivos selecionado(s)')
        } else {
            $("#" + fileinput).siblings(".input-text-label").html('');
        }

        $("#" + fileinput).val("");
        $("#" + fileinput).data("files", files);
    }

    function simulaclick() {
        var fileinput = $(this).data("element");
        $("#" + fileinput).trigger('click');
    }


    function precargas( opcancho, opcalto, contenPreviw) {
        opcancho = 128;
        opcalto = 150;
        console.log(opcancho, opcalto);
        var divPreview = document.createElement('div');
        $(divPreview).addClass("div-preview-inpufile");
        $(divPreview).width(opcancho);
        $(divPreview).height(opcalto);
        var altoImagen = opcalto - 44;


        var CURRENT_URL = window.location.href;
        console.log(CURRENT_URL.split("/"));
        if(CURRENT_URL.split("/").length>4){
            imagen = new Image();
            imagen.src = "/image/temporalimagen.jpg";
            imagen.setAttribute("class", "img-thumb-preview-inpufile");
            imagen.width = "100%";
            imagen.height = altoImagen;
            $(divPreview).append(imagen);
        }
        else{$(divPreview).append('<img class="img-thumb-preview-inpufile" src="image/temporalimagen.jpg" title="" width="100%" height="' + altoImagen + '"/>');}
          //  imagen.src = "images/temporalimagen.jpg";


        var divAcciones = document.createElement('div');
        divAcciones.setAttribute("class", "div-acciones-preview-inpufile");
        divPreview.appendChild(divAcciones);
        contenPreviw.appendChild(divPreview);
    }

})(jQuery);
