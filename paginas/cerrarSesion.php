<?php
session_start();
session_destroy();

header("Location: ../paginas/inicioSesion.php");
