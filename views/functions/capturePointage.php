<?php 
function capturePointage($bdd, $reqCaturePointage, $reqCaturePointageInfo){
    global $bdd, $reqCaturePointage, $reqCaturePointageInfo;
    while($reqCaturePointageInfo){
        echo "Nom : ".$reqCaturePointageInfo['nom_emp'];
        echo "Prénom : ".$reqCaturePointageInfo['prenom__emp'];
        echo "Heure Arrivée : ".$reqCaturePointageInfo['date_debut'];
        echo "Heure départ : ".$reqCaturePointageInfo['date_fin'];
    }
}
?>