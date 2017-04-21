<?php
header("Access-Control-Allow-Origin:*");

$pdo = new PDO('mysql:host=localhost;dbname=Mike','root','',
array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

$resultat = $pdo -> prepare("SELECT * FROM utilisateurs");
$resultat -> execute();
$utilisateurs = $resultat -> FETCHAll(PDO::FETCH_ASSOC);
// echo json_encode($utilisateurs);

// var_dump($utilisateurs);

// $tableau ="<table><tr><th>ID</th><th>Nom</th><th>Prneom</th><th>poste</th><th>Date Create</th></tr>";

// 1. AVEC LE FETCH ASSOC en ligne 10 :
$tableau = '<table border "1">';
     $tableau .= '<tr>';
         for($i=0; $i < $resultat -> columnCount(); $i++){
             $meta = $resultat -> getColumnMeta($i);
             $tableau .= '<th>'.$meta['name'].'</th>';
        }
        $tableau.= '</tr>';

// Autre méthode pour récupérer les entetes :

// $tableau = '<table><tr>';
// foreach ($utilisateurs[0] as $key => $value) {
//     $tableau .='<th>'.$key.'</th>';
// }
// $tableau.='</tr>';

// Essai avec un for :
// $tableau = '<table><tr>';
// for ($i=0; $i < count($utilisateurs); $i++) {
//     $tableau .='<th>'.key($utilisateurs[$i]).'</th>';
// }
// $tableau.='</tr>';

foreach ($utilisateurs as $key => $value) {
    $tableau .='<tr>';
    foreach ($utilisateurs[$key] as $key => $value) {
        $tableau .= "<td>".$value."</td>";
    }
    $tableau.='</tr>';
}

// 2. SANS LE FETCH ASSOC en ligne 10  :

// Tableau statique :
// while ($utilisateurs = $resultat -> fetchAll()) {
//     $tableau .= "<tr>";
//     $tableau .= "<td>".$utilisateurs[0]['id']."</td>";
//     $tableau .= "<td>".$utilisateurs[0]['nom']."</td>";
//     $tableau .= "<td>".$utilisateurs[0]['prenom']."</td>";
//     $tableau .= "<td>".$utilisateurs[0]['poste']."</td>";
//     $tableau .= "<td>".$utilisateurs[0]['date_create']."</td>";
//     $tableau .= "</tr>";
//     $tableau .= "</table>";
// }
//
// Boucle While :
// while($utilisateurs = $resultat -> FETCH(PDO::FETCH_ASSOC)){
//     $tableau .= '<tr>';
//         foreach($utilisateurs as $key => $value){
//         $tableau .= '<td>'.$value.'</td>';
//        }
//        $tableau .='</tr>';
//    }

echo $tableau;

 ?>
