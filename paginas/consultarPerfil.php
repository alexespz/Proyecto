<?php
session_start();
include_once '../procedimientos/procedimientos.php';
include_once '../consultas/obtenerPerfil.php';

?>
<html lang="en">
    <div class="col-md-9 pull-md-right main-content">
        <div class="col-md-12 text-center"><h1><p>PERFIL PERSONAL</p></h1></div>
        <form action="return false" onsubmit="return false" method="POST">
            <div class="row">
                <div class="col-md-6 form-group">
                    <div class="form-group">
                        <label for="nombre" class="control-label">Nombre</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" maxlength="20" value="<?php echo $nombre ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="email" class="control-label">Dirección email</label>
                        <input type="text" name="email" id="email" class="form-control" placeholder="Correo electrónico *" maxlength="60" required>
                    </div>
                    <div class="form-group">
                        <label for="sexo" class="control-label">Sexo</label>
                        <select name="sexo" class="form-control" id="sexo" required>
                            <option value="Hombre">Hombre</option>
                            <option value="Mejer">Mujer</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6 form-group">
                    <div class="form-group">
                        <label for="apellidos" class="control-label">Apellidos</label>
                        <input type="text" name="apellidos" id="apellidos" class="form-control" placeholder="Apellidos *" maxlength="40" required>
                    </div>
                    <div class="form-group">
                        <label for="telefono" class="control-label">Telefono</label>
                        <input type="text" name="telefono" id="telefono" class="form-control" placeholder="Telefono *" maxlength="9" required>
                    </div>
                    <div class="form-group">
                        <label for="dni" class="control-label">DNI</label>
                        <input type="text" name="dni" id="dni" class="form-control" placeholder="DNI *" maxlength="9" required>
                    </div>
                </div>
                <div class="divider"></div>
                <div class="col-md-8 form-group">
                    <div class="form-group">
                        <label for="usuario" class="control-label">Usuario</label>
                        <input type="text" name="usuario" id="usuario" class="form-control" placeholder="Usuario *" maxlength="25" required>
                    </div>
                </div>
                <div class="col-md-4 form-group">
                    <div class="form-group">
                        <button class="btn btn-info" id="submit" style="margin-top: 25px;" onclick="">Modificar usuario</button>
                    </div>
                </div>
            </div>

            </div>
            <div class="col-md-12 " id="boton">
                <button class="btn btn-info" id="submit" onclick="Validar(document.getElementById('nombre').value, document.getElementById('apellidos').value, document.getElementById('email').value, document.getElementById('telefono').value, document.getElementById('sexo').value, document.getElementById('dni').value, document.getElementById('usuario').value, document.getElementById('contrasenia').value, document.getElementById('contrasenia2').value, document.getElementById('submit').value);">Entrar</button>
            </div>
            <div class="col-md-12 espacios" id="resultado"></div>
        </form>
    </div>
</html>
