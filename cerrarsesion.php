<?php
session_start();
session_destroy();
header('Location: /Administracion_reportes/Login.html');