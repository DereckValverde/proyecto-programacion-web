<?php
session_start();
session_destroy();
header('Location: /proyecto-programacion-web/frontend/pages/admin/login.php');
exit;
