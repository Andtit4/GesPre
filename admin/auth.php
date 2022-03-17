<?php 
session_start();
require('../config/database.php');
if (isset($_POST['connexion'])){
    if (!empty($_POST['pseudo'] && $_POST['pass'])){
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $pass = htmlspecialchars($_POST['pass']);

        $reqSelectAdmin = $bdd -> query("SELECT * FROM admins WHERE nom_admin = '$pseudo' AND mdp_admin = '$pass' ");
        $adminExist = $reqSelectAdmin -> rowCount();
        
        if ($adminExist == 1)
        {
            $adminInfo = $reqSelectAdmin -> fetch();
            $_SESSION['id_admin'] = $adminInfo['id_admin'];
            
            header("Location: admin.index.php?admin=".$_SESSION['id_admin']);
        }
    }
    else
    {
        echo "<script>alert('Veuillez remplir tous les champs')</script>";
    }
}
require ('../views/functions/errors.php');
require('../views/admin.login.html');
