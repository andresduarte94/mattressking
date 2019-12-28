$('.editarProducto').each(function () {
    $(this).validate({
        rules: {
            nombre: {required: true},
            categoria: {required: true},
            subcategoria: {required: true},
            precio: {required: true},
            cantidad: {required: true},
            descripcion: {
                required: true,
                maxlength: 1000
            }
        },
        messages: {
            nombre: {required: "Debe ingresar nombre del producto"},
            categoria: {required: "Debe ingresar categoria del producto"},
            subcategoria: {required: "Debe ingresar subcategoria del producto"},
            precio: {required: "Debe ingresar precio del producto"},
            cantidad: {required: "Debe ingresar cantidad en stock del producto"},
            descripcion: {
                required: "Debe ingresar una descripción del producto",
                maxlength: "Máximo 1000 caracteres"
            }
        },
    })
});

$('.usuario').each(function () {
    $(this).validate({
        rules: {
            nombre: {required: true},
            email: {required: true,
                email: true},
            pass: {required: true},
            tipo: {required: true},
        },
        messages: {
            nombre: {required: "Debe ingresar nombre del usuario"},
            tipo: {required: "Debe ingresar tipo de usuario"},
            pass: {required: "Debe ingresar contraseña"},
            email: {
                required: "Debe ingresar email del usuario",
                email: "El formato del email no es válido"
            }
        },
    })
});

$('.categoria').each(function () {
    $(this).validate({
        rules: {
            nombre: {required: true},
            descripcion: {required: true,
                maxlength: 1000},
        },
        messages: {
            nombre: {required: "Debe ingresar nombre de la categoria"},
            descripcion: {
                required: "Debe ingresar una descripción",
                maxlength: "Máximo 1000 caracteres"
            }
        },
    })
});

$('.subcategoria').each(function () {
    $(this).validate({
        rules: {
            nombre: {required: true},
            categoria: {required: true},
            descripcion: {required: true,
                maxlength: 1000},
        },
        messages: {
            nombre: {required: "Debe ingresar nombre de la categoria"},
            categoria: {required: "Debe seleccionar una categoria a relacionar"},
            descripcion: {
                required: "Debe ingresar una descripción",
                maxlength: "Máximo 1000 caracteres"
            }
        },
    })
});

$('.comentario').validate({
    ignore:'',
    rules: {
        valoracion: {required: true},
        comentario: {
            required: true,
            maxlength: 1000}
    },
    messages: {
        valoracion: {required: "Debe colocar una valoración."},
        comentario: {
            required: "&nbsp; Debe ingresar un comentario.",
            maxlength: "Máximo 1000 caracteres"
        }
    }
    ,
    errorLabelContainer: '.errorTxt'
});
