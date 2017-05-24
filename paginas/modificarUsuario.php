<?php
session_start();

?>
<script>
    function cambiarUsuario(oldUser, newUser) {
        $.ajax({
            async: true,
            type: "POST",
            url: "../consultas/modificarUsuario.php",
            data: "usuarioAntiguo="+oldUser+"&usuarioNuevo="+newUser,
            success: function(resp){
                $('#resultado').html(resp);
            }
        });
    }

    function volver(){
      $('#cuerpo').load('../paginas/consultarPerfil.php');
    }
</script>
<html lang="en">
    <div class="col-md-9 pull-md-right main-content">
        <div class="col-md-12 text-center"><h1><p>MODIFICAR USUARIO</p></h1></div>
        <form action="return false" onsubmit="return false" method="POST">
            <div class="row">
                <div class="col-md-6 form-group">
                    <div class="form-group">
                        <label for="usuarioAntiguo" class="control-label">Antiguo Usuario</label>
                        <input type="text" name="usuarioAntiguo" id="usuarioAntiguo" class="form-control" value="<?php echo $_SESSION["usuario"] ?>" disabled>
                    </div>
                </div>
                <div class="col-md-6 form-group">
                    <div class="form-group">
                        <label for="nuevoUsuario" class="control-label">Nuevo Usuario</label>
                        <input type="text" name="nuevoUsuario" id="nuevoUsuario" class="form-control" placeholder="Nuevo Usuario" required>
                    </div>
                </div>
            </div>
            <div class="col-md-12 " id="boton">
                <button class="btn btn-info" id="submit" onclick="cambiarUsuario(document.getElementById('usuarioAntiguo').value, document.getElementById('nuevoUsuario').value);">Modificar</button>
                <button class="btn btn-info" id="submit" onclick="volver();">Volver al Menu</button>
            </div>
            <div class="col-md-12 espacios" id="resultado"></div>
        </form>
    </div>
</html>
