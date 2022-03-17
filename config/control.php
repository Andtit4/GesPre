<?php
session_start();
require('database.php');
include('functions/success.php');
$today = date("Y-m-d");
echo $today;
$idPointage = random_int(0, 9999);
$matricule = intval($_GET['matricule']);


//Controle du cas pointage deja effectué
$reqPointage = $bdd->query("SELECT * FROM pointage WHERE mat_emp = '$matricule' ");
$pointageInfo = $reqPointage->fetch();

if (isset($pointageInfo['heure_depart'])) {
    if (!empty($pointageInfo['heure_depart'])) {
        $heureDepart = $pointageInfo['heure_depart'];
    }
}

//Départ
$reqDejaPointeDepart = $bdd->prepare("SELECT * FROM pointage WHERE   mat_emp = ? AND heure_depart = ? AND date_pointage = ?");
$reqDejaPointeDepart->execute(array($matricule, $heureDepart, $today));
$nbDeJaPointeDepart = $reqDejaPointeDepart->rowCount();




$reqDejaPointeArrive = $bdd->prepare("SELECT * FROM pointage WHERE   mat_emp = ? AND date_pointage = ?");
$reqDejaPointeArrive->execute(array($matricule, $today));
$nbDeJaPointeArrive = $reqDejaPointeArrive->rowCount();



if (isset($_POST['envoyer'])) {
    if ($reqDejaPointeArrive == false) {
        echo "Une erreur s'est produite";
    } else {

        if ($nbDeJaPointeArrive == 1) {
            $success = "Vous avez déja pointé votre arrivé !";
            echo "<script>alert('$success')</script>";
        } else {
            if (!empty($_POST['pass'])) {
                $pass = htmlspecialchars($_POST['pass']);
                $reqSelVerEmp = $bdd->query("SELECT * FROM employe WHERE mdp_emp = '$pass' AND mat_emp = '$matricule' ");
                $nbEmp = $reqSelVerEmp->rowCount();
                if ($nbEmp == 1) {

                    $reqPoint = $bdd->query("INSERT INTO pointage (id_point, heure_arrive, mat_emp, date_pointage) VALUES ('$idPointage', NOW(), '$matricule', NOW()) ");
                    $success = "Pointage effectué ! Bienvenu";
                    echo "<script>alert('$success')</script>";
                } else {
                    $erreur = "Mot de passe incorrect";
                    echo "<script>alert('$erreur')</script>";
                }
            }
        }
    }
}


if (isset($_POST['depart'])) {
    if ($reqDejaPointeDepart == false) {
        echo "Une erreur s'est produite";
    } else {

        if ($nbDeJaPointeDepart == 1) {
            $success = "Vous avez déja pointé votre départ !";
            echo "<script>alert('$success')</script>";
        } else {
            if (!empty($_POST['pass'])) {
                $pass = htmlspecialchars($_POST['pass']);
                $reqSelVerEmp = $bdd->query("SELECT * FROM employe WHERE mdp_emp = '$pass' AND mat_emp = '$matricule' ");
                $nbEmp = $reqSelVerEmp->rowCount();
                if ($nbEmp == 1) {

                    $reqPoint = $bdd->query("UPDATE pointage SET heure_depart = NOW()  WHERE mat_emp = '$matricule' ");
                    $success = "Pointage effectué ! Au revoir";
                    echo "<script>alert('$success')</script>";
                } else {
                    $erreur = "Mot de passe incorrect";
                    echo "<script>alert('$erreur')</script>";
                }
            }
        }
    }
}







//Deja pointé
if (isset($heureArrive)) {
    if (isset($today)) {
    }
}
if (isset($reqDejaPointeArrive)) {
    if (isset($heureDepart)) {
        $reqDejaPointeDepart = $bdd->query("SELECT * FROM pointage WHERE heure_depart = '$heureDepart' AND heure_arrive = '$dateDebutPointageEmp' AND mat_emp = '$matricule' AND date_pointage = '$datePointage' ");
    }
}

//$reqDejaPointeValue = $reqDejaPointe -> rowCount();

//Début



//Départ


include('../functions/errors.php');
include('../views/control.html');
