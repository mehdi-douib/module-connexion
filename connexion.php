
    <?php
session_start();

if(isset($_POST['submit']))
{
    if(!empty($_POST))
    {
        $login = $_POST['login'];
        $password= $_POST['password'];
        $connexion= mysqli_connect('localhost','root','','moduleconnexion');
       
        //$connexion = mysqli_connect('localhost','mehdi','4Ar01e1_j','mehdi-douib_moduleconnexion') ;

        //on va utiliser num_rows pour verifier que l'utilisateur existe
        $resultat = mysqli_num_rows($requete);

        //on fait un fetch row pour recup la ligne
        $resultat2 = mysqli_fetch_row($requete);

        //Decryptage du password
        $verify = password_verify($password, $resultat2[1]);
    }

    //si verify existe
    if($verify==true)
    {
        if($resultat2[0]=='admin') //on verifie seulement le login puisque le password à deja été verifié
        {
            // session_start();
            $_SESSION['admin'] = 'admin';
            header('location: admin.php');
            exit();
        }

        if($resultat==1);
        {
            // session_start();
            $_SESSION['connexion'] =  $login ;
            header('location: profil.php');
            exit();
        }

    }
}

?>
       

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="module.css" />
        <title>Connexion</title>
        <h1>connexion</h1>
    <?php
        include 'header.php';
    ?>
    
        <main class="main_ins">
            <section class="boite_ins">
                <form class="form_ins"  method="post">
                    <article class="pseudo_ins">
                        <label for="pseudo"> Pseudo :</label>
                        <input type="text" id="pseudo" name="login" required>
                    </article>
                    <article class="mp_ins">
                        <label for="motdepasse"> Mot de passe :</label>
                        <input type="password" id="motdepasse" name="password" required>
                    </article>
                    <article class="button_ins">
                        <button type="submit" name="submit" >Valider</button>
                    </article>
                </form>
                    <article class="linkcreate">
                        <a style="color:white; text-decoration:none;" class="boutton_nav" href="inscription.php">Créer un compte</a><br/>
                        <a style="color:white; text-decoration:none;" class="boutton_nav" href="index.php">Retour accueil</a>
                    </article>
            </section>
        </main>

        <?php
        include 'footer.php';
    ?>

    </body>
</html>