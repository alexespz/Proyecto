<?php
session_start();
include_once '../procedimientos/procedimientos.php';
include_once '../consultas/obtenerPerfil.php';

?>
<script>
    function modificarUsuario(user) {
        $.ajax({
            async: true,
            type: "POST",
            url: "../paginas/modificarUsuario.php",
            data: "usuario="+user,
            success: function(resp){
                $('#cuerpo').load("modificarUsuario.php");
            }
        });
    }
    
    function modificarPerfil(nombre, apellidos, email, telefono, sexo, dni, submit) {
        $.ajax({
            async: true,
            type: "POST",
            url: "../paginas/modificarPerfil.php",
            data: "nombre="+nombre+"&apellidos="+apellidos+"&email="+email+"&telefono="+telefono+"&sexo="+sexo+"&dni="+dni+"&submit="+submit,
            success: function(resp){
                $('#cuerpo').load("modificarPerfil.php");
            }
        });
    }
</script>
<html lang="en">
    <div class="col-md-9 pull-md-right main-content">
        <div class="col-md-12 text-center"><h1><p>PERFIL PERSONAL</p></h1></div>
        <form action="return false" onsubmit="return false" method="POST">
            <div class="row">
                <div class="col-md-6 form-group">
                    <div class="form-group">
                        <label for="nombre" class="control-label">Nombre</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo $nombre ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="email" class="control-label">Dirección email</label>
                        <input type="text" name="email" id="email" class="form-control" value="<?php echo $email ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="sexo" class="control-label">Sexo</label>
                        <?php if($sexo == 'H'){
                            $sexo = "Hombre";
                        }else{
                            $sexo = "Mujer";
                        }?>
                        <input type="text" name="sexo" id="sexo" class="form-control" value="<?php echo $sexo ?>" disabled>
                    </div>
                </div>
                <div class="col-md-6 form-group">
                    <div class="form-group">
                        <label for="apellidos" class="control-label">Apellidos</label>
                        <input type="text" name="apellidos" id="apellidos" class="form-control" value="<?php echo $apellidos ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="telefono" class="control-label">Telefono</label>
                        <input type="text" name="telefono" id="telefono" class="form-control" value="<?php echo $telefono ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="dni" class="control-label">DNI</label>
                        <input type="text" name="dni" id="dni" class="form-control" value="<?php echo $dni ?>" disabled>
                    </div>
                </div>
                <div class="divider"></div>
                <div class="col-md-8 form-group">
                    <div class="form-group">
                        <label for="usuario" class="control-label">Usuario</label>
                        <input type="text" name="usuario" id="usuario" class="form-control" value="<?php echo $usuario ?>" disabled>
                    </div>
                </div>
                <div class="col-md-4 form-group">
                    <div class="form-group">
                        <button class="btn btn-info" style="margin-top: 25px;" onclick="modificarUsuario(document.getElementById('usuario').value);">Cambiar usuario</button>
                    </div>
                </div>
            </div>
            <div class="col-md-12 " id="boton">
                <!--<button class="btn btn-info" id="submit" onclick="modificarPerfil(document.getElementById('nombre').value, document.getElementById('apellidos').value, document.getElementById('email').value, document.getElementById('telefono').value, document.getElementById('sexo').value, document.getElementById('dni').value, document.getElementById('submit').value);">Modificar datos</button>-->
            </div>
            <div class="col-md-12 espacios" id="resultado"></div>
        </form>
    </div>
</html>
