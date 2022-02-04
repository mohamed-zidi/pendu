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

        <form action="" method="post">
            <label for="word">Entrer votre mot</label>
            <input type="text" name="word" id="word">

            <input type="submit" value="Envoyer" name="envoyer">
        </form>

        <?php
        $words=file("mots.txt");

        foreach($words as $word){
            echo $word.'</br>';
        }

        if(isset($_POST["envoyer"])){
            if(ctype_alpha($_POST["word"])){
                echo 1;
                $m = $_POST["word"];
                $fichier = file_put_contents('mots.txt', $m.PHP_EOL , FILE_APPEND | LOCK_EX);
                header("location:admin.php");
            } else{
                echo "Le mot choisi ne doit contenir uniquement des lettres.";
            }
        }
        ?>
    </main>
</body>
</html>