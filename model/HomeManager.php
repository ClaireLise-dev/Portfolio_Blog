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
        $requete = $bdd->query('SELECT * FROM projects ORDER BY id DESC');
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getArticles()
    {
        $bdd = $this->getPDO();
        $requete = $bdd->query('SELECT * FROM articles ORDER BY id DESC');
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getWordpress()
    {
        $bdd = $this->getPDO();
        $requete = $bdd->query('SELECT * FROM wordpress ORDER BY id DESC');
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }
}
