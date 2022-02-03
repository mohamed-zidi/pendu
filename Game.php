<?php

class Pendu 
{
    public $play;


    public function choseWord($fichier){
        if(!isset($_SESSION["word"])){
            $_SESSION["word"] = rtrim($fichier[array_rand($fichier)]);
        }
    }

    public function normalCharacter(){

    }
}