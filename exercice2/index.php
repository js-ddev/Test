<!-- CONSIGNES :

http://jsonplaceholder.typicode.com/users

1. Tableau : afficher un tableau avec :
name
username
email
phone
company name

2. Si on clique sur le nom d'utilisateur on affiche toutes ses informations

 -->

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <title></title>
    </head>
    <body>
        <div id="table"> <!-- Tableau de tous les utilisateurs -->
        </div>
        <div id="infos"> <!-- Tableau de l'utilisateur sélectionné -->
        </div>
        <script>
            $(function(){ // Start document.ready en Jquery


                // Requete Ajax pour récupérer les utilisateurs, retour en Array JSON :
                $(function(){
                    var api = $.ajax({ // Possible d'écrire sans variable : remplacer api. par le . seul
                        url: "http://jsonplaceholder.typicode.com/users",
                        method: "GET", // On récupère la data de la page, même s'il n'y a pas de paramètre dans l'url
                    });

                    api.done(function( msg ) { // En cas de réussite on stocke le retour dans la variable msf
                        // console.log(msg);

                        var table = '<table>'; // Init variable table
                        table += '<tr>';

                        // 1ère boucle pour récupérer les titres. En bouclant sur le premier élément de la réponse msg[0] on récupère les key de l'objet.
                        $.each(msg[0], function(index, value){
                            if(index == "name" || index == "username" || index == "email" || index == "phone" || index == "company"){
                                table += "<th>";
                                table += index;
                                table += "</th>";
                            }
                        });


                        // 2ème boucle : parcours toutes les lignes du tableau
                        //                       |id|name|  phone  |
                        // première itération -> |1 |Mike|012344433|
                        // deuxième itération -> |2 |Bob |063323344|
                        table += "</tr>";
                        for (var i = 0 ; i < msg.length; i++){
                            table += '<tr>';

                            // 3ème boucle : parcours chaque colonne du tableau
                            // première itération
                            //       |           deuxième itération
                            //       V                  |
                            // |1 |Mike|                V
                            //                      |063323344|
                            $.each(msg[i], function(index,value){
                                if(index == "name" || index == "username" || index == "email" || index == "phone" || index == "company"){
                                    if(index == 'name'){ // Si l'index est "name" alors on ajoute une balise 'a'
                                        table += "<td><a href='#'>";
                                        // Pour faire un url avec l'id de l'utilisateur :
                                        // var id = msg[i].id;
                                        // table += "<td><a href='"+id+"'>";

                                        table += value;
                                        table += "</a></td>";
                                    }
                                    else{
                                        table += '<td>';
                                        if(index == "company"){ // Company est un objet dans le premier objet
                                            table += value.name;
                                        }
                                        else{
                                            table += value;
                                        }
                                        table += '</td>';
                                    }
                                }
                            })
                            table += '</tr>';
                        }


                        table += '</table>';
                        $('#table').html(table); // Affiche le tableau dans la balise d'id "table"

                        $('a').click(function(event){ // Evenement Jquery qui se declenche au click sur la balise a. event stocke l'événement
                            event.preventDefault();
                                var nameUser = $(this).text();

                                var request = $.ajax ({
                                    url: "http://jsonplaceholder.typicode.com/users",
                                    method: "GET",
                                })

                                request.done(function(msg2) {
                                    newTable = ""
                                    for (var i = 0; i < msg2.length; i++) {
                                        console.log()

                                        if (msg2[i].name == nameUser) {
                                            newTable = "<table border='2'><tr>";

                                            $.each(msg2[i], function(index, value) {

                                                newTable += "<td>";
                                                if (index == "company") {
                                                    newTable += value.name;
                                                } else if (index == "address") {
                                                    newTable += value.street + " " + value.suite + " " + value.city + " " + value.zipcode;
                                                } else {
                                                    newTable += value;
                                                }
                                                newTable += "</td>";
                                            })

                                            newTable += "</tr></table>";
                                        }
                                    }
                                    
                                    $("#infos").html(newTable);
                                })

                            })



                        // Ma tentative de création du tableau utilisateur
                        // $('a').click(function(event){ // Evenement Jquery qui se declenche au click sur la balise a. event stocke l'événement
                        //     event.preventDefault();
                        //     // Fonctionne pas, je récupère que 1...
                        //     var id = $('a').attr('href');
                        //         console.log(id);
                        // })

                        // ESSAI D'AFFICHAGE DU TABLEAU :
                        // var table = '<table border "1"><tr>';
                        // for( var i=0; i < msg.length; i+=1 ) {
                        // 	table = table + msg[i].id + msg[i].name
                        //     // document.body.innerHTML = table ;
                        //     $("#table").html(table);
                        // }
                        // var table = table + '</tr></table>';

                        // for( var i in msg) {
                        //     $("#table").html(msg[i].id + msg[i].name);
                        // }
                    });

                    api.fail(function(XPDDR, data ) {
                        alert("Request fail !");
                    });
                });
            }) // End document ready jquery
        </script>
    </body>
</html>
