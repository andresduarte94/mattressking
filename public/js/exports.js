$(document).ready (function () {

    $('#exportar').click(function () {
        console.log("exporting...");
        $('#compras').table2excel({
            name: "Compras",
            filename: "Compras", //do not include extension
        });
    });

    $('#exportar_ventas').click(function () {
        console.log("exporting...");
        $('#ventas').table2excel({
            name: "Ventas",
            filename: "Ventas", //do not include extension
        });
    });

    $('#exportar_cat').click(function () {
        console.log("exporting...");
        $('#categoriasAdmin').table2excel({
            name: "Categorias",
            filename: "Categorias", //do not include extension
        });
    });
    $('#exportar_sub').click(function () {
        console.log("exporting...");
        $('#subcategoriasAdmin').table2excel({
            name: "Subcategorias",
            filename: "Subcategorias", //do not include extension
        });
    });
    $('#exportar_user').click(function () {
        console.log("exporting...");
        $('#usersAdmin').table2excel({
            name: "Usuarios",
            filename: "Usuarios", //do not include extension
        });
    });

    $('#exportar_prod').click(function () {
        console.log("exporting...1");
        $('#productos').table2excel({
            exclude: ".noExl",
            name: "Productos",
            filename: "Productos", //do not include extension
        });
    });

    $('#exportar_prod2').click(function () {
        console.log("exporting...2");
        $('#productosAdmin').table2excel({
            exclude: ".noExl",
            name: "ProductosAdmin",
            filename: "ProductosAdmin", //do not include extension
        });
    });
    
});




