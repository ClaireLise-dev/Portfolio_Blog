<?php
class Manager
{
    protected function connection()
    {
        try {
            $bdd = new PDO('mysql:host=localhost;dbname=portfolio;charset=utf8', 'root', '');
            return $bdd;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
}