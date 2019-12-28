$(function () {
    $('#nuevoProd').validate({
        rules: {
            nombre: { required: true },
            categoria: { required: true },
            subcategoria: { required: true },
            precio: { required: true },
            cantidad: { required: true },
            imagen: { required: true },
            descripcion: {
                required: true,
                maxlength: 1000
            }
        },
        messages: {
            nombre: { required: "Debe ingresar nombre del producto" },
            categoria: { required: "Debe ingresar categoria del producto" },
            subcategoria: { required: "Debe ingresar subcategoria del producto" },
            precio: { required: "Debe ingresar precio del producto" },
            cantidad: { required: "Debe ingresar cantidad en stock del producto" },
            imagen: { required: "Debe ingresar imagen del producto" },
            descripcion: {
                required: "Debe ingresar una descripción del producto",
                maxlength: "Máximo 1000 caracteres"
            }
        },
    });
})


