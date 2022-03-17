<?php
require('../config/database.php');
if (isset($_POST['recherche'])){
    if (!empty($_POST['date_src'])){
        $date_src = htmlspecialchars($_POST['date_src']);
        $reqSelectAdmin = $bdd -> query("SELECT * FROM pointage , employe WHERE pointage.mat_emp = employe.mat_emp AND pointage.date_pointage = '$date_src'");
        $nbValue = $reqSelectAdmin -> rowCount();

        if ($nbValue == 0){
            echo "<script>alert('Aucun enregistrement à cette date')</script>";
        }
        elseif ($nbValue >= 1) {
            $activate = true;
            echo "<script>alert('Liste de pésence du $date_src')</script>";
            
        }

    }
    else{
        echo "<script>alert('Veuillez insérer la date')</script>";
    }
}

require('../views/admin.index.html');
?>