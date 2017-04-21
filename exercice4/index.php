<!-- CONSIGNES :

Formulaire d'inscription de voiture dans la table voiture de la bdd mike


 -->

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Exercice 3</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    </head>
    <body>
        <div>
            <form class="form" method="post">
                <label for="marque">Marque : </label>
                <input type="text" name="marque" id="marque" value="">
                <br>
                <label for="modele">Modèle : </label>
                <input type="text" name="modele"  id="modele" value="">
                <br>
                <label for="annee">Année : </label>
                <select class=""  id="annee" name="annee">
                    <?php for ($i=1950; $i <= date('Y'); $i++) : ?>
                    <option value='<?= $i ?>'><?= $i ?></option>
                    <?php endfor; ?>
                </select>
                <br>
                <label for="couleur">Couleur : </label>
                <input type="color" name="couleur"  id="couleur" value="">
                <br>
                <input type="submit" name="soumission" value="envoyer">
            </form>
        </div>
        <div id="resultat">
        </div>
        <script>
            $(function(){
                $("form").submit(function(e){
                    // plein d'autres manières, par ex : $("input[type=submit]").submit(function(e){})
                    e.preventDefault();
                    // alert('Form soumis....');

                    var marque = $("#marque").val();
                    var modele = $("#modele").val();
                    var annee = $("#annee").val();
                    var couleur = $("#couleur").val();
                    // console.log(marque);

                    $.post("traitement.php", $('form').serialize()) // Manière raccourcie d'écrire une requête AJAX

                    .done(function(msg) {
                        $( "#resultat" ).html('le formulaire a été soumis et...'+msg);
                    })

                    .fail(function( jqXHR, textStatus ) {
                        alert( "Erreur : " + textStatus );
                    });
                });
            })
        </script>
    </body>
</html>
