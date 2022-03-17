<?php
require('config/database.php');
$admin = intval($_GET['admin']);
//Choix du matricule
$choice = random_int(0, 9999);

//Test de l'existence des matricules
$reqUserMatExist = $bdd -> query("SELECT * FROM employe WHERE mat_emp = '$choice' ");
$nbUserMat = $reqUserMatExist -> rowCount();

echo $choice;
//Controle
if (isset($_POST['envoyer'])){
    if (!empty($_POST['nom'] && $_POST['prenom'] && $_POST['mdp'] && $_POST['mdpconf'])){
        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $mdp = htmlspecialchars($_POST['mdp']);
        $mdpconf = htmlspecialchars($_POST['mdpconf']);

        if ($mdp == $mdpconf){
            if ($nbUserMat == 0){
                $reqInsert = $bdd -> query("INSERT INTO employe (mat_emp, nom_emp, prenom_emp, mdp_emp) VALUES ('$choice', '$nom', '$prenom', '$mdp')");
                if ($reqInsert == true){
                    echo "<script>alert('Employe matricule $choice Enregistré')</script>";
                    header("Location: sign-in.php?admin=".$admin);
                }
                else{
                    echo "<script>alert('Erreur enregistrement non effectué')</script>";
                }
            }
            else{
                echo "<script>alert('Une erreur est survenue')</script>";
            }
        }
        else{
            $erreur = "Les mots de passe ne concordent pas";
        }
    }
    else{
        $erreur = "Veuillez complèter tous les champs";
    }
}
include('functions/errors.php');
include('views/sign-in.html');
?>