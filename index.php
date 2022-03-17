<?php
require('config/database.php');
$reqSelAllUser = $bdd -> query("SELECT * FROM employe");



function captureUser($reqSelAllUser){
    while ($userSelInfo = $reqSelAllUser -> fetch()){
        echo "<div class='card ' style='width: 18rem; margin-left: auto; margin-rigth: auto;' >";
        echo "<div class='card-body'>";
        echo " Nom : ".$userSelInfo['nom_emp']."<br>";
        echo "Prenom : ".$userSelInfo['prenom_emp']."<br>";
        echo "</div>";
        echo "</div>";
        echo "<div class='card-footer'>";
        echo "<a class='btn btn-primary' href='config/control.php?matricule=".$userSelInfo['mat_emp']."'>Pointer</a><br><br>";
        echo "</div><br>";
    }
    
    return $userSelInfo;
}
include('views/index.html');
