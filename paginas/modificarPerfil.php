<?php
session_start();
include_once '../procedimientos/procedimientos.php';
include_once '../consultas/perfil/obtenerPerfil.php';

?>
<html lang="en">
<script src="../sources/ajaxPerfil.js"></script>
<div class="col-md-9 pull-md-right main-content">
    <div class="col-md-12 text-center"><h1><p>PERFIL PERSONAL</p></h1></div>
    <form action="return false" onsubmit="return false" method="POST">
        <div class="row">
            <div class="col-md-6 form-group">
                <div class="form-group">
                    <label for="nombre" class="control-label">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" placeholder="<?php echo $nombre ?>">
                </div>
                <div class="form-group">
                    <label for="email" class="control-label">Dirección email</label>
                    <input type="text" name="email" id="email" class="form-control" placeholder="<?php echo $email ?>">
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
                    <input type="text" name="apellidos" id="apellidos" class="form-control" placeholder="<?php echo $apellidos ?>">
                </div>
                <div class="form-group">
                    <label for="telefono" class="control-label">Telefono</label>
                    <input type="text" name="telefono" id="telefono" class="form-control" placeholder="<?php echo $telefono ?>">
                </div>
                <div class="form-group">
                    <label for="dni" class="control-label">DNI</label>
                    <input type="text" name="dni" id="dni" class="form-control" placeholder="<?php echo $dni ?>">
                </div>
            </div>
        </div>
        <div class="col-md-12 " id="boton">
            <button class="btn btn-info" id="submit" onclick="modificarPerfil($('#nombre').val(), $('#apellidos').val(), $('#email').val(), $('#telefono').val(), $('#sexo').val(), $('#dni').val());">Modificar datos</button>
        </div>
        <div class="col-md-12 espacios" id="resultado"></div>
    </form>
</div>
</html>
