<?php


 ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <title></title>
    </head>
    <body>
        <div id="table">


        </div>
        <script>
            $(function(){
                var api = $.ajax({
                    method: "GET",
                    url: "http://jsonplaceholder.typicode.com/users",
                });

                api.done(function( msg ) {
                    console.log(msg);

                    var table = '<table>';
                    table += '<tr>';

                    $.each(msg[0], function(index, value){
                        if(index == "name" || index == "username" || index == "email" || index == "phone" || index == "company"){
                            table += "<th>";
                            table += index;
                            table += "</th>";
                        }
                    });

                    table += "</tr>";

                    for (var i = 0 ; i < msg.length; i++){
                        table += '<tr>';
                        $.each(msg[i], function(index,value){
                            table += '<td>';
                            if(index == "company"){
                                table += value.name;
                            }
                            else{
                                table += value;
                            }
                            table += '</td>';
                        })
                        table += '</tr>';
                    }

                    table += '</table>';
                    $('#table').html(table);
                    // console.log( JSON.stringify(msg) );

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
        </script>
    </body>
</html>
