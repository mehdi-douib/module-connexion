<?php

if(isset($_POST['submit']))
{   
    $login = $_POST['login'];
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    if($login && $prenom && $nom && $password)
    {

        if($password==$password2)
        {
            //hachage du password
            $password3 = password_hash($password, PASSWORD_BCRYPT, array('cost' =>10 ));

            $connexion = mysqli_connect("localhost","root","","moduleconnexion");
            //$connexion = mysqli_connect('localhost','mehdi','4Ar01e1_j','mehdi-douib_moduleconnexion') ;

            $reget = ("SELECT * FROM utilisateurs WHERE login='$login' ");
            $regetx = mysqli_query($connexion, $reget);
            $row = mysqli_num_rows($regetx);
           
            if($row==0)
            {
            $requete = ("INSERT INTO utilisateurs (`login`, `prenom`, `nom`, `password`) VALUE ('$login','$prenom','$nom','$password3')");
            $query = mysqli_query($connexion, $requete);
            header('location: connexion.php');
            }
            else echo "<p style='color: white'>" . "Ce pseudo existe deja". "</p>";
        }
        else echo "<p style='color: white'>" . "les deux mots de passe doivent être identiques". "</p>";
    }
    else $erreur= 'renseignez tous les champs';
}


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="module.css" />
        <title>Inscription</title>
    </head>  

   <h1>inscription</h1>
    <?php
        include 'header.php';
    ?>
    
    <body class="bodyinscription">
        <main class="main_ins">
            <section class="boite_ins">
                <form class="form_ins"  method="post">
                    <article class="pseudo_ins">
                        <label for="login">Votre pseudo :</label>
                        <input type="text" id="login" name="login" >
                    </article>
                    <article class="firstName_ins">
                        <label for="enterFirstName">Prénom :</label>
                        <input type="text" id="enterFirstName" name="prenom" >
                    </article>
                    <article class="lastName_ins">
                        <label for="enterLastName">Nom :</label>
                        <input type="text" id="enterLastName" name="nom" >
                    </article>
                    <article class="mp_ins">
                        <label for="enterMp">Mot de passe : </label>
                        <input type="password" id="enterMp" name="password" >
                    </article>    
                    <article class="mp_ins">
                        <label for="confirmMp">Confirmez votre mot de passe :</label>
                        <input type="password" id="confirmMp" name="password2" >
                    </article>  
                    <article class="button_ins">
                        <button type="submit" value="Submit"  name="submit">Valider</button><br/>
                        <a style="color:white; text-decoration:none;" class="boutton_nav" href="index.php">Retour accueil</a>
                        <?php if(isset($erreur)){echo $erreur;}?>
                    </article>
                </form>
            </section>
        </main>

        <?php
        include 'footer.php';
    ?>
        
    
    </body>
</html>