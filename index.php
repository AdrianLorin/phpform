<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Phpform</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>


        <div class="pageidentifiant">
            <form action='index.php' method='post'>
                <label>Identifiant de la Catégorie</label>
                <input style='width:173px; height:30px' type='text' name='shortname' required>
                <input name='bouttonconsulter' type=submit value='Consulter'>
            </form>

            <?php

                if (isset($_POST['shortname'])) {
                    $shortname = $_POST['shortname'];
                    print($shortname);
                

                echo "<table border>
                            <caption> <b> Identification </b> </caption>
                            <tr> <th> Shortname </th> <th> Longname </th> </tr>";
                                //--- Connection au SGBDR 
                                $DataBase = mysqli_connect ( "localhost" , "slamquiz" , "czWs2HqkVdJ6TQhA" ) ;

                                //--- Ouverture de la base de données
                                mysqli_select_db ( $DataBase, "slamquiz" ) ;

                                //--- Préparation de la requête
                                $Requete = "Select * From identification Where shortname='" . $_POST['shortname'] . "' ;" ;

                                //--- Exécution de la requête (fin du script possible sur erreur ...)
                                $Resultat = mysqli_query ( $DataBase, $Requete )  or  die(mysqli_error($DataBase) ) ;

                                //--- Enumération des lignes du résultat de la requête
                                while (  $ligne = mysqli_fetch_array($Resultat)  )
                                {
                                //--- Afficher une ligne du tableau HTML pour chaque enregistrement de la table 
                                echo "<tr>\n" ;
                                echo "<td>" . $ligne['shortname']       . "</td>\n" ;
                                echo "<td>" . $ligne['longname']    . "</td>\n" ;
                                echo "</tr>\n" ;
                                }

                                //--- Libérer l'espace mémoire du résultat de la requête
                                mysqli_free_result ( $Resultat ) ;

                                //--- Déconnection de la base de données
                                mysqli_close ( $DataBase ) ;
                echo "</table>";

                }

            ?>

        </div>

        <!--
            if (isset($_GET['shortname'])){

                $shortname=$_GET['shortname'];
                $longname=$_GET['longname'];

                //--- Connection au SGBDR 
                $DataBase = mysqli_connect ( "localhost" , "slamquizz" , "czWs2HqkVdJ6TQhA" ) ;

                //--- Ouverture de la base de données
                mysqli_select_db ( $DataBase, "BD_etudiants" ) ;

                //--- Préparation de la requête
                $Requete = "INSERT INTO identification(shortname,longname)
                            VALUES ('$shortname','$longname');" ;

                //--- Exécution de la requête (fin du script possible sur erreur ...)
                $Resultat = mysqli_query ( $DataBase, $Requete )  or  die(mysqli_error($DataBase) ) ;

                //--- Déconnection de la base de données
                mysqli_close ( $DataBase ) ;

            }
            
        
        -->
        
    </body>
</html>