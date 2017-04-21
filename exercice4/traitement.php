<?php
header("Access-Control-Allow-Origin:*");

// Print_r($_POST);

if(isset($_POST['marque']) && $_POST['modele'] && $_POST['annee'] && $_POST['couleur']){

    // On va vérifier la connexion à la base de donnée avec try/catch :
    try{
        $pdo = new PDO('mysql:host=localhost;dbname=Mike','root','',
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
    }
    catch(PDOException $e){ //$e pour erreur
        echo 'erreur';
    }

    $marque = $_POST['marque'];
    $modele = $_POST['modele'];
    $annee = $_POST['annee'];
    $couleur = $_POST['couleur'];

    $insertrequete = $pdo -> prepare("INSERT INTO `voiture`(`marque`, `modele`, `annee`, `couleur`) VALUES (:marque,:modele,:annee,:couleur)");
    $insertrequete -> bindParam(":marque",$_POST['marque']);
    $insertrequete -> bindParam(":modele",$_POST['modele']);
    $insertrequete -> bindParam(":annee",$_POST['annee']);
    $insertrequete -> bindParam(":couleur",$_POST['couleur']);
    $insertrequete -> execute();
    echo '<p style="green">la requête a été insérée en base</p>';
}
else {
    echo '<p style="red">la requête n\'a pas été insérée en base, merci de vérifier vos champs !</p>';
}

    // Requete d'affichage des données de la table, pour test :
    // $resultat -> execute();
    // $voiture = $resultat -> FETCHAll(PDO::FETCH_ASSOC);
    // print_r($voiture);

?>
