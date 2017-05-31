$(window).on('load', function(){
    $.ajax({
        async: true,
        type: "POST",
        url: "../consultas/obtenerProductos.php",
        data: "tipo="+1,
        success: function(resp){
            $('#entrantes').attr('class', 'active');
            $('#ensaladas').attr('class', '');
            $('#carnes').attr('class', '');
            $('#pescados').attr('class', '');
            $('#bebidas').attr('class', '');
            $('#postres').attr('class', '');
            $('#ensaladas').empty();
            $('#carnes').empty();
            $('#pescados').empty();
            $('#bebidas').empty();
            $('#postres').empty();

            $('#entrantes').html(resp);
        }
    });

    $(document).ready(function() {
        $('#Modal').on('hidden.bs.modal', function () {
            $(this).removeData('bs.modal');
        });
    });
});

function ValidarEnsaladas(tipo) {
    $.ajax({
        async: true,
        type: "POST",
        url: "../consultas/obtenerProductos.php",
        data: "tipo="+tipo,
        success: function(resp){
            $('#ensaladas').attr('class', 'active');
            $('#entrantes').attr('class', '');
            $('#carnes').attr('class', '');
            $('#pescados').attr('class', '');
            $('#bebidas').attr('class', '');
            $('#postres').attr('class', '');
            $('#entrantes').empty();
            $('#carnes').empty();
            $('#pescados').empty();
            $('#bebidas').empty();
            $('#postres').empty();

            $('#ensaladas').html(resp);
        }
    });

    $(document).ready(function() {
        $('#Modal').on('hidden.bs.modal', function () {
            $(this).removeData('bs.modal');
        });
    });
}

function ValidarEntrantes(tipo) {
    $.ajax({
        async: true,
        type: "POST",
        url: "../consultas/obtenerProductos.php",
        data: "tipo="+tipo,
        success: function(resp){
            $('#entrantes').attr('class', 'active');
            $('#ensaladas').attr('class', '');
            $('#carnes').attr('class', '');
            $('#pescados').attr('class', '');
            $('#bebidas').attr('class', '');
            $('#postres').attr('class', '');
            $('#ensaladas').empty();
            $('#carnes').empty();
            $('#pescados').empty();
            $('#bebidas').empty();
            $('#postres').empty();

            $('#entrantes').html(resp);
        }
    });

    $(document).ready(function() {
        $('#Modal').on('hidden.bs.modal', function () {
            $(this).removeData('bs.modal');
        });
    });
}

function ValidarCarnes(tipo) {
    $.ajax({
        async: true,
        type: "POST",
        url: "../consultas/obtenerProductos.php",
        data: "tipo="+tipo,
        success: function(resp){
            $('#carnes').attr('class', 'active');
            $('#entrantes').attr('class', '');
            $('#ensaladas').attr('class', '');
            $('#pescados').attr('class', '');
            $('#bebidas').attr('class', '');
            $('#postres').attr('class', '');
            $('#entrantes').empty();
            $('#ensaladas').empty();
            $('#pescados').empty();
            $('#bebidas').empty();
            $('#postres').empty();

            $('#carnes').html(resp);
        }
    });

    $(document).ready(function() {
        $('#Modal').on('hidden.bs.modal', function () {
            $(this).removeData('bs.modal');
        });
    });
}

function ValidarPescados(tipo) {
    $.ajax({
        async: true,
        type: "POST",
        url: "../consultas/obtenerProductos.php",
        data: "tipo="+tipo,
        success: function(resp){
            $('#pescados').attr('class', 'active');
            $('#entrantes').attr('class', '');
            $('#carnes').attr('class', '');
            $('#ensaladas').attr('class', '');
            $('#bebidas').attr('class', '');
            $('#postres').attr('class', '');
            $('#entrantes').empty();
            $('#carnes').empty();
            $('#ensaladas').empty();
            $('#bebidas').empty();
            $('#postres').empty();

            $('#pescados').html(resp);
        }
    });

    $(document).ready(function() {
        $('#Modal').on('hidden.bs.modal', function () {
            $(this).removeData('bs.modal');
        });
    });
}

function ValidarBebidas(tipo) {
    $.ajax({
        async: true,
        type: "POST",
        url: "../consultas/obtenerProductos.php",
        data: "tipo="+tipo,
        success: function(resp){
            $('#bebidas').attr('class', 'active');
            $('#entrantes').attr('class', '');
            $('#carnes').attr('class', '');
            $('#pescados').attr('class', '');
            $('#ensaladas').attr('class', '');
            $('#postres').attr('class', '');
            $('#entrantes').empty();
            $('#carnes').empty();
            $('#pescados').empty();
            $('#ensaladas').empty();
            $('#postres').empty();

            $('#bebidas').html(resp);
        }
    });

    $(document).ready(function() {
        $('#Modal').on('hidden.bs.modal', function () {
            $(this).removeData('bs.modal');
        });
    });
}

function ValidarPostres(tipo) {
    $.ajax({
        async: true,
        type: "POST",
        url: "../consultas/obtenerProductos.php",
        data: "tipo="+tipo,
        success: function(resp){
            $('#postres').attr('class', 'active');
            $('#entrantes').attr('class', '');
            $('#carnes').attr('class', '');
            $('#pescados').attr('class', '');
            $('#bebidas').attr('class', '');
            $('#ensaladas').attr('class', '');
            $('#entrantes').empty();
            $('#carnes').empty();
            $('#pescados').empty();
            $('#bebidas').empty();
            $('#ensaladas').empty();

            $('#postres').html(resp);
        }
    });

    $(document).ready(function() {
        $('#Modal').on('hidden.bs.modal', function () {
            $(this).removeData('bs.modal');
        });
    });
}