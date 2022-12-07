<?php
session_start();

if(!isset($_SESSION['admin']))
{
    header('location: connexion.php');
    exit();
}

else $connexion = mysqli_connect('localhost', 'root', '', 'moduleconnexion');
//$connexion = mysqli_connect('localhost','mehdi','4Ar01e1_j','mehdi-douib_moduleconnexion') ;
    $requete = 'SELECT * FROM utilisateurs';
    $query = mysqli_query($connexion, $requete);

    $champs = mysqli_fetch_fields($query);
    
    $resultat = mysqli_fetch_assoc($query);
?>

 
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="module.css" />
        <title>Admin</title>
    </head>  
    <h1>page admin</h1>
    <?php
        include 'header.php';
    ?>
    <body class="bodyinscription">
       
           

        <main class="admin_page">
            <section class="boite_admin">
                <h1 class="head_admin">Toutes les infos de la base de donnée</h2>
                <?php 
                echo "<table border 5 style=width='300px;' class='liste'>";
                echo '<tr>';
                foreach ($champs as $champ ) 
                {
                echo "<td> $champ->name </td>" ;
                }
                echo '</tr>';
                
                while(($resultat = mysqli_fetch_assoc($query))!=null)
                {
                    echo '<tr>';
                    foreach ($resultat as $value)
                    {
                    echo '<td>' . $value . '</td>';
                    }
                    echo '</tr>';
                }
                echo '</table>';
                ?>
                <a style="color:white; text-decoration:none;" href="deconnexion.php">Deconnexion</a>
            </section>
        </main>

      
    
    </body>
    <?php
        include 'footer.php';
    ?>
        
</html>
