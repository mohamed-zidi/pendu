<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    include "header.php";
    ?>
    <main>

        <?php
            include "Game.php";
            session_start();
            $fichier = file("mots.txt");
            $lettres = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
            $game = new Pendu;
            $game->choseWord($fichier);  /*Recuperation d'un mot au hasard dans le fichier mots.txt */
            $maj = strtoupper($_SESSION["word"]); /* mot en maj */
            $mot = $game->normalCharacter($maj); /* enlever les charactères speciaux et mettre dans une variable */

            $_SESSION['true'] = 0;
            $_SESSION['false'] = 0;
            

            if(!isset($_SESSION['victoires'])){
                $_SESSION['victoires'] = 0;
                $victoires = $_SESSION['victoires'];
            }


            if(empty($_GET)){

                // Si je n'ai rien dans l'url affichage index hors jeu
                $game->Index();


            } elseif(!empty($_GET) && $_GET['etat']=='play'){ /** Si j'ai ce qu'il faut dans l'url affichage */
                
                


                if(isset($_POST['lettres'])){
    
                    $game->lettresJouees();
                }


                if(!empty($_SESSION['played'])){

                    $game->mauvaisesLettres($mot);
                    
                }

                ?>
                <form action="" method="post">
                    <?php $game->Affichage($lettres); ?>
                </form>
                <?php  

                $game->bonnesLettres($mot);
                $hang = $_SESSION['false'] -1;
                echo '<img src="img/Hangman-'.$hang.'.png"';
                $false=$_SESSION['false'];
                $true=$_SESSION['true'];
                
                if($false >= 7){

                    header("location:index.php?etat=lose");

                } elseif($true==strlen($mot)){

                    header("location:index.php?etat=win");
                    
                }

                ?>
                
                <a href="index.php">Recommencer</a>

            <?php
                    
            }elseif(!empty($_GET) && $_GET['etat']=='win'){

                $game->partieGagne($mot);
                

            }elseif(!empty($_GET) && $_GET['etat']=='lose'){

                $game->partiePerdue($mot);

            }
            
    ?>   
    </main>
    <a href=""></a>
</body>
</html>