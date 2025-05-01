<?php 
require('Manager.php');
class HomeManager extends Manager{

    public function getProjects(){
        $bdd = $this->connection();
        $requete = $bdd->query('SELECT * FROM projects');
        return $requete;
    }

    public function getArticles(){
        $bdd = $this->connection();
        $requete = $bdd->query('SELECT * FROM articles');
        return $requete;
    }
}