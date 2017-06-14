<?php
session_start();

?>
<html lang="en">
<div class="col-md-9 pull-md-right main-content">
    <div class="col-md-12 text-center"><h1><p>MODIFICAR CONTRASEÑA</p></h1></div>
    <form action="return false" onsubmit="return false" method="POST">
        <div class="row">
            <div class="col-md-6 form-group">
                <div class="form-group">
                    <label for="nuevaContrasena" class="control-label">Nueva Contraseña</label>
                    <input type="password" name="nuevaContrasena" id="nuevaContrasena" class="form-control">
                </div>
            </div>
            <div class="col-md-6 form-group">
                <div class="form-group">
                    <label for="repetirContrasena" class="control-label">Repite Contraseña</label>
                    <input type="password" name="repetirContrasena" id="repetirContrasena" class="form-control">
                </div>
            </div>
        </div>
        <div class="col-md-12 " id="boton">
            <button class="btn btn-info" id="submit" onclick="cambiarContrasena(document.getElementById('nuevaContrasena').value, document.getElementById('repetirContrasena').value);">Modificar</button>
            <button class="btn btn-info" id="submit" onclick="volver();">Volver al Menu</button>
        </div>
        <div class="col-md-12 espacios" id="resultado"></div>
    </form>
</div>
</html>
