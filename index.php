<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Phpform</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body class='page'>
        <center>

        <div class="pageidentifiant">
            <form action='index.php' method='post'>
                <br>
                <h1>Identifiant de la Catégorie</h1>
                <br>
                <br>
                <input style='width:173px; height:30px' type='text' name='shortname' required>
                <br>
                <br>
                <input class='bouttonconsulter' type=submit value='Consulter'>
                <br>
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
                                $Requete = "Select * From identification Where shortname Like '%" . $_POST['shortname'] . "%' ;" ;

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
            <br>
            <br>
            <br>
        </div>
        <div class="interface">
            <br>
            <br>
            <br>
            <form action='index.php'>
                <br>
                <h1>Ajouter à la base de donnée</h1>
                <br>
                <br>
                <table cellspacing='15'>
                    <tr>
                        <td> Shortname </td>
                        <td><input style='width:173px; height:30px' type='text'      name='shortname1' required></td>
                    </tr>
                    <tr>    
                        <td> Longname </td>
                        <td><textarea style='width:173px'           type='textarea'  name='longname1'  required></textarea></td>
                    </tr>   
                </table>
                <br>
                <input class='bouttonajouter' type=submit value='Ajouter'>
                
            </form>

            <?php
            if (isset($_GET['shortname1'])){
                if (isset($_GET['longname1'])){

                    $shortname1=$_GET['shortname1'];
                    $longname1=$_GET['longname1'];

                    //--- Connection au SGBDR 
                    $DataBase1 = mysqli_connect ( "localhost" , "slamquiz" , "czWs2HqkVdJ6TQhA" ) ;

                    //--- Ouverture de la base de données
                    mysqli_select_db ( $DataBase1, "slamquiz" ) ;

                    //--- Préparation de la requête
                    $Requete1 = "INSERT INTO identification(shortname,longname)
                                VALUES ('$shortname1','$longname1');" ;

                    //--- Exécution de la requête (fin du script possible sur erreur ...)
                    $Resultat1 = mysqli_query ( $DataBase1, $Requete1 )  or  die(mysqli_error($DataBase1) ) ;

                    //--- Déconnection de la base de données
                    mysqli_close ( $DataBase1 ) ;

                    header('Location: index.php');
                    
                }
            }
        
            ?>
        </div>
            
        </center>
        
        
    </body>
</html>