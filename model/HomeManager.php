<?php
require_once __DIR__ . '/Manager.php';

class HomeManager extends Manager
{

    public function __construct()
    {
        $this->connection();
    }

    public function getProjects()
    {
        $bdd = $this->getPDO();
        $requete = $bdd->query('SELECT * FROM projects');
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getArticles()
    {
        $bdd = $this->getPDO();
        $requete = $bdd->query('SELECT * FROM articles');
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getWordpress()
    {
        $bdd = $this->getPDO();
        $requete = $bdd->query('SELECT * FROM wordpress');
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }
}
