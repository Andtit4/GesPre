<?php
require('../config/database.php');
$today = date("Y-m-d");

$id_admin = intval($_GET['admin']);
$reqSelectAdmin = $bdd -> query("SELECT * FROM pointage , employe WHERE pointage.mat_emp = employe.mat_emp AND pointage.date_pointage = '$today'");




require('../views/admin.index.html');
?>